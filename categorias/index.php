<?
include("../checa_login.php");
if($_SESSION["bt3"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();
$con2 = new DB();
$con->selTab("","categoria"," * ","","");
?>

<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="cad_categoria.php?acao=novo">Novo<br />
<img src="../imagens/novo_curso.png" width="50" title="Novo" /></a>
</td>
</table>
<form style="padding-top: 140px;">
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Categorias</legend>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:5%">ID</th>
<th style="width:75%">Nome</th>
<th style="width:5%">Curso</th>
<th style="width:5%">Editar</th>
<th style="width:5%">Deletar</th>


<?
		while($categorias = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="center">'.$categorias["cat_id"].'</td>
			<td>'.$categorias["cat_nome"].'</td><td align="center">';

			$con2->selTab("","cursos"," img_cur, nome_cur ","id_cur = ".$categorias["cat_curso"],"");
			$img = mysql_fetch_array($con2->resultado);

			echo '<img src="'.$img[0].'" width="40px" title="'.$img[1].'"/>';




			echo '</td><td style="text-align:center"><a href="cad_categoria.php?categoria='.$categorias["cat_id"].'&acao=editar"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deleta('.$categorias["cat_id"].')"><img src="../imagens/deletar.jpg"></a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
