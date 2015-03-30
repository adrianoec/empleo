<?php

$objFunciones = new Funciones();
$sqlgrupo = "select codigo, nombre  from  grupo_etnico ";
$cmbGrupoEtnico = $objFunciones->generarCombo("cmbGrupoEtnico", $sqlgrupo, "", true, false, "", "");

$sqldisponibilidad = "select codigo, nombre  from  disponibilidad ";
$cmbDisponibilidad = $objFunciones->generarCombo("cmbDisponibilidad", $sqldisponibilidad, "", true, false, "", "");

function validarForm($form, $opcion) {

    $codigo = strtoupper(trim($form['codigo']));
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $cedula = strtoupper(trim($form['cedula']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $archivo = strtoupper(trim($form['archivo']));
    $codigo_grupo_etnico = strtoupper(trim($form['cmbGrupoEtnico']));
    $disponibilidad = strtoupper(trim($form['cmbDisponibilidad']));
    $objResponse = new xajaxResponse();
    $msg = "";
//    $objResponse->alert(print_r($form, true));
    if (strcasecmp($nombres, '') == 0 or strcasecmp($nombres, 'seleccione') == 0) {
        $msg.="\nINGRESE NOMBRES...";
    }
    if (strcasecmp($apellidos, '') == 0 or strcasecmp($apellidos, 'seleccione') == 0) {
        $msg.="\nINGRESE APELLIDOS...";
    }
    if (strcasecmp($cedula, '') == 0 or strcasecmp($cedula, 'seleccione') == 0) {
        $msg.="\nINGRESE CEDULA...";
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
    if (strcasecmp($archivo, '') == 0 or strcasecmp($archivo, 'seleccione') == 0) {
        //$msg.="\nINGRESE ARCHIVO...";
    }
    if (strcasecmp($codigo_grupo_etnico, '') == 0 or strcasecmp($codigo_grupo_etnico, 'seleccione') == 0) {
        $msg.="\nSELECCIONE GRUPO ETNICO...";
    }
    if (strcasecmp($disponibilidad, '') == 0 or strcasecmp($disponibilidad, 'seleccione') == 0) {
        $msg.="\nINGRESE DISPONIBILIDAD...";
    }

    //$objResponse->alert(print_r($form, true));

    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        if ($opcion == 0) { // inserta
            //$objResponse->call("xajax_ingresar", $form);
            $objResponse->assign("btna", "value", "guardar");
            $objResponse->script("document.form.submit();");
        } else { // actualizar
            //$objResponse->call("xajax_actualizar", $form);
            $objResponse->assign("btna", "value", "actualizar");
            $objResponse->script("document.form.submit();");
        }
    }
    return $objResponse;
}

function ingresar($form) {

    $form = json_decode($form, true);
    $codigo = strtoupper(trim($form['codigo']));
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $cedula = strtoupper(trim($form['cedula']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $archivo = trim($form['archivo']);
    $foto = trim($form['foto']);
    $codigo_grupo_etnico = strtoupper(trim($form['cmbGrupoEtnico']));
    $disponibilidad = strtoupper(trim($form['cmbDisponibilidad']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $objResponse = new xajaxResponse();
    //$objResponse->alert(print_r($form, true));
    $sqlInsert = "insert into candidato "
            . "(nombres,apellidos,fecha_nacimiento,genero,telefono,movil,archivo,grupo_etnico,disponibilidad, cedula,foto) "
            . "values"
            . "('$nombres','$apellidos','$fecha_nacimiento','$genero','$telefono','$movil','$archivo','$codigo_grupo_etnico','$disponibilidad','$cedula', '$foto');";
    $rs = $objDB->query($sqlInsert);
    if ($rs) {
        $sqlid = "select last_insert_id() as last;";
        $rs1 = $objDB->query($sqlid);
        $arr = $objDB->fetch_array($rs1);
        $cod = trim($arr["last"]);
        if ($cod > 0) {
            $_SESSION["codigo_candidato"] = $cod;
        }
        $objResponse->alert("Registrado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("Error:\n" . $objDB->getLastError());
    }



    return $objResponse;
}

function actualizar($form) {
    $form = json_decode($form, true);
    $codigo = strtoupper(trim($form['codigo']));
    $nombres = strtoupper(trim($form['nombres']));
    $apellidos = strtoupper(trim($form['apellidos']));
    $cedula = strtoupper(trim($form['cedula']));
    $fecha_nacimiento = strtoupper(trim($form['fecha_nacimiento']));
    $genero = strtoupper(trim($form['genero']));
    $telefono = strtoupper(trim($form['telefono']));
    $movil = strtoupper(trim($form['movil']));
    $codigo_direccion = strtoupper(trim($form['codigo_direccion']));
    $archivo = trim($form['archivo']);
    $foto = trim($form['foto']);
    $codigo_grupo_etnico = strtoupper(trim($form['codigo_grupo_etnico']));
    $disponibilidad = strtoupper(trim($form['disponibilidad']));
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $uploads = "";
    if (strlen(trim($archivo)) > 5) {
        $uploads.=", archivo= '$archivo' ";
    }
    if (strlen(trim($foto)) > 5) {
        $uploads.=" , foto= '$foto'";
    }

    $sqlUpdate = "update  candidato set  nombres= '$nombres'
    , apellidos= '$apellidos'
    , cedula = '$cedula'
    , fecha_nacimiento= '$fecha_nacimiento'
    , genero= '$genero'
    , telefono= '$telefono'
    , movil= '$movil'
    $uploads
    , grupo_etnico= '$codigo_grupo_etnico'
    , disponibilidad= '$disponibilidad'
     where  codigo= '$codigo'
    ";

    $rs = $objDB->query($sqlUpdate);

    if ($rs == true) {
        $objResponse->alert("Actualizado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("No se pudo actualizar los datos del Candidato\nError:\n",$objDB->getLastError()."\n".$sqlUpdate);
    }
    return $objResponse;
}

function confirmarEliminarForm($id) {
    $objResponse = new xajaxResponse();
    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar", $id);
    return $objResponse;
}

function eliminar($id) {

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $sqlUpdate = "update  candidato set estado=0 where  codigo= '$id'";
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
    $objResponse->assign("cedula", "value", "");
    $objResponse->assign("fecha_nacimiento", "value", "");
    $objResponse->assign("genero", "value", "");
    $objResponse->assign("telefono", "value", "");
    $objResponse->assign("movil", "value", "");
    $objResponse->assign("codigo_direccion", "value", "");
    $objResponse->assign("archivo", "value", "");
    $objResponse->assign("foto", "src", "");
    $objResponse->assign("cmbGrupoEtnico", "value", "");
    $objResponse->assign("cmbDisponibilidad", "value", "");

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
    $objResponse->assign("cedula", "value", $ln["cedula"]);
    $objResponse->assign("fecha_nacimiento", "value", $ln["fecha_nacimiento"]);
    $objResponse->assign("genero", "value", $ln["genero"]);
    $objResponse->assign("telefono", "value", $ln["telefono"]);
    $objResponse->assign("movil", "value", $ln["movil"]);

    $objResponse->assign("hoja", "value", $ln["archivo"]);
    $objResponse->assign("foto", "src", $ln["foto"]);
    $objResponse->assign("cmbGrupoEtnico", "value", $ln["grupo_etnico"]);
    $objResponse->assign("cmbDisponibilidad", "value", $ln["disponibilidad"]);
    $objResponse->call("xajax_consultarDirecciones", $id);
    $objResponse->call("xajax_consultarEstudios", $id);
    $objResponse->call("xajax_consultarExperiencia", $id);
    $_SESSION["codigo_candidato"] = $id;
    return $objResponse;
}

function consultar($form) {
    $_SESSION["codigo_candidato"] = 0;
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from candidato 
    where  concat(nombres,' ',apellidos)  like '%$query%' and estado =1";

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
        if ($_SESSION["pe"] == "0") {
            $eliminarLnk = " style='cursor:pointer' title='no tiene permisos' ";
        } else {
            $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        }

        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table> ";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");
    //$objResponse->alert($sql);
    return $objResponse;
}

function consultarDirecciones($codigo) {
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from direccion 
    where  codigo_candidato  = '$codigo' ";


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
        $actalizarLnk = " style='cursor:pointer' onclick=\"return popitup('./direccion_aux.php?codigo=$id', 'direccion', 300, 400);\" ";
        $eliminar = "<img src='" . HOME . "imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarDireccion($id)' ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table>";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvDireccion", "innerHTML", "$tabla");

    return $objResponse;
}

function consultarEstudios($codigo) {
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from estudio 
    where  codigo_candidato  = '$codigo' ";

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
        //$actalizarLnk = " style='cursor:pointer' onclick = 'xajax_seleccionar($id)' ";
        $actalizarLnk = " style='cursor:pointer' onclick=\"return popitup('./estudio_aux.php?codigo=$id', 'direccion', 300, 400);\" ";
        $eliminar = "<img src='" . HOME . "imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table> ";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvEstudios", "innerHTML", "$tabla");

    return $objResponse;
}

function consultarExperiencia($codigo) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from experiencia 
    where  codigo_candidato  = '$codigo' ";

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
        $actalizarLnk = " style='cursor:pointer' onclick=\"return popitup('./experiencia_aux.php?codigo=$id', 'direccion', 400, 400);\" ";
        $eliminar = "<img src='" . HOME . "imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table> ";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvExperiencia", "innerHTML", "$tabla");

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

$xajax->register(XAJAX_FUNCTION, "consultarDirecciones");
$xajax->register(XAJAX_FUNCTION, "consultarEstudios");
$xajax->register(XAJAX_FUNCTION, "consultarExperiencia");
?>
