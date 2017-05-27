<?
session_start();
include("checa_login.php");
include("includes/header.php");
include("classes/banco.php");
$con = new DB();
$dbcat = new DB();
$dbsubcat = new DB();
$con->selTab("","alunoxcursos, cursos"," * ","alunoxcursos.ac_aluno = ".$_SESSION["usuario"]." and cursos.id_cur = alunoxcursos.ac_curso","");
?>

<div style="width:100%; height:80px; text-align:center; background-image:url(imagens/bg_top.jpg)"><img src="imagens/logo.png" height="70" /><div style="width:45px; height:80px; background-color:#FFF; float:right"><a href="logoff.php" style="float:right">Sair<br />
<img src="../imagens/sair.jpg" width="40" title="Sair do Curso" style="float:right"/></a></div></div>
<div style="width:100%; height:32px; text-align:center; background-color:#5499c4 "> <img src="imagens/titulo.png" /></div>
<script>

largura = screen.width;
altura = screen.height-166;

document.write('<div style="background-image:url(imagens/bg.jpg); height:100%; width:100%; background-position:top; background-size:'+largura+'px '+altura+'px;background-repeat:no-repeat;">');
</script>
<div style="margin:0 auto; width:600px; height:100%; background-image:url(imagens/logo_bg.png); background-repeat:no-repeat; background-position:top;">

<?
while($cursos = mysql_fetch_array($con->resultado)){

$concluido = $cursos["ac_concluido"];
$nomecurso = $cursos["nome_cur"];
///////////


//Menu Principal//
$dbcat->selTab("","categoria"," * ", "cat_curso = ".$cursos["id_cur"],"cat_ordem");
$categorias = mysql_fetch_array($dbcat->resultado);
$nu = mysql_num_rows($dbcat->resultado);
if($nu > 0){
	$nomecat = $categorias["cat_nome"];
	$idcategoria = $categorias["cat_id"];
	$dbsubcat->selTab("","subcategoria"," * ", "sub_cat = ".$idcategoria,"sub_ordem");
	
	
	$principal = mysql_fetch_array($dbsubcat->resultado);	
	$subnome = $principal['sub_nome'];

	$linkprincipal = 'curso.php?curso='.$cursos["id_cur"].'&cat='.$principal['sub_cat'].'&subcat='.$principal['sub_id'].'&nome='.$nomecurso.'&nomecat='.$nomecat.'&subnome='.$subnome;
	}


////////////
if($concluido == 1){
echo '<div class="cursos">
<a href="#" style="display:inline;"><img src="imagens/Check.png" style="position:absolute;"><img src="'.$cursos["img_cur"].'" /><br /><div style="height:20px">'.$cursos["nome_cur"].'</div>

</a>
</div>';
}
else{
echo '<div class="cursos">
<a href="'.$linkprincipal.'" style="display:inline"><img src="'.$cursos["img_cur"].'" /><br /><div style="height:20px">'.$cursos["nome_cur"].'</div>

</a>
</div>';	
	}
}
?>
</div>
</div>