<?
include("includes/header.php");
include("classes/banco.php");
$con = new DB();
$con->selTab("","cursos"," * ","","");
?>

<div style="margin:0 auto; width:600px; height:100%; background-color:#fff">
<div style="font-size:12px; font-weight:bold"><img src="imagens/logo.jpg"  width="100px"/>&nbsp;&nbsp;&nbsp;Habilitare - Cursos Profissionais . Seguran&ccedil;a do Trabalho</div>
<?
while($cursos = mysql_fetch_array($con->resultado)){
	

?>

<div class="cursos">
<a href="curso.php?curso=<?=$cursos["id_cur"]?>&nome=<?=$cursos["nome_cur"]?>"><div style="height:20px"><?=$cursos["nome_cur"]?></div><br />
<img src="<?=$cursos["img_cur"]?>" width="150px" />
</a>
</div>

<?
}
?>
