<?php

//error_reporting(E_ALL ^ E_NOTICE);
//ini_set("display_errors", 1);

function validarForm($form) {
    $titulo = strtoupper(trim($form['titulo']));
    //$descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    //$localizacion = strtoupper(trim($form['localizacion']));

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
    //$objResponse->assign("descripcion", "value", "");
    $objResponse->assign("sueldo", "value", "");
    //$objResponse->assign("localizacion", "value", "");
    $objResponse->assign("duracion_contrato", "value", "");
    $objResponse->assign("cod_empresa", "value", "");
    $objResponse->assign("empresa", "value", "");

    return $objResponse;
}

function consultar($form) {
    $titulo = strtoupper(trim($form['titulo']));
    //$descripcion = strtoupper(trim($form['descripcion']));
    $sueldo = strtoupper(trim($form['sueldo']));
    //$localizacion = strtoupper(trim($form['localizacion']));

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
    and concat(a.nombre,' ',a.descripcion)  like '%$titulo%'  
    and concat(a.sueldo,' ',a.localizacion)  like '%$sueldo%'         ";
//and a.descripcion  like '%$descripcion%'   and a.localizacion  like '%$localizacion%'
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
        $desempleo = $ln[1];
        $desempleo = str_replace("\n", "", $desempleo);
        $tb = "<tr>";
        for ($i = 0; $i < $numCols; $i++) {
            $dato = $ln[$i];
            $tb.="<td id = 'dv_$i'.'_$id'>$dato</td>";
        }
        $actualizar = "<img src='" . HOME . "imagenes/telephone_go.png'/>";
        $actalizarLnk = " style='cursor:pointer' onclick = \"xajax_aplicarempleo('$desempleo',$id)\" ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td>   </tr>";
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

function aplicarempleo($empleo, $ide) {
    $objResponse = new xajaxResponse();
    $objResponse->confirmCommands(1, "Esta  aplicando al empleo:$empleo \nDesea continuar?");
    $objResponse->call("xajax_aplicarempleo_registro", $ide);
    return $objResponse;
}

function aplicarempleo_registro($ide) {
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $idc = $_SESSION["aut_usuario"];
    $sql = "select count(*) as cantidad from candidato_empleo where empleo_codigo='$ide' and candidato_codigo='$idc'";
    $rs = $objDB->query($sql);

    $arr = $objDB->fetch_array($rs);
    if ($arr["cantidad"] == "0") {
        $objResponse->alert('Gracias por  aplicar al empleo, en momentos la Empresa se contactara contigo!!!');
        $sql = "insert into candidato_empleo(empleo_codigo, candidato_codigo)values($ide,$idc);";
        $rs = $objDB->query($sql);
//    $objResponse->alert($sql);
//     $objResponse->alert($objDB->getLastError());
        if ($rs != false) {
            /* envio mail de notificacion a la empresa */
            sendmail_empresa($ide, $idc);
        }
    } else {
        $objResponse->alert('Ya estas aplicando al empleo seleccionado!!!');
    }

    $objDB->cerrar();

    return $objResponse;
}

function sendmail_empresa($ide, $idc) {

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = "Select a.codigo as cod_empleo, a.nombre as titulo, a.descripcion, "
            . "a.sueldo, a.localizacion, c.nombre as duracion_contrato, "
            . "b.codigo as cod_empresa, b.razon_social as empresa , b.email"
            . "from empleo as a inner join empresa as b "
            . "on a.codigo_empresa = b.codigo inner join duracion_contrato as c "
            . "on a.duracion_contrato = c.codigo and a.estado =1 "
            . "and b.estado =1 "
            . "and a.fecha_vigencia >=CURRENT_DATE "
            . "and a.codigo = '$ide' ";
    $rs = $objDB->query($sql);
    $arr = $objDB->fetch_array($rs);
    /*  */
    $sql2 = "select * from empleo.candidato where usuario = '$idc' and estado = 1 ";
    $rs2 = $objDB->query($sql2);
    $arr2 = $objDB->fetch_array($rs2);


    $objDB->cerrar();

    $titulo = $arr["titulo"];
    $remitente = "aspirante@empleo.com.ec";
    $destino = $arr["email"];

    $nombres = $arr2["nombres"] . ' ' . $arr2["apellidos"];

    // multiple recipients
    $to = $destino;

    // subject
    $subject = 'Aspirante Empleo - ' . $titulo;

    // message
    $message = '
<html>
<head>
  <title>Solicitud de Empleo</title>
</head>
<body>
  <p>Solicitud de Empleo</p>
  <table>
    <tr>
      <th>Persona</th>
    </tr>
    <tr>
      <td>' . $nombres . '</td>
    </tr>
  </table>
</body>
</html>
';

// To send HTML mail, the Content-type header must be set
    $headers = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

// Additional headers
    $headers .= 'To: ' . $destino . "\r\n";
    $headers .= 'From: Aspirante Empleo <aspirante@empleo.com.ec>' . "\r\n";
    //$headers .= 'Cc: birthdayarchive@example.com' . "\r\n";
    //$headers .= 'Bcc: birthdaycheck@example.com' . "\r\n";
// Mail it
    mail($to, $subject, $message, $headers);
}

$xajax->register(XAJAX_FUNCTION, "validarForm");
$xajax->register(XAJAX_FUNCTION, "aplicarempleo_registro");
$xajax->register(XAJAX_FUNCTION, "consultar");
$xajax->register(XAJAX_FUNCTION, "aplicarempleo");
?>