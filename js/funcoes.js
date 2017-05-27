
function salvarProduto(){

	var nome = document.getElementById("nome").value;
	var preco = document.getElementById("preco").value;
	var categoria = document.getElementById("categoria").value;
	var subcategoria = document.getElementById("subcategoria").value;
		if(nome == "" || nome.length <= 2){
			alert("O campo Nome não foi preenchido corretamente!");
			document.getElementById("nome").focus();
			return false;
		}
		
		if(preco == ""){
			alert("O campo Preço não foi preenchido corretamente!");		
			document.getElementById("preco").focus();
			return false;
		}
		if(categoria == ""){
			alert("O campo Categoria não foi selecionado corretamente!");		
			document.getElementById("categoria").focus();
			return false;
		}
		if(subcategoria == ""){
			alert("O campo Subcategoria não foi Selecionado corretamente!");		
			document.getElementById("subcategoria").focus();
			return false;
		}else{
			updateRTEs();
			document.forms["formproduto"].submit();
		}
}





function salvarSubcategoria(){

	var nome = document.getElementById("nomesub").value;
		var categoria = document.getElementById("cat").value;

		if(categoria == ""){
			alert("Para poder habilitar essa função:\n1 passo - Prencha os dados da Categoria\n2 passo - Clique no botão salvar\n3 passo - Em seguida poderá cadastrar as subcategorias.");
			document.getElementById("nomecat").focus();
			return false;

		}
		if(nome == "" || nome.length <= 2){
			alert("O campo Nome da subcategoria não foi preenchido corretamente!");
			document.getElementById("nomesub").focus();
			return false;

		}
		else{
			return true;
		}
}

function salvarCategoria(){

	var nome = document.getElementById("nomecat").value;

		if(nome == "" || nome.length <= 2){
			alert("O campo Nome da categoria não foi preenchido corretamente!");
			document.getElementById("nomecat").focus();
			return false;

		}
		else{
			document.forms["formcategoria"].submit();
		}
}


function salvarCliente(){

	var nome = document.getElementById("nome_cli").value;

		if(nome == "" || nome.length <= 2){
			alert("O campo Nome não foi preenchido corretamente!");
			document.getElementById("nome_cli").focus();
			return false;
		}else{
			updateRTEs();
			document.forms["formcliente"].submit();
		}
}

function deletarProduto(){
		var confirmacao = confirm("Deseja realmente deletar o produto?");
		if(confirmacao == true){
		document.getElementById("acao").value = "del";
		document.forms["formproduto"].submit();
		}
}

function deletarImagem(){
		var confirmacao = confirm("Deseja realmente deletar a imagem?");
		if(confirmacao == true){
			return true;
		}
		else
		{
			return false;
		}
}

function deletarCategoria(){
		var confirmacao = confirm("Deseja realmente deletar a Categoria?");
		if(confirmacao == true){
		document.getElementById("acao").value = "delcat";
		document.forms["formcategoria"].submit();
		}
}

function deletarCategoria2(){
		var confirmacao = confirm("Deseja realmente deletar a Categoria?");
		if(confirmacao == true){
		return true;
		}
		else{
			return false;
			}
}

function deletarSub(){
		var confirmacao = confirm("Deseja realmente deletar a Subcategoria?");
		if(confirmacao == true){
		return true;
		}
		else{
			return false;
			}
}


function deletarProduto2(){
		var confirmacao = confirm("Deseja realmente deletar o Produto?");
		if(confirmacao == true){
		return true;
		}
		else{
			return false;
			}
}

function cadImagem(){

	var d = document.getElementById;
	var nome = d("nome").value;

		if(nome == "" || nome.length <= 2){
			alert("O campo Nome não foi preenchido corretamente!");
			d("nome").focus();
			return false;
		}
		imagemp = document.getElementById("imagemp");
		url = "upload.php?imagemp="+imagemp;
		ajaximagens(url);

}
function editImagem(){

	var d = document.getElementById;
	var nome = d("nome").value;

		if(nome == "" || nome.length <= 2){
			alert("O campo Nome não foi preenchido corretamente!");
			d("nome").focus();
			return false;
		}
		

}


