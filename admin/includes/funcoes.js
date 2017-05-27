// JavaScript Document

function deletar()
{
	var decisao = confirm("Deseja realmente deletar");
	if(decisao == "true"){	}
	else{}
}

function selecionacheck()
{

	var objeto = document.forms["formulario"].elements["opcao"];
	if(!objeto)
		return;
	var contachecks = objeto.length;
	if(!contachecks)
		objeto.checked = document.getElementById("opcaop").checked;
	else
		for(var i = 0; i < contachecks; i++)
			objeto[i].checked = document.getElementById("opcaop").checked;
	
}