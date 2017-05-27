<?
include("includes/header.php");
include("classes/banco.php");

?>
<div style="margin:auto; height:85px; width:1100px;">
<img src="imagens/logo.jpg" height="80px"/><span style="font-size:24px; color:#1A6FA8; margin:10px"><?=$_GET["nome"]?></span>
<div id="crom" style="color:#FFF">1</div>
</div>
<div style="margin:auto; height:600px; width:1100px; background-color:#fff">

<div style="width:1100px; margin:auto;height:50px; "><br />
    <div style="margin-left:10px;"><a href="#" onclick="javascript:mostraMenu()" onblur="javascript:saiMenu()" style="color:#1A6FA8; "><img src="imagens/menu.jpg" /></a></div>
    <ul id="menu" style="display:none; position:fixed">

<?
function maiuscula($letras)
{
 return strtoupper($letras);
}
function maiusculap($letras)
{
 return ucwords($letras);
}
$dbcat = new DB();
$dbsubcat = new DB();
$dbcat->selTab("","categoria"," * ", "cat_curso = ".$_GET['curso'],"cat_ordem");
while($categorias = mysql_fetch_array($dbcat->resultado)){
		 
		 echo '<li><a href="#" >'.maiuscula($categorias["cat_nome"]).'</a>';
		 
		 $dbsubcat->selTab("","subcategoria"," * ", "sub_cat = ".$categorias["cat_id"],"sub_ordem");
		 $num_sub = mysql_num_rows($dbsubcat->resultado);
		 if($num_sub == 0)
		 {
			 echo "</li>";
		 }
		 else{
			 for($i=0; $i < $num_sub; $i++){
				 $subcategorias = mysql_fetch_array($dbsubcat->resultado);
				 
				 if($i == 0){
					echo '<ul>'; 
				 }
				 if($i < $num_sub){
				 echo '<li><a href="../principal/curso.php?curso='.$_GET['curso'].'&subcat='.$subcategorias['sub_id'].'">'.maiusculap($subcategorias['sub_nome']).'</a></li>';
				 }
				 
				 if($i+1 == $num_sub){
					 echo '</ul></li>';
				 }
			 }
		 }
	}
?>
    </ul>

<?
if($_GET["subcat"]){

$consub = new DB();
$consub->selTab("","subcategoria"," * ", "sub_id = ".$_GET["subcat"],"sub_ordem");
$aula = mysql_fetch_array($consub->resultado);

}
?>
    
    </div>
    <div id="caminhopao" style="font-size:16px; background-color:#1A6FA8;margin-bottom:10px; height:30px">
    <div style="margin-left:20px; color:#FFF; padding-top:5px">Menu <img src="imagens/pao.jpg" width="10"/> Empilhadeira</div>
    </div>


<div style="float:left; margin-left:15px; width:540px">
<?
if($_GET["subcat"]){
?>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" width="550" height="400" id="pa_carregadeira" align="middle">
				<param name="movie" value="<?=$aula["sub_img"]?>" />
				<param name="quality" value="high" />
				<param name="bgcolor" value="#ffffff" />
				<param name="play" value="true" />
				<param name="loop" value="true" />
				<param name="scale" value="showall" />
				<param name="menu" value="true" />
				<param name="devicefont" value="false" />
				<param name="salign" value="" />
				<param name="allowScriptAccess" value="sameDomain" />
                <param name="wmode" value="transparent" />
				<!--[if !IE]>-->
				<object type="application/x-shockwave-flash" data="<?=$aula["sub_img"]?>" width="550" height="400">
					<param name="movie" value="<?=$aula["sub_img"]?>" />
					<param name="quality" value="high" />
					<param name="bgcolor" value="#ffffff" />
					<param name="play" value="true" />
					<param name="loop" value="true" />
<param name="wmode" value="transparent" />
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
            <? }
			else{
				echo "<br>";
				}
			?>
</div>
            <div id="texto">
              <span><p>Before you begin, please familiarize yourself with the course navigation. Use the BACK and NEXT buttons at the bottom right of the screen to view the course. You can refer to a specific topic by using the drop-down menu at the top left of the screen. As you progress through the course, previously viewed topics will be indicated by a checkmark next to the title in the drop-down menu.</p>
              <p>To access additional features, use the six buttons at the top center of the screen:</p>
              <p>1. Search - Finds any word or phrase in the course content.</p>
              <p>2. Help - Provides additional information about the features of the course.</p>
              <p>3. Resources - Provides additional information related to the topics in the course.</p>
              <p>4. Notes - Provides a printable outline of the course. You may want to print the outline now and add your own notes as you advance through the course.</p>
              <p>5. Print - Prints the current page of the course.</p>
              <p>6. Audio - Turns the narration OFF or ON.</p>              <p>Before you begin, please familiarize yourself with the course navigation. Use the BACK and NEXT buttons at the bottom right of the screen to view the course. You can refer to a specific topic by using the drop-down menu at the top left of the screen. As you progress through the course, previously viewed topics will be indicated by a checkmark next to the title in the drop-down menu.</p>
              <p>To access additional features, use the six buttons at the top center of the screen:</p>
              <p>1. Search - Finds any word or phrase in the course content.</p>
              <p>2. Help - Provides additional information about the features of the course.</p>
              <p>3. Resources - Provides additional information related to the topics in the course.</p>
              <p>4. Notes - Provides a printable outline of the course. You may want to print the outline now and add your own notes as you advance through the course.</p>
              <p>5. Print - Prints the current page of the course.</p>
              <p>6. Audio - Turns the narration OFF or ON.</p>              <p>Before you begin, please familiarize yourself with the course navigation. Use the BACK and NEXT buttons at the bottom right of the screen to view the course. You can refer to a specific topic by using the drop-down menu at the top left of the screen. As you progress through the course, previously viewed topics will be indicated by a checkmark next to the title in the drop-down menu.</p>
              <p>To access additional features, use the six buttons at the top center of the screen:</p>
              <p>1. Search - Finds any word or phrase in the course content.</p>
              <p>2. Help - Provides additional information about the features of the course.</p>
              <p>3. Resources - Provides additional information related to the topics in the course.</p>
              <p>4. Notes - Provides a printable outline of the course. You may want to print the outline now and add your own notes as you advance through the course.</p>
              <p>5. Print - Prints the current page of the course.</p>
              <p>6. Audio - Turns the narration OFF or ON.</p></span>
            </div>
            <div id="controle"> 
            <span style="float:left; font-size:14px">Clique em <b>Pr&oacute;ximo</b> para continuar</span>
            <span style="font-size:14px; margin-right:20px">Pagina 3 de 10</span>
            <input type="button" value="anterior" id="anterior" class="navegacao" />
            <input type="button" value="proximo"  id="proximo" class="navegacao" disabled="disabled"/>

            
            </div>
</div>