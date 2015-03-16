<?php

function validarForm($form, $opcion) {
    $descripcion = strtoupper(trim($form['descripcion']));

    $pagina = strtoupper(trim($form['pagina']));

    $activo = strtoupper(trim($form['activo']));

    global $enlace, $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();

    $msg = "";
    /*
      if (strcasecmp($pagina, '') == 0 or strcasecmp($pagina, 'seleccione') == 0) {
      $msg.="\nINGRESE PAGINA...";
      }

      if (strcasecmp($activo, '') == 0 or strcasecmp($activo, 'seleccione') == 0) {
      $msg .= "\nSELECCIONE ACTIVO...";
      }
     */
    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        if ($opcion == 0) {// inserta
            $objResponse->call("xajax_ingresar", $form);
        } else {// actualizar
            $objResponse->call("xajax_actualizar", $form);
        }
    }
    return $objResponse;
}

function ingresar($form) {
    $descripcion = trim($form['descripcion']);
    $pagina = trim($form['pagina']);
    $espadre = strtoupper(trim($form['es_padre']));
    $codigo_padre = strtoupper(trim($form['padre']));
    $menu = trim($form['menu']);
    $orden = trim($form['orden']);
    if ($codigo_padre == 0) {
        $espadre = 1;
    }
    if ($orden == '') {
        $orden = 0;
    }

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlInsert = "insert into empleo.pagina (descripcion,pagina,estado, menu, codigo_padre, padre, orden) values";

    $sqlInsert .= "('$descripcion','$pagina','1','$menu',$codigo_padre,$espadre,$orden);";

    $rs = $objDB->query($sqlInsert);

    $objResponse->alert("Registrado...  $sqlInsert ");
    return $objResponse;
}

function actualizar($form) {
    $descripcion = trim($form['descripcion']);
    $pagina = trim($form['pagina']);
    $espadre = strtoupper(trim($form['es_padre']));
    $codigo_padre = strtoupper(trim($form['padre']));
    $menu = trim($form['menu']);
    $orden = trim($form['orden']);

    $codigo = trim($form['codigo']);

    if ($codigo_padre == 0) {
        $espadre = 1;
    }
    if ($orden == '') {
        $orden = 0;
    }

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  empleo.pagina set  descripcion= '$descripcion'
    , pagina= '$pagina'
    , menu= '$menu'
    , orden= '$orden'
    , codigo_padre = $codigo_padre
    where codigo = $codigo";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Actualizado...");
    return $objResponse;
}

function mostrarPadres() {

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "select * from empleo.pagina where padre=1";
    $rs = $objDB->query($sqlUpdate);
    $numrows = $objDB->getNumRows();
    if ($numrows > 0) {
        while ($ln = $objDB->fetch_array($rs)) {
            $codigo = $ln["codigo"];
            $codigo_padre = $ln["codigo_padre"];
            if ($codigo_padre > 0) {
                $menu = padres($objDB, $codigo_padre) . "/" . $ln["menu"];
            } else {
                $menu = "/" . $ln["menu"];
            }
            $padres .= "<option value='$codigo'>$menu</option>";
        }
    } else {
        $padres = '';
    }

    return $padres;
}

function padres($objDB, $codigo_padre) {

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sqlUpdate = "select menu, codigo_padre from empleo.pagina where codigo=$codigo_padre";
    $rs = $objDB->query($sqlUpdate);
    $numrows = $objDB->getNumRows();
    if ($numrows > 0) {
        while ($ln = $objDB->fetch_array($rs)) {
            $codigo_padre = $ln["codigo_padre"];
            $padres = padres($objDB, $codigo_padre) . "/" . $ln["menu"];
        }
    }

    return $padres;
}

function confirmarEliminarForm($form) {

    global $enlace, $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();

    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar", $form);
    return $objResponse;
}

function eliminar($form) {

    $descripcion = strtoupper(trim($form['descripcion']));

    $pagina = strtoupper(trim($form['pagina']));

    $activo = strtoupper(trim($form['activo']));

    global $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  empleo.pagina set estado=0 where ";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Desactivado...");
    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("descripcion", "value", "");
    $objResponse->assign("pagina", "value", "");
    $objResponse->assign("activo", "value", "");

    return $objResponse;
}

function seleccionar($id) {

    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select codigo, descripcion, pagina, menu, orden, padre , codigo_padre   from empleo.pagina 
    where  codigo  = '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", "$ln[0]");
    $objResponse->assign("descripcion", "value", "$ln[1]");
    $objResponse->assign("pagina", "value", "$ln[2]");
    $objResponse->assign("menu", "value", "$ln[3]");
    $objResponse->assign("orden", "value", "$ln[4]");
    $objResponse->assign("es_padre", "value", "$ln[5]");
    $objResponse->assign("padre", "value", "$ln[6]");
    return $objResponse;
}

function consultar($form) {
    $query = strtoupper(trim($form["txtConsulta"]));
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $where = "";
    if (is_numeric($query)) {
        $where = " where (codigo)  = '$query' or (codigo_padre)  = '$query'  ";
    } else {
        $where = " where upper(pagina||' '||menu)  like '%$query%'";
    }
    $sql = " select *    from pagina 
      $where order by orden,codigo_padre ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $nuevo = "<img src='" . HOME . "imagenes/page_white_text.png'/>";
    $nuevoLnk = " style='cursor:pointer' onclick = 'xajax_nuevo()' ";

    $tabla = "<table border='0' align ='center' class='tablesorter' cellspacing='1'><thead><tr>";
    $arrTi = $objDB->field_name($result);

    foreach ($arrTi as $ln) {
        $campo = $ln;
        $tabla .= "<th>$campo</th>";
    }
    $tabla .= " <th colspan='2' $nuevoLnk >$nuevo</th> </tr></thead><tbody>";
    while ($ln = $objDB->fetch_array($result)) {
        $id = $ln[0];
        $tb = "<tr>";
        for ($i = 0; $i < $numCols; $i++) {
            $dato = $ln[$i];
            $tb .= "<td id = 'dv_$i'.'_$id'>$dato</td>";
        }
        $actualizar = "<img src='" . HOME . "imagenes/page_white_edit.png'/>";
        $actalizarLnk = " style='cursor:pointer' onclick = 'xajax_seleccionar($id)' ";
        $eliminar = "<img src='" . HOME . "imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        $tabla .= $tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla .= "</tbody></table>";

    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");
    $objResponse->script('loadTabla();');
    return $objResponse;
}

$xajax->register(XAJAX_FUNCTION, "validarForm");

$xajax->register(XAJAX_FUNCTION, "ingresar");

$xajax->register(XAJAX_FUNCTION, "actualizar");

$xajax->register(XAJAX_FUNCTION, "eliminar");

$xajax->register(XAJAX_FUNCTION, "limpiar");

$xajax->register(XAJAX_FUNCTION, "confirmarEliminarForm");

$xajax->register(XAJAX_FUNCTION, "consultar");

$xajax->register(XAJAX_FUNCTION, "seleccionar");
?>