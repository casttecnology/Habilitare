<?
include("../checa_login.php");
if($_SESSION["bt3"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();
$con3 = new DB();

if($_GET["acao"] == "editar")
{
$con->selTab("","categoria"," * ","cat_id = ".$_GET["categoria"],"");
$cat = mysql_fetch_array($con->resultado);
}

$con2 = new DB();
$con2->selTab("","cursos"," * ","","");
?>
    <link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />


<table border="0" style="font-size:10px; float:right; width:100%"><tr>

<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>

<td style="width:90%"></td>
</table>
<form>
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Categorias</legend>

<table class="lista"> 
<tr><td>Codigo:</td><td><?=$_GET["categoria"]?><input type="hidden" id="codigo" name="codigo" value="<?=$_GET["categoria"]?>"></td></tr>
<tr><td>Curso:</td><td><select id="curso" name="curso">
<?
		echo "<option value='0'>Selecione...</option>";
		while($cursos = mysql_fetch_array($con2->resultado))
		{
			if($cat["cat_curso"] == $cursos["id_cur"]){
				echo "<option value='".$cursos["id_cur"]."' selected='selected'>".$cursos["nome_cur"]."</option>";
			}else
			{
				echo "<option value='".$cursos["id_cur"]."'>".$cursos["nome_cur"]."</option>";
			}
		}
?>
</select></td></tr>
<tr><td>Categoria:</td><td><input type="text" name="categoria" id="categoria" value='<?=$cat["cat_nome"]?>' style="width:300px"/></td></tr>
<tr><td></td><td><input type="button" value="Cadastrar" onclick="javascript:cadCategoria()" /></td></tr>
</table>
<input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />

</fieldset></form>
<?
if($_GET["acao"] == "editar"){

?>
<form enctype="multipart/form-data" action="sqls2.php" method="post" target="cadastra">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Testes</legend>

<table class="lista"> 
<tr><td>Pergunta:</td><td><input type="text" name="pergunta" id="pergunta" value='<?=$te["te_pergunta"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
<tr><td>Resposta 1:</td><td><input type="text" name="resposta1" id="resposta1" value='<?=$te["te_resp1"]?>' style="width:300px" title="Digite a Resposta 1"/></td></tr>
<tr><td>Resposta 2:</td><td><input type="text" name="resposta2" id="resposta2" value='<?=$te["te_resp2"]?>' style="width:300px" title="Digite a Resposta 2"/></td></tr>
<tr><td>Resposta 3:</td><td><input type="text" name="resposta3" id="resposta3" value='<?=$te["te_resp3"]?>' style="width:300px" title="Digite a Resposta 3"/></td></tr>
<tr><td>Resposta 4:</td><td><input type="text" name="resposta4" id="resposta4" value='<?=$te["te_resp4"]?>' style="width:300px" title="Digite a Resposta 4"/></td></tr>
<tr><td>Imagem:</td><td><input type="file" name="img" id="img" style="width:300px" title="Selecione a imagem"/></td></tr>
<tr><td>Digite o n&uacute;mero da resposta correta:</td><td><input type="text" name="respostacorreta" id="respostacorreta" value='<?=$te["te_respcorreta"]?>' style="width:50px" title="Digite a Resposta Correta"/></td></tr>
<tr><td></td><td><input type="submit" value="Cadastrar" /></td></tr>
<tr><td></td><td><input type="hidden" name="curso2" id="curso2" value='<?=$_GET['categoria']?>' /><input type="hidden" id="acao2" name="acao2" value="novo" /></td></tr>
<input type="hidden" name="caminho" id="caminho" value='<?=$_SERVER['REQUEST_URI'];?>' />

</table>

</fieldset>

<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Testes</legend>

<table class="lista"> 
<th>Pergunta:</th>
<th>Resposta 1</th>
<th>Resposta 2</th>
<th>Resposta 3</th>
<th>Resposta 4</th>
<th>Remover</th>
<?
$con3->selTab("","testes","*",'te_curso = '.$_GET["categoria"],"");

while($teste = mysql_fetch_array($con3->resultado)){

echo '<tr><td>'.$teste["te_pergunta"].'</td><td>'.$teste["te_resp1"].'</td><td>'.$teste["te_resp2"].'</td><td>'.$teste["te_resp3"].'</td><td>'.$teste["te_resp4"].'</td><td style="text-align:center"><a href="" onclick="deleta2('.$teste["te_id"].')"><img src="../imagens/deletar.jpg"></a></td></tr>';


}
?>
</table>
</fieldset>
</form>
<br /><br /><br />
<form enctype="multipart/form-data" action="sqls3.php" method="post" target="cad_emb">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Videos</legend>

<table class="lista" style="background-color:#FFC" > 
<tr><td>Titulo:</td><td><input type="text" name="titulo" id="titulo" value='<?=$te["te_pergunta"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
<tr><td>Link:</td><td><input type="text" name="link" id="link" value='<?=$te["te_resp1"]?>' style="width:300px" title="Digite a Resposta 1"/></td></tr>
<tr><td>Miniatura:</td><td><input type="file" name="miniatura" id="miniatura" style="width:300px" title="Selecione a imagem"/></td></tr>
<tr><td></td><td><input type="submit" value="Cadastrar" /></td></tr>
<tr><td></td><td><input type="hidden" name="curso2" id="curso2" value='<?=$_GET['categoria']?>' /><input type="hidden" id="acao2" name="acao2" value="novo" /></td></tr>
<input type="hidden" name="caminho" id="caminho" value='<?=$_SERVER['REQUEST_URI'];?>' />
</table>

</fieldset>
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Videos</legend>

<table class="lista"> 
<th>Titulo:</th>
<th>Link:</th>
<th>Miniatura</th>
<th>Remover</th>
<?
$con3->selTab("","embeds","*",'emb_cat = '.$_GET["categoria"],"");

while($embeds = mysql_fetch_array($con3->resultado)){

echo '<tr><td>'.$embeds["emb_titulo"].'</td><td><a target="_blank" href="'.$embeds["emb_link"].'">'.$embeds["emb_link"].'</a></td><td style="text-align:center"><img width="100px" src="../imagens/videos/'.$embeds["emb_miniatura"].'"></td><td style="text-align:center"><a href="" onclick="deleta3('.$embeds["emb_id"].')"><img src="../imagens/deletar.jpg"></a></td></tr>';


}
?>

</table>
</fieldset>



</form>

<?
}
?>
<iframe src="sqls2.php" id="cadastra" name="cadastra" frameborder="0" width="0" height="0"></iframe>
<iframe src="sqls3.php" id="cad_emb" name="cad_emb" frameborder="0" width="0" height="0"></iframe>

</body>
</html>
<? } ?>