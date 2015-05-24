<?php

function validarForm($form, $opcion) {
    $codigo = strtoupper(trim($form['codigo']));
    $razon_social = strtoupper(trim($form['razon_social']));
    $direccion = strtoupper(trim($form['direccion']));
    $representante = strtoupper(trim($form['representante']));
    $email = strtoupper(trim($form['email']));
    $telefono1 = strtoupper(trim($form['telefono1']));
    $telefono2 = strtoupper(trim($form['telefono2']));

    $objResponse = new xajaxResponse();

    $msg = "";

    if ($opcion != 0) {
        if (strcasecmp($codigo, '') == 0 or strcasecmp($codigo, 'seleccione') == 0) {
            $msg.="\nINGRESE CODIGO...";
        }
    }

    if (strcasecmp($razon_social, '') == 0 or strcasecmp($razon_social, 'seleccione') == 0) {
        $msg.="\nINGRESE RAZON SOCIAL...";
    }

    if (strcasecmp($direccion, '') == 0 or strcasecmp($direccion, 'seleccione') == 0) {
        $msg.="\nINGRESE DIRECCION...";
    }

    if (strcasecmp($representante, '') == 0 or strcasecmp($representante, 'seleccione') == 0) {
        $msg.="\nINGRESE REPRESENTANTE...";
    }

    if (strcasecmp($email, '') == 0 or strcasecmp($email, 'seleccione') == 0) {
        $msg.="\nINGRESE EMAIL...";
    }

    if (strcasecmp($telefono1, '') == 0 or strcasecmp($telefono1, 'seleccione') == 0) {
        $msg.="\nINGRESE TELEFONO1...";
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


    $razon_social = strtoupper(trim($form['razon_social']));
    $direccion = strtoupper(trim($form['direccion']));
    $representante = strtoupper(trim($form['representante']));
    $email = strtoupper(trim($form['email']));
    $telefono1 = strtoupper(trim($form['telefono1']));
    $telefono2 = strtoupper(trim($form['telefono2']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();
    $aut_usuario = $_SESSION["aut_usuario"];
    $sqlInsert = "insert into " . SCHEMA . ".empresa (razon_social,direccion,representante,email,telefono1,telefono2,usuario) values";

    $sqlInsert .= "('$razon_social','$direccion','$representante','$email','$telefono1','$telefono2','$aut_usuario');";

    $rs = $objDB->query($sqlInsert);



    if ($rs == true) {
        $objResponse->alert("Registrado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("No se pudo registrar los datos de la Empresa\nError:\n", $objDB->getLastError());
    }

    return $objResponse;
}

function actualizar($form) {

    $codigo = strtoupper(trim($form['codigo']));
    $razon_social = strtoupper(trim($form['razon_social']));
    $direccion = strtoupper(trim($form['direccion']));
    $representante = strtoupper(trim($form['representante']));
    $email = strtoupper(trim($form['email']));
    $telefono1 = strtoupper(trim($form['telefono1']));
    $telefono2 = strtoupper(trim($form['telefono2']));

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlUpdate = "update  " . SCHEMA . ".empresa set  "
            . "razon_social= '$razon_social' "
            . ", direccion= '$direccion' "
            . ", representante= '$representante' "
            . ", email= '$email' "
            . ", telefono1= '$telefono1' "
            . ", telefono2= '$telefono2' "
            . "where  codigo= '$codigo'    ";

    $rs = $objDB->query($sqlUpdate);


    if ($rs == true) {
        $objResponse->alert("Actualizado...");
        $objResponse->call("xajax_limpiar");
    } else {
        $objResponse->alert("No se pudo actualizar los datos de la Empresa\nError:\n", $objDB->getLastError());
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

    $sqlUpdate = "update  " . SCHEMA . ".empresa set activo=0 where  codigo= '$codigo'";

    $rs = $objDB->query($sqlUpdate);

    if ($rs == true) {
        $objResponse->alert("Desactivado...");
    } else {
        $objResponse->alert("No se pudo desactivar la Empresa");
    }

    return $objResponse;
}

function limpiar($form) {

    $objResponse = new xajaxResponse();

    $objResponse->assign("codigo", "value", "");
    $objResponse->assign("razon_social", "value", "");
    $objResponse->assign("direccion", "value", "");
    $objResponse->assign("representante", "value", "");
    $objResponse->assign("email", "value", "");
    $objResponse->assign("telefono1", "value", "");
    $objResponse->assign("telefono2", "value", "");

    return $objResponse;
}

function seleccionar($id) {
    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from " . SCHEMA . ".empresa 
    where  codigo  = '$id' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln = $objDB->fetch_array($result);

    $objResponse->assign("codigo", "value", $ln["codigo"]);
    $objResponse->assign("razon_social", "value", $ln["razon_social"]);
    $objResponse->assign("direccion", "value", $ln["direccion"]);
    $objResponse->assign("representante", "value", $ln["representante"]);
    $objResponse->assign("email", "value", $ln["email"]);
    $objResponse->assign("telefono1", "value", $ln["telefono1"]);
    $objResponse->assign("telefono2", "value", $ln["telefono2"]);


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

    $sql = " select *    from " . SCHEMA . ".empresa 
    where  concat(razon_social,' ' , direccion)  like '%$query%' and estado =1 $where";

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