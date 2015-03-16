<?php
//$fileForm = fopen("./formularios/$txtNombreArchivo" . "_form.php", "w+");
//if (fwrite($fileForm, $tabla)) {
//    $objResponse->alert("formulario creado...");
//}
//fclose($fileForm);
/**
 * 
  select a.codigo, a.pagina, a.menu
  , a.codigo_padre, b.codigo_perfil, a.descripcion
  from pagina as a inner join pagina_perfil as b
  on a.codigo = b.codigo_pagina
  inner join permiso as c
  on a.codigo=c.codigo_pagina
  and b.codigo_perfil=c.codigo_perfil
  and c.acceso_menu=1
  and c.activo=1
  and c.codigo_perfil=1
  union
 */
//include_once ('facturacion_config.php');
//include_once (HOME . 'include/xajax_conf.php');
//include_once (HOME . 'include/db_conf.php');
//include_once (HOME . 'include/xajax_conf_process.php');
//include_once (HOME . 'cabecera.php');

$objDB = new Database();
$objDB->setParametrosBD(HOST, BASE, USER, PWD);
$objDB->getConexion();
$objResponse = new xajaxResponse();
$sqlInsert = "
select codigo, pagina, menu
, codigo_padre, descripcion 
from pagina where padre =1 and codigo_padre=0 order by orden,codigo_padre";
$rs = $objDB->query($sqlInsert);
$numrows = $objDB->getNumRows();
?>
<div style="border: 1px solid blue; ">
    <ul class="jd_menu">
        <?php
        while ($ln = $objDB->fetch_array($rs)) {
            $nom = $ln["menu"];
            $padre = $ln["codigo"];

            echo "<li><a href='#' class='accessible'>$nom</a>";
            echo hijo($objDB, $padre);
            echo "</li>\n";
        }
        ?>
    </ul>
</div>
<?php

function hijo($objDB, $codigo) {
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sqlUpdate = "select a.codigo, a.pagina, a.menu
  , a.codigo_padre, b.codigo_rol, a.descripcion, a.padre
  from ".SCHEMA.".pagina as a inner join ".SCHEMA.".pagina_rol as b
  on a.codigo = b.codigo_pagina
  inner join ".SCHEMA.".permiso as c
  on a.codigo=c.codigo_pagina
  and b.codigo_rol=c.codigo_rol
  and c.acceso_menu=1
  and c.estado=1
  and a.codigo_padre=$codigo
  and c.codigo_rol=" . $_SESSION["aut_perfil"] . " order by orden";

    $rs = $objDB->query($sqlUpdate);
    $numrows = $objDB->getNumRows();
    $m="";
    if ($numrows > 0) {
        $m.="\n<ul>";
        while ($ln = $objDB->fetch_array($rs)) {
            $codigo = $ln["codigo"];
            $espadre = $ln["padre"];
            $pagina = $ln["pagina"];
            $menu = $ln["menu"];
            if ($espadre == 0) {
                $m.=" \n\t <li><a href='$pagina' target='_self'>$menu</a></li>";
            } else {
                $m.= "<li>$menu &raquo;";
                $m.= hijo($objDB, $codigo);
                $m.= "\n</li>";
            }
        }
        $m.="\n</ul>";
    }

    return $m;
}
?>