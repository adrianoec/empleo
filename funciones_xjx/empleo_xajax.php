<?php

$aut_usuario = $_SESSION["aut_usuario"];
$aut_perfil = $_SESSION["aut_perfil"];
$where = "";
if ($aut_perfil != "1") {
    $where.=" and usuario='$aut_usuario' ";
}

$objFunciones = new Funciones();
$sqlgrupo = "select codigo, razon_social  from  " . SCHEMA . ".empresa where estado = 1 $where ";
$cmbEmpresa = $objFunciones->generarCombo("cmbEmpresa", $sqlgrupo, "", true, false, "", "");

$sqlestado = "select codigo, nombre  from  " . SCHEMA . ".estado ";
$cmbEstado = $objFunciones->generarCombo("cmbEstado", $sqlestado, "", true, false, "", "");

$sqlduracion = "select codigo, nombre  from  " . SCHEMA . ".duracion_contrato ";
$cmbDuracion = $objFunciones->generarCombo("cmbDuracion", $sqlduracion, "", true, false, "", "");

$sqldisponibilidad = "select codigo, nombre  from  " . SCHEMA . ".disponibilidad ";
$cmbDisponibilidad = $objFunciones->generarCombo("cmbDisponibilidad", $sqldisponibilidad, "", true, false, "", "");

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $nombre = strtoupper(trim($form['nombre']));
    $descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    $codigo_empresa = strtoupper(trim($form['cmbEmpresa']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));
    $duracion_contrato = strtoupper(trim($form['cmbDuracion']));
    $localizacion = strtoupper(trim($form['localizacion']));
    $disponibilidad = strtoupper(trim($form['cmbDisponibilidad']));
    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));

    $objResponse = new xajaxResponse();

    $msg = "";

    if ($codigo != 0) {
        if (strcasecmp($codigo, '') == 0 or strcasecmp($codigo, 'seleccione') == 0) {
            $msg.="\nINGRESE CODIGO...";
        }
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
        $msg.="\nSELECCIONE EMPRESA...";
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

    $nombre = strtoupper(trim($form['nombre']));
    $descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    $codigo_empresa = strtoupper(trim($form['cmbEmpresa']));

    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));
    $duracion_contrato = strtoupper(trim($form['cmbDuracion']));
    $localizacion = strtoupper(trim($form['localizacion']));
    $disponibilidad = strtoupper(trim($form['cmbDisponibilidad']));
    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $aut_usuario = $_SESSION["aut_usuario"];
    $sqlInsert = "insert into " . SCHEMA . ".empleo (nombre,descripcion,sueldo,codigo_empresa,fecha_vigencia,duracion_contrato,localizacion,disponibilidad,fecha_publicacion, usuario) values";

    $sqlInsert .= "('$nombre','$descripcion','$sueldo','$codigo_empresa','$fecha_vigencia','$duracion_contrato','$localizacion','$disponibilidad','$fecha_publicacion', '$aut_usuario');";

    $rs = $objDB->query($sqlInsert);


    if ($rs == true) {
        $objResponse->alert("Registrado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("No se pudo registrar los datos del Empleo\nError:\n", $objDB->getLastError());
    }

    return $objResponse;
}

function actualizar($form) {

    $codigo = strtoupper(trim($form['codigo']));
    $nombre = strtoupper(trim($form['nombre']));
    $descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    $codigo_empresa = strtoupper(trim($form['cmbEmpresa']));
    $fecha_vigencia = strtoupper(trim($form['fecha_vigencia']));
    $duracion_contrato = strtoupper(trim($form['cmbDuracion']));
    $localizacion = strtoupper(trim($form['localizacion']));
    $disponibilidad = strtoupper(trim($form['cmbDisponibilidad']));
    $fecha_publicacion = strtoupper(trim($form['fecha_publicacion']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  " . SCHEMA . ".empleo set  nombre= '$nombre'
    , descripcion= '$descripcion'
    , sueldo= '$sueldo'
    , codigo_empresa= '$codigo_empresa'
    , fecha_vigencia= '$fecha_vigencia'
    , duracion_contrato= '$duracion_contrato'
    , localizacion= '$localizacion'
    , disponibilidad= '$disponibilidad'
    , fecha_publicacion= '$fecha_publicacion'
     where  codigo= '$codigo'
    ";

    $rs = $objDB->query($sqlUpdate);


    if ($rs == true) {
        $objResponse->alert("Actualizado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("No se pudo actualizar los datos del Empleo\nError:\n", $objDB->getLastError());
    }
    return $objResponse;
}

function confirmarEliminarForm($form) {
    $objResponse = new xajaxResponse();
    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar", $form);
    return $objResponse;
}

function eliminar($form) {
    $codigo = strtoupper(trim($form['codigo']));

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  " . SCHEMA . ".empleo set estado=0 where  codigo= '$codigo' ";

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
    $objResponse->assign("cmbEmpresa", "value", "");
    $objResponse->assign("estado", "value", "");
    $objResponse->assign("fecha_vigencia", "value", "");
    $objResponse->assign("cmbDuracion", "value", "");
    $objResponse->assign("localizacion", "value", "");
    $objResponse->assign("cmbDisponibilidad", "value", "");
    $objResponse->assign("fecha_publicacion", "value", "");

    return $objResponse;
}

function seleccionar($id) {

    $objResponse = new xajaxResponse();


    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from " . SCHEMA . ".empleo 
    where  codigo  = '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("nombre", "value", $ln["nombre"]);
    $objResponse->assign("descripcion", "value", $ln["descripcion"]);
    $objResponse->assign("sueldo", "value", $ln["sueldo"]);
    $objResponse->assign("cmbEmpresa", "value", $ln["codigo_empresa"]);
    $objResponse->assign("estado", "value", $ln["estado"]);
    $objResponse->assign("fecha_vigencia", "value", $ln["fecha_vigencia"]);
    $objResponse->assign("cmbDuracion", "value", $ln["duracion_contrato"]);
    $objResponse->assign("localizacion", "value", $ln["localizacion"]);
    $objResponse->assign("cmbDisponibilidad", "value", $ln["disponibilidad"]);
    $objResponse->assign("fecha_publicacion", "value", $ln["fecha_publicacion"]);


    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $aut_usuario = $_SESSION["aut_usuario"];
    $aut_perfil = $_SESSION["aut_perfil"];
    $where = "";
    if ($aut_perfil != "1") {
        $where.=" and usuario='$aut_usuario' ";
    }


    $sql = "select a.codigo, a.nombre	, a.descripcion	, a.sueldo,	d.razon_social as empresa	
        , a.fecha_vigencia,	b.nombre as duracion_contrato	, a.localizacion,	
        c.nombre as disponibilidad	, a.fecha_publicacion    
        from " . SCHEMA . ".empleo  as a inner join " . SCHEMA . ".duracion_contrato  as b 
        on a.duracion_contrato = b.codigo  inner join " . SCHEMA . ".disponibilidad as c 
        on a.disponibilidad = c.codigo inner join  " . SCHEMA . ".empresa as d
        on a.codigo_empresa = d.codigo
        and   concat(a.nombre,' ', a.descripcion ,' ', a.localizacion )  like '%$query%' $where ";
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
    //$objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->script('loadTabla();');
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