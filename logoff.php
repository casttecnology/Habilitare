<?
session_start();
session_destroy();
echo"<script>document.location.href='login.php?usr_ok=0'</script>";
?>
