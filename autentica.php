<?
session_start();

include("classes/banco.php");

$usuario 	= $_POST["login"];
$senha 		= $_POST["senha"];
$usr_ok=0;
$con = new DB();
$con->DBError();
$con->selTab("","usuarios","*","usuario='".$usuario."' and senha='".$senha."'","");


if($dados = mysql_fetch_array($con->resultado))
{

	$nivel=$dados["usuario"];
    $usuario=$dados["senha"];
	$bt1=$dados["bt1"];
	$bt2=$dados["bt2"];
	$bt3=$dados["bt3"];
	$bt4=$dados["bt4"];
	$bt5=$dados["bt5"];
	$bt6=$dados["bt6"];
	if($bt1 == "1"){$li = "alunos";}
	elseif($bt2 == "1"){$li = "cursos";}
	elseif($bt3 == "1"){$li = "categorias";}
	elseif($bt4 == "1"){$li = "subcategorias";}
	elseif($bt5 == "1"){$li = "usuarios";}
	elseif($bt6 == "1"){$li = "manoel";}
	$_SESSION["bt1"] = $bt1;
	$_SESSION["bt2"] = $bt2;
	$_SESSION["bt3"] = $bt3;
	$_SESSION["bt4"] = $bt4;
	$_SESSION["bt5"] = $bt5;
	$_SESSION["bt6"] = $bt6;
  $_SESSION["usr_ok"] = "1";
	echo"<script>document.location.href='".$li."/index.php'</script>";
}
else
{

	$login_erro=1;
  	include("login.php");
}
?>
