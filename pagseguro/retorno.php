<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	header("Content-Type: text/html; charset=UTF-8",true);
	date_default_timezone_set('America/Sao_Paulo');

	require_once("PagSeguro.class.php");
	$PagSeguro = new PagSeguro();

	include("../classes/banco.php");
	$con = new DB();
	if( isset($_GET['transaction_id']) ){
		$pagamento = $PagSeguro->getStatusByReference($_GET['codigo']);
		
		$pagamento->codigo_pagseguro = $_GET['transaction_id'];
		if($pagamento->status==3 || $pagamento->status==4){
			//ATUALIZAR DADOS DA VENDA, COMO DATA DO PAGAMENTO E STATUS DO PAGAMENTO
			echo "deu boa!";
		}else{
			//ATUALIZAR NA BASE DE DADOS
			echo "aguardando dar boa!";
		}
		$con->upTab("movimento","sts_id =".$PagSeguro->status, "mov_reference = ".$_GET['codigo']);

		//var_dump($pagamento);
?>
<script>
    console.log('<?= $pagamento; ?>');
</script>
<?
		errorr();
	}
?>