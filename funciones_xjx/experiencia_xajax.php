<?php

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $codigo_candidato = strtoupper(trim($form['codigo_candidato']));
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $empresa = strtoupper(trim($form['empresa']));
    $cargo = strtoupper(trim($form['cargo']));
    $tareas = strtoupper(trim($form['tareas']));
    $nro_empleados = strtoupper(trim($form['nro_empleados']));

    $objResponse = new xajaxResponse();
    $msg = "";

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
    $codigo_candidato = $_SESSION['codigo_candidato'];
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $empresa = strtoupper(trim($form['empresa']));
    $cargo = strtoupper(trim($form['cargo']));
    $tareas = strtoupper(trim($form['tareas']));
    $nro_empleados = strtoupper(trim($form['nro_empleados']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlInsert = "insert into experiencia (codigo_candidato,fecha_inicio,fecha_fin,empresa,cargo,tareas,nro_empleados) values";
    $sqlInsert .= "('$codigo_candidato','$fecha_inicio','$fecha_fin','$empresa','$cargo','$tareas','$nro_empleados');";

    $rs = $objDB->query($sqlInsert);

    if ($rs) {
        $objResponse->alert("Registrado...");
    } else {
        $objResponse->alert("Error:\n$sqlInsert\n" . $objDB->getLastError());
    }
    return $objResponse;
}

function actualizar($form) {
    $codigo = strtoupper(trim($form['codigo']));
    $codigo_candidato = strtoupper(trim($form['codigo_candidato']));
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $empresa = strtoupper(trim($form['empresa']));
    $cargo = strtoupper(trim($form['cargo']));
    $tareas = strtoupper(trim($form['tareas']));
    $nro_empleados = strtoupper(trim($form['nro_empleados']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  experiencia set  codigo_candidato= '$codigo_candidato'
, fecha_inicio= '$fecha_inicio'
, fecha_fin= '$fecha_fin'
, empresa= '$empresa'
, cargo= '$cargo'
, tareas= '$tareas'
, nro_empleados= '$nro_empleados'
 where  codigo= '$codigo'
";

    $rs = $objDB->query($sqlUpdate);

    if ($rs) {
        $objResponse->alert("Actualizado...");
    } else {
        $objResponse->alert("Error:\n$sqlUpdate\n" . $objDB->getLastError());
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
    $codigo_candidato = strtoupper(trim($form['codigo_candidato']));
   
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  experiencia set activo=0 where  codigo= '$codigo'";

    $rs = $objDB->query($sqlUpdate);
    $objResponse->alert("Desactivado...");
    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();
    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("codigo_candidato", "value", "");
    $objResponse->assign("fecha_inicio", "value", "");
    $objResponse->assign("fecha_fin", "value", "");
    $objResponse->assign("empresa", "value", "");
    $objResponse->assign("cargo", "value", "");
    $objResponse->assign("tareas", "value", "");
    $objResponse->assign("nro_empleados", "value", "");

    return $objResponse;
}

function seleccionar($id) {
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from experiencia 
    where  codigo_candidato  = '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();
    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("codigo_candidato", "value", $ln["codigo_candidato"]);
    $objResponse->assign("fecha_inicio", "value", $ln["fecha_inicio"]);
    $objResponse->assign("fecha_fin", "value", $ln["fecha_fin"]);
    $objResponse->assign("empresa", "value", $ln["empresa"]);
    $objResponse->assign("cargo", "value", $ln["cargo"]);
    $objResponse->assign("tareas", "value", $ln["tareas"]);
    $objResponse->assign("nro_empleados", "value", $ln["nro_empleados"]);

    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from experiencia 
    where  concat(cargo,' ', tareas )  like '%$query%' ";

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