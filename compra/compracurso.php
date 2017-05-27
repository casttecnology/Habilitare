<?
$con->selTab("","cursos"," * ","","");
?>
<form style="padding-top: 140px;">
<fieldset  style="padding:10px; background-color:#FFF"><legend style="font-size:16px; color:#0099FF; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding:10px">Comprar Cursos</legend>

<table class="lista">
<th style="width:60%">Curso</th>
<th style="width:30%"></th>
<th style="width:10%">Vagas</th>


<?
		while($cursos = mysql_fetch_array($con->resultado))
		{

			echo '<tr style="BACKGROUND-COLOR: \'#FFF\'" onmouseover="this.style.backgroundColor=\'#FFFFCA\'" onmouseout="this.style.backgroundColor=\'#FFF\'" style="border:1px solid #f4f4f4">
			<td>'.$cursos["nome_cur"].'</td>
			<td align="center"><img src="'.$cursos["img_cur"].'" width="40px"/></td>
			<td style="text-align:center"><a href="index?curso='.$cursos["id_cur"].'">Comprar</a></td>';
		}
?>
</table>
</fieldset></form>
</body>
</html>
<? } ?>
