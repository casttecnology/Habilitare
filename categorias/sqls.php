<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("../classes/banco.php");


$con = new DB();
$acao = $_POST["acao"];
$codigo = $_POST["codigo"];
$categoria = utf8_decode($_POST["categoria"]);
$curso = $_POST["curso"];

if($acao == "editar"){
	$con->upTab("categoria","cat_nome ='".$categoria."', cat_curso =".$curso, "cat_id = ".$codigo);

}
else if($acao == "novo"){
	$con->insTab("categoria","cat_nome,cat_curso","'".$categoria."',".$curso);

}
else if($acao == "deletar"){
	$con->delTab("categoria", "cat_id = ".$codigo);

}


?>