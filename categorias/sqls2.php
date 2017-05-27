<?php
header('Content-Type: text/html; charset=utf-8');
include("../classes/banco.php");

$con = new DB();
$con2 = new DB();

$pergunta 			=  utf8_decode($_POST["pergunta"]);
$resposta1 			=  utf8_decode($_POST["resposta1"]);
$resposta2 			=  utf8_decode($_POST["resposta2"]);
$resposta3 			=  utf8_decode($_POST["resposta3"]);
$resposta4 			=  utf8_decode($_POST["resposta4"]);
$respostacorreta 	=  $_POST["respostacorreta"];
$curso			 	=  $_POST["curso2"];
$acao	 			=  $_POST["acao2"];
$codigo	 			=  $_POST["codigo"];

if($acao == "editar"){
if(isset ($_FILES['img'])){
	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
	
	if (in_array($type, $allowtype)) {
        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../imagens/testes/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
	$con->upTab("testes","te_pergunta ='".$pergunta."', te_resp1 ='".$resposta1."', te_resp2 ='".$resposta2."', te_resp3 ='".$resposta3."', te_resp4 ='".$resposta4."', te_respcorreta =".$respostacorreta.", te_curso =".$curso, "te_id = ".$codigo.", te_img = '".$nome_imagem."'");

		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}
	else {

	$con->upTab("testes","te_pergunta ='".$pergunta."', te_resp1 ='".$resposta1."', te_resp2 ='".$resposta2."', te_resp3 ='".$resposta3."', te_resp4 ='".$resposta4."', te_respcorreta =".$respostacorreta.", te_curso =".$curso, "te_id = ".$codigo);

		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}	
}
	echo "entrou editar";
}

else if($acao == "novo"){
	echo "novo";
if(isset ($_FILES['img'])){

	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
	
	if (in_array($type, $allowtype)) {

        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../imagens/testes/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
		
		$con2->selTab("","testes","te_ordem","te_curso=".$curso,"te_ordem desc");
		$cursoaux = mysql_fetch_array($con2->resultado);		
		$ordem = $cursoaux[0];	
		$ordem = $ordem + 1;
		
		$con->insTab("testes","te_pergunta,te_resp1,te_resp2,te_resp3,te_resp4,te_respcorreta,te_curso,te_ordem,te_img","'".$pergunta."','".$resposta1."','".$resposta2."','".$resposta3."','".$resposta4."',".$respostacorreta.",".$curso.",".$ordem.",'".$nome_imagem."'");
		echo mysql_error();
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.href='index.php' </script>";
		
	}
	
}else{echo "erro no upload";}
	
}

else if($acao == "deletar"){
	$con2->selTab("","resultado_aluno","re_id","re_pergunta = ".$codigo,"");
	$num = mysql_num_rows($con2->resultado);

	$con2->selTab("","testes","te_img","te_id = ".$codigo,"");
	$num2 = mysql_fetch_array($con2->resultado);
	unlink("../imagens/testes/".$num2["te_img"]);

	$con->delTab("testes", "te_id = ".$codigo);
	
}

?>