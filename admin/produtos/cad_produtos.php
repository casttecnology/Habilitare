<?
include("../classes/banco.php");
include("../includes/funcoes.php");

if($_GET['produto'] <> ""){

$con = new DB();
$con->selTab("","produtos"," * ","prod_id = ".$_GET['produto'],"");
$produto = mysql_fetch_array($con->resultado);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="../includes/estilo.css" type="text/css" rel="stylesheet" />
<title>DIRT ADMIN</title>
</head>

<script src="../includes/funcoes.js"></script>
<script src="../includes/ajax.js"></script>

<body>
<?
include("../includes/menu.php");
?>
<form method="post" name="form_produtos" id="form_produtos">
<fieldset>
<legend>
Cadastro de Produtos
</legend>

<table>
    <tr>
        <td>
        Nome:
        </td>
        <td>
        <input type="text" name="nome" id="nome" style="width:300px" value="<?=$produto["prod_nome"]?>" class="txt" />
        </td>        
    </tr>
    <tr>
        <td>
        Descri&ccedil;&atilde;o:
        </td>
        <td>
        <textarea name="descricao" id="descricao" cols="40" rows="5" value="<?=$produto["prod_desc"]?>" class="txt"></textarea>
        </td>        
    </tr> 
    <tr>
        <td>
        Pre&ccedil;o:
        </td>
        <td>
        <input type="text" name="preco" id="preco" value="<?=$produto["prod_preco"]?>" class="txt"/>
        </td>        
    </tr>    
    <tr>
        <td>
        Pre&ccedil;o Promocional:
        </td>
        <td>
        <input type="text" name="precopromocional" id="precopromocional" value="<?=$produto["prod_promo"]?>" class="txt"/>
        </td>        
    </tr>     
    <tr>
        <td>
        Titulo:
        </td>
        <td>
        <input type="text" name="titulo" id="titulo" value="<?=$produto["prod_tit"]?>" class="txt"/>
        </td>        
    </tr> 
    <tr>
        <td>
        Prazo:
        </td>
        <td>
        <select name="prazo" id="prazo">
        </select>
        
        </td>        
    </tr>  
    <tr>
        <td>
        Imagens:
        </td>
        <td>
        <input type="file" disabled="disabled" name="imagens" id="imagens" class="txt" /><input type="button" value="Adicionar" />
        </td>        
    </tr>   
    <tr>
        <td>
        Codigo PagSeguro:
        </td>
        <td>
        <input type="text" name="pagseguro" id="pagseguro" style="width:500px" class="txt"/>
        </td>        
    </tr>
    <tr>
        <td>
        Quantidade:
        </td>
        <td>
        <input type="text" name="quantidade" id="quantidade" value="<?=$produto["prod_qtd"]?>" class="txt" />
        </td>        
    </tr>
    <tr>
        <td>
        Status:
        </td>
        <td>
        <select name="status" id="status">
        <option value="1">Online</option>
        <option value="0">Offline</option>
        </select>
        </td>        
    </tr> 
    <tr>
        <td>
        Categoria:
        </td>
        <td>
        <select name="categoria" id="categoria" onchange="selecionaSub()">
        <?
		preencheCombo("categorias","cat_id","cat_nome","");
		?>
        
        </select>
        </td>        
    </tr>   
    <tr>
        <td>
        Subcategorias:
        </td>
        <td>
        <select name="subcategoria" id="subcategoria">
        <option value="">teste</option>

        </select>
        </td>        
    </tr>      
    <tr>
        <td>
        </td>
        <td>
		<input type="button" value="Cadastrar" onclick="cadastraprod()" />
        </td>        
    </tr>                     
</table>
</fieldset>

</form>
</body>
</html>