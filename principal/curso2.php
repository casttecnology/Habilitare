<?

session_start();
include("includes/header.php");
include("classes/banco.php");
$cursoid = $_SESSION["curso"];
//////Gravacao historico

$con = new DB();
$con2 = new DB();
$con3 = new DB();

$user = $_SESSION['usuario'];
$cursofeito = $_SESSION['curso'];

///////////

//nome do curso
$con->selTab("","cursos","nome_cur","id_cur = ".$cursofeito,"");
$nomecurso = mysql_fetch_array($con->resultado);
echo '<div style="margin:20px;font-size:12px;font-family:Arial, Helvetica, sans-serif">';
//

$dbcurso = new DB();

$dbcurso->selTab("","cursos","*", "id_cur = ".$cursoid,"");

$imgcurso = mysql_fetch_array($dbcurso->resultado);

$contapag = new DB();
?>

<script type="text/javascript" src="includes/ajax.js"></script>


<div style="width:100%; height:80px; text-align:center; background-image:url(imagens/bg_top.jpg)"><img src="imagens/logo.png" height="70" /></div>

<div style="width:100%; height:35px; text-align:center; background-color:#5499c4">

<a href="#" id="menudiv" style="color:#1A6FA8;"><img src="imagens/menu_up.jpg" /></a><img src="imagens/titulo.png" /><a href="index2.php"><img src="imagens/home_up.jpg" /></a></div>

<div style="margin:auto; width:1064px;">

<div id="crom" style="color:#FFF; display:none">1</div>

</div>

<script>

largura = screen.width;

altura = screen.height-166;

document.write('<div style="background-image:url(imagens/bg.jpg); height:100%; width:100%; background-position:top; background-size:'+largura+'px '+altura+'px;background-repeat:no-repeat;">');



</script>



<style>

#bgBody{background-color:#333}

</style>



<div style="background-image:url(imagens/bg_titulo.png); width:1101px; height:67px; margin:auto">

<div id="caminhopao" style="margin-bottom:10px; height:30px;">

    <div style="margin-left:20px; color:#362590; font-size:30px; font-style:italic; font-weight:600; font-family:Arial, Helvetica, sans-serif; padding-top:5px; text-align:center"><div style="margin-top:10px; width:900px; float:left"><?=$imgcurso["nome_cur"]?></div><div style="float:right; margin-top:-10px; margin-right:15px"><img height="68px" src="<?=$imgcurso["img_cur"]?>" /></div></div>

    </div></div>

    

<div style="margin:auto; height:612px; width:1064px; background-image:url(imagens/bg_curso.png); background-repeat:no-repeat;">







<div style="color:#FFFFFF; font-size:18px; float:right; width:410px; margin-right:20px; text-align:center"><?=$titulosub?></div>
<div style="width:550px; float:right; margin:20px; height:520px;overflow:auto; color:#FFF; border-left:1px solid #FFF; padding-left:10px">

<?
$con3->selTab("","categoria","*","cat_curso= ".$cursofeito,"cat_ordem");
while($cats = mysql_fetch_array($con3->resultado)){
	
$idcat = $cats["cat_id"];
$nomecat = $cats["cat_nome"];

echo "<b>".$nomecat."</b><br>";

$con2->selTab("","resultado_aluno,testes ","distinct re_pergunta,re_resposta,te_pergunta,te_respcorreta, max(re_hora)","re_aluno = ".$user." and te_curso = ".$idcat." and te_id = re_pergunta group by re_pergunta","te_ordem asc, re_data asc, re_hora asc");

$numresp = mysql_num_rows($con2->resultado);
//echo $numresp;
	if($numresp <> 0){
		while($perguntas = mysql_fetch_array($con2->resultado)){
			
			$pergunta = $perguntas['re_pergunta'];
			$resposta = $perguntas['re_resposta'];
			//$dia = $perguntas[5];
			$questiontrue = $perguntas['te_pergunta'];
			$respostacorreta = $perguntas['te_respcorreta'];
			//$categoria = $perguntas["cat_nome"];
			
				if($resposta == $respostacorreta){
				echo $questiontrue.' <img src="imagens/visitado.png" height="10px"><br>';
				}else
				{
				echo $questiontrue.' <img src="imagens/deletar.jpg" height="10px"><br>';
				}
		}
	}else{echo "Nenhuma pergunta respondida<br>";}
echo "</br>";
}
echo '</div>';

echo '<div style="float:left; width:300px; margin:20px;color:#FFF">';
$con->selTab("","resultado_aluno,testes,categoria","distinct re_pergunta,re_resposta,te_pergunta,te_respcorreta, max(re_hora)","re_aluno = ".$user." and cat_id = te_curso and te_id = re_pergunta group by re_pergunta","re_data asc");


$p_pos = 0;
$p_neg = 0;
$p_total = 0;
while($dados = mysql_fetch_array($con->resultado)){
$dados[0]."-";
$cat = $dados[1];
$aluno = $dados[2];
$pergunta = $dados[3];
$resposta = $dados["re_resposta"];
$dia = $dados[5];
$questiontrue = $dados[8];
$respostacorreta = $dados["te_respcorreta"];

$p_total = $p_total + 1;
if($resposta == $respostacorreta){
	$p_pos = $p_pos + 1;
}
elseif($resposta <> $respostacorreta){
	$p_neg = $p_neg + 1;
}
}

function arredondar($valor) { 
    $float_arredondado=round($valor * 100) / 100; 
    return $float_arredondado; 
 }

$porcent = ($p_pos * 100)/$p_total;
echo '<span style="font-size:16px">Voc&ecirc; acertou: '.$p_pos.' de '.$p_total.'</span><br>';


$porcent = arredondar($porcent);
if($porcent >= 70){
	echo '<span style="font-size:16px;color:#FFF">Porcentagem de acertos : '.arredondar($porcent).' %<br>';
	echo '<div style="font-size:14px; color:#FFF;font-weight:bold">Parab&eacute;ns voce atingiu a nota necessaria. Passe na Secretaria e retire seu Comprovante de Conclusao de Curso</div>';
}elseif($porcent < 70){
echo "Porcentagem de acertos : ".arredondar($porcent)." %";
	echo '<div style="font-size:14px; color:#FFF">Infelizmente voce nao atingiu a nota necessaria. Passe na Secretaria para tirar duvidas e marcar o exame Escrito</div>';
}

echo '</div>';
echo '</div>';
?>



            <div id="texto" <?=$sometexto?>>

              <?=$aula["sub_texto"]?>

            </div>            


            </div>

</div>