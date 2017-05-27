<?
session_start();
include("classes/banco.php");
$idsessao = session_id();
$con = new DB();

$con->upTab("logalunos","log_dtout = '".date("Y-m-d")."', log_hrout = '".date("H:i:s")."'","log_session = '".$idsessao."' and log_aluno = ".$_SESSION["usuario"]);
session_regenerate_id();
session_destroy();
session_unset();
echo"<script>document.location.href='login.php?usr_ok=0'</script>";

?>
