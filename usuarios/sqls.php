<?php
include("../classes/banco.php");


$con = new DB();
$acao 		= $_POST["acao"];
$codigo 	= $_POST["codigo"];
$usuario 	= $_POST["usuario"];
$senha 		= $_POST["senha"];
$bt1 		= $_POST["bt1"];
$bt2 		= $_POST["bt2"];
$bt3 		= $_POST["bt3"];
$bt4 		= $_POST["bt4"];
$bt5 		= $_POST["bt5"];

if($acao == "editar"){
	$con->upTab("usuarios","usuario ='".$usuario."', senha ='".$senha."', bt1='".$bt1."', bt2='".$bt2."', bt3='".$bt3."', bt4='".$bt4."', bt5='".$bt5."'", "Id = ".$codigo);

}
else if($acao == "novo"){

	$con->insTab("usuarios","usuario,senha,bt1,bt2,bt3,bt4,bt5","'".$usuario."','".$senha."','".$bt1."', '".$bt2."', '".$bt3."', '".$bt4."', '".$bt5."'");

}
else if($acao == "deletar"){
	$con->delTab("usuarios", "Id = ".$codigo);

}

?>