<?
session_start();
$idsessao = session_id();
//session_register(usr_ok);
include("classes/banco.php");

$usuario 	= $_POST["login"];
$senha 		= $_POST["senha"];
$usr_ok=0;	
$con = new DB();
$con2 = new DB();
$con->DBError();
$con->selTab("","aluno","*","al_nome='".$usuario."' and al_senha='".$senha."'","");

if($dados = mysql_fetch_array($con->resultado))
{
    $_SESSION["usuario"]=$dados["al_id"];
	
	$con2->insTab("logalunos","log_aluno, log_dtin, log_hrin, log_session",$dados["al_id"].",'".date("Y-m-d")."','".date("H:i:s")."','".$idsessao."'");
    $_SESSION["logado"] = 1;
	echo "<script>document.location.href='index2.php'</script>";
}
else
{
	$login_erro=1;
  	include("login.php");
}
?>
