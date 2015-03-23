<?php

$objFunciones = new Funciones();
$sqlNivel = "select codigo, nombre  from  tipo_nivel_academico ";
$cmbNivel = $objFunciones->generarCombo("codigo_tipo_nivel_academico", $sqlNivel, " ", true, false, "", "");

$sqlInstitucion = "select codigo, nombre  from  institucion ";
$cmbInstitucion = $objFunciones->generarCombo("codigo_institucion", $sqlInstitucion, " ", true, false, "", "");

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $codigo_candidato = $_SESSION['codigo_candidato']; //strtoupper(trim($form['codigo_candidato']));
    $titulo = strtoupper(trim($form['titulo']));
    $horas = strtoupper(trim($form['horas']));
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $codigo_tipo_nivel_academico = strtoupper(trim($form['codigo_tipo_nivel_academico']));
    $codigo_institucion = strtoupper(trim($form['codigo_institucion']));

    $objResponse = new xajaxResponse();

    $msg = "";

    if (strcasecmp($codigo_candidato, '') == 0 or strcasecmp($codigo_candidato, 'seleccione') == 0) {
        $msg.="\nINGRESE CODIGO CANDIDATO...";
    }

    if (strcasecmp($titulo, '') == 0 or strcasecmp($titulo, 'seleccione') == 0) {
        $msg.="\nINGRESE TITULO...";
    }

    if (strcasecmp($horas, '') == 0 or strcasecmp($horas, 'seleccione') == 0) {
        $msg.="\nINGRESE HORAS...";
    }

    if (strcasecmp($fecha_inicio, '') == 0 or strcasecmp($fecha_inicio, 'seleccione') == 0) {
        $msg.="\nINGRESE FECHA INICIO...";
    }

    if (strcasecmp($fecha_fin, '') == 0 or strcasecmp($fecha_fin, 'seleccione') == 0) {
        $msg.="\nINGRESE FECHA FIN...";
    }

    if (strcasecmp($codigo_tipo_nivel_academico, '') == 0 or strcasecmp($codigo_tipo_nivel_academico, 'seleccione') == 0) {
        $msg.="\nSELECCIONE CODIGO TIPO NIVEL ACADEMICO...";
    }

    if (strcasecmp($codigo_institucion, '') == 0 or strcasecmp($codigo_institucion, 'seleccione') == 0) {
        $msg.="\nSELECCIONE CODIGO INSTITUCION...";
    }

    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        if (strlen($_GET["codigo"]) == 0) { // inserta
            $objResponse->call("xajax_ingresar", $form);
        } else { // actualizar
            $objResponse->call("xajax_actualizar", $form);
        }
    }
    return $objResponse;
}

function ingresar($form) {

    $codigo_candidato = $_SESSION['codigo_candidato'];
    $titulo = strtoupper(trim($form['titulo']));
    $horas = strtoupper(trim($form['horas']));
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $codigo_tipo_nivel_academico = strtoupper(trim($form['codigo_tipo_nivel_academico']));
    $codigo_institucion = strtoupper(trim($form['codigo_institucion']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlInsert = "insert into estudio (codigo_candidato,titulo,horas,fecha_inicio,fecha_fin,codigo_tipo_nivel_academico,codigo_institucion) values";
    $sqlInsert .= "('$codigo_candidato','$titulo','$horas','$fecha_inicio','$fecha_fin','$codigo_tipo_nivel_academico','$codigo_institucion');";

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

    $titulo = strtoupper(trim($form['titulo']));

    $horas = strtoupper(trim($form['horas']));

    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));

    $fecha_fin = strtoupper(trim($form['fecha_fin']));

    $codigo_tipo_nivel_academico = strtoupper(trim($form['codigo_tipo_nivel_academico']));

    $codigo_institucion = strtoupper(trim($form['codigo_institucion']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  estudio set  codigo_candidato= '$codigo_candidato'
, titulo= '$titulo'
, horas= '$horas'
, fecha_inicio= '$fecha_inicio'
, fecha_fin= '$fecha_fin'
, codigo_tipo_nivel_academico= '$codigo_tipo_nivel_academico'
, codigo_institucion= '$codigo_institucion'
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
    $titulo = strtoupper(trim($form['titulo']));
    $horas = strtoupper(trim($form['horas']));
    $fecha_inicio = strtoupper(trim($form['fecha_inicio']));
    $fecha_fin = strtoupper(trim($form['fecha_fin']));
    $codigo_tipo_nivel_academico = strtoupper(trim($form['codigo_tipo_nivel_academico']));
    $codigo_institucion = strtoupper(trim($form['codigo_institucion']));

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  estudio set activo=0 where  codigo= '$codigo'
";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Desactivado...");
    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("codigo_candidato", "value", "");
    $objResponse->assign("titulo", "value", "");
    $objResponse->assign("horas", "value", "");
    $objResponse->assign("fecha_inicio", "value", "");
    $objResponse->assign("fecha_fin", "value", "");
    $objResponse->assign("codigo_tipo_nivel_academico", "value", "");
    $objResponse->assign("codigo_institucion", "value", "");

    return $objResponse;
}

function seleccionar($id) {
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $sql = " select *    from estudio 
    where  codigo_candidato  = '$id' ";
    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();
    $ln = $objDB->fetch_array($result);
    //$objResponse->alert($sql);
    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("codigo_candidato", "value", $ln["codigo_candidato"]);
    $objResponse->assign("titulo", "value", $ln["titulo"]);
    $objResponse->assign("horas", "value", $ln["horas"]);
    $objResponse->assign("fecha_inicio", "value", $ln["fecha_inicio"]);
    $objResponse->assign("fecha_fin", "value", $ln["fecha_fin"]);
    $objResponse->assign("codigo_tipo_nivel_academico", "value", $ln["codigo_tipo_nivel_academico"]);
    $objResponse->assign("codigo_institucion", "value", $ln["codigo_institucion"]);
    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from estudio 
    where  nombre  like '%$query%' ";

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