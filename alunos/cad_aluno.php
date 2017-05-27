<?
include("../checa_login.php");
if($_SESSION["bt1"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();

if($_GET["acao"] == "editar")
{
$con->selTab("","aluno"," * ","al_id = ".$_GET["aluno"],"");
$cat = mysql_fetch_array($con->resultado);
}


$con2 = new DB();
$con2->selTab("","aluno"," * ","","");

$con3 = new DB();
$con3->selTab("","cursos"," * ","","");

?>

    <link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<? if($_GET["acao"] == "editar"){?>
<td style="text-align:center; width:60px" align="right"><a href="cad_aluno.php?acao=novo">Hist&oacute;rico<br />
<img src="../imagens/Database.png" title="Exibir Hist&oacute;rico de acessos" height="32px" /></a>
</td>
<td style="text-align:center; width:60px" align="right"><a href="rel_teste.php?aluno=<?=$_GET["aluno"]?>" target="local">Resultados<br />
<img src="../imagens/testes.png" title="Exibir Resultados dos Testes" height="32px" /></a>
</td>
<? } ?>
<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>

</table>

<form id="formulario" name="formulario" style="padding-top: 150px;">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Alunos</legend>

<table class="lista"> 
<tr><td>Codigo:</td><td><?=$_GET["aluno"]?><input type="hidden" id="codigo" name="codigo" value="<?=$_GET["aluno"]?>" disabled="disabled" title="Codigo de cadastro do Aluno"></td></tr>

<tr><td>Nome:</td><td><input type="text" name="nome" id="nome" value='<?=$cat["al_nome"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
<tr><td>Sobrenome:</td><td><input type="text" name="sobrenome" id="sobrenome" value='<?=$cat["al_sobrenome"]?>' style="width:300px" title="Digite o Sobrenome do Aluno"/></td></tr>
<tr><td>Senha:</td><td><input type="text" name="senha" id="senha" value='<?=$cat["al_senha"]?>' style="width:300px" title="Digite a Senha do Aluno"/></td></tr>
<tr><td>CPF:</td><td><input type="text" name="cpf" id="cpf" value='<?=$cat["al_cpf"]?>' style="width:100px" title="Digite o CPF do Aluno" maxlength="11" /><span>Ex: 50032132155</span></td></tr>
<tr><td>R.G:</td><td><input type="text" name="rg" id="rg" value='<?=$cat["al_rg"]?>' style="width:100px" title="Digite o R.G do Aluno" maxlength="15"/></td></tr>
<tr><td>Telefone:</td><td><input type="text" name="telefone" id="telefone" value='<?=$cat["al_fone"]?>' style="width:100px" title="Digite o Telefone do Aluno" maxlength="11"/><span>Ex: 04133333333</span></td></tr>
<tr><td>Endere&ccedil;o:</td><td><input type="text" name="endereco" id="endereco" value='<?=$cat["al_endereco"]?>' style="width:300px" title="Digite o Endere&ccedil;o do Aluno" maxlength="255"/></td></tr>



<tr><td>Cursos Liberados:</td><td>
<?
if($_GET["acao"] == "editar"){
$con2->selTab("","alunoxcursos"," * ","alunoxcursos.ac_aluno = ".$cat["al_id"],"");

$c = 0;
while($alxcu = mysql_fetch_array($con2->resultado)){
	$cursofez[] = $alxcu["ac_curso"];
}

$nc = count($cursofez);

	while($cursos = mysql_fetch_array($con3->resultado)){
		$d=0;
		$curso = $cursos["id_cur"];
				
		while ($nc > $d)
		{
			//echo $cursofez[$d] ."==". $curso." c=".$c." * ";
			if($cursofez[$d] == $curso){	
			$sel = 'checked="checked"';
			}
			$d++;			
		}
		$con2->selTab("","alunoxcursos"," ac_id ","alunoxcursos.ac_aluno = ".$cat["al_id"]." and ac_curso = ".$curso." and ac_concluido = 1","");
		$concluido = mysql_num_rows($con2->resultado);
		if($concluido > 0){
			$terminado = mysql_fetch_array($con2->resultado);
		echo '<input title="Curso concluido.&ensp;Clique para Reabilitar o Curso" type="button" value="v" onclick="javascript:reabilitar('.$terminado[0].')">';
		}else
		{
		echo '<input title="Curso em andamento" type="button" value="x">';	
		}
	?>
    
	
    
    <label style="font-size:11px" >
    <input type="checkbox" id="curso[]" name="curso[]" value="<?=$cursos["id_cur"]?>"  <?=$sel?> /><?=$cursos["nome_cur"]?> &nbsp;</label></br>
	
	<?
	$sel = "";
	
}
}else{ echo "<span style='color:#ccc'>Cadastre o aluno primeiro.</span>";}
?>
</td></tr>
<tr><td></td><td><input type="button" value="Cadastrar" onclick="javascript:cadAluno()" /></td></tr>
</table>
<input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />

</fieldset></form>
<iframe id="local" name="local" frameborder="0" width="100%" height="500"></iframe>
</body>
</html>
<? } ?>