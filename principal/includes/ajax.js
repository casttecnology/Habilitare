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

function gEs(tag){
	return document.getElementsByTagName(tag);
	}
	function gE(tag){
	return document.getElementById(tag);
	}
function fechaBox(){
	gE("embeds").innerHTML = "<div></div>";
gE("boxteste").style.display = "none";
	}
	
function abreBox(){
gE("boxteste").style.display = "block";
}	

function gravaQuestao()
{
var radio = document.getElementsByName('resposta');
for (i=0;i<radio.length;i++){
   if (radio[i].checked == true){
	   var resposta = radio[i].value;
	   
   }
}

var questao = gE("questao").value;
var cat = gE("categoria").value;
var ordem = gE("ordem").value;

	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = atualizaQuestao;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("acao=grava&cat="+cat+"&questao="+questao+"&resposta="+resposta+"&ordem="+ordem);
}


function carregaQuestao()
{
	abreBox();
	criaRequisicao();
	var url = "sqls.php";
	var cat = gE("categoria").value;
	var questao = gE("questao").value;
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = atualizaQuestao;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("acao=carrega&cat="+cat+"&questao="+questao);
	
}

function cria_player(cd){
	var oque = cd.name;
	if(oque == "fecha"){
			gE("embeds").innerHTML = "<div></div>";
gE("boxvideo").style.display = "none";
	}else{
	document.getElementById("embeds").innerHTML = '<div style=" margin: 0 auto; width: 50%;"><iframe width="800" height="450" src="https://www.youtube.com/embed/'+oque+'" frameborder="0" allowfullscreen></iframe></div>';
	}
}

function atualizaQuestao()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			//alert(resposta);
			var str = resposta.split("*-*");
			//alert("mostrando   "+str[0]+"..."+str[1]+"..."+str[2]+"..."+str[3]+"..."+str[4]+"..."+str[5]+"..."+str[8]);
			if(str[0] != "acabo"){
			document.getElementById("questao").value = str[0];
			document.getElementById("ordem").value = str[8];
			if(str[11] != ""){
			document.getElementById("imgtestes").innerHTML = '<img src="../imagens/testes/'+str[11]+'" width="500px" />';}
			document.getElementById("perguntas").innerHTML = '<div style="font-size:18px; padding:30px 0px 10px 50px">'+str[1]+'</div>';
			document.getElementById("respostas").innerHTML = '<div style="font-size:16px; padding:20px 0px 30px 20px"><label for="resposta1"><input type="radio" value="1" id="resposta1" name="resposta" />'+str[2]+'</label></div><div style="font-size:16px; padding:20px 0px 30px 20px"><label for="resposta2"><input type="radio" value="2" id="resposta2" name="resposta" />'+str[3]+'</label></div><div style="font-size:16px; padding:20px 0px 30px 20px"><label for="resposta3"><input type="radio" value="3" id="resposta3" name="resposta" />'+str[4]+'</label></div><div style="font-size:16px; padding:20px 0px 30px 20px"><label for="resposta4"><input type="radio" value="4" id="resposta4" name="resposta" />'+str[5]+'</label></div>';
			
			document.getElementById("pagquestao").innerHTML = str[9]+" de "+str[10];
			
			}else
			{
				
				if(str[1] == "")
				{
					if(str[2] == "nrespt")
					alert("VOCE NAO RESPONDEU TODAS AS PERGUNTAS! QUANDO RESPONDER VOLTE E REFACA ESSE ULTIMO TESTE PARA VER SUA NOTA FINAL.")
					else
					document.location.href = 'resultado.php';

				}
				else{
					
			document.location.href = str[1];
				}
			}
			
		}
	}
}

function Ordena(combo){
	var x=document.getElementById(combo);
	total = x.length;
	var cats = [];
	for (i=0;i<total;i++)
    {
		cats[i] = x.options[i].value;
    }

	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = verOrdenar;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	if(combo == "select-para")
	{
		var acao = "ordenacats"	;
	}
	else
	{
		var acao = "ordenasubs"	;
	}
	requisicao.send("codigo="+cats+"&acao="+acao);
}

function verOrdenar()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Reorganizado!"+resposta);

		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function var_dump(obj) {
   if(typeof obj == "object") {
      return "Type: "+typeof(obj)+((obj.constructor) ? "\nConstructor: "+obj.constructor : "")+"\nValue: " + obj;
   } else {
      return "Type: "+typeof(obj)+"\nValue: "+obj;
   }
}//end function var_dump

