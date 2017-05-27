
<script>
    function fullScreenMode(url) { document.open(url, '', 'fullscreen=yes, scrollbars=auto'); }
</script>
<table border="0" style="font-size:10px; float:right"><tr>
        <td style=" text-align:center"><a href="" onclick="javascript:fullScreenMode('../principal/')">Portal do Aluno<br />
            <img src="../imagens/usuarios.png" width="40" title="Pr&eacute;-Visualizar Curso" /></a></td>
        <td style=" text-align:center"><a href="../logoff.php">Sair<br />
            <img src="../imagens/sair.png" width="40" title="Sair do Gerenciador" /></a>
        </td>
    </tr>
</table>
<style type="text/css">
    .dropdownmenu ul, .dropdownmenu li {
        margin: 0;
        padding: 0;
    }
    .dropdownmenu ul {
        background: gray;
        list-style: none;
        width: 100%;
    }
    .dropdownmenu li {
        float: left;
        position: relative;
        width:auto;
    }
    .dropdownmenu a {
        background: #30A6E6;
        color: #FFFFFF;
        display: block;
        font: bold 12px/20px sans-serif;
        padding: 10px 25px;
        text-align: center;
        text-decoration: none;
        -webkit-transition: all .25s ease;
        -moz-transition: all .25s ease;
        -ms-transition: all .25s ease;
        -o-transition: all .25s ease;
        transition: all .25s ease; 
    }
    .dropdownmenu li:hover a {
        background: #000000;
    }
    #submenu {
        left: 0;
        opacity: 0;
        position: absolute;
        top: 35px;
        visibility: hidden;
        z-index: 1;
    }
    li:hover ul#submenu {
        opacity: 1;
        top: 40px;  /* adjust this as per top nav padding top & bottom comes */
        visibility: visible;
    }
    #submenu li {
        float: none;
        width: 100%;
    }
    #submenu a:hover {
        background: #DF4B05;
    }
    #submenu a {
        background-color:#000000;
    }
</style>
<div style="padding-top: 110px;">
    <nav class="dropdownmenu">
      <ul>
        <? 
        if($_SESSION["bt1"] == 1){?>
            <li><a href="../alunos">Alunos</a></li>
        <? } ?>
        <li><a href="#">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cursos&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
          <ul id="submenu">
            <? if($_SESSION["bt2"] == 1){?>
                <li><a href="../cursos">Cursos</a></li>
            <? } ?>
            <? if($_SESSION["bt3"] == 1){?>
                <li><a href="../categorias">Categoria</a></li>
            <? } ?>
            <? if($_SESSION["bt4"] == 1){?>
                <li><a href="../subcategorias">Subcategoria</a></li>
            <? } ?>
          </ul>
        </li>
        <? if($_SESSION["bt5"] == 1){?>
            <li><a href="../usuarios">Usu&aacute;rios</a></li>
        <?} if($_SESSION["bt6"] == 1){?>
            <li><a href="../financeiro">Financeiro</a></li>
        <? } ?>
      </ul>
    </nav>
</div>
