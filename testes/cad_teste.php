<?
include("../checa_login.php");
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();

if($_GET["acao"] == "editar")
{
$con->selTab("","testes"," * ","te_id = ".$_GET["teste"],"");
$te = mysql_fetch_array($con->resultado);
}

$con3 = new DB();
$con3->selTab("","cursos"," * ","","");
?>
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>
</table>

<form>
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Testes</legend>

<table class="lista"> 
<tr><td>Codigo:</td><td><?=$_GET["teste"]?><input type="hidden" id="codigo" name="codigo" value="<?=$_GET["teste"]?>" disabled="disabled" title="Codigo de cadastro do Teste"></td></tr>

<tr><td>Pergunta:</td><td><input type="text" name="pergunta" id="pergunta" value='<?=$te["te_pergunta"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
<tr><td>Resposta 1:</td><td><input type="text" name="resposta1" id="resposta1" value='<?=$te["te_resp1"]?>' style="width:300px" title="Digite a Resposta 1"/></td></tr>
<tr><td>Resposta 2:</td><td><input type="text" name="resposta2" id="resposta2" value='<?=$te["te_resp2"]?>' style="width:300px" title="Digite a Resposta 2"/></td></tr>
<tr><td>Resposta 3:</td><td><input type="text" name="resposta3" id="resposta3" value='<?=$te["te_resp3"]?>' style="width:300px" title="Digite a Resposta 3"/></td></tr>
<tr><td>Resposta 4:</td><td><input type="text" name="resposta4" id="resposta4" value='<?=$te["te_resp4"]?>' style="width:300px" title="Digite a Resposta 4"/></td></tr>
<tr><td>Resposta Correta:</td><td><input type="text" name="respostacorreta" id="respostacorreta" value='<?=$te["te_respcorreta"]?>' style="width:300px" title="Digite a Resposta Correta"/></td></tr>


<tr><td>Curso:</td><td>
<select id="curso" name="curso">
<?

		echo "<option value='0'>Selecione...</option>";
		while($cursos = mysql_fetch_array($con3->resultado))
		{
			if($te["te_curso"] == $cursos["id_cur"]){
				echo "<option value='".$cursos["id_cur"]."' selected='selected'>".$cursos["nome_cur"]."</option>";
			}else
			{
				echo "<option value='".$cursos["id_cur"]."'>".$cursos["nome_cur"]."</option>";
			}
		}

?>
</select>
</td></tr>
<tr><td></td><td><input type="button" value="Cadastrar" onclick="javascript:cadTeste()" /></td></tr>
</table>
<input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />

</fieldset></form>
</body>
</html>