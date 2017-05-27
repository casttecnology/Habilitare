<?
include("classes/banco.php");
$con = new DB();
$con->selTab("","cursos"," img_cur ","id_cur = ".$_GET["curso"],"");
$cur = mysql_fetch_array($con->resultado);

$imagem = $cur[0];


header("Content-type:image/jpeg");

echo $imagem;   
?>