<!--
<table border="0" style="text-align:center; font-family:Helvetica, sans-serif;" class="tabela">
    <tr>
    <? if($_SESSION["bt1"] == 1){?>
        <td width="100px" class="<? if(strstr($_SERVER["REQUEST_URI"],"/alunos/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/alunos/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
        <a href="../alunos">ALUNOS</a>
        </td>  <? }?>

         <? if($_SESSION["bt2"] == 1){?>
        <td width="100px" class="<? if(strstr($_SERVER["REQUEST_URI"],"/cursos/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/cursos/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
        <a href="../cursos">CURSOS</a>
        <? }?>

         <? if($_SESSION["bt3"] == 1){?>
        <td width="100px" class="<? if(strstr($_SERVER["REQUEST_URI"],"/categorias/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/categorias/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
        <a href="../categorias">CATEGORIAS</a>
        </td>  <? }?>

         <? if($_SESSION["bt4"] == 1){?>
        <td width="100px" class="<? if(strstr($_SERVER["REQUEST_URI"],"/subcategorias/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/subcategorias/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
        <a href="../subcategorias">SUBCATEGORIAS</a>
        </td>  <? }?>

         <? if($_SESSION["bt5"] == 1){?>
        <td width="100" class="<? if(strstr($_SERVER["REQUEST_URI"],"/usuarios/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/usuarios/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
        <a href="../usuarios">USUARIOS</a>
        </td>   <? }?>

        <? if($_SESSION["bt6"] == 1){?>
       <td width="100px" class="<? if(strstr($_SERVER["REQUEST_URI"],"/financeiro/")){echo "menuon";}?>" <? if(strstr($_SERVER["REQUEST_URI"],"/financeiro/")){echo " onmouseover=\"className='menuoff';\" onmouseout=\"className='menuon';\"";}else{echo " onmouseover=\"className='menuon';\" onmouseout=\"className='menuoff';\"";}?>>
       <a href="../financeiro">FINANCEIRO</a>
       </td>   <? }?>

    </tr>
</table>
-->