<?php

//error_reporting(E_ALL ^ E_NOTICE);
//ini_set("display_errors", 1);

function validarForm($form) {
    $titulo = strtoupper(trim($form['titulo']));
    $descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    $localizacion = strtoupper(trim($form['localizacion']));

    $objResponse = new xajaxResponse();
    $msg = "";

    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        $objResponse->call("xajax_consultar", $form);
    }
    return $objResponse;
}

function limpiar() {

    $objResponse = new xajaxResponse();

    $objResponse->assign("cod_empleo", "value", "");
    $objResponse->assign("titulo", "value", "");
    $objResponse->assign("descripcion", "value", "");
    $objResponse->assign("sueldo", "value", "");
    $objResponse->assign("localizacion", "value", "");
    $objResponse->assign("duracion_contrato", "value", "");
    $objResponse->assign("cod_empresa", "value", "");
    $objResponse->assign("empresa", "value", "");

    return $objResponse;
}

function consultar($form) {
    $titulo = strtoupper(trim($form['titulo']));
    $descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    $localizacion = strtoupper(trim($form['localizacion']));
    
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = "Select a.codigo as cod_empleo, a.nombre as titulo, a.descripcion, a.sueldo, a.localizacion, c.nombre as duracion_contrato, b.codigo as cod_empresa, b.razon_social as empresa 
    from empleo as a inner join empresa as b 
    on a.codigo_empresa = b.codigo inner join duracion_contrato as c 
    on a.duracion_contrato = c.codigo
    and a.estado =1 and b.estado =1
    and a.fecha_vigencia >=CURRENT_DATE 
    and a.nombre  like '%$titulo%' 
    and a.descripcion  like '%$descripcion%'    
    and a.localizacion  like '%$localizacion%'
    and a.sueldo  like '%$sueldo%'         ";

//    $objResponse->alert($sql);

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();
    $nuevo = "<img src='" . HOME . "imagenes/page_white_text.png'/>";
    $nuevoLnk = " style='cursor:pointer' onclick = 'xajax_nuevo()' ";

    $tabla = "<table border='0' width='70%'>"
            . "<tr>"
            . "<td> "
            . "<table border='0' align ='center' class='tablesorter' cellspacing='1'>"
            . "<thead>"
            . "<tr>";
    $arrTi = $objDB->field_name($result);

    foreach ($arrTi as $ln) {
        $campo = $ln;
        $tabla .="<th>$campo</th>";
    }
    $tabla.=" <th ></th> </tr></thead><tbody>";
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
    $tabla.="</tbody>"
            . "</table>"
            . "</td>"
            . "</tr>"
            . "</table> ";
    $objResponse->script('loadTabla();');
    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");

    $objDB->cerrar();

    return $objResponse;
}

$xajax->register(XAJAX_FUNCTION, "validarForm");
$xajax->register(XAJAX_FUNCTION, "limpiar");
$xajax->register(XAJAX_FUNCTION, "consultar");
$xajax->register(XAJAX_FUNCTION, "seleccionar");
?>