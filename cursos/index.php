<?
include("../checa_login.php");
if($_SESSION["bt2"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();

$pesquisa = $_GET["pesq"];
if($pesquisa <> ""){
$proc = "al_nome like '%".$pesquisa."%' OR  al_cpf like '%".$pesquisa."%'";
}

$con->selTab("","cursos"," * ","","");
?>
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="text-align:right; width:50px" align="right">Pesquisar : <input type="text" id="pesq" name="pesq" title="Digite o Nome ou CPF" />&nbsp;<input type="submit" value="Procurar"  /></td>
<td style="width:1%"></td>
<td style="text-align:center; width:100px" align="right"><a href="cad_curso.php?acao=novo">Novo<br />
<img src="../imagens/novo_curso.png" width="20" title="Novo" /></a>
</td>
</table>
<form style="padding-top: 140px;">
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cursos</legend>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:5%">ID</th>
<th style="width:75%">Curso</th>
<th style="width:5%">Ico.</th>
<th style="width:5%">Editar</th>
<th style="width:5%">Deletar</th>


<?
		while($cursos = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="center">'.$cursos["id_cur"].'</td>
			<td>'.$cursos["nome_cur"].'</td>
			<td align="center"><img src="'.$cursos["img_cur"].'" width="40px"/></td>
			<td style="text-align:center"><a href="cad_curso.php?acao=editar&curso='.$cursos["id_cur"].'"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deleta('.$cursos["id_cur"].')"><img src="../imagens/deletar.jpg"></a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
