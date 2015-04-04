<?php

function validarForm($form, $opcion) {
    $usuario = $form['usuario'];
    $clave = $form['clave'];
    $cmbRol = $form['cmbRol'];
    $objResponse = new xajaxResponse();
    $msg = "";
    if (strcasecmp($usuario, '') == 0 or strcasecmp($usuario, 'seleccione') == 0) {
        $msg .= "\nINGRESE USUARIO";
    }
    if (strcasecmp($clave, '') == 0 or strcasecmp($clave, 'seleccione') == 0) {
        $msg .= "\nINGRESE CLAVE...";
    }
    if (strcasecmp($cmbRol, '') == 0 or strcasecmp($cmbRol, 'seleccione') == 0) {
        $msg .= "\nSELECCIONE EL PERFIL...";
    }
    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        $objResponse->call("xajax_ingresar", $form);
    }
    return $objResponse;
}

function ingresar($form) {

    $usuario = $form['usuario'];
    $clave = $form['clave'];
    $cmbRol = $form['cmbRol'];
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $objResponse = new xajaxResponse();

    $sqlInsert = "select count(*) as cantidad, a.codigo, b.codigo_rol"
            . " from " . SCHEMA . ".usuario as a INNER JOIN  " . SCHEMA . ".rol_usuario as b "
            . "ON a.codigo = b.codigo_usuario  "
            . "AND a.nombre='$usuario'  "
            . "and a.clave='$clave'  "
            . "and b.codigo_rol='$cmbRol' "
            . "group by a.codigo  "
            . "limit 1";
    $rs = $objDB->query($sqlInsert);
    $numrows = $objDB->getNumRows();
   
    if ($numrows > 0) {
        $_SESSION["aut_usuario"] = $usuario;
        $_SESSION["aut_clave"] = $clave;
        $_SESSION["aut_perfil"] = $cmbRol;
        $objResponse->redirect("index.php");
    } else {
        $_SESSION["aut_usuario"] = "";
        $_SESSION["aut_clave"] = "";
        $_SESSION["aut_perfil"] = "";
     
        $objResponse->alert("Datos incorrectos!!!");
    }
    return $objResponse;
}

function limpiar($form) {
    $objResponse = new xajaxResponse();
    $objResponse->assign("codigo_tipo_impuesto", "value", "");
    $objResponse->assign("descripcion", "value", "");
    $objResponse->assign("activo", "value", "");
    $objResponse->assign("codigo_sri", "value", "");
    return $objResponse;
}

$xajax->register(XAJAX_FUNCTION, "validarForm");
$xajax->register(XAJAX_FUNCTION, "ingresar");
$xajax->register(XAJAX_FUNCTION, "limpiar");
?>