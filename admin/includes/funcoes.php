<?

function preencheCombo($tabela, $campo1, $campo2, $condicao)
{
        $conpreenche = new DB();
		$conpreenche->selTab("",$tabela,$campo1.", ".$campo2,"","");
		while($valores = mysql_fetch_array($conpreenche->resultado))
		{
			if($condicao != "")
			{
				
			}
			else{
			echo '<option value="'.$valores[$campo1].'">'.$valores[$campo2].$valores[$campo1].'</option>';
			}
		}
	
}

?>