<? 
include("../checa_login.php");
include("../includes/header.php");
include("../classes/banco.php");
$con = new DB();
$con2 = new DB();
$aluno = $_GET["aluno"];

$con2->selTab("","categoria","*", "cat_id = ".$categoria,"");
$con->selTab("","resultado_aluno, testes","*", "te_id = re_pergunta and re_aluno = ".$aluno,"");

?>
<input type="button" value="Limpar resultados" onclick="javascript:LimpaRel()">
<input type="hidden" name="cdaluno" id="cdaluno" value="<?=$aluno?>">
<body>
<table border="1" style="width:100%">
<th>categoria</th>
<th>aluno</th>
<th>pergunta</th>
<th>resposta correta</th>
<th>resposta aluno</th>
<th>data</th>
<th>hora</th>

<?
if($aluno <> ""){ 
while($res = mysql_fetch_array($con->resultado)){
	$categoria = $res["re_cat"];
		
	$pergunta = $res["te_pergunta"];
	$respostacorreta = $res["te_respcorreta"];
	$respostaaluno = $res["re_resposta"];
	$cor = "";
	if($respostaaluno == $respostacorreta){
		$cor = "#00FF00";
	}else{
		$cor = "#FF0000";
	}
			$respostaaluno = '<span style="color:'.$cor.'">'.$respostaaluno.'</span>';
	
	echo "<tr><td>".$categoria."</td><td>".$res["re_aluno"]."</td><td>".$res["te_pergunta"]."</td><td>".$respostacorreta."</td><td>".$respostaaluno."</td><td>".$res[5]."</td><td>".$res[6]."</td></tr>";
	}
}
?>

</table>

</body>
</html>