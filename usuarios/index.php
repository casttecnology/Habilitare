<?
include("../checa_login.php");
if($_SESSION["bt5"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");

$con = new DB();
$con2 = new DB();

$pesquisa = $_GET["pesq"];
if($pesquisa <> ""){
//$proc = "al_nome like '%".$pesquisa."%' OR  al_cpf like '%".$pesquisa."%'";
}
$con->selTab("","usuarios"," * ",$proc,"");

?>
<form action="index.php" method="get" style="padding-top: 150px;">
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<!--<td style="text-align:center; width:50px" align="right">Pesquisar : <input type="text" id="pesq" name="pesq" title="Digite o Nome ou CPF" />&nbsp;<input type="submit" value="Procurar"  /></td>-->
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="cad_usuarios.php?acao=novo">Novo<br />
<img src="../imagens/novo_aluno.png" width="50" title="Novo" /></a>
</td>
</tr>
</table>
</form>

<form>
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Usu&aacute;rios</legend>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:5%">ID</th>
<th style="width:30%">Usuario</th>
<th style="width:40%">Senha</th>
<th style="width:5%">Editar</th>
<th style="width:5%">Deletar</th>


<?
		while($usuarios = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="center">'.$usuarios["Id"].'</td>
			<td>'.$usuarios["usuario"].'</td>
			<td>'.$usuarios["senha"].'</td>';
		echo '</td><td style="text-align:center"><a href="cad_usuarios.php?acao=editar&usuario='.$usuarios["Id"].'"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deleta('.$usuarios["Id"].')"><img src="../imagens/deletar.jpg"></a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
