<?php
header('Content-Type: text/html; charset=iso-8859-1');
include("../classes/banco.php");

$con = new DB();
$con2 = new DB();
$codigo = $_POST["codigo"];
$acao = $_POST["acao"];
$categoria = utf8_decode($_POST["categoria"]);
$subcategoria = addslashes($_POST["subcategoria"]);
$tempo = addslashes($_POST["tempo"]);
$textofull = addslashes($_POST["full"]);
echo $subcategoria;
$texto = addslashes($_POST["wysiwyg"]);


if($acao == "editar"){
if(isset ($_FILES['img'])){
	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'mp4');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
$con2->selTab("","categoria","cat_curso","cat_id = ".$categoria,"");
$cursoaux = mysql_fetch_array($con2->resultado);
$curso = $cursoaux[0];	
	
	if (in_array($type, $allowtype)) {
        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../principal/swf/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
		$con->upTab("subcategoria","sub_cat =".$categoria.", sub_nome ='".$subcategoria."', sub_img ='".$thefile."', sub_texto = '".$texto."', sub_curso = ".$curso.", sub_full = '".$textofull."', sub_tempo = '".$tempo."'", "sub_id = ".$codigo);
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}
	else {

		$con->upTab("subcategoria","sub_cat =".$categoria.", sub_nome ='".$subcategoria."', sub_texto = '".$texto."', sub_curso = ".$curso.", sub_full = '".$textofull."', sub_tempo = '".$tempo."'", "sub_id = ".$codigo);
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}	


}
	echo "entrou editar";
}

if($acao == "novo"){
	
	
if(isset ($_FILES['img'])){

	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png', 'swf', 'mp4');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
	
	if (in_array($type, $allowtype)) {

        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../principal/swf/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
		
		
$con2->selTab("","categoria","cat_curso","cat_id = ".$categoria,"");
$cursoaux = mysql_fetch_array($con2->resultado);
$curso = $cursoaux[0];
		
		$con->insTab("subcategoria","sub_cat,sub_nome, sub_img, sub_texto,sub_curso,sub_full,sub_tempo", $categoria.",'".$subcategoria."','".$thefile."','".$texto."',".$curso.",'".$textofull."','".$tempo."'");
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.href='index.php' </script>";
	}
	
}else{echo "erro no upload";}

}
if($acao == "deletar"){
	$con->delTab("subcategoria", "sub_id = ".$codigo);
}


?>