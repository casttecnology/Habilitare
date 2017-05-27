<?
//ini_set( 'display_errors', TRUE );

//error_reporting( E_ALL | E_STRICT );
//include("../checa_login.php");
?> <div style="position: fixed;text-align:center; font-family:Helvetica, sans-serif; width:100%;background: #FFFFFF;"> <?
include("../includes/header.php");
//include("../includes/menu.php");
?> </div> <?
include("../classes/banco.php");
$con = new DB();

if($_GET["curso"] != "")
{
	$curso = $_GET["curso"];
	$con->selTab("","cursos"," * ","id_cur = ".$curso,"");
	$cur = mysql_fetch_array($con->resultado);
}
else
{
	//session_start();
	//$idsessao = session_id();
	//if($_SESSION["logado"]==1)
	//{
	//	$con->upTab("logalunos","log_dtout = '".date("Y-m-d")."', log_hrout = '".date("H:i:s")."'","log_session = '".$idsessao."' and log_aluno = ".$_SESSION["usuario"]);
	//}
	//session_regenerate_id();
	//session_destroy();
	//session_unset();
	//include_once("compracurso.php");
	//exit;
}

?>

<link rel="stylesheet" href="../js/jwysiwyg/jquery.wysiwyg.css" type="text/css" />

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script> 
		<script type="text/javascript">
			$(document).ready(function(){
				$("a[rel=modal]").click( function(ev){
					ev.preventDefault();

					var id = $(this).attr("href");

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
 				});

 				$("#mascara").click( function(){
 					$(this).hide();
 					$(".window").hide();
 				});

 				$('.fechar').click(function(ev){
 					ev.preventDefault();
 					$("#mascara").hide();
 					$(".window").hide();
 				});
			});
		</script>
<form id="formulario" name="formulario" style="padding-top: 110px;">
<style type="text/css">
	.window{
			display:none;
			width:1000px;
			height:550px;
			position:absolute;
			left:0;
			top:0;
			background:#FFF;
			z-index:9900;
			padding:10px;
			border-radius:10px;
	}
	
	.window2{
			display:none;
			width:300px;
			height:200px;
			position:absolute;
			left:0;
			top:0;
			background:#FFF;
			z-index:9900;
			padding:10px;
			border-radius:10px;
	}

	#mascara{
		position:absolute;
			left:0;
			top:0;
			z-index:9000;
			background-color:#000;
			display:none;
	}

	.fechar{display:block; text-align:right;}
</style>

<?
function gravaLog($registroLog)
	{
		$iplogfile = 'log.txt';
		$ipaddress = $_SERVER['REMOTE_ADDR'];
		$webpage = $_SERVER['SCRIPT_NAME'];
		$timestamp = date('m/d/Y h:i:s');
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$fp = fopen($iplogfile, 'a+');
		chmod($iplogfile, 0777);
		fwrite($fp, '['.$timestamp.']: '.$registroLog.''.$ipaddress.' '.$webpage.' '.$browser. "\r\n");
		fclose($fp);
	}
session_start();
gravaLog("passouss");
if($_SESSION["logado"]==1)
{
	$con->selTab("","aluno"," * ","al_id = ".$_SESSION["usuario"],"");
	$cat = mysql_fetch_array($con->resultado);
	?>
	<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Ol&aacute; <?=$cat["al_nome"]?> - Deseja comprar o curso <?=$cur["nome_cur"]?>? </legend>
	<table class="lista"> 
	<tr><td>Codigo:</td><td><?=$cat["al_id"]?><input type="hidden" id="codigo" name="codigo" value="<?=$cat["al_id"]?>" disabled="disabled" title="Codigo de cadastro do Aluno"></td></tr>

	<tr><td>Nome:</td><td><input type="text" name="nome" id="nome" value='<?=$cat["al_nome"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
	<tr><td>Sobrenome:</td><td><input type="text" name="sobrenome" id="sobrenome" value='<?=$cat["al_sobrenome"]?>' style="width:300px" title="Digite o Sobrenome do Aluno"/></td></tr>
	<tr><td>CPF:</td><td><input type="text" name="cpf" id="cpf" value='<?=$cat["al_cpf"]?>' style="width:100px" title="Digite o CPF do Aluno" maxlength="11" /><span>Ex: 50032132155</span></td></tr>
	<tr><td>R.G:</td><td><input type="text" name="rg" id="rg" value='<?=$cat["al_rg"]?>' style="width:100px" title="Digite o R.G do Aluno" maxlength="15"/></td></tr>
	<tr><td>Telefone:</td><td><input type="text" name="telefone" id="telefone" value='<?=$cat["al_fone"]?>' style="width:100px" title="Digite o Telefone do Aluno" maxlength="11"/><span>Ex: 04133333333</span></td></tr>
	<tr><td>Endere&ccedil;o:</td><td><input type="text" name="endereco" id="endereco" value='<?=$cat["al_endereco"]?>' style="width:300px" title="Digite o Endere&ccedil;o do Aluno" maxlength="255"/></td></tr>
	</td></tr>
	<tr><td></td><td><input type="button" value="Comprar" onclick="javascript:cadAlunoCompra()" /></td></tr>
	</table>
	<input type="hidden" id="acao" name="acao" value="velhaCompra" />
	<input type="button" value="outro usuario" onclick="javascript:newLogin()">
	<?
}
else
{
?>
	<input type="button" value="Ja tenho cadastro" onclick="javascript:loginAluno()" />
	<fieldset><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Cadastro de Aluno - <?=$cur["nome_cur"]?> </legend>
	<table class="lista"> 
	<tr><td>Codigo:</td><td><?=$cat["al_id"]?><input type="hidden" id="codigo" name="codigo" value="<?=$cat["al_id"]?>" disabled="disabled" title="Codigo de cadastro do Aluno"></td></tr>

	<tr><td>Nome:</td><td><input type="text" name="nome" id="nome" value='<?=$cat["al_nome"]?>' style="width:300px" title="Digite o Nome do Aluno"/></td></tr>
	<tr><td>Sobrenome:</td><td><input type="text" name="sobrenome" id="sobrenome" value='<?=$cat["al_sobrenome"]?>' style="width:300px" title="Digite o Sobrenome do Aluno"/></td></tr>
	<tr><td>CPF:</td><td><input type="text" name="cpf" id="cpf" value='<?=$cat["al_cpf"]?>' style="width:100px" title="Digite o CPF do Aluno" maxlength="11" /><span>Ex: 50032132155</span></td></tr>
	<tr><td>R.G:</td><td><input type="text" name="rg" id="rg" value='<?=$cat["al_rg"]?>' style="width:100px" title="Digite o R.G do Aluno" maxlength="15"/></td></tr>
	<tr><td>Telefone:</td><td><input type="text" name="telefone" id="telefone" value='<?=$cat["al_fone"]?>' style="width:100px" title="Digite o Telefone do Aluno" maxlength="11"/><span>Ex: 04133333333</span></td></tr>
	<tr><td>Endere&ccedil;o:</td><td><input type="text" name="endereco" id="endereco" value='<?=$cat["al_endereco"]?>' style="width:300px" title="Digite o Endere&ccedil;o do Aluno" maxlength="255"/></td></tr>
	</td></tr>
	<tr><td></td><td><input type="button" value="Comprar" onclick="javascript:cadAlunoCompra()" /></td></tr>
	</table>
	<input type="hidden" id="acao" name="acao" value="novaCompra" />	
<?
}
?>
	<input type="hidden" id="curso" name="curso" value="<?=$_GET["curso"]?>" disabled="disabled" />
	<input type="hidden" id="descricao" name="descricao" value="<?=$cur["nome_cur"]?>" disabled="disabled" />
	<input type="hidden" id="valor" name="valor" value="500" disabled="disabled" />
	</fieldset>

	<div class="window" id="janela1">
		<a href="#" class="fechar">X Fechar</a>
		<iframe id="pedido" src="about:blank" width="100%" height="95%" frameborder="0" scrolling="yes"></iframe>
	</div>

	<div class="window2" id="janela2">
		<a href="#" class="fechar">X Fechar</a>
		<h4>Formulario</h4>
		<form action="#" method="post" action="autentica.php">
			<label for="usuario">Nome:</label>
			<input type="text" name="usuario" id="usuario">
			<br />

			<label for="pwsn">Senha:</label>
			<input type="password" name="pwsn" id="pwsn">
			<br />

			<input type="button" value="Entrar" onclick="javascript:requerLogin()">

		</form>	
	</div>

	<!-- mascara para cobrir o site -->	
	<div id="mascara"></div>
</form>
<iframe id="local" name="local" frameborder="0" width="100%" height="500"></iframe>
</body>
</html>