<?php
include("../classes/banco.php");


$con = new DB();
$codigo 			=  $_POST["codigo"];
$pergunta 			=  utf8_decode($_POST["pergunta"]);
$resposta1 			=  utf8_decode($_POST["resposta1"]);
$resposta2 			=  utf8_decode($_POST["resposta2"]);
$resposta3 			=  utf8_decode($_POST["resposta3"]);
$resposta4 			=  utf8_decode($_POST["resposta4"]);
$respostacorreta 	=  $_POST["respostacorreta"];
$curso			 	=  $_POST["curso"];
$acao	 			=  $_POST["acao"];

if($acao == "editar"){
	$con->upTab("testes","te_pergunta ='".$pergunta."', te_resp1 ='".$resposta1."', te_resp2 ='".$resposta2."', te_resp3 ='".$resposta3."', te_resp4 ='".$resposta4."', te_respcorreta =".$respostacorreta.", te_curso =".$curso, "te_id = ".$codigo);

}
else if($acao == "novo"){
	$con->insTab("testes","te_pergunta,te_resp1,te_resp2,te_resp3,te_resp4,te_respcorreta,te_curso","'".$pergunta."','".$resposta1."','".$resposta2."','".$resposta3."','".$resposta4."',".$respostacorreta.",".$curso."");

}
else if($acao == "deletar"){
	$con->delTab("testes", "te_id = ".$codigo);

}


?>