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

setlocale(LC_MONETARY, 'pt_BR', 'ptb');

$con->selTab("","movimento mv, status sts, alunoxcursos ac, aluno al, cursos cu",
				" mv.mov_id, al.al_nome, cu.nome_cur, mv.mov_valor, sts.sts_descricao, COALESCE(mv.mov_datasts, mv.mov_dataincl) dtastatus",
				" mv.sts_id = sts.sts_id and mv.ac_id = ac.ac_id and ac.ac_aluno = al.al_id and cu.id_cur = ac.ac_curso","");
?>
<form style="padding-top: 140px;">
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Movimentos</legend>

<script>
    console.log('<?= $con->resultado; ?>');
</script>

<table class="lista">
<th style="width:5%"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:10%">ID</th>
<th style="width:25%">Aluno</th>
<th style="width:25%">Curso</th>
<th style="width:10%">Valor</th>
<th style="width:15%">Situa&ccedil;&atilde;o</th>
<th style="width:10%">Ultima Altera&ccedil;&atilde;o</th>

<?
		while($compras = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td align="left">'.$compras["mov_id"].'</td>
			<td align="left">'.$compras["al_nome"].'</td>
			<td align="left">'.$compras["nome_cur"].'</td>
			<td style="text-align:right">'.money_format('%i',$compras["mov_valor"]).'</td>
			<td style="text-align:center">'.$compras["sts_descricao"].'</td>
			<td style="text-align:center">'.$compras["dtastatus"].'</td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
