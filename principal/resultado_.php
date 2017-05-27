<? 
session_start();
include("includes/header.php");
include("classes/banco.php");

$con = new DB();
$con2 = new DB();
$con3 = new DB();

$user = $_SESSION['usuario'];
$cursofeito = $_SESSION['curso'];

//Conclui o curso do  aluno 
$con3->upTab("alunoxcursos", "ac_concluido = 1", "ac_aluno = ".$user." and ac_curso = ".$cursofeito);
//

//nome do curso
$con->selTab("","cursos","nome_cur","id_cur = ".$cursofeito,"");
$nomecurso = mysql_fetch_array($con->resultado);
echo '<div style="margin:20px;font-size:12px;font-family:Arial, Helvetica, sans-serif">';
echo '<span style="font-size:22px;color:#F60">Curso '.$nomecurso[0]."</span></br></br>";
//

echo "Hoje:".date("d/m/Y")."</br></br>";
?>

<script>

largura = screen.width;

altura = screen.height-166;

document.write('<div style="float:left; width:50%; overflow:auto; height:'+altura+'px">');



</script>
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

echo '<div style="float:right; width:40%">';
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
	echo '<span style="font-size:16px">Porcentagem de acertos : '.arredondar($porcent).' %<br>';
	echo '<div style="font-size:14px; color:#03F;font-weight:bold">Parabens voce atingiu a nota necessaria. Passe na Secretaria e retire seu Comprovante de Conclusao de Curso</div>';
}elseif($porcent < 70){
echo "Porcentagem de acertos : ".arredondar($porcent)." %";
	echo '<div style="font-size:14px; color:#F00; ">Infelizmente voce nao atingiu a nota necessaria. Passe na Secretaria para tirar duvidas e marcar o exame Escrito</div>';
}
echo '</br><a href="logoff.php" style="font-size:18px">Clique aqui para sair</a>';
echo '</div>';
echo '</div>';
?>