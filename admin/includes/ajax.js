// JavaScript Document

var requisicao = null;

function criaRequisicao()
{
	try
	{
		requisicao = new XMLHttpRequest();
	}
	catch(microsoft)
	{
		try
		{
			requisicao = new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(outros)
		{
			try
			{
				requisicao = new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(falhou)
			{
				requisicao = null;
			}
		}
	}
	if(requisicao == null)
	alert("erro ao criar objeto de request");
}

function deletaprod(produto)
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	requisicao.onreadystatechange = atualizaPag;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+produto+"&acao=delprod");
}

function atualizaPag()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			alert("Deletado com sucesso!");
		}
	}
}

function cadastraprod()
{
criaRequisicao();
var nome = document.getElementById("nome").value;
var descricao = document.getElementById("descricao").value;
var preco = document.getElementById("preco").value;
var precopromocional = document.getElementById("precopromocional").value;
var titulo = document.getElementById("titulo").value;
var prazo = document.getElementById("prazo").value;
var pagseguro = document.getElementById("pagseguro").value;
var quantidade = document.getElementById("quantidade").value;
var status = document.getElementById("status").value;
var subcategoria = document.getElementById("subcategoria").value;

var url = "sqls.php";
requisicao.open("POST", url, true);
requisicao.onreadystatechange = cadprod;
requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
requisicao.send("nome="+nome+"&descricao="+descricao+"&preco="+preco+"&precopromocional="+precopromocional+"&titulo="+titulo+"&prazo="+prazo+"&pagseguro="+pagseguro+"&quantidade="+quantidade+"&status="+status+"&subcategoria="+subcategoria+"&acao=cadprod");
}


function cadprod()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;

			alert(resposta);

		}
	}
}

function limpaSel(combo){
	var x=document.getElementById(combo);
	total = x.length;
	for (i=0;i<=total;i++)
    {
   x.remove(x.options[i]);
    }
}


function selecionaSub()
{
criaRequisicao();
var categoria = document.getElementById("categoria").value;
var url = "../produtos/sqls.php";
requisicao.open("POST", url, true);
requisicao.onreadystatechange = atualizaSub;
requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
requisicao.send("acao=categoria&categoria="+categoria);
}


function atualizaSub()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
	try{
		var resposta = requisicao.responseText;
		var str = resposta.split("xyz");
		var x=document.getElementById("subcategoria");
		limpaSel("subcategoria");


		for(i=0; i < str.length - 1; i++) {
			var y=document.createElement('option');
			vs = str[i].split(":::::");

			try{
				//firefox
				var y=document.createElement('option');
				y.text=vs[1];
				y.value=vs[0];
				x.add(y,null);
				}
			catch(Ex){
				var y=document.createElement('option');
				y.text=vs[1];
				y.value=vs[0];
				x.add(y);	
			}

		}
		
}

	catch(Exception){
		document.getElementById("subcategoria").value = innerHTML = aux;
		}
	
		}
	}
}

function mudaStatus(codigo,status)
{
criaRequisicao();
var url = "sqls.php";
//alert("codigo="+codigo+"&status="+status);
requisicao.open("POST", url, true);
requisicao.onreadystatechange = atualizaStatus;
requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
requisicao.send("codigo="+codigo+"&status="+status+"&acao=status");
}
function atualizaStatus()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			var str = resposta.split("XX");
			//alert(resposta);
			if(str[0] == 0){var imgstatus = "offline.jpg";}
			if(str[0] == 1){var imgstatus = "online.jpg";}
			document.getElementById("status"+str[1]).InnerHTML = '<a href="" onclick="mudaStatus(\''+str[1]+'\',\''+str[0]+'\')"><img src="../imagens/'+imgstatus+'"></a>';
		}
	}
}