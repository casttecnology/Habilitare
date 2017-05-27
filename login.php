<html>
<head>
  <title>LOGIN</title>
</head>

<body>
<img align = "center" src="imagens/testes/0bf5589dd111a7133728ef78f90fa89f.jpg" width="160" height="133" alt=""/>

<form name="form1" method="post" action="autentica.php">
<table width="250" align="center">
<tr>
<td></td>
<td align="center">
 <table border="0" width="220" cellpadding="0" cellspacing="0" style="font-family:Verdana, Geneva, sans-serif; font-size:10px">
  <tr>
    <td align="center" style="font-size:14px; font-weight:bold" colspan="2">Login<br>
      <br></td>
  </tr>
  <tr>
    <td height="29" align="right">Usu&aacute;rio :&nbsp;</td>
    <td><input type="text" name="login" id="login" /></td>
  </tr>
  <tr>
    <td align="right">Senha :&nbsp;</td>
    <td><input type="password" name="senha" /></td>
   </tr>
   <tr>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
     <td><div align="left"><input class="Botao" type="submit" name="enviar" value="   Entrar   "></div></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
     <td>&nbsp;</td>
  </tr>
  <tr>
  <td colspan="2" align="center">&nbsp;
     <font color="#FF0000"><b>
	 <?
     if($login_erro==1)
     echo "Login ou senha invalido!";
     ?>
	 </b></font>
     </td>
  </tr>
</table>
</td>
</tr>
</table>
 </form>
 <script>
document.getElementById("login").focus();
</script>
</body>

</html>
