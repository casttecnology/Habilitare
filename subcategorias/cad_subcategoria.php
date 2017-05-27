<?
include("../checa_login.php");
if($_SESSION["bt4"] == "1"){
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();
$con2 = new DB();
if($_GET["acao"] == "editar")
{
$con->selTab("","subcategoria"," * ","sub_id = ".$_GET["subcategoria"],"");
$sub = mysql_fetch_array($con->resultado);
$previsu = $sub["sub_img"];
$pieces = explode(".", $previsu);
 

}

$con2->selTab("","cursos, categoria","nome_cur,  cat_nome, cat_id ","cat_curso = id_cur","");
?>
    <link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />
<table border="0" style="font-size:10px; float:right; width:100%"><tr>
<td style="width:90%"></td>
<td style="text-align:center; width:50px" align="right"><a href="index.php">Voltar<br />
<img src="../imagens/voltar.png" title="Voltar" height="32px" /></a>
</td>
</table>
<form enctype="multipart/form-data" action="sqls.php" method="post" target="cadastra" onsubmit="return cadSub();" style="padding-top: 140px;">
<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de SubCategorias</legend>

<table class="lista">
<tr><td>Codigo:</td><td><?=$sub["sub_id"]?><input type="hidden" name="codigo" id="codigo" value="<?=$sub["sub_id"]?>" style="width:400px"/></td></tr>
<tr><td>Categoria</td><td><select id="categoria" name="categoria">
<?
	echo "<option value='0'>Selecione...</option>";
	while($cursos = mysql_fetch_array($con2->resultado))
	{
		if($sub["sub_cat"] == $cursos["cat_id"]){
			echo "<option value='".$cursos["cat_id"]."' selected='selected'>".$cursos["nome_cur"]." - ".$cursos["cat_nome"]."</option>";
		}else
		{
			echo "<option value='".$cursos["cat_id"]."'>".$cursos["nome_cur"]." - ".$cursos["cat_nome"]."</option>";
		}
	}
?>

</select></td></tr>
<tr><td>SubCategoria:</td><td><input type="text" id="subcategoria" name="subcategoria" value="<?=$sub["sub_nome"]?>" style="width:400px"/></td></tr>
<tr><td>Inserir Imagem,SWF ou MP4:</td><td><input type="file" id="img" name="img"/>


   <?
   if($pieces[3] == "swf"){
   ?>
			<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="150" height="109" id="flash" align="middle">
				<param name="movie" value="<?=$sub["sub_img"]?>" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="wmode" value="window" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="<?=$sub["sub_img"]?>" width="150" height="109">
					<param name="movie" value="<?=$sub["sub_img"]?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
					<param name="wmode" value="window" />
					<param name="scale" value="showall" />
					<param name="menu" value="true" />
					<param name="devicefont" value="false" />
					<param name="salign" value="" />
					<param name="allowScriptAccess" value="sameDomain" />
				<!--<![endif]-->
					<a href="http://www.adobe.com/go/getflash">
						<img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Obter Adobe Flash Player" />
					</a>
				<!--[if !IE]>-->
				</object>
				<!--<![endif]-->
			</object>

   <?
   }elseif($pieces[3] == "mp4"){
   
   echo '<video src="'.$previsu.'" autoplay controls height="200px"></video>';
   }
   ?>
</td></tr>
<tr><td>Mostrar SWF, MP4 na tela inteira ?</td><td><select name="full" id="full" onchange="javascript:mostraTexto()"><option value="nao" <? if($sub["sub_full"] == "nao"){echo "selected";} ?>>n&atilde;o</option><option value="sim" <? if($sub["sub_full"] == "sim"){echo "selected";} ?>>sim</option></select></td></tr>
<tr><td>Tempo da aula:</td><td><input type="text" id="tempo" name="tempo" value="<?=$sub["sub_tempo"]?>" title="Insira o tempo de aula"/>ex: 120 (é igual a 2 minutos que tem 120 seg.)</td></tr>
<tr id="textoarea"><td>Descri&ccedil;&atilde;o:</td><td><textarea name="wysiwyg" id="wysiwyg" rows="10" cols="103"><?=$sub["sub_texto"]?></textarea></td></tr>

<tr><td></td><td><input type="submit" value="Cadastrar" /></td></tr>
</table><input type="hidden" id="acao" name="acao" value="<?=$_GET["acao"]?>" />
<script></script>
<iframe src="sqls.php" id="cadastra" name="cadastra" frameborder="0" width="0" height="0"></iframe>

 <script type="text/javascript" src="../js/jquery/jquery-1.3.2.js"></script>
    <script type="text/javascript" src="../js/jwysiwyg/jquery.wysiwyg.js"></script>
    <script type="text/javascript">
(function($)
{
  $('#wysiwyg').wysiwyg({
    controls: {
      strikeThrough : { visible : true },
      underline     : { visible : true },
      
      separator00 : { visible : true },
      
      justifyLeft   : { visible : true },
      justifyCenter : { visible : true },
      justifyRight  : { visible : true },
      justifyFull   : { visible : true },
      
      separator01 : { visible : true },
      
      indent  : { visible : true },
      outdent : { visible : true },
      
      separator02 : { visible : true },
      
      subscript   : { visible : true },
      superscript : { visible : true },
      
      separator03 : { visible : true },
      
      undo : { visible : true },
      redo : { visible : true },
      
      separator04 : { visible : true },
      
      insertOrderedList    : { visible : true },
      insertUnorderedList  : { visible : true },
      insertHorizontalRule : { visible : true },
      
      h4mozilla : { visible : true && $.browser.mozilla, className : 'h4', command : 'heading', arguments : ['h4'], tags : ['h4'], tooltip : "Header 4" },
      h5mozilla : { visible : true && $.browser.mozilla, className : 'h5', command : 'heading', arguments : ['h5'], tags : ['h5'], tooltip : "Header 5" },
      h6mozilla : { visible : true && $.browser.mozilla, className : 'h6', command : 'heading', arguments : ['h6'], tags : ['h6'], tooltip : "Header 6" },
      
      h4 : { visible : true && !( $.browser.mozilla ), className : 'h4', command : 'formatBlock', arguments : ['<H4>'], tags : ['h4'], tooltip : "Header 4" },
      h5 : { visible : true && !( $.browser.mozilla ), className : 'h5', command : 'formatBlock', arguments : ['<H5>'], tags : ['h5'], tooltip : "Header 5" },
      h6 : { visible : true && !( $.browser.mozilla ), className : 'h6', command : 'formatBlock', arguments : ['<H6>'], tags : ['h6'], tooltip : "Header 6" },
      
      separator07 : { visible : true },
      
      cut   : { visible : true },
      copy  : { visible : true },
      paste : { visible : true }
    }
  });
})(jQuery);
    </script>
</fieldset></form>
</body>
</html>
<? } ?>