function mostraTexto()
{
var condi = document.getElementById("full").value;	
if(condi=="sim"){
	document.getElementById("textoarea").style.display = "none";	
}
if(condi=="nao"){
	document.getElementById("textoarea").style.display = "block";	
}
}

function procSubcats(cat)
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = atualizaSubTestes;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+cat+"&acao=procurasubcategorias");
}

function atualizaSubTestes()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
	try{
		var resposta = requisicao.responseText;
		
		var str = resposta.split(":::::");
		var x=document.getElementById("select-para2");
		limpaSel("select-para2");
		
		for(i=0; i < str.length - 1; i++) {
			var y=document.createElement('option');
			var str2 = str[i].split("*-*");
			try{
				//firefox
						var y=document.createElement('option');
						y.value=str2[0];
						y.text=str2[1];
						x.add(y,null);
				}
			catch(Ex){			
						var y=document.createElement('option');
						y.value=str2[0];
						y.text=str2[1];
						x.add(y);	
			}
		}	
}

	catch(Exception){
		alert(resposta);
		}
	
		}
	}
	
}


function cadCurso()
{

	d = document;
	var curso 		= $("curso");
	var img 		= d.getElementById("img");
	var acao		= d.getElementById("acao");
	
	if(curso.value.length < 3)
	{
		alert("Preencha o campo Curso.");
		curso.focus();
		return false;
	}
	
	 if(img.value.length < 3)
	{
		alert("Preencha o campo Imagem.");
		img.focus();
		return false;
	}
	
	else
	{
		return true;
	}

}

function cadSub()
{

	d = document;
	var subcategoria 		= d.getElementById("subcategoria");
	var img 				= d.getElementById("img");
	var acao				= d.getElementById("acao");
	
	if(subcategoria.value.length < 3)
	{
		alert("Preencha o campo SubCategoria.");
		subcategoria.focus();
		return false;
	}
	
	 if(img.value.length < 3 && acao == "novo")
	{
		alert("Preencha o campo Imagem.");
		img.focus();
		return false;
	}
	
	else
	{
		return true;
	}

}


function deleta(codigo)
{
	veri = confirm("Deseja realmente deletar");
	if(veri == true){
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = verDeleta;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&acao=deletar");
	}
}



function verDeleta()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Deletado com sucesso!");
		document.location= "index.php";

		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function cadCategoria()
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 		= d.getElementById("codigo").value;
	var curso 		= d.getElementById("curso").value;
	var categoria 	= d.getElementById("categoria").value;
	var acao	 	= d.getElementById("acao").value;		
	requisicao.onreadystatechange = verCadastroCat;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&curso="+curso+"&categoria="+categoria+"&acao="+acao);
}

function cadTeste()
{
	criaRequisicao();
	var url = "sqls2.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 				= d.getElementById("codigo").value;
	var pergunta 			= d.getElementById("pergunta");
	var resposta1 			= d.getElementById("resposta1");
	var resposta2 			= d.getElementById("resposta2");
	var resposta3 			= d.getElementById("resposta3");
	var resposta4 			= d.getElementById("resposta4");
	var respostacorreta 	= d.getElementById("respostacorreta");
	var curso			 	= d.getElementById("curso2");
	
	if(pergunta.value.length < 3)
	{
		alert("Preencha o campo Pergunta corretamente.");
		pergunta.focus();
		return false;
	}
	if(resposta1.value.length < 3)
	{
		alert("Preencha o campo Resposta1 corretamente.");
		resposta1.focus();
		return false;
	}
	if(resposta2.value.length < 3)
	{
		alert("Preencha o campo Resposta2 corretamente.");
		resposta2.focus();
		return false;
	}
		if(resposta3.value.length < 3)
	{
		alert("Preencha o campo Resposta3 corretamente.");
		resposta3.focus();
		return false;
	}
		if(resposta4.value.length < 3)
	{
		alert("Preencha o campo Resposta4 corretamente.");
		resposta4.focus();
		return false;
	}	
	if(respostacorreta.value.length < 1)
	{
		alert("Preencha o campo Resposta Correta corretamente.");
		respostacorreta.focus();
		return false;
	}
	if(curso.value == 0)
	{
		alert("Selecione um Curso.");
		curso.focus();
		return false;
	}		
	else{
	var acao = d.getElementById("acao2").value;
	requisicao.onreadystatechange = verCadastroTe;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&pergunta="+pergunta.value+"&resposta1="+resposta1.value+"&resposta2="+resposta2.value+"&resposta3="+resposta3.value+"&resposta4="+resposta4.value+"&respostacorreta="+respostacorreta.value+"&curso="+curso.value+"&acao="+acao);
	}
}

function verCadastroTe()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Cadastro realizado com sucesso!"+resposta);
		var local =document.getElementById("caminho").value;
		document.location= local;
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function verCadastroCat()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Cadastro realizado com sucesso!");
		document.location= "index.php";
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function cadAluno()
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 		= d.getElementById("codigo").value;
	var nome 		= d.getElementById("nome").value;
	var sobrenome 	= d.getElementById("sobrenome").value;
	var senha	 	= d.getElementById("senha").value;
	var cpf	 		= d.getElementById("cpf").value;
	var rg	 		= d.getElementById("rg").value;
	var telefone	= d.getElementById("telefone").value;
	var endereco	= d.getElementById("endereco").value;
		var marcados = ' '; 
		var chk =document.getElementById('formulario');
		for(i=0;i<chk.length;i++){ 
		if(chk.elements[i].name=='curso[]' && chk.elements[i].checked==true) 
		marcados += chk.elements[i].value + " "; 
		} 
	var acao	 	= d.getElementById("acao").value;		
	requisicao.onreadystatechange = verCadastroAluno;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&nome="+nome+"&sobrenome="+sobrenome+"&senha="+senha+"&cpf="+cpf+"&rg="+rg+"&telefone="+telefone+"&endereco="+endereco+"&curso="+marcados+"&acao="+acao);
}
function verCadastroAluno()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Cadastro realizado com sucesso!"+resposta);
		document.location= "index.php";
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function verCadastroCat()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Cadastro realizado com sucesso!");
		document.location= "index.php";
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function verCurso()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Cadastro realizado com sucesso!"+resposta);
		document.location= "../cursos/index.php";
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}


function cadCliente(produto)
{
	criaRequisicao();
	var url = "../classes/sqls.class.php";
	requisicao.open("POST", url, true);
	d = document;
	var email 		= d.getElementById("email").value;
	var senha 		= d.getElementById("senha").value;
	var resenha 	= d.getElementById("resenha").value;
	var nome		= d.getElementById("nome").value;
	var sobrenome	= d.getElementById("sobrenome").value;
	var cpf			= d.getElementById("cpf").value;
	var rg			= d.getElementById("rg").value;
	var dt_dia		= d.getElementById("dt_dia").value;
	var dt_mes		= d.getElementById("dt_mes").value;
	var dt_ano		= d.getElementById("dt_ano").value;
	var sexo		= d.getElementById("sexo").value;
	var cep			= d.getElementById("cep").value;
	var numero		= d.getElementById("numero").value;
	var endereco	= d.getElementById("endereco").value;
	var complemento	= d.getElementById("complemento").value;
	var bairro		= d.getElementById("bairro").value;
	var cidade		= d.getElementById("cidade").value;
	var estado		= d.getElementById("estado").value;
	var telefone1	= d.getElementById("telefone1").value;
	var telefone2	= d.getElementById("telefone2").value;
	var celular		= d.getElementById("celular").value;
	var recebeemail	= d.getElementById("recebeemail").value;
	
	requisicao.onreadystatechange = verificaCadastro;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("email="+email+"&senha="+senha+"&resenha="+resenha+"&nome="+nome+"&sobrenome="+sobrenome+"&cpf="+cpf+"&rg="+rg+"&dt_dia="+dt_dia+"&dt_mes="+dt_mes+"&dt_ano="+dt_ano+"&sexo="+sexo+"&cep="+cep+"&numero="+numero+"&endereco="+endereco+"&complemento="+complemento+"&bairro="+bairro+"&cidade="+cidade+"&estado="+estado+"&telefone1="+telefone1+"&telefone2="+telefone2+"&celular="+celular+"&recebeemail="+recebeemail);
}


function verificaCadastro()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			alert(resposta);
			document.getElementById('frete').innerHTML = resposta;
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