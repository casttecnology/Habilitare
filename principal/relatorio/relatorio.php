<?php    
 /* pChart library inclusions */ 
  include("../classes/banco.php");
 include("pchart/class/pData.class.php"); 
 include("pchart/class/pDraw.class.php"); 
 include("pchart/class/pPie.class.php"); 
 include("pchart/class/pImage.class.php"); 

$dbcat = new DB();

 /* vetor que define porcentagem do grafico */ 
 $MyData = new pData();    
 $MyData->addPoints(array(50,2,3,4,7,10,25,48),"ScoreA");   
 $MyData->setSerieDescription("ScoreA","Application A"); 

 /* vetor de nomes dos dados */ 
$dbcat->selTab("","categoria"," * ", "cat_curso = 2","cat_ordem");
$nomecat = array();
while($categorias = mysql_fetch_array($dbcat->resultado)){
	$nomecat[] = $categorias["cat_nome"];
}


 $MyData->addPoints($nomecat,"Labels"); 
 $MyData->setAbscissa("Labels"); 

 /* Create the pChart object */ 
 $myPicture = new pImage(1000,480,$MyData); 

 /* fundo  de linhas */ 
 $Settings = array("R"=>170, "G"=>183, "B"=>87, "Dash"=>1, "DashR"=>190, "DashG"=>203, "DashB"=>107); 
 $myPicture->drawFilledRectangle(0,0,1000,1000,$Settings); 

 /* Overlay with a gradient */ 
 $Settings = array("StartR"=>219, "StartG"=>231, "StartB"=>139, "EndR"=>1, "EndG"=>138, "EndB"=>68, "Alpha"=>50); 
 $myPicture->drawGradientArea(0,0,1000,480,DIRECTION_VERTICAL,$Settings); 
 $myPicture->drawGradientArea(0,0,1000,20,DIRECTION_VERTICAL,array("StartR"=>0,"StartG"=>0,"StartB"=>0,"EndR"=>50,"EndG"=>50,"EndB"=>50,"Alpha"=>100)); 

 /* borda preta */ 
 $myPicture->drawRectangle(0,0,999,479,array("R"=>0,"G"=>0,"B"=>0)); 

 /* Titulo */  
 $myPicture->setFontProperties(array("FontName"=>"pchart/fonts/Silkscreen.ttf","FontSize"=>6)); 
 $myPicture->drawText(13,13,"Resultado Final dos testes realizados",array("R"=>255,"G"=>255,"B"=>255)); 

 /* Fonte do grafico */  
 $myPicture->setFontProperties(array("FontName"=>"pchart/fonts/Forgotte.ttf","FontSize"=>12,"R"=>80,"G"=>80,"B"=>80)); 

 /* Cria grafico */  
 $PieChart = new pPie($myPicture,$MyData); 

 /* Configuração do raio de pizza, etc */  
 $PieChart->draw3DPie(450,200,array("Radius"=>150,"DrawLabels"=>TRUE,"LabelStacked"=>TRUE,"Border"=>TRUE,"DataGapAngle"=>5,"WriteValues"=>TRUE,"DataGapRadius"=>6)); 

 /* Write the legend box */  
 $myPicture->setShadow(FALSE); 
//$PieChart->drawPieLegend(15,40,array("Alpha"=>80)); 

 /* diretorio cache de saida da imagem */ 
 $myPicture->autoOutput("pictures/example.draw3DPie.labels.png"); 
?> 