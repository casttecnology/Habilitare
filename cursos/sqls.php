<?php
include("../classes/banco.php");


$con = new DB();
$acao = $_POST["acao"];
$curso = utf8_decode($_POST["curso"]);
$codigo = $_POST["codigo"];



if($acao == "editar"){
if(isset ($_FILES['img'])){
	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
	
	if (in_array($type, $allowtype)) {
        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../principal/imagens/cursos/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
		$con->upTab("cursos","nome_cur ='".$curso."', img_cur ='".$thefile."'", "id_cur = ".$codigo);
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.reload() </script>";
		
	}

}
	echo "entrou editar";
}

if($acao == "novo"){
	
	
if(isset ($_FILES['img'])){

	$allowtype = array('bmp', 'gif', 'jpg', 'jpeg', 'gif', 'png');
	$type = end(explode(".", strtolower($_FILES['img']['name'])));
	
	if (in_array($type, $allowtype)) {
        $nome_imagem = md5(uniqid(time())) . "." . $type;
		$thefile = "../principal/imagens/cursos/". $nome_imagem;
		move_uploaded_file ($_FILES['img']['tmp_name'], $thefile);
		$con->insTab("cursos","nome_cur,img_cur","'".$curso."','".$thefile."'");
		echo "<script>alert('Cadastro realizado com sucesso');parent.location.href='index.php' </script>";
	}
	
}else{echo "erro no upload";}

}
if($acao == "deletar"){
	$con->delTab("cursos", "id_cur = ".$codigo);
}

if($acao == "procurasubcategorias"){
	$con->selTab("","subcategoria","sub_id, sub_nome", "sub_cat = ".$codigo, "sub_ordem");
	while($dados = mysql_fetch_array($con->resultado))
	{
		if($dados[0] <> ""){
			echo $dados[0]."*-*".utf8_encode($dados[1]).":::::";
		}
	}	
}

if($acao == "ordenacats"){

$codigos = explode(",",$codigo);
$n = count($codigos);

for($i=1; $i <= $n; $i++){
$con->upTab("categoria","cat_ordem =".$i, "cat_id = ".$codigos[$i-1]);
}
echo "";
}
if($acao == "ordenasubs"){

$codigos = explode(",",$codigo);
$n = count($codigos);

for($i=1; $i <= $n; $i++){
$con->upTab("subcategoria","sub_ordem =".$i, "sub_id = ".$codigos[$i-1]);
}
echo "";
}

?>