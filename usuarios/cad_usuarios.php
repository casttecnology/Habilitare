<?
include("../checa_login.php");
if($_SESSION["bt5"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();

if($_GET["acao"] == "editar")
{
$con->selTab("","usuarios"," * ","Id = ".$_GET["usuario"],"");
$cat = mysql_fetch_array($con->resultado);
}


$con2 = new DB();
$con2->selTab("","usuarios"," * ","","");

?>
<link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>
</table>

<form id="formulario" name="formulario" style="padding-top: 150px;">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Usuarios</legend>

<table class="lista">
<tr><td>Codigo:</td><td><?=$_GET["usuario"]?><input type="hidden" id="codigo" name="codigo" value="<?=$_GET["usuario"]?>" disabled="disabled" title="Codigo de cadastro do Usuario"></td></tr>

<tr><td>Usuario:</td><td><input type="text" name="usuarios" id="usuario" value='<?=$cat["usuario"]?>' style="width:300px" title="Digite o Usuario"/></td></tr>
<tr><td>Senha:</td><td><input type="text" name="senha" id="senha" value='<?=$cat["senha"]?>' style="width:300px" title="Digite a senha do usuario"/></td></tr>
<tr><td></td><td></br>Acessos do usuarios:</td></tr>
<tr><td></td><td><input type="checkbox" id="alunos" <? if($cat["bt1"] == 1){ echo "checked";}?> /><label for="alunos">Alunos</label></td></tr>
<tr><td></td><td><input type="checkbox" id="cursos"  <? if($cat["bt2"] == 1){ echo "checked";}?>/><label for="cursos">Cursos</label></td></tr>
<tr><td></td><td><input type="checkbox" id="categorias"  <? if($cat["bt3"] == 1){ echo "checked";}?>/><label for="categorias">Categorias</label></td></tr>
<tr><td></td><td><input type="checkbox" id="subcategorias"  <? if($cat["bt4"] == 1){ echo "checked";}?> /><label for="subcategorias">Subcategorias</label></td></tr>
<tr><td></td><td><input type="checkbox" id="usuarios" <? if($cat["bt5"] == 1){ echo "checked";}?> /><label for="usuarios">Usuarios</label></td></tr>
<tr><td></td><td><input type="checkbox" id="financeiro" <? if($cat["bt6"] == 1){ echo "checked";}?> /><label for="financeiro">Financeiro</label></td></tr>

</td></tr>
<tr><td></td><td><input type="button" value="Cadastrar" onclick="javascript:cadUsuario()" /></td></tr>
</table>
<input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />

</fieldset></form>
<iframe id="local" name="local" frameborder="0" width="100%" height="500"></iframe>
</body>
</html>
<? } ?>
