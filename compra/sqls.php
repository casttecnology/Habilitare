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
$valor 		= $_POST["valor"];
$descricao	= $_POST["descricao"];

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

}else if($acao == "novaCompra"){

	$aluno_id = $con->insTabRet("aluno","al_nome,al_sobrenome,al_senha,al_cpf,al_rg,al_fone,al_endereco","'".$nome."','".$sobrenome."','".$senha."', '".$cpf."', '".$rg."', '".$telefone."', '".$endereco."'");

	$id_ac = $con->insTabRet("alunoxcursos","ac_aluno,ac_curso","".$aluno_id.",".$curso);

	$id_mov = $con->insTabRet("movimento","mov_valor,ac_id","".$valor.",".$id_ac);

	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("Content-Type: text/html; charset=UTF-8",true);
	date_default_timezone_set('America/Sao_Paulo');

	require_once("../pagseguro/PagSeguro.class.php");
	$PagSeguro = new PagSeguro();
		
	//EFETUAR PAGAMENTO	
	$venda = array("codigo"=>$id_mov,
				   "valor"=>$valor,
				   "descricao"=>$descricao,
				   "nome"=>"Jose da silva",
				   "email"=>"consumidor@gmail.com",
				   "telefone"=>"(41) 98422-5758",
				   "rua"=>"rua das casas",
				   "numero"=>"155",
				   "bairro"=>"cajuru",
				   "cidade"=>"curitiba",
				   "estado"=>"PR", //2 LETRAS MAIÚSCULAS
				   "cep"=>"82.980-140",
				   "codigo_pagseguro"=>"");

	$retorno = $PagSeguro->executeCheckout($venda,"http://cellofor.com.br/teste/pagseguro/retorno.php");

	$retorno = $retorno.'#'.$pagamento->codigo_pagseguro;

	var_dump($retorno);//
}
else if($acao == "velhaCompra")
{
	$aluno_id = $codigo;

	$id_ac = $con->insTabRet("alunoxcursos","ac_aluno,ac_curso","".$aluno_id.",".$curso);

	$con->insTab("movimento","mov_valor,ac_id","".$valor.",".$id_ac);

	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("Content-Type: text/html; charset=UTF-8",true);
	date_default_timezone_set('America/Sao_Paulo');

	require_once("../pagseguro/PagSeguro.class.php");
	$PagSeguro = new PagSeguro();
		
	//EFETUAR PAGAMENTO	
	$venda = array("codigo"=>$curso,
				   "valor"=>$valor,
				   "descricao"=>$descricao,
				   "nome"=>"Jose da silva",
				   "email"=>"consumidor@gmail.com",
				   "telefone"=>"(41) 98422-5758",
				   "rua"=>"rua das casas",
				   "numero"=>"155",
				   "bairro"=>"cajuru",
				   "cidade"=>"curitiba",
				   "estado"=>"PR", //2 LETRAS MAIÚSCULAS
				   "cep"=>"82.980-140",
				   "codigo_pagseguro"=>"");

	$retorno = $PagSeguro->executeCheckout($venda,"http://cellofor.com.br/teste/pagseguro/notificacao.php");

	var_dump($retorno);//
}
?>