<?

class DB

{

public $conexao;

public $resultado;

public $dominio;

public $usuario;

public $senha;

public $db;



function __construct()

	{

//	$this->dominio='127.0.0.1';
//	$this->usuario='root';
//	$this->senha = 'Senha666';
//	$this->db = 'cellofor';

	$this->dominio='cellofor.mysql.uhserver.com';
	$this->usuario='cellofor';
	$this->senha = 'felipe10@';
	$this->db = 'cellofor';

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

		//echo $declar;

	}

	function insTabRet ($tab, $campos, $valores)
	{
		$declar = "INSERT into $tab ($campos) values ($valores)";

		mysql_query ($declar);
		//$this->resultado = mysql_insert_id()

		//$auxSql = "INSERT into movimento(mov_valor, ac_id, "
		//echo $declar;
		return mysql_insert_id();
	}


	function selTab ($quant, $tab, $campos, $condicao,$order)
	{
		$limite = "";

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