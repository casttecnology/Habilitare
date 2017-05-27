<?php
include("../classes/banco.php");


$con = new DB();
$acao 		= $_POST["acao"];
$curso 		= $_POST["curso"];
$codigo 	= $_POST["codigo"];
$nome 		= $_POST["nome"];
$sobrenome 	= $_POST["sobrenome"];
$senha 		= $_POST["senha"];
$cpf 		= $_POST["cpf"];
$rg 		= $_POST["rg"];
$telefone 	= $_POST["telefone"];
$endereco 	= $_POST["endereco"];

if($acao == "editar"){
$cursos = explode(" ",$curso);

$n = count($cursos);
$conta = 1;
$con->delTab("alunoxcursos", "ac_aluno = ".$codigo);
while($n > $conta)
{
	$con->insTab("alunoxcursos","ac_aluno,ac_curso","".$codigo.",".$cursos[$conta]);
	$conta++;
}	
	$con->upTab("aluno","al_nome ='".$nome."', al_sobrenome ='".$sobrenome."', al_senha='".$senha."', al_cpf='".$cpf."', al_rg='".$rg."', al_fone='".$telefone."', al_endereco='".$endereco."'", "al_id = ".$codigo);

}
else if($acao == "novo"){

	$con->insTab("aluno","al_nome,al_sobrenome,al_senha,al_cpf,al_rg,al_fone,al_endereco","'".$nome."','".$sobrenome."','".$senha."', '".$cpf."', '".$rg."', '".$telefone."', '".$endereco."'");

}
else if($acao == "deletar"){
	$con->delTab("aluno", "al_id = ".$codigo);

}
else if($acao == "limparel"){
	$con->delTab("resultado_aluno","re_aluno = ".$codigo);

}
else if($acao == "reabilita"){
	$con->upTab("alunoxcursos","ac_concluido =''", "ac_id = ".$codigo);

}

?>