<?php

$objFunciones = new Funciones();
$sqlgrupo = "select codigo, nombre  from  pais ";
$cmbPais = $objFunciones->generarCombo("codigo_pais", $sqlgrupo, " onchange='xajax_verProvincia(this.value)' ", true, false, "", "");

function verProvincia($pais) {
    $objFunciones = new Funciones();
    $sqlgrupo = "select codigo, nombre  from  provincia where codigo_pais ='$pais' ";
    $cmb = $objFunciones->generarCombo("codigo_provincia", $sqlgrupo, " onchange='xajax_verCiudad(this.value)' ", true, false, "", "");
    $objResponse = new xajaxResponse();

    $objResponse->assign("dvProvincia", "innerHTML", $cmb);
    return $objResponse;
}

function verCiudad($provinvia) {
    $objFunciones = new Funciones();
    $sqlgrupo = "select codigo, nombre  from  ciudad where codigo_provincia ='$provinvia' ";
    $cmb = $objFunciones->generarCombo("codigo_ciudad", $sqlgrupo, " ", true, false, "", "");
    $objResponse = new xajaxResponse();

    $objResponse->assign("dvCiudad", "innerHTML", $cmb);
    return $objResponse;
}

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $calle_principal = strtoupper(trim($form['calle_principal']));
    $calle_secundaria = strtoupper(trim($form['calle_secundaria']));
    $nro = strtoupper(trim($form['nro']));
    $referencia = strtoupper(trim($form['referencia']));
    $codigo_ciudad = strtoupper(trim($form['codigo_ciudad']));

    $objResponse = new xajaxResponse();

    $msg = "";

    if (strcasecmp($calle_principal, '') == 0 or strcasecmp($calle_principal, 'seleccione') == 0) {
        $msg.="\nINGRESE CALLE PRINCIPAL...";
    }

    if (strcasecmp($calle_secundaria, '') == 0 or strcasecmp($calle_secundaria, 'seleccione') == 0) {
        $msg.="\nINGRESE CALLE SECUNDARIA...";
    }

    if (strcasecmp($nro, '') == 0 or strcasecmp($nro, 'seleccione') == 0) {
        $msg.="\nINGRESE NRO...";
    }

    if (strcasecmp($referencia, '') == 0 or strcasecmp($referencia, 'seleccione') == 0) {
        $msg.="\nINGRESE REFERENCIA...";
    }

    if (strcasecmp($codigo_ciudad, '') == 0 or strcasecmp($codigo_ciudad, 'seleccione') == 0) {
        $msg.="\nSELECCIONE CODIGO CIUDAD...";
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

    $calle_principal = strtoupper(trim($form['calle_principal']));
    $calle_secundaria = strtoupper(trim($form['calle_secundaria']));
    $nro = strtoupper(trim($form['nro']));
    $referencia = strtoupper(trim($form['referencia']));
    $codigo_ciudad = strtoupper(trim($form['codigo_ciudad']));
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $codigo_candidato = $_SESSION["codigo_candidato"];
    $sqlInsert = "insert into direccion (calle_principal,calle_secundaria,nro,referencia,codigo_ciudad,codigo_candidato) values";
    $sqlInsert .= "('$calle_principal','$calle_secundaria','$nro','$referencia','$codigo_ciudad','$codigo_candidato');";
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
    $calle_principal = strtoupper(trim($form['calle_principal']));
    $calle_secundaria = strtoupper(trim($form['calle_secundaria']));
    $nro = strtoupper(trim($form['nro']));
    $referencia = strtoupper(trim($form['referencia']));
    $codigo_ciudad = strtoupper(trim($form['codigo_ciudad']));
    $codigo_candidato = strtoupper(trim($form['codigo_candidato']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  direccion set  calle_principal= '$calle_principal'
, calle_secundaria= '$calle_secundaria'
, nro= '$nro'
, referencia= '$referencia'
, codigo_ciudad= '$codigo_ciudad'
, codigo_candidato= '$codigo_candidato'
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

    global $enlace, $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();

    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar", $form);
    return $objResponse;
}

function eliminar($form) {

    $codigo = strtoupper(trim($form['codigo']));

    $calle_principal = strtoupper(trim($form['calle_principal']));

    $calle_secundaria = strtoupper(trim($form['calle_secundaria']));

    $nro = strtoupper(trim($form['nro']));

    $referencia = strtoupper(trim($form['referencia']));

    $codigo_ciudad = strtoupper(trim($form['codigo_ciudad']));

    $codigo_candidato = strtoupper(trim($form['codigo_candidato']));


    global $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  direccion set activo=0 where  codigo= '$codigo'
";

    $rs = $objDB->query($sqlUpdate);

    $objResponse->alert("Desactivado...");
    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("calle_principal", "value", "");
    $objResponse->assign("calle_secundaria", "value", "");
    $objResponse->assign("nro", "value", "");
    $objResponse->assign("referencia", "value", "");
    $objResponse->assign("codigo_ciudad", "value", "");
    $objResponse->assign("codigo_candidato", "value", "");

    return $objResponse;
}

function seleccionar($id) {

    $objResponse = new xajaxResponse();


    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from direccion 
    where  codigo  = '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("calle_principal", "value", $ln["calle_principal"]);
    $objResponse->assign("calle_secundaria", "value", $ln["calle_secundaria"]);
    $objResponse->assign("nro", "value", $ln["nro"]);
    $objResponse->assign("referencia", "value", $ln["referencia"]);
    $objResponse->assign("codigo_ciudad", "value", $ln["codigo_ciudad"]);
    $objResponse->assign("codigo_candidato", "value", $ln["codigo_candidato"]);


    return $objResponse;
}

function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from direccion 
    where  concat(calle_principal,' ', calle_secundaria ,' ', referencia)  like '%$query%' ";

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
$xajax->register(XAJAX_FUNCTION, "verProvincia");
$xajax->register(XAJAX_FUNCTION, "verCiudad");
?>