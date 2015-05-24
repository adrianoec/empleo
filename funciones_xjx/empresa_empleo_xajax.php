<?php

//error_reporting(E_ALL ^ E_NOTICE);
//ini_set("display_errors", 1);

function validarForm($desde, $hasta) {

    $form = array("desde" => $fchdesde, "hasta" => $fchhasta);

    $objResponse = new xajaxResponse();
    $msg = "";

    if (strlen(trim($msg)) > 0) {
        $objResponse->alert($msg);
        return $objResponse;
    } else {
        $objResponse->call("xajax_consultar", $desde, $hasta);
    }
    return $objResponse;
}

function limpiar() {

    $objResponse = new xajaxResponse();

    $objResponse->assign("desde", "value", "");
    $objResponse->assign("hasta", "value", "");


    return $objResponse;
}

function consultar($desde, $hasta) {
    
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    
    $aut_usuario = $_SESSION["aut_usuario"];
    $aut_perfil = $_SESSION["aut_perfil"];
    $where = "";
    if ($aut_perfil != "1") {
        $where.=" and a.usuario='$aut_usuario' ";
    }
    
    $sql = "Select 
    d.razon_social as empresa
    , a.nombre as empleo, concat(c.nombres ,' ',c.apellidos) as candidato
    , c.telefono, c.movil
    , a.fecha_publicacion, b.fecha_aplicacion
    from empleo as a inner join candidato_empleo as b 
    on a.codigo = b.empleo_codigo inner join candidato as c
    on b.candidato_codigo =c.codigo  inner join empresa as d
    on a.codigo_empresa = d.codigo
    and a.estado =1
    and b.fecha_aplicacion >='$desde'
    and b.fecha_aplicacion <='$hasta'  
        $where
      ";


    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();
    $nuevo = "<img src='" . HOME . "imagenes/page_white_text.png'/>";
    //$nuevoLnk = " style='cursor:pointer' onclick = 'xajax_nuevo()' ";

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
        //$actualizar = "<img src='" . HOME . "imagenes/telephone_go.png'/>";
        //$actalizarLnk = " style='cursor:pointer' onclick = \"xajax_aplicarempleo('$desempleo',$id)\" ";
        $tabla.=$tb . " <td $actalizarLnk >$actualizar</td>   </tr>";
    }
    $tabla.="</tbody>"
            . "</table>"
            . "</td>"
            . "</tr>"
            . "</table>  ";
    $objResponse->script('loadTabla();');
    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");

    $objDB->cerrar();

    return $objResponse;
}

$xajax->register(XAJAX_FUNCTION, "validarForm");
$xajax->register(XAJAX_FUNCTION, "aplicarempleo_registro");
$xajax->register(XAJAX_FUNCTION, "consultar");
$xajax->register(XAJAX_FUNCTION, "aplicarempleo");
?>