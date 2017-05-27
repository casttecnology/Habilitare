<?php
session_start();
include("classes/banco.php");

$con		= new DB();

$acao 		= $_POST["acao"];
$cat 		= $_POST["cat"];
$questao 	= $_POST["questao"];
$resposta 	= $_POST["resposta"];
$ordem 		= $_POST["ordem"];
$aluno		= $_SESSION["usuario"];
$ord2 = "";



if($acao == "grava"){
	$con->insTab("resultado_aluno","re_cat, re_aluno, re_pergunta, re_resposta, re_data, re_hora",$cat.",".$_SESSION["usuario"].",".$questao.",".$resposta.",'".date("Y-m-d")."','".date("H:i:s")."'");
	carregaQuestao($cat,$questao,$ordem);
}

if($acao == "carrega"){
carregaQuestao($cat,$questao,$ordem);
}

function carregaQuestao($cat,$questao,$ordem)
{
	//se a questao nao for a primeira
	if($ordem <> 0){
		$ordem  = $ordem;
	$limite = $ordem.",1";
	}
	$aluno		= $_SESSION["usuario"];
	$cursofeito = $_SESSION["curso"];
	$con = new DB();
	$con2 = new DB();
	$con3 = new DB();
	$con->selTab($limite,"testes","*", "te_curso = ".$cat,"te_ordem");
	$dados = mysql_fetch_array($con->resultado);
	$qtd = mysql_num_rows($con->resultado);

	if($qtd > 0){
	echo $dados[0]."*-*".$dados[1]."*-*".$dados[2]."*-*".$dados[3]."*-*".$dados[4]."*-*".$dados[5]."*-*".$dados[6]."*-*".$dados[7]."*-*".$dados[8];
	$imagem = "*-*".$dados[9];
	$teste = $dados[0];
	
	$con2->selTab("","testes","*", "te_curso = ".$cat,"te_ordem asc");
	$num = mysql_num_rows($con2->resultado);
	$cc = 1;
		$link = '../principal/index.php';
	echo "*-*".($ordem+1)."*-*".$num.$imagem;

}
else{
		echo "acabo*-*";
	$con->selTab("","categoria"," cat_ordem, cat_curso ", "cat_id = ".$cat,"cat_ordem asc");
	$ordcat = mysql_fetch_array($con->resultado);
	$curso = $ordcat["cat_curso"];
	$ord = $ordcat["cat_ordem"];
	$ord2 = 1;
	//Verifica se não existem mais categorias com perguntas a serem respondidas
	$con->selTab($ord.",".$ord2,"categoria, cursos"," * ", "cursos.id_cur = categoria.cat_curso and categoria.cat_curso = ".$curso,"cat_ordem asc");
			$cone = mysql_num_rows($con->resultado);
		
		if($cone == 0)
		{
		
		$con3->selTab("","testes, categoria","te_pergunta","NOT EXISTS (SELECT * FROM resultado_aluno
WHERE re_aluno = ".$aluno." and te_curso = re_cat","re_data asc, re_hora asc) and categoria.cat_curso = ".$cursofeito." and categoria.cat_id = testes.te_curso");
		$numresp = mysql_num_rows($con3->resultado);
		if($numresp > 0){
			echo $de."*-*nrespt";
			/*while($naoresp = mysql_fetch_array($con3->resultado)){
			echo "<br>".$naoresp[0];
			}*/

		}
		
		
		}
	
	while($prox = mysql_fetch_array($con->resultado)){
		$curso = $prox["id_cur"];
		$nome= $prox["nome_cur"];
		$categoria = $prox["cat_id"];
		$nomecat = $prox["cat_nome"];
		
		$con2->selTab("1","subcategoria"," * ", "sub_cat = ".$categoria,"sub_ordem asc");
		$subs = mysql_fetch_array($con2->resultado);
		$contagem = mysql_num_rows($con2->resultado);
		$subcat = $subs["sub_id"];
		$subnome = $subs["sub_nome"];	
		$link = '../principal/curso.php?curso='.$curso.'&cat='.$categoria.'&subcat='.$subcat.'&nome='.$nome.'&nomecat='.$nomecat.'&subnome='.$subnome;
	}
	
		echo $link;
	}
}
?>