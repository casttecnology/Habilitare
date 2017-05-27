<?
include("../classes/banco.php");

$acao = $_POST["acao"];

$id = $_POST["codigo"];
$nome = $_POST["nome"];
$categoria = $_POST["categoria"];
$status = $_POST["status"];
$con = new DB();

if($acao == "delprod"){

	$con->delTab("produtos","prod_id = ".$id);
	$resp = $con->resultado;

}

if($acao == "cadprod"){

$nome = $_POST["nome"];
$descricao = $_POST["descricao"];
$status = $_POST["status"];

if($subcategoria == ""){
	$subcategoria ="0";
}

if($prazo == ""){
	$prazo ="0";
}

$con->insTab("produtos","prod_nome, prod_desc, prod_preco, prod_promo, prod_tit, prod_prazo, prod_pagseguro, prod_qtd, prod_status, prod_sub", "'$nome', '$descricao', '$preco', '$precopromocional', '$titulo', $prazo, '$pagseguro', $quantidade, '$status', $subcategoria");

}

if($acao == "status"){
		
	$con->upTab("produtos","prod_status = ".$status,"prod_id = ".$id);
	$resp = $con->resultado;
	if($status == 1){$status = 0;}
	if($status == 0){$status = 1;}
	echo $status."XX".$id;
}

if($acao == "categoria"){
		$con->selTab("","subcategorias"," * ","subcat_cat = ".$categoria,"");
		while($sub = mysql_fetch_array($con->resultado))
		{
			echo $sub["subcat_id"].":::::".$sub["subcat_nome"]."xyz";
		}
}

?>