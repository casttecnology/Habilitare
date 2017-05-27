<?
class DB{
public $conexao;
public $resultado;
public $dominio;
public $usuario;
public $senha;
public $db;

function __construct()
	{
	$this->dominio='fdb2.awardspace.com';
	$this->usuario='maikonl_habi';
	$this->senha = '123654';
	$this->db = 'maikonl_habi';
	$this->conecta();		
	}
	public function conecta(){
	$this->conexao = mysql_connect($this->dominio, $this->usuario, $this->senha);
	mysql_select_db($this->db, $this->conexao);
	}
	
	function DBError()
	{
		echo mysql_error($this->conexao);
	}
	function insTab ($tab, $campos, $valores)
	{
		$declar = "INSERT into $tab ($campos) values ($valores)";
		$this->resultado = mysql_query ($declar);
		//echo $declar.'<br>';
	}
	function selTab ($quant, $tab, $campos, $condicao,$order)
	{
	if($quant > 0){
	$limite = " LIMIT $quant";
	}
	else if($quant <> ""){
	$limite = " LIMIT $quant";
	}
	if($condicao <> ''){
	$condicao = " where $condicao";
	}
	if($order <> ''){
	$order = " order by $order";
	}
		$declar = "SELECT $campos from $tab $condicao $order $limite";
		$this->resultado = mysql_query ($declar);
		
		//echo $declar.'<br>';
	}
	function delTab ($tab, $condicao)
	
	{
		if($condicao != ""){
		$condicao = " where ".$condicao;
		}
		$declar = "DELETE from $tab $condicao";
		$this->resultado = mysql_query ($declar);
		//echo $declar.'<br>';
	}
	function upTab ($tab, $campos, $condicao)
	{
		$declar = "UPDATE $tab SET $campos WHERE $condicao";
		$this->resultado = mysql_query ($declar);
		//echo $declar;
	}
}
?>