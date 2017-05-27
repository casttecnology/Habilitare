<?
include("../checa_login.php");
if($_SESSION["bt1"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();
$con2 = new DB();

$pesquisa = $_GET["pesq"];
if($pesquisa <> ""){
$proc = "al_nome like '%".$pesquisa."%' OR  al_cpf like '%".$pesquisa."%'";
}
$con->selTab("","aluno"," * ",$proc,"");

?>
<form action="index.php" method="get" style="padding-top: 150px;">
<table border="0" style="position: fixed;font-size:10px; float:right; width:100%; background:;z-index: 4;"><tr>
<td style="text-align:right; width:50px" align="right">Pesquisar : <input type="text" id="pesq" name="pesq" title="Digite o Nome ou CPF" />&nbsp;<input type="submit" value="Procurar"  /></td>
<td style="width:1%"><a href="cad_aluno.php?acao=novo"><img src="../imagens/novo_aluno.png" width="20" title="Novo" /></a></td>
</tr>
</table>
</form>

<form>
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Alunos</legend>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:5%">ID</th>
<th style="width:30%">Nome</th>
<th style="width:40%">Sobrenome</th>
<th style="width:10%">Cursos</th>
<th style="width:5%">Editar</th>
<th style="width:5%">Deletar</th>


<?
		while($alunos = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="center">'.$alunos["al_id"].'</td>
			<td>'.$alunos["al_nome"].'</td>
			<td>'.$alunos["al_sobrenome"].'</td><td>';

			$con2->selTab("","alunoxcursos,cursos"," cursos.img_cur ","alunoxcursos.ac_aluno = ".$alunos["al_id"]. " and alunoxcursos.ac_curso = cursos.id_cur","");
			$imgs = mysql_num_rows($con2->resultado);
			echo $imgs;


			echo '</td><td style="text-align:center"><a href="cad_aluno.php?acao=editar&aluno='.$alunos["al_id"].'"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deleta('.$alunos["al_id"].')"><img src="../imagens/deletar.jpg"></a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? }?>
