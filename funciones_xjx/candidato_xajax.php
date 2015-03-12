<?php

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $codigo_direccion = strtoupper(trim($form['codigo_direccion']));
    $archivo = strtoupper(trim($form['archivo']));
    $codigo_grupo_etnico = strtoupper(trim($form['codigo_grupo_etnico']));
    $disponibilidad = strtoupper(trim($form['disponibilidad']));
    $objResponse = new xajaxResponse();
    $msg = "";
    if (strcasecmp($codigo, '') == 0 or strcasecmp($codigo, 'seleccione') == 0) {
        $msg.="\nINGRESE CODIGO...";
    }
    if (strcasecmp($nombres, '') == 0 or strcasecmp($nombres, 'seleccione') == 0) {
        $msg.="\nINGRESE NOMBRES...";
    }
    if (strcasecmp($apellidos, '') == 0 or strcasecmp($apellidos, 'seleccione') == 0) {
        $msg.="\nINGRESE APELLIDOS...";
    }
    if (strcasecmp($fecha_nacimiento, '') == 0 or strcasecmp($fecha_nacimiento, 'seleccione') == 0) {
        $msg.="\nINGRESE FECHA NACIMIENTO...";
    }
    if (strcasecmp($genero, '') == 0 or strcasecmp($genero, 'seleccione') == 0) {
        $msg.="\nSELECCIONE GENERO...";
    }
    if (strcasecmp($telefono, '') == 0 or strcasecmp($telefono, 'seleccione') == 0) {
        $msg.="\nINGRESE TELEFONO...";
    }
    if (strcasecmp($codigo_direccion, '') == 0 or strcasecmp($codigo_direccion, 'seleccione') == 0) {
        $msg.="\nINGRESE CODIGO DIRECCION...";
    }
    if (strcasecmp($archivo, '') == 0 or strcasecmp($archivo, 'seleccione') == 0) {
        $msg.="\nINGRESE ARCHIVO...";
    }
    if (strcasecmp($codigo_grupo_etnico, '') == 0 or strcasecmp($codigo_grupo_etnico, 'seleccione') == 0) {
        $msg.="\nSELECCIONE CODIGO GRUPO ETNICO...";
    }
    if (strcasecmp($disponibilidad, '') == 0 or strcasecmp($disponibilidad, 'seleccione') == 0) {
        $msg.="\nINGRESE DISPONIBILIDAD...";
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
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $codigo_direccion = strtoupper(trim($form['codigo_direccion']));
    $archivo = strtoupper(trim($form['archivo']));
    $codigo_grupo_etnico = strtoupper(trim($form['codigo_grupo_etnico']));
    $disponibilidad = strtoupper(trim($form['disponibilidad']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $sqlInsert = "insert into candidato (nombres,apellidos,fecha_nacimiento,genero,telefono,movil,codigo_direccion,archivo,codigo_grupo_etnico,disponibilidad) values";
    $sqlInsert .= "('$nombres','$apellidos','$fecha_nacimiento','$genero','$telefono','$movil','$codigo_direccion','$archivo','$codigo_grupo_etnico','$disponibilidad');";
    $rs = $objDB->query($sqlInsert);
    $objResponse->alert("Registrado...");
    return $objResponse;
}

function actualizar($form) {
    $codigo = strtoupper(trim($form['codigo']));
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $codigo_direccion = strtoupper(trim($form['codigo_direccion']));
    $archivo = strtoupper(trim($form['archivo']));
    $codigo_grupo_etnico = strtoupper(trim($form['codigo_grupo_etnico']));
    $disponibilidad = strtoupper(trim($form['disponibilidad']));
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $sqlUpdate = "update  candidato set  nombres= '$nombres'
    , apellidos= '$apellidos'
    , fecha_nacimiento= '$fecha_nacimiento'
    , genero= '$genero'
    , telefono= '$telefono'
    , movil= '$movil'
    , codigo_direccion= '$codigo_direccion'
    , archivo= '$archivo'
    , codigo_grupo_etnico= '$codigo_grupo_etnico'
    , disponibilidad= '$disponibilidad'
     where  codigo= '$codigo'
    ";

    $rs = $objDB->query($sqlUpdate);

    if ($rs == true) {
        $objResponse->alert("Actualizado...");
    } else {
        $objResponse->alert("No se pudo actualizar los datos del Candidato");
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
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $codigo_direccion = strtoupper(trim($form['codigo_direccion']));
    $archivo = strtoupper(trim($form['archivo']));
    $codigo_grupo_etnico = strtoupper(trim($form['codigo_grupo_etnico']));
    $disponibilidad = strtoupper(trim($form['disponibilidad']));
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $sqlUpdate = "update  candidato set activo=0 where  codigo= '$codigo'";
    $rs = $objDB->query($sqlUpdate);
    if ($rs == true) {
        $objResponse->alert("Desactivado...");
    } else {
        $objResponse->alert("No se pudo desactivar al Candidato");
    }

    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("nombres", "value", "");
    $objResponse->assign("apellidos", "value", "");
    $objResponse->assign("fecha_nacimiento", "value", "");
    $objResponse->assign("genero", "value", "");
    $objResponse->assign("telefono", "value", "");
    $objResponse->assign("movil", "value", "");
    $objResponse->assign("codigo_direccion", "value", "");
    $objResponse->assign("archivo", "value", "");
    $objResponse->assign("codigo_grupo_etnico", "value", "");
    $objResponse->assign("disponibilidad", "value", "");

    return $objResponse;
}

function seleccionar($id) {
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from candidato 
    where  codigo  =  '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("nombres", "value", $ln["nombres"]);
    $objResponse->assign("apellidos", "value", $ln["apellidos"]);
    $objResponse->assign("fecha_nacimiento", "value", $ln["fecha_nacimiento"]);
    $objResponse->assign("genero", "value", $ln["genero"]);
    $objResponse->assign("telefono", "value", $ln["telefono"]);
    $objResponse->assign("movil", "value", $ln["movil"]);
    $objResponse->assign("codigo_direccion", "value", $ln["codigo_direccion"]);
    $objResponse->assign("archivo", "value", $ln["archivo"]);
    $objResponse->assign("codigo_grupo_etnico", "value", $ln["codigo_grupo_etnico"]);
    $objResponse->assign("disponibilidad", "value", $ln["disponibilidad"]);


    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from candidato 
    where  concat(nombres,' ',apellidos)  like '%$query%' ";

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
    $objResponse->alert($sql);
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