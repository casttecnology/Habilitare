<?php
	header("access-control-allow-origin: https://pagseguro.uol.com.br");
	require_once("PagSeguro.class.php");
	include("../classes/banco.php");
	$con = new DB();
gravaLog("notificação");
	if(isset($_POST['notificationType']) && $_POST['notificationType'] == 'transaction'){
		$PagSeguro = new PagSeguro();
		$response = $PagSeguro->executeNotification($_POST);
		/*if( $response->status==3 || $response->status==4 ){
        	//PAGAMENTO CONFIRMADO
			//ATUALIZAR O STATUS NO BANCO DE DADOS
			echo $PagSeguro->getStatusText($PagSeguro->status);
		}else{
			//PAGAMENTO PENDENTE
			echo $PagSeguro->getStatusText($PagSeguro->status);
		}*/

		//var_dump($PagSeguro);
		//erroorr();
		$con->upTab("movimento","sts_id =".$PagSeguro->status, "mov_id = ".$PagSeguro->reference);
	}

	echo $_POST['notificationType'];


	function gravaLog($registroLog)
	{
		$iplogfile = 'log.txt';
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$webpage = $_SERVER['SCRIPT_NAME'];
		$timestamp = date('m/d/Y h:i:s');
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$fp = fopen($iplogfile, 'a+');
		chmod($iplogfile, 0777);
		fwrite($fp, '['.$timestamp.']: '.$registroLog.''.$ipaddress.' '.$webpage.' '.$browser. "\r\n");
		fclose($fp);
	}
?>