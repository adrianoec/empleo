<?php

$objFunciones = new Funciones();
$sqlgrupo = "select codigo, razon_social  from  empresa ";
$cmbEmpresa = $objFunciones->generarCombo("cmbEmpresa", $sqlgrupo, "", true, false, "", "");

$sqlestado = "select codigo, nombre  from  estado ";
$cmbEstado = $objFunciones->generarCombo("cmbEstado", $sqlestado, "", true, false, "", "");

$sqlduracion = "select codigo, nombre  from  duracion_contrato ";
$cmbDuracion = $objFunciones->generarCombo("cmbDuracion", $sqlduracion, "", true, false, "", "");

$sqldisponibilidad = "select codigo, nombre  from  disponibilidad ";
$cmbDisponibilidad = $objFunciones->generarCombo("cmbDisponibilidad", $sqldisponibilidad, "", true, false, "", "");

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));

    $nombre = strtoupper(trim($form['nombre']));

    $descripcion = strtoupper(trim($form['descripcion']));

    $sueldo = strtoupper(trim($form['sueldo']));

    $codigo_empresa = strtoupper(trim($form['codigo_empresa']));

    $estado = strtoupper(trim($form['estado']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));

    $duracion_contrato = strtoupper(trim($form['duracion_contrato']));

    $localizacion = strtoupper(trim($form['localizacion']));

    $disponibilidad = strtoupper(trim($form['disponibilidad']));

    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));


    global $enlace, $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();

    $msg = "";

    if (strcasecmp($codigo, '') == 0 or strcasecmp($codigo, 'seleccione') == 0) {
        $msg.="\nINGRESE CODIGO...";
    }

    if (strcasecmp($nombre, '') == 0 or strcasecmp($nombre, 'seleccione') == 0) {
        $msg.="\nINGRESE NOMBRE...";
    }

    if (strcasecmp($descripcion, '') == 0 or strcasecmp($descripcion, 'seleccione') == 0) {
        $msg.="\nINGRESE DESCRIPCION...";
    }

    if (strcasecmp($sueldo, '') == 0 or strcasecmp($sueldo, 'seleccione') == 0) {
        $msg.="\nINGRESE SUELDO...";
    }

    if (strcasecmp($codigo_empresa, '') == 0 or strcasecmp($codigo_empresa, 'seleccione') == 0) {
        $msg.="\nSELECCIONE CODIGO EMPRESA...";
    }

    if (strcasecmp($estado, '') == 0 or strcasecmp($estado, 'seleccione') == 0) {
        $msg.="\nSELECCIONE ESTADO...";
    }

    if (strcasecmp($fecha_vigencia, '') == 0 or strcasecmp($fecha_vigencia, 'seleccione') == 0) {
        $msg.="\nINGRESE FECHA VIGENCIA...";
    }

    if (strcasecmp($duracion_contrato, '') == 0 or strcasecmp($duracion_contrato, 'seleccione') == 0) {
        $msg.="\nSELECCIONE DURACION CONTRATO...";
    }

    if (strcasecmp($localizacion, '') == 0 or strcasecmp($localizacion, 'seleccione') == 0) {
        $msg.="\nINGRESE LOCALIZACION...";
    }

    if (strcasecmp($disponibilidad, '') == 0 or strcasecmp($disponibilidad, 'seleccione') == 0) {
        $msg.="\nINGRESE DISPONIBILIDAD...";
    }

    if (strcasecmp($fecha_publicacion, '') == 0 or strcasecmp($fecha_publicacion, 'seleccione') == 0) {
        $msg.="\nINGRESE FECHA PUBLICACION...";
    }

    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        if ($opcion == 0) { // inserta
            $objResponse->call("xajax_ingresar", $form);
        } else { // actualizar
            $objResponse->call("xajax_actualizar", $form);
        }
    }
    return $objResponse;
}

function ingresar($form) {

    $codigo = strtoupper(trim($form['codigo']));

    $nombre = strtoupper(trim($form['nombre']));

    $descripcion = strtoupper(trim($form['descripcion']));

    $sueldo = strtoupper(trim($form['sueldo']));

    $codigo_empresa = strtoupper(trim($form['codigo_empresa']));

    $estado = strtoupper(trim($form['estado']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));

    $duracion_contrato = strtoupper(trim($form['duracion_contrato']));

    $localizacion = strtoupper(trim($form['localizacion']));

    $disponibilidad = strtoupper(trim($form['disponibilidad']));

    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));


    global $objPaginacion, $objComun;

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlInsert = "insert into empleo (nombre,descripcion,sueldo,codigo_empresa,estado,fecha_vigencia,duracion_contrato,localizacion,disponibilidad,fecha_publicacion) values";

    $sqlInsert .= "('$nombre','$descripcion','$sueldo','$codigo_empresa','$estado','$fecha_vigencia','$duracion_contrato','$localizacion','$disponibilidad','$fecha_publicacion');";

    $rs = $objDB->query($sqlInsert);

    $objResponse->alert("Registrado...");
    return $objResponse;
}

