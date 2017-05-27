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
function deleta2(codigo)
{
	veri = confirm("Deseja realmente deletar");
	if(veri == true){
	criaRequisicao();
	var url = "sqls2.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = verDeleta2;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&acao2=deletar");
	}
}
function verDeleta2()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			//alert(resposta);
	try{
			if(resposta == "nao"){
			alert("A pergunta ja foi respondida por alunos, impossivel deletar.");
			
			}else{
				alert("Deletado com sucesso!");
				document.location= "cad_categoria.php";
			}
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
	}
}

function deleta3(codigo)
{
	veri = confirm("Deseja realmente deletar");
	if(veri == true){
	criaRequisicao();
	var url = "sqls3.php";
	requisicao.open("POST", url, false);
	requisicao.onreadystatechange = verDeleta3;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&acao2=deletar");
	}
}
function verDeleta3()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			//alert(resposta);
	try{
			if(resposta == "nao"){
			alert("A pergunta ja foi respondida por alunos, impossivel deletar.");
			
			}else{
				alert("Deletado com sucesso!");
				document.location= "cad_categoria.php";
			}
		}

	catch(Exception){
		alert("Ocorreu um erro tente novamente!");
		}
	
		}
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

function LimpaRel()
{
	
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 		= d.getElementById("cdaluno").value;
	var acao	 	= "limparel";
	requisicao.onreadystatechange = verLimpaRel;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&acao="+acao);
}
function verLimpaRel()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("Deletado com sucesso!"+resposta);
		document.location= "rel_teste.php";
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
				
				alert("Cadastro realizado com sucesso!");
				document.location= "index.php";
			}

			catch(Exception){
				alert("Ocorreu um erro tente novamente!");
			}
			
		}
	}
}

function cadAlunoCompra()
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 		= d.getElementById("codigo").value;
	var nome 		= d.getElementById("nome").value;
	var sobrenome 	= d.getElementById("sobrenome").value;
	var cpf	 		= d.getElementById("cpf").value;
	var rg	 		= d.getElementById("rg").value;
	var telefone	= d.getElementById("telefone").value;
	var endereco	= d.getElementById("endereco").value;
	var valor		= d.getElementById("valor").value;
	var marcados 	= d.getElementById("curso").value; 
	var acao	 	= d.getElementById("acao").value;		
	var descricao	= d.getElementById("descricao").value;
	var senha	 	= rg.substring(0, 5);
	requisicao.onreadystatechange = verCadastroAlunoCompra;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&nome="+nome+"&sobrenome="+sobrenome+"&senha="+senha+"&cpf="+cpf+"&rg="+rg+"&telefone="+telefone+"&endereco="+endereco+"&curso="+marcados+"&acao="+acao+"&valor="+valor+"&descricao="+descricao);
}

function verCadastroAlunoCompra()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			
			try{
				debugger;
				//alert("Cadastro realizado com sucesso!");
				resposta = resposta.replace(/\"/g,"#");
				var res = resposta.split("#");
				//document.location = res[1];
				document.getElementById('pedido').src = res[1];

				var id = "#janela1";

				var alturaTela = $(document).height();
				var larguraTela = $(window).width();

				//colocando o fundo preto
				$('#mascara').css({'width':larguraTela,'height':alturaTela});
				$('#mascara').fadeIn(1000);	
				$('#mascara').fadeTo("slow",0.8);

				var left = ($(window).width() /2) - ( $(id).width() / 2 );
				var top = ($(window).height() / 2) - ( $(id).height() / 2 );
				
				$(id).css({'top':top,'left':left});
				$(id).show();	


			}

			catch(Exception){
				alert("Ocorreu um erro tente novamente!");
			}
			
		}
	}
	//else{alert( "Unexpected error:  " + this.statusText + ".\nPlease try again");}
}

function cadUsuario()
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	d = document;
	var codigo 		= d.getElementById("codigo").value;
	var usuario 	= d.getElementById("usuario").value;
	var senha 		= d.getElementById("senha").value;
	var bt1	 		= d.getElementById("alunos");
	var bt2	 		= d.getElementById("cursos");
	var bt3	 		= d.getElementById("categorias");
	var bt4			= d.getElementById("subcategorias");
	var bt5			= d.getElementById("usuarios");
	var acao	 	= d.getElementById("acao").value;	
	
	if(bt1.checked==true){
		bt1 = "1";
	}else{ bt1 = "0";}
	if(bt2.checked==true){
		bt2 = "1";
	}else{ bt2 = "0";}	
	if(bt3.checked==true){
		bt3 = "1";
	}else{ bt3 = "0";}
	if(bt4.checked==true){
		bt4 = "1";
	}else{ bt4 = "0";}
	if(bt5.checked==true){
		bt5 = "1";
	}else{ bt5 = "0";}			

	requisicao.onreadystatechange = verCadastroAluno;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&usuario="+usuario+"&senha="+senha+"&bt1="+bt1+"&bt2="+bt2+"&bt3="+bt3+"&bt4="+bt4+"&bt5="+bt5+"&acao="+acao);
}

function reabilitar(curso)
{
	criaRequisicao();
	var url = "sqls.php";
	requisicao.open("POST", url, true);
	var codigo 		= curso;
	var acao	 	= "reabilita";		
	requisicao.onreadystatechange = verR;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("codigo="+codigo+"&acao="+acao);
}
function verR()
{
	if(requisicao.readyState == 4)
	{
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
	try{
		
		alert("O Curso foi reabilitado!"+resposta);
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

function loginAluno()
{
	var id = "#janela2";

	var alturaTela = $(document).height();
	var larguraTela = $(window).width();

	//colocando o fundo preto
	$('#mascara').css({'width':larguraTela,'height':alturaTela});
	$('#mascara').fadeIn(1000);	
	$('#mascara').fadeTo("slow",0.8);

	var left = ($(window).width() /2) - ( $(id).width() / 2 );
	var top = ($(window).height() / 2) - ( $(id).height() / 2 );
	
	$(id).css({'top':top,'left':left});
	$(id).show();	
}

function requerLogin()
{
	debugger;
	criaRequisicao();
	var url = "autentica.php";
	requisicao.open("POST", url, true);
	d = document;
	var nome 		= d.getElementById("usuario").value;
	var pwsn 		= d.getElementById("pwsn").value;
	requisicao.onreadystatechange = verLogin;
	requisicao.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	requisicao.send("nome="+nome+"&senha="+pwsn);
}

function verLogin()
{
	if(requisicao.readyState == 4)
	{
		debugger;
		if(requisicao.status == 200)
		{
			var resposta = requisicao.responseText;
			try{
				//alert("Cadastro realizado com sucesso!"+resposta);
				document.location= "../compra/index.php";
			}

			catch(Exception){
				alert("Ocorreu um erro tente novamente!");
			}
	
		}
	}
}

function newLogin()
{
	sessionStorage.clear();
	document.location= "../compra/index.php";
}