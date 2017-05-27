<?
include("includes/header.php");


?>

<script>
largura = screen.width;
altura = screen.height;


document.write('<div style="background-image:url(imagens/bg.jpg); height:100%; width:100%; background-position:top; background-size:'+largura+'px '+altura+'px;background-repeat:no-repeat;">');
</script>


<center>
<form name="form1" method="post" action="autentica.php" style="width:600px">

<div style="height:20px; width:500px"></div><div style="float:left; width:250px; font-size:12px; color:#69F; margin:5px; font-family:Arial, Helvetica, sans-serif">Use um nome de usu&aacute;rio e senha v&aacute;lidos para acessar o Painel de Cursos
<img src="imagens/login_lock.jpg">
 </div>
<div style="float:left">
<table width="250">
<tr>
<td></td>
<td align="center">
 <table border="0" width="240" style="font-family:Verdana, Geneva, sans-serif; font-size:10px">
  <tr>
    <td align="center" style="font-size:14px; font-weight:bold; color:#69F;" colspan="2">Habilitare - Login do Aluno<br><br></td>
  </tr>
          <tr>
            <td align="right">Nome de Usu&aacute;rio :&nbsp;</td>
            <td><input type="text" name="login" size="15"></td>
          </tr>
          <tr>
            <td align="right">Senha :&nbsp;</td>
            <td><input type="password" name="senha" size="15" maxlength="10"></td>
           </tr>
   <tr>
    <td></td>
     <td>&nbsp;</td>
  </tr>
    <tr>
    <td></td>
     <td><div align="left"><input class="Botao" type="submit" name="enviar" value="Login"></div></td>
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
</table> </div>

 </form>


 </center><div style="margin:0 auto; width:600px; height:100%; background-image:url(imagens/logo_bg.png); background-repeat:no-repeat; background-position:top; margin-top:140px">
</div>
</div>