function publicaProdutos() { 
/*	var namelist = new Array();
	with(document.formprodutos) {
		for(var i = 0; i < produtos.length; i++){
			if(produtos[i].checked == true) {
				namelist[i] = produtos[i].value;
			}
		}
	}
	*/
/*	var mutli_education = document.formprodutos.elements["produtos[]"];
	for(i=0;i<mutli_education.length;i++)
{
 alert(mutli_education[i].value);
}
*/
document.getElementById("acao").value = "publicar";
document.getElementById("publicado").value = "1";
 document.formprodutos.submit();
//document.location.href="teste.php?prods="+namelist;
}
function despublicaProdutos() { 
/*	var namelist = new Array();
	with(document.formprodutos) {
		for(var i = 0; i < produtos.length; i++){
			if(produtos[i].checked == true) {
				namelist[i] = produtos[i].value;
			}
		}
	}
	*/
/*	var mutli_education = document.formprodutos.elements["produtos[]"];
	for(i=0;i<mutli_education.length;i++)
{
 alert(mutli_education[i].value);
}
*/
document.getElementById("acao").value = "publicar";
document.getElementById("publicado").value = "0";
 document.formprodutos.submit();
//document.location.href="teste.php?prods="+namelist;
}


function startUpload(){
var imagemp = document.getElementById("imagemp").value;
var imagemg = document.getElementById("imagemg").value;
var idproduto = document.getElementById("idproduto").value;

		if(idproduto == ""){
			alert("Para poder habilitar essa função:\n1 passo - Prencha os dados do produto\n2 passo - Clique no botão salvar\n3 passo - Em seguida poderá carregar as imagens.");
			return false;
		}

		if(imagemp == ""){
			alert("O campo imagem menor não foi preenchido!");
			document.getElementById("imagemp").style.backgroundColor = "#FFFFD5";
			return false;
		}
		if(imagemg == ""){
			alert("O campo imagem maior não foi preenchido!");
			document.getElementById("imagemg").style.backgroundColor = "#FFFFD5";
			return false;
			
		}else{
      document.getElementById('f1_upload_process').style.visibility = 'visible';
      document.getElementById('f1_upload_form').style.visibility = 'hidden';
      return true;			
		}

}

function limpaTabela(tabela)
{
	var tble = document.getElementById(tabela);
	for (var i=tble.rows.length-1; i>-1; i--) {
		tble.deleteRow(i);
	}
}
function stopUpload(success, imagemcarregada,imagemcarregada2,diretorio,acao){

      var result = '';
      if (success == 1){
         result = '';
      }
      else {
         result = '';
      }
		document.getElementById('f1_upload_process').style.visibility = 'hidden';
		document.getElementById('f1_upload_form').innerHTML = '<br>Carregado com sucesso!';
		document.getElementById('f1_upload_form').style.visibility = 'visible'; 

		
			try{
			
				imagemcarregada = "../../images/produtos/"+diretorio+"/"+imagemcarregada;
				imagemcarregada2 = "../../images/produtos/"+diretorio+"/"+imagemcarregada2;


				var i = i + 1;
				var tbl = document.getElementById("imagens");
				var novalinha = tbl.insertRow(-1);
				var coluna1 = novalinha.insertCell(0);
					coluna1.setAttribute('align', 'center');
					coluna1.setAttribute('class', 'tabdesc');
				coluna1.innerHTML = "<input type='radio' name='imagemdestaque' value='"+i+"'>";
				var coluna2 = novalinha.insertCell(1);
					coluna2.setAttribute('class', 'tabmeio');
					coluna2.innerHTML = '<img src="'+imagemcarregada+'" width="35px" height="26px" style="margin-right:5px"><img src="'+imagemcarregada2+'" width="70px" height="53px">';
				var coluna3 = novalinha.insertCell(2);
					coluna3.setAttribute('class', 'tabmeio');	
					coluna3.innerHTML = "<a href='../produtos/cadastros.php onclick='return deletarImagem()'><img src='../images/lixeira.png' /></a>";

document.getElementById("frmupload").reset();
}
catch(Exception){
alert("erro;")
	}
		
		
      return true;   
}

