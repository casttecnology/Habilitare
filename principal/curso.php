<?

session_start();
$_SESSION["curso"] = $_GET['curso'];

include("includes/header.php");

include("classes/banco.php");

//////Gravacao historico

$dbhist = new DB();

$dbtest = new DB();

$dbhist->insTab("historico_aluno", "his_aluno,his_cat,his_sub,his_data,his_hora", $_SESSION["usuario"].", ".$_GET["cat"].",".$_GET["subcat"].",'".date("Y-m-d")."','".date("H:i:s")."'");

///////////

$dbcurso = new DB();

$dbcurso->selTab("","cursos","img_cur", "id_cur = ".$_GET['curso'],"");

$imgcurso = mysql_fetch_array($dbcurso->resultado);

$contapag = new DB();
?>

<script type="text/javascript" src="includes/ajax.js"></script>

<div id="boxteste" style="position:fixed; width:100%; height:100%; display:none; ">

<div style="width:98%; height:690px; background-color: #DDD; margin:0 auto; margin-top:120px; color:#0066FF;box-shadow:0px 0px 450px 3px #000;"><div style="font-family:Arial, Helvetica, sans-serif; font-size:18px; font-weight:bold; float:right; color:#666;"><a onclick="fechaBox()">Fechar X</a></div>
<?
$dbvideos = new DB();
$dbvideos->selTab("","embeds","*", "emb_cat = ".$_GET['cat'],"");
$contvideos = mysql_num_rows($dbvideos->resultado);

if($contvideos > 0)
{


?>
<div id="boxvideo" style="width:98%; height:100%; z-index:2000; position:fixed; background-color: #DDD; margin-top:20px">
<div id="embeds" style="height:60%; width:100%; float:left; background:#000 " ></div>
<div id="miniaturas" style="height:30%; width:100%; float:left; background: #C06; text-align:center; overflow:auto;" >
<div style="margin:0 auto; width:auto;white-space: nowrap;">
<?

while($videos = mysql_fetch_array($dbvideos->resultado)){
echo "<a style='float:left; margin-left:10px; margin-top:10px' href='#' name='".$videos["emb_link"]."' onclick='javascript:cria_player(this)'><img style='height:100px' src='../imagens/videos/".$videos["emb_miniatura"]."' /></a>";
}
?>
<input type="button" value="Continuar" onclick="javascript:cria_player(this)" name="fecha" style="padding:5px; float:left; margin-left:50px; margin-top:5px; font-size:16px" />
</div>
</div>
</div>
<?
}
?>


<input type="hidden" id="questao" value="0" />

<input type="hidden" id="categoria" value="<?=$_GET["cat"]?>" />

<input type="hidden" id="ordem" value="0" />

<div id="titulo" style="font-size:20px;  padding:20px 0px 0px 20px; color:#666666;"><div style="font-size:16px;  padding:0px 5px 5px 10px; color:#666666; float: right"></div></div>

<div id="perguntas">

</div>
<div id="imgtestes" style="float:right; height:300px; width:40%; margin-right:20px">&nbsp;</div>
<div id="respostas" style="height:400px">

        <div style="font-size:16px; padding:20px 0px 30px 50px"><label for="resposta1"><input type="radio" value="pergunta1" id="resposta1" name="resposta" /> </label></div>

        <div style="font-size:16px; padding:20px 0px 30px 50px"><label for="resposta2"><input type="radio" value="pergunta1" id="resposta2" name="resposta" /> </label></div>

        <div style="font-size:16px; padding:20px 0px 30px 50px"><label for="resposta3"><input type="radio" value="pergunta1" id="resposta3" name="resposta" /></label></div>

        <div style="font-size:16px; padding:20px 0px 30px 50px"><label for="resposta4"><input type="radio" value="pergunta1" id="resposta4" name="resposta" /> </label></div>

        </div>

        <hr />

      <input type="button" value="Continuar" onclick="gravaQuestao()" style="padding:5px; float:left; margin-left:50px; margin-top:5px; font-size:16px" /><span style="float:right; font-size:16px; margin-right:20px"><div id="pagquestao"></div></span>

</div>

</div><!--/*fimboxteste*/-->



<div style="width:100%; height:80px; text-align:center; background-image:url(imagens/bg_top.jpg)"><img src="imagens/logo.png" height="70" /><div style="width:45px; height:80px; background-color:#FFF; float:right"><a href="logoff.php" style="float:right">Sair<br />
<img src="../imagens/sair.jpg" width="40" title="Sair do Curso" style="float:right"/></a></div></div>

<div style="width:100%; height:35px; text-align:center; background-color:#5499c4">

<a href="#" id="menudiv" onclick="javascript:mostraMenu()" onblur="javascript:saiMenu()" style="color:#1A6FA8;"><img src="imagens/menu.jpg" /></a><img src="imagens/titulo.png" /><a href="index2.php"><img src="imagens/home_up.jpg" /></a></div>

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

    <div style="margin-left:20px; color:#362590; font-size:30px; font-style:italic; font-weight:600; font-family:Arial, Helvetica, sans-serif; padding-top:5px; text-align:center"><div style="margin-top:10px; width:900px; float:left"><?=$_GET['nome']?></div><div style="float:right; margin-top:-10px; margin-right:15px"><img height="68px" src="<?=$imgcurso["img_cur"]?>" /></div></div>

    </div></div>



<div style="margin:auto; height:612px; width:1064px; background-image:url(imagens/bg_curso.png); background-repeat:no-repeat;">



<div style="width:1064px; margin:auto; height:40px;"><br />

    <ul id="menu" style="display:none; position:fixed">
<?

function maiuscula($letras)
{ return strtoupper($letras);}

function maiusculap($letras)
{ return ucwords($letras);}

$dbcat = new DB();
$dbsubcat = new DB();

//Menu Principal//
$dbcat->selTab("","categoria"," * ", "cat_curso = ".$_GET['curso'],"cat_ordem");
while($categorias = mysql_fetch_array($dbcat->resultado)){

	$nomecat = $categorias["cat_nome"];

	$idcategoria = $categorias["cat_id"];

	$dbtest->selTab("1", "testes", "te_id", "te_curso = ".$categorias["cat_id"],"");

	$teste = mysql_num_rows($dbtest->resultado);
	$linkteste = '';
	$btteste = '';

	if($teste > 0)

	{

	$linkteste = '#';
	$btteste = '<a href="'.$linkteste.'" onclick=\'carregaQuestao()\'>Avaliacao</a>';

		}

	$dbhist->selTab("1", "historico_aluno", "his_id", "his_aluno = ".$_SESSION["usuario"]." and his_cat = ".$idcategoria ,"");

		 $visitou = mysql_fetch_array($dbhist->resultado);

		 if($visitou[0] <> ""){

			 $imagem = '<img src="imagens/visitado.png" align="right">';

		 }else{$imagem = "";}

$dbsubcat->selTab("","subcategoria"," * ", "sub_cat = ".$categorias["cat_id"],"sub_ordem");
$principal = mysql_fetch_array($dbsubcat->resultado);
$subnome = $principal['sub_nome'];

$linkprincipal = '../principal/curso.php?curso='.$_GET['curso'].'&cat='.$principal['sub_cat'].'&subcat='.$principal['sub_id'].'&nome='.$_GET['nome'].'&nomecat='.$nomecat.'&subnome='.$subnome;

		 echo '<li><a href="'.$linkprincipal.'" >'.maiuscula($nomecat).$imagem.'</a>';
		 $dbsubcat->selTab("","subcategoria"," * ", "sub_cat = ".$categorias["cat_id"],"sub_ordem");
		 $num_sub = mysql_num_rows($dbsubcat->resultado);
		 if($num_sub == 0)
		 {
			 echo "</li>";
		 }
		 else{
			 for($i=0; $i < $num_sub; $i++){
				 $subcategorias = mysql_fetch_array($dbsubcat->resultado);
				 if($i == 0){

					echo '<ul>';

				 }

				 if($i < $num_sub){

					$subnome = $subcategorias['sub_nome'];

					$dbhist->selTab("1", "historico_aluno", "his_id", "his_aluno = ".$_SESSION["usuario"]." and his_sub = ".$subcategorias["sub_id"] ,"");

		 $visitou = mysql_fetch_array($dbhist->resultado);

		 if($visitou[0] <> ""){

			 $imagem = '<img src="imagens/visitado.png" align="right">';

		 }else{$imagem = "";}



$link = '../principal/curso.php?curso='.$_GET['curso'].'&cat='.$subcategorias['sub_cat'].'&subcat='.$subcategorias['sub_id'].'&nome='.$_GET['nome'].'&nomecat='.$nomecat.'&subnome='.$subnome;



				 echo '<a href="'.$link.'">'.$subnome.$imagem.'</a>';

				 }
				 if($i+1 == $num_sub){

					echo $btteste;

					 echo '</ul></li>';
				 }
			 }
		 }
	}

?>

    </ul>

<?
//Fim Menu principal

if($_GET["subcat"]){



$consub = new DB();

$consub->selTab("","subcategoria"," * ", "sub_id = ".$_GET["subcat"],"sub_ordem");

$aula = mysql_fetch_array($consub->resultado);

$imagemSwf = $aula["sub_img"];


$ordenado  = $aula["sub_ordem"];

$subfull  = $aula["sub_full"];

	if($subfull == "sim"){

	$swfW = "1050";

	$sometexto = 'style="display:none"';



	}else{

		$swfW = "550";

		$titulosub = $_GET["subnome"];
		$sometexto = 'style=" height:400px"';

		}

}

?>

</div>

<div style="float:left; margin-left:40px; width:540px">

<?
				if($_GET["curso"] <> "" and $_GET["cat"] == "")

				{

				$dbsubcat->selTab("","subcategoria"," * ", "sub_cat = ".$idcategoria,"sub_ordem");

				$dados = mysql_fetch_array($dbsubcat->resultado);

				$imagemSwf = $dados["sub_img"];

				}
$pieces = explode(".", $imagemSwf);
if($_GET["subcat"] && $pieces[3] == "swf"){

if($pieces[3] == "swf"){
?>

<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="<?=$swfW?>" height="450" id="pa_carregadeira" align="middle">

				<param name="movie" value="<?=$imagemSwf?>" />

				<param name="quality" value="high" />

				<param name="bgcolor" value="#ffffff" />

				<param name="play" value="true" />

				<param name="loop" value="true" />

				<param name="scale" value="showall" />

				<param name="menu" value="true" />

				<param name="devicefont" value="false" />

				<param name="salign" value="" />

				<param name="allowScriptAccess" value="sameDomain" />

                <param name="wmode" value="transparent" />

				<!--[if !IE]>-->

				<object type="application/x-shockwave-flash" data="<?=$aula["sub_img"]?>" width="<?=$swfW?>" height="450">

					<param name="movie" value="<?=$imagemSwf?>" />

					<param name="quality" value="high" />

					<param name="bgcolor" value="#ffffff" />

					<param name="play" value="true" />

					<param name="loop" value="true" />

<param name="wmode" value="transparent" />

					<param name="scale" value="showall" />

					<param name="menu" value="true" />

					<param name="devicefont" value="false" />

					<param name="salign" value="" />

					<param name="allowScriptAccess" value="sameDomain" />

				<!--<![endif]-->

					<a href="http://www.adobe.com/go/getflash">

						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obter Adobe Flash Player" />

					</a>

				<!--[if !IE]>-->

				</object>

				<!--<![endif]-->

			</object>

            <?
			}}
elseif($pieces[3] == "mp4"){
   $mudaheight = ($swfW - 210);
   echo '<video src="'.$imagemSwf.'" autoplay controls width="'.$mudaheight.'"></video>';
   }
			else{

if($pieces[3] == "swf"){

				?>
                <div style="float:left; margin-left:-110px; width:540px">
				<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="1200" height="540" id="pa_carregadeira" align="middle">

				<param name="movie" value="help.swf" />

				<param name="quality" value="high" />

				<param name="bgcolor" value="#ffffff" />

				<param name="play" value="true" />

				<param name="loop" value="true" />

				<param name="scale" value="showall" />

				<param name="menu" value="true" />

				<param name="devicefont" value="false" />

				<param name="salign" value="" />

				<param name="allowScriptAccess" value="sameDomain" />

                <param name="wmode" value="transparent" />

				<!--[if !IE]>-->

				<object type="application/x-shockwave-flash" data="<?=$aula["sub_img"]?>" width="1200" height="540">

					<param name="movie" value="help.swf" />

					<param name="quality" value="high" />

					<param name="bgcolor" value="#ffffff" />

					<param name="play" value="true" />

					<param name="loop" value="true" />

<param name="wmode" value="transparent" />

					<param name="scale" value="showall" />

					<param name="menu" value="true" />

					<param name="devicefont" value="false" />

					<param name="salign" value="" />

					<param name="allowScriptAccess" value="sameDomain" />

				<!--<![endif]-->

					<a href="http://www.adobe.com/go/getflash">

						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obter Adobe Flash Player" />

					</a>

				<!--[if !IE]>-->

				</object>

				<!--<![endif]-->

			</object>
            </div>
				<?

				}
				}

			?>

</div>

<div style="color:#FFFFFF; font-size:18px; float:right; width:410px; margin-right:20px; text-align:center"><?=$titulosub?></div>

            <div id="texto" <?=$sometexto?>>

              <?=$aula["sub_texto"]?>

            </div>


            <div id="controle">

<?
if($_GET["subcat"]){

$contapag->selTab("","subcategoria", "sub_id","sub_cat=".$_GET['cat'],"sub_ordem desc");

$num = mysql_num_rows($contapag->resultado);

$cc = $num;

while($dado = mysql_fetch_array($contapag->resultado)){

if($dado[0] == $_GET["subcat"])

{

	break;

}else

{

$cc--;

}

}

?>

<span style="font-size:14px; margin-right:20px; color:#FFF">Pagina <? echo $cc." de ".$num?></span>

<form action="curso.php" method="post">

<?

$co = new DB();

if($ordenado > 1){

	$anterior = $ordenado-2;

}

if($ordenado < 1){

$anterior = $ordenado-1;

}

$proximo = 3;

if($anterior < 1){$anterior = 0;}

$co->selTab(($anterior).",".($proximo),"subcategoria", "sub_id,sub_ordem, sub_nome, sub_cat","sub_curso=".$_SESSION["curso"],"sub_ordem asc");

$num_reg = mysql_num_rows($co->resultado);

$cont = 0;

while($d = mysql_fetch_array($co->resultado))
{
		$link = 'href="../principal/curso.php?curso='.$_GET['curso'].'&cat='.$d['sub_cat'].'&subcat='.$d["sub_id"].'&nome='.$_GET['nome'].'&nomecat='.$nomecat.'&subnome='.$d["sub_nome"].'"';

if($cont == 0)

	{$aux = $d['sub_ordem'];}

	$cont++;

	if($num_reg == 3 && $ordenado == 1)

	{

		if($cont == 2)

		{

			echo '<a id="btproximo" '.$link.'><img src="imagens/proximo.jpg" /></a>'."&nbsp;&nbsp;&nbsp;&nbsp;";

			//echo 'primeiro';

		}

	}

	if($num_reg == 2)

	{

		if($cont == 1)

		{

		$teste = 0;
		//Verifica se existem testes
		$dbtest->selTab("1", "testes", "te_id", "te_curso = ".$_GET["cat"],"");
		$teste = mysql_num_rows($dbtest->resultado);


		if($teste > 0)

		{

		$funcao = ' onclick=\'carregaQuestao()\'';

		$link = "href='#'";
		$lugar = '<img src="imagens/proximo.jpg" />';

		}else{
			$lugar = '<img src="imagens/anterior.jpg" />';
			}

			echo '<a '.$link.$funcao.'>'.$lugar.'</a>'."&nbsp;&nbsp;&nbsp;&nbsp;";

			//echo 'ultimo';

		}

	}

	if($num_reg == 3 && $ordenado > 1)

	{

	//echo "anterior e proximo";

		if($cont == 1)

		{

			echo '<a '.$link.'><img src="imagens/anterior.jpg" /></a>'."&nbsp;&nbsp;&nbsp;&nbsp;";

		}

		else if($cont == 3)

		{

		$teste = 0;

		if($d["sub_cat"] <> $_GET["cat"])

		{

		$dbtest->selTab("1", "testes", "te_id", "te_curso = ".$_GET["cat"],"");

		$teste = mysql_num_rows($dbtest->resultado);

		}

		if($teste > 0)

		{

		$funcao = ' onclick=\'carregaQuestao()\'';

		$link = "href='#'";

		}

		echo '<a id="btproximo" '.$link.$funcao.'><img  src="imagens/proximo.jpg" /></a>'."&nbsp;&nbsp;&nbsp;&nbsp;";

		}
	}
}

}

?>

</form>
<script>
var aula = '<?=$aula['sub_nome']?>';
var tempo = '<? echo ($aula['sub_tempo']*1000) ?>';

function tempoAula(){
document.getElementById("menudiv").style.visibility = "visible";
document.getElementById("btproximo").style.visibility = "visible";
}
setTimeout("tempoAula()",tempo);


document.getElementById("menudiv").style.visibility = "hidden";
document.getElementById("btproximo").style.visibility = "hidden";
</script>
            </div>
</div>

</div>
