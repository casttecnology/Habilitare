<?
include("../classes/banco.php");

$con = new DB();
$con->selTab("","produtos"," * ","","");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../includes/estilo.css" type="text/css" rel="stylesheet" />
<title>DIRT ADMIN</title>
</head>
<script src="../includes/funcoes.js"></script>
<script src="../includes/ajax.js"></script>

<body>

<?
include("../includes/menu.php");
?>

<a href="cad_produtos.php">NOVO</a>&nbsp;
<a href="cad_produtos.php">DELETAR</a>&nbsp;
<a href="cad_produtos.php">ALTERAR STATUS</a>

<form method="post" name="formulario" style="padding-top: 150px;">
<fieldset>
<legend>
Listagem de produtos
</legend>

<table class="tabela"> 
<th style="width:5px"><input type="checkbox" id="opcaop" onclick="selecionacheck()"></th>
<th style="width:20px">ID</th>
<th style="width:55%">Nome</th>
<th style="width:60px">Preço</th> 
<th style="width:20px">Editar</th> 
<th style="width:20px">Deletar</th> 
<th style="width:20px">Status</th> 

<?
		while($produtos = mysql_fetch_array($con->resultado))
		{
			if($produtos["prod_status"] == 1)
			{$statusimg = "online.jpg";
			$status = "0";
			}
			else
			{$statusimg = "offline.jpg";
			$status = "1";
			}
			
			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td align="center"><input type="checkbox" name="opcao"></td>
			<td>'.$produtos["prod_id"].'</td>
			<td>'.$produtos["prod_nome"].'</td>
			<td>'.$produtos["prod_preco"].'</td>
			<td style="text-align:center"><a href="cad_produtos.php?produto='.$produtos["prod_id"].'"><img src="../imagens/editar.jpg"></a></td>
			<td style="text-align:center"><a href="" onclick="deletaprod('.$produtos["prod_id"].')"><img src="../imagens/deletar.jpg"></a></td>
			<td style="text-align:center"><div id="status'.$produtos["prod_id"].'"><a href="" onclick="mudaStatus(\''.$produtos["prod_id"].'\',\''.$status.'\')"><img src="../imagens/'.$statusimg.'"></a></div></td></tr>';
		}
?>
</table>

</fieldset>

</form>
</body>
</html>