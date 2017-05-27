<?
include("../classes/banco.php");

if($_GET['produto'] <> ""){

$con = new DB();
$con->selTab("","produtos"," * ","prod_id = ".$_GET['produto'],"");
$produto = mysql_fetch_array($con->resultado);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../includes/estilo.css" type="text/css" rel="stylesheet" />
<title>DIRT ADMIN</title>
</head>

<body>

<form method="post" name="form_produtos">
<fieldset>
<legend>
Cadastro de Clientes
</legend>

<table>
    <tr>
        <td>
        Nome:
        </td>
        <td>
        <input type="text" name="nome" id="nome" style="width:300px" value="<?=$produto["prod_nome"]?>" />
        </td>        
    </tr>
    <tr>
        <td>
        RG:
        </td>
        <td>
        <input type="text" name="nome" id="nome" style="width:300px" value="<?=$produto["prod_nome"]?>" />
        </td>        
    </tr>   
    <tr>
        <td>
        CPF:
        </td>
        <td>
        <input type="text" name="nome" id="nome" style="width:300px" value="<?=$produto["prod_nome"]?>" />
        </td>        
    </tr>       
    <tr>
        <td>
        Rua:
        </td>
        <td>
        <input type="text" name="nome" id="nome" style="width:300px" value="<?=$produto["prod_nome"]?>" />
        </td>        
    </tr> 
    <tr>
        <td>
        Numero:
        </td>
        <td>
        <input type="text" name="preco" id="preco" value="<?=$produto["prod_valor"]?>" />
        </td>        
    </tr>  
    <tr>
        <td>
        Complemento:
        </td>
        <td>
        <input type="text" name="prazo" id="prazo"  />
        </td>        
    </tr>       
    <tr>
        <td>
        CEP:
        </td>
        <td>
        <input type="text" name="precopromocional" id="precopromocional" />
        </td>        
    </tr>     
    <tr>
        <td>
        Bairro:
        </td>
        <td>
        <input type="text" name="titulo" id="titulo" value="<?=$produto["prod_tit"]?>" />
        </td>        
    </tr> 
    <tr>
        <td>
        Estado:
        </td>
        <td>
        <input type="text" name="prazo" id="prazo"  />
        </td>        
    </tr>  
    <tr>
        <td>
        Pais:
        </td>
        <td>
        <input type="file" disabled="disabled" name="imagens" id="imagens" /><input type="button" value="Adicionar" />
        </td>        
    </tr>  
    <tr>
        <td>
        DDD:
        </td>
        <td>
        <input type="text" name="prazo" id="prazo"  />
        </td>        
    </tr>
    <tr>
        <td>
        Telefone:
        </td>
        <td>
        <input type="text" name="prazo" id="prazo"  />
        </td>        
    </tr> 
    <tr>
        <td>
        Email:
        </td>
        <td>
        <input type="text" name="prazo" id="prazo"  />
        </td>        
    </tr>               
    <tr>
        <td>
        Status:
        </td>
        <td>
        <select>
        <option value="1">Online</option>
        <option value="0">Offline</option>
        </select>
        </td>        
    </tr> 
   
    <tr>
        <td>
        </td>
        <td>
		<input type="button" value="Cadastrar" />
        </td>        
    </tr>                     
</table>
</fieldset>

</form>
</body>
</html>