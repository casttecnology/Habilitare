<?
include("../checa_login.php");
if($_SESSION["bt4"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();
$con2 = new DB();

$pesquisa = $_GET["pesq"];
if($pesquisa <> ""){
$proc = "sub_nome like '%".$pesquisa."%'";
}
$con->selTab("","subcategoria"," * ",$proc,"");
?>

<form action="index.php" method="get" style="padding-top: 150px;">
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="text-align:center; width:50px" align="right">Pesquisar : <input type="text" id="pesq" name="pesq" title="Digite o Nome ou CPF" />&nbsp;
<input type="submit" value="Procurar"  /></td>
<td style="width:70%"></td>
<td style="text-align:center; width:50px" align="right"><a href="cad_subcategoria.php?acao=novo">Novo
<img src="../imagens/novo_curso.png" width="50" title="Novo" /></a>
</td>
</tr>
</table>
</form>

<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">SubCategorias</legend>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:5%">ID</th>
<th style="width:75%">SubCategoria</th>
<th style="width:5%" title="Categoria">Cat.</th>
<th style="width:5%">Editar</th>
<th style="width:5%">Deletar</th>


<?
		while($subcategorias = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="center">'.$subcategorias["sub_id"].'</td>
			<td>'.$subcategorias["sub_nome"].'</td><td>';

			$con2->selTab("","cursos, categoria"," img_cur, nome_cur,  cat_nome ","cat_id = ".$subcategorias["sub_cat"]." and cat_curso = id_cur","");
			$img = mysql_fetch_array($con2->resultado);

			echo '<img src="'.$img[0].'" width="40px" title="'.$img[1]." - ".$img[2].'"/>';



			echo '</td><td style="text-align:center"><a href="cad_subcategoria.php?acao=editar&subcategoria='.$subcategorias["sub_id"].'"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deleta('.$subcategorias["sub_id"].')"><img src="../imagens/deletar.jpg"></a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
