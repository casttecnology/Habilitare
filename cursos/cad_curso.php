<?
include("../checa_login.php");
if($_SESSION["bt2"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");


$con = new DB();

if($_GET["acao"] == "editar")
{
$con->selTab("","cursos"," * ","id_cur = ".$_GET["curso"],"");
$cur = mysql_fetch_array($con->resultado);
}
$con2 = new DB();
$con2->selTab("","categoria"," * ","cat_curso = ".$_GET["curso"],"cat_ordem");
?>
<script src="../js/jquery-1.3.2.min.js"></script>
<script>
$(document).ready(function() { 
$('#btn-organizar').click(function(){          $('#select-para option:selected').each( function() {             $('#select-antes').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");  procSubcats($(this).val());     }); });

//$('#select-para').click(function(){limpaSel("select-para2");});
$('#btn-salvar').click(function(){Ordena("select-para")});

$('#btn-salvar2').click(function(){Ordena("select-para2")});

$('#btn-add').click(function(){         $('#select-antes option:selected').each( function() {                 $('#select-para').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");             $(this).remove();         });     });

$('#btn-remove').click(function(){         $('#select-para option:selected').each( function() {             $('#select-antes').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");             $(this).remove();         });     });

$('#btn-up').bind('click', function() {         $('#select-para option:selected').each( function() {             var newPos = $('#select-para option').index(this) - 1;             if (newPos > -1) {                 $('#select-para option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");                 $(this).remove();}});});

$('#btn-down').bind('click', function() {         var countOptions = $('#select-para option').size();         $('#select-para option:selected').each( function() {             var newPos = $('#select-para option').index(this) + 1;             if (newPos < countOptions) {                 $('#select-para option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");                 $(this).remove();             }         });     }); }); 
 
  $(document).ready(function() {     $('#btn-add2').click(function(){         $('#select-antes2 option:selected').each( function() {                 $('#select-para2').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");             $(this).remove();         });     });     $('#btn-remove2').click(function(){         $('#select-para2 option:selected').each( function() {             $('#select-antes2').append("<option value='"+$(this).val()+"'>"+$(this).text()+"</option>");             $(this).remove();         });     });     $('#btn-up2').bind('click', function() {         $('#select-para2 option:selected').each( function() {             var newPos = $('#select-para2 option').index(this) - 1;             if (newPos > -1) {                 $('#select-para2 option').eq(newPos).before("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");                 $(this).remove();             }         });     });     $('#btn-down2').bind('click', function() {         var countOptions = $('#select-para2 option').size();         $('#select-para2 option:selected').each( function() {             var newPos = $('#select-para2 option').index(this) + 1;             if (newPos < countOptions) {                 $('#select-para2 option').eq(newPos).after("<option value='"+$(this).val()+"' selected='selected'>"+$(this).text()+"</option>");                 $(this).remove();             }         });     }); }); 

</script>
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>
</table>


<form enctype="multipart/form-data" action="sqls.php" method="post" target="cadastra" onsubmit="return cadCurso();">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Cursos</legend>

<table class="lista"> 
<tr><td>Codigo:</td><td><?=$_GET["curso"]?><input type="hidden" id="codigo" name="codigo" value="<?=$_GET["curso"]?>" title="Codigo de cadastro do Curso"></td></tr>

<tr><td>Curso:</td><td><input type="text" name="curso" id="curso" value='<?=$cur["nome_cur"]?>' style="width:300px" title="Digite o Nome do Curso"/></td></tr>
<tr><td>Procurar imagem:</td><td><input type="file" name="img" id="img" title="Procure a imagem referente ao curso" />
<br /><? if($_GET["curso"]){?><img src="<?=$cur["img_cur"]?>" /><? }?></td></tr>
<tr><td></td><td><input type="submit" value="Cadastrar"/></td></tr>
</table>
<input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />

</fieldset></form>
<iframe src="sqls.php" id="cadastra" name="cadastra" frameborder="0" width="0" height="0"></iframe>
<form>   
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Organizar aulas</legend>     
<div style="margin:10px; float:left">
<div style="font-weight:bold; margin:5px">Categorias</div>
<div style="margin:5px">
<select name="selectpara" id="select-para" multiple size="8"> 
<? 
		while($cursos = mysql_fetch_array($con2->resultado))
		{
				echo "<option value='".$cursos["cat_id"]."'>".$cursos["cat_id"]." - ".$cursos["cat_nome"]."</option>";
		}       
?>
</select>
</div>
<a href="JavaScript:void(0);" id="btn-up"><img src="../imagens/cima.png" width="30" title="Mover para Cima" /></a>     
<a href="JavaScript:void(0);" id="btn-down"><img src="../imagens/baixo.png" width="30" title="Mover para Baixo" /></a>   

<a href="JavaScript:void(0);" id="btn-salvar"><img src="../imagens/salvar.png" width="30" title="Salvar Ordem" /></a>   
</div> 

<div style="margin:10px; float:left">
<div style="font-weight:bold; margin:5px">Subcategorias e Testes</div>
<div style="margin:5px">
<select name="selectpara2" id="select-para2" multiple size="10"> 
<? 
$con2->selTab("","subcategoria"," * ","sub_curso = ".$_GET["curso"],"sub_ordem");
		while($cursos = mysql_fetch_array($con2->resultado))
		{
				echo "<option value='".$cursos["sub_id"]."'>".$cursos["sub_cat"]." - ".$cursos["sub_nome"]."</option>";
		}       
?>
</select>
</div>
<a href="JavaScript:void(0);" id="btn-up2"><img src="../imagens/cima.png" width="30" title="Mover para Cima" /></a>     
<a href="JavaScript:void(0);" id="btn-down2"><img src="../imagens/baixo.png" width="30" title="Mover para Baixo" /></a>   
<a href="JavaScript:void(0);" id="btn-salvar2"><img src="../imagens/salvar.png" width="30" title="Salvar Ordem" /></a>   
</div> 
</fieldset> 
</form> 
</body>
</html>
<? } ?>