<?php
require_once('class.Thumbnail.php');

$galeriaThumbs = "../imagens/produtos/";

            	if (!file_exists($galeriaThumbs.$img)) {
            		$img = "capa.jpg";
            	}
				//echo "<script>alert('$galeriaThumbs . $img')</sc

$tn_image = new Thumbnail($galeriaThumbs . $img, $_GET["w"], $_GET["h"], 0);
$tn_image->show();
?>