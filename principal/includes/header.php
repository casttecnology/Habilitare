<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="includes/estilo.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="../ajax/ajax.js"  charset="utf-8"></script>
<script type="text/javascript" src="ajax.js"></script>
<script language=Javascript>
/*var message="Desabilitado!";
function clickIE4(){if (event.button==2){alert(message);return false;}}function clickNS4(e){if (document.layers||document.getElementById&&!document.all){if (e.which==2||e.which==3){alert(message);return false;}}}if (document.layers){document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS4;}else if (document.all&&!document.getElementById){document.onmousedown=clickIE4;}document.oncontextmenu=new Function("alert(message);return false") 

*/
function mostraMenu()
{
	var menu = document.getElementById("menu").style.display;
	if(menu=="block"){
		document.getElementById("menu").style.display = "none";
	}else
	{
		document.getElementById("menu").style.display = "block";
	}
}

function saiMenu()
{
	setTimeout("mostraMenu()",800);
}

function habilitaNagegacao()
{
	time = setInterval("soma()", 1000);
	setTimeout("habilita()",2000);
}

function soma()
{
	valor = document.getElementById('crom').innerHTML;
	document.getElementById('crom').innerHTML = parseInt(valor) + 1;

}
function habilita()
{
	clearInterval(time);
	//document.getElementById('crom').innerHTML = "";
if (document.getElementById("proximo").disabled==true)
document.getElementById("proximo").disabled=false
else
document.getElementById("proximo").disabled=true

}

</script>


<title>Administrador</title>
</head>

<body onload="javascript:habilitaNagegacao()">
