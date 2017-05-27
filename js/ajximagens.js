// JavaScript Document
function ajaximagens(url)
{
req = null;
// Procura por um objeto nativo (Mozilla/Safari)


if (window.XMLHttpRequest) {
		req = new XMLHttpRequest();
		req.onreadystatechange = AtualizaModelo;
		req.open("POST",url,true);

		req.send('');
		

// Procura por uma versão ActiveX (IE)
} else if (window.ActiveXObject) {
	req = new ActiveXObject("Microsoft.XMLHTTP");
	if (req) {
	req.onreadystatechange = AtualizaModelo;
	req.open("POST",url,true);

	req.send('');
	

	}
	 else {
		alert("Seu Browser(Mozila, Internet Explorer, Safari)?");
	}
  }
}



function AtualizaModelo()
{
if (req.readyState == 4 || req.readyState == 0) {

if (req.status == 200) {

aux = req.responseText;

erro = "erro";
if(aux == erro){
alert(aux);
}else{


	alert("ok");
		
}


}
else {
alert("Houve um problema, tente novamente:n" + req.statusText);
}
}
}