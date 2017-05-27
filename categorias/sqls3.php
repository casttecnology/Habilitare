<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("../classes/banco.php");
//Cadastro de videos
$con = new DB();
$con2 = new DB();

$titulo 			=  utf8_decode($_POST["titulo"]);
$linque 			=  utf8_decode($_POST["link"]);

$curso			 	=  $_POST["curso2"];
$acao	 			=  $_POST["acao2"];
$codigo	 			=  $_POST["codigo"];

if($acao == "editar"){
if(isset ($_FILES['miniatura'])){
	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf');
	$type = end(explode(".", strtolower($_FILES['miniatura']['name'])));
	
	if (in_array($type, $allowtype)) {
        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../imagens/testes/". $nome_imagem;
		move_uploaded_file ($_FILES['miniatura']['tmp_name'], $thefile);
	$con->upTab("embeds","emb_titulo ='".$titulo."', emb_link ='".$linque."', te_resp2 ='".$resposta2."', te_resp3 ='".$resposta3."', te_resp4 ='".$resposta4."', te_respcorreta =".$respostacorreta.", te_curso =".$curso, "emb_id = ".$codigo.", emb_miniatura = '".$nome_imagem."'");

		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}
	else {

	$con->upTab("embeds","emb_titulo ='".$titulo."', emb_link ='".$linque.", te_curso =".$curso, "emb_id = ".$codigo);

		echo "<script>alert('Cadastro realizado com sucesso3');parent.location.reload() </script>";
		
	}	
}
	echo "entrou editar";
}

else if($acao == "novo"){
	echo "novo";
if(isset ($_FILES['miniatura'])){

	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf');
	$type = end(explode(".", strtolower($_FILES['miniatura']['name'])));
	
	if (in_array($type, $allowtype)) {

        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../imagens/videos/". $nome_imagem;
		move_uploaded_file ($_FILES['miniatura']['tmp_name'], $thefile);
		
		$con->insTab("embeds","emb_titulo, emb_link, emb_cat, emb_miniatura","'".$titulo."','".$linque."',".$curso.",'".$nome_imagem."'");
		
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.href='index.php' </script>";
	}
	
}else{echo "erro no upload";}
	
}

else if($acao == "deletar"){
	
	$con2->selTab("","embeds","emb_miniatura","emb_id = ".$codigo,"");
	$num2 = mysql_fetch_array($con2->resultado);
	unlink("../imagens/videos/".$num2["emb_miniatura"]);
	$con->delTab("embeds", "emb_id = ".$codigo);
}

?>