function actualizar($form) {

    $codigo = strtoupper(trim($form['codigo']));

    $nombre = strtoupper(trim($form['nombre']));

    $descripcion = strtoupper(trim($form['descripcion']));

    $sueldo = strtoupper(trim($form['sueldo']));

    $codigo_empresa = strtoupper(trim($form['codigo_empresa']));

    $estado = strtoupper(trim($form['estado']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));

    $duracion_contrato = strtoupper(trim($form['duracion_contrato']));

    $localizacion = strtoupper(trim($form['localizacion']));

    $disponibilidad = strtoupper(trim($form['disponibilidad']));

    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));


    global $objPaginacion, $objComun;

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  empleo set  nombre= '$nombre'
, descripcion= '$descripcion'
, sueldo= '$sueldo'
, codigo_empresa= '$codigo_empresa'
, estado= '$estado'
, fecha_vigencia= '$fecha_vigencia'
, duracion_contrato= '$duracion_contrato'
, localizacion= '$localizacion'
, disponibilidad= '$disponibilidad'
, fecha_publicacion= '$fecha_publicacion'
 where  codigo= '$codigo'
";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Actualizado...");
    return $objResponse;
}

function confirmarEliminarForm($form) {

    global $enlace, $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();

    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar", $form);
    return $objResponse;
}

function eliminar($form) {

    $codigo = strtoupper(trim($form['codigo']));

    $nombre = strtoupper(trim($form['nombre']));

    $descripcion = strtoupper(trim($form['descripcion']));

    $sueldo = strtoupper(trim($form['sueldo']));

    $codigo_empresa = strtoupper(trim($form['codigo_empresa']));

    $estado = strtoupper(trim($form['estado']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));

    $duracion_contrato = strtoupper(trim($form['duracion_contrato']));

    $localizacion = strtoupper(trim($form['localizacion']));

    $disponibilidad = strtoupper(trim($form['disponibilidad']));

    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));


    global $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  empleo set activo=0 where  codigo= '$codigo'
";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Desactivado...");
    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("nombre", "value", "");
    $objResponse->assign("descripcion", "value", "");
    $objResponse->assign("sueldo", "value", "");
    $objResponse->assign("codigo_empresa", "value", "");
    $objResponse->assign("estado", "value", "");
    $objResponse->assign("fecha_vigencia", "value", "");
    $objResponse->assign("duracion_contrato", "value", "");
    $objResponse->assign("localizacion", "value", "");
    $objResponse->assign("disponibilidad", "value", "");
    $objResponse->assign("fecha_publicacion", "value", "");

    return $objResponse;
}

function seleccionar($id) {

    $objResponse = new xajaxResponse();


    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from empleo 
    where  XXXXXXXXXXXX  like '%$query%' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", "$nombre");
    $objResponse->assign("nombre", "value", "$nombre");
    $objResponse->assign("descripcion", "value", "$nombre");
    $objResponse->assign("sueldo", "value", "$nombre");
    $objResponse->assign("codigo_empresa", "value", "$nombre");
    $objResponse->assign("estado", "value", "$nombre");
    $objResponse->assign("fecha_vigencia", "value", "$nombre");
    $objResponse->assign("duracion_contrato", "value", "$nombre");
    $objResponse->assign("localizacion", "value", "$nombre");
    $objResponse->assign("disponibilidad", "value", "$nombre");
    $objResponse->assign("fecha_publicacion", "value", "$nombre");


    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from empleo 
    where  concat(nombre,' ', descripcion ,' ', localizacion )  like '%$query%' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $nuevo = "<img src='" . HOME . "imagenes/page_white_text.png'/>";
    $nuevoLnk = " style='cursor:pointer' onclick = 'xajax_nuevo()' ";

    $tabla = "<table border='0' width='70%'> <tr><td> <table border='0' align ='center' class='tablesorter' cellspacing='1'><thead><tr>";
    $arrTi = $objDB->field_name($result);



    foreach ($arrTi as $ln) {
        $campo = $ln;
        $tabla .="<th>$campo</th>";
    }
    $tabla.=" <th colspan='2' $nuevoLnk >$nuevo</th> </tr></thead><tbody>";
    while ($ln = $objDB->fetch_array($result)) {
        $id = $ln[0];
        $tb = "<tr>";
        for ($i = 0; $i < $numCols; $i++) {
            $dato = $ln[$i];
            $tb.="<td id = 'dv_$i'.'_$id'>$dato</td>";
        }
        $actualizar = "<img src='" . HOME . "imagenes/page_white_edit.png'/>";
        $actalizarLnk = " style='cursor:pointer' onclick = 'xajax_seleccionar($id)' ";
        $eliminar = "<img src='" . HOME . "imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table> ";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");
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