<?php
session_start();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

// pg_connect("host=192.168.1.104, user=postgres, password=postgres");
//$enlace = pg_connect("host=localhost port=5432 dbname=facturacion user=postgres password=postgres");
$enlace = mysql_connect("localhost", "root", "root123");
mysql_select_db('empleo', $enlace);
if ($enlace) {
    $msg = "exito...";
} else {
    $msg = "error al conectar";
}


require ('./lib/xajax_05/xajax_core/xajax.inc.php');
$xajax = new xajax();
//$xajax->configure('debug', true);


$arrSn[0][0] = 'S';
$arrSn[0][1] = 'Si';
$arrSn[1][0] = 'N';
$arrSn[1][1] = 'No';


$arrHTML[0][0] = 'textBox';
$arrHTML[0][1] = 'Text Box';
$arrHTML[1][0] = 'listBox';
$arrHTML[1][1] = 'List Box';
$arrHTML[2][0] = 'textarea';
$arrHTML[2][1] = 'Text Area';
$arrHTML[3][0] = 'comboBox';
$arrHTML[3][1] = 'Combo Box';
$arrHTML[4][0] = 'checkBox';
$arrHTML[4][1] = 'Check Box';
$arrHTML[5][0] = 'button';
$arrHTML[5][1] = 'Button';
$arrHTML[6][0] = 'password';
$arrHTML[6][1] = 'Password';
$arrHTML[7][0] = 'hidden';
$arrHTML[7][1] = 'Hidden';


$arrVal[0][0] = 'texto';
$arrVal[0][1] = 'Texto';
$arrVal[1][0] = 'numeros';
$arrVal[1][1] = 'Numeros';
$arrVal[2][0] = 'fecha';
$arrVal[2][1] = 'Fecha';
$arrVal[3][0] = 'cedula';
$arrVal[3][1] = 'RUC/CI';
$arrVal[4][0] = 'longitud';
$arrVal[4][1] = 'Longitud';
$arrVal[5][0] = 'email';
$arrVal[5][1] = 'Email';

function mostrarDatos($form) {
    global $enlace;
    $objResponse = new xajaxResponse();
    //$objResponse->alert("uio");
    $sql = $form['txtSql'];
    $rs = mysql_query($sql,$enlace);
    $nroFilas = mysql_num_rows($rs);
    $nroCol = mysql_num_fields($rs);
    $datos = array();

    for ($i = 0; $i < $nroCol; $i++) {
        $nomFila = mysql_field_name($rs, $i);
        $longitud = mysql_field_len($rs, $i);
        $tipoDato = mysql_field_type($rs, $i);

        $datos[$i][0] = $nomFila;
        $datos[$i][1] = $longitud;
        $datos[$i][2] = $tipoDato;
    }

    $_SESSION['datos'] = $datos;
    $_SESSION['nroFilas'] = $nroFilas;
    $_SESSION['nroCol'] = $nroCol;

    $objResponse->assign("txtColumnas", "value", $nroCol);
    $objResponse->assign("txtFilas", "value", $nroFilas);

    $objResponse->script("xajax_mostrarCampos()");
    return $objResponse;
}

function mostrarCampos() {
    global $enlace, $arrSn;
    $objResponse = new xajaxResponse();

    $datos = $_SESSION['datos'];

    $tabla = "<table border='1'>
        <tr>
            <th>COLUMNA</th>
            <th>TIPO DATO</th>
            <th>LONGITUD</th>
            <th>PK</th>
            <th>INCLUIR FORM?</th>
            <th>OBJ HTML?</th>
            <th>REQUERIDO?</th>
            <th>VAL?</th>
            <th>TIPO VAL</th>
            <th>SQL</th>
        </tr> ";
    $i = 0;
    foreach ($datos as $ln) {
        $nomFila = $ln[0];
        $longitud = $ln[1];
        $tipoDato = $ln[2];

        $combo = objetoHTML("cmbSN$i", $arrSn, "xajax_habilitarObjHTML(this.value,$i)", "N");
        $combopk = objetoHTML("cmbpk$i", $arrSn, "", "N");
        $comboval = objetoHTML("cmbVal$i", $arrSn, "xajax_tipoValidacion(this.value,$i)", "N");
        $tabla.="<tr>
        <td> <div id=''> <input type='text' name='txtCol$i' id='txtCol$i' value='$nomFila'> </div> </td>
        <td> <div id=''> <input type='text' name='txtTipoDat$i' id='txtCol$i' value='$tipoDato' size='10'> </div> </td>
        <td> <div id=''> <input type='text' name='txtLongitud$i' id='txtCol$i' value='$longitud' size='10'> </div> </td>
        <td> <div id='dvPkForm$i'> $combopk </div> </td>
        <td> <div id='dvIncluirForm$i'> $combo </div> </td>
        <td> <div id='dvObjHTML$i'>  </div> </td>
        <td> <div id='dvCampoRequerido$i'>  </div> </td>
        <td> <div id='dvCampoValidacion$i'> $comboval </div> </td>
        <td> <div id='dvEspacioUno$i'>  </div> </td>
        <td> <div id='dvEspacioDos$i'> <input type='text' name='txtsql$i' id='txtsql$i' value=''> </div> </td>
        <td> <div id='dvEspacioTres$i'>  </div> </td>
        </tr>";
        $i++;
    }
    $tabla.="</table>";
    $objResponse->assign("dvResultado", "innerHTML", $tabla);
    return $objResponse;
}

function habilitarObjHTML($option, $indice) {
    global $arrHTML;
    $objResponse = new xajaxResponse();
    if ($option == 'S') {
        $cmb = objetoHTML("cmbObjHTML$indice", $arrHTML, "xajax_habilitarRequerido(this.value,$indice)", "");
    } else {
        $cmb = "";
    }
    $objResponse->assign("dvObjHTML$indice", "innerHTML", $cmb);
    return $objResponse;
}

function habilitarRequerido($option, $indice) {
    global $arrSn;
    $objResponse = new xajaxResponse();

    $cmb = objetoHTML("cmbRequerido$indice", $arrSn, "", "");

    $objResponse->assign("dvCampoRequerido$indice", "innerHTML", $cmb);
    $objResponse->call("xajax_sqlDependiente('$option','$indice')");
    return $objResponse;
}

function tipoValidacion($option, $indice) {
    global $arrVal;
    $objResponse = new xajaxResponse();
    if ($option == 'S') {
        $cmb = objetoHTML("cmbTipoValidacion$indice", $arrVal, "xajax_sqlDependiente(this.value,$indice)", "");
    } else {
        $cmb = "";
    }
    $objResponse->assign("dvEspacioUno$indice", "innerHTML", $cmb);
    return $objResponse;
}

function sqlDependiente($option, $indice) {
    global $arrVal;
    $objResponse = new xajaxResponse();
    if ($option == 'comboBox' or $option == 'listBox') {
        $cmb = generarObjHTML("textBox", "sqlDependiente$indice", 40, "");
    } else {
        $cmb = "";
    }
    $objResponse->assign("dvEspacioDos$indice", "innerHTML", $cmb);
    return $objResponse;
}

/**
 * dibuja el combo
 * @param <type> $nombre
 * @param <type> $array
 * @param <type> $evento
 * @param <type> $selected
 * @return string
 */
function objetoHTML($nombre, $array, $evento, $selected) {
    $tabla.="<select name='$nombre' id='$nombre' onchange='$evento' ><option value=''></option>";
    foreach ($array as $ln) {
        if ($ln[0] == $selected) {
            $tabla.="<option value='$ln[0]' selected>$ln[1]</option>";
        } else {
            $tabla.="<option value='$ln[0]'>$ln[1]</option>";
        }
    }
    $tabla.="</select>";
    return $tabla;
}

/**
 * Genera los  archivos de la interfaz
 * @param <type> $form
 * @return xajaxResponse
 */
function generarInterface($form) {
    $objResponse = new xajaxResponse();

    $nroFilas = $form['txtColumnas'];



    $nroColumas = $form['txtNroColumnas'];
    $cmbTipoInterface = $form['cmbTipoInterface'];
    $txtNombreArchivo = trim($form['txtNombreArchivo']);


    $divform = "<?php 
        \$pm=\"\";
\$pc=\"\";
\$pg=\"\";
\$pa=\"\";
\$pe=\"\";
            if(\$_SESSION[\"pm\"]==\"0\"){
                \$pm =\"disabled='true'\";
            }
            if(\$_SESSION[\"pc\"]==\"0\"){
                \$pc =\"disabled='true'\";
            }
            if(\$_SESSION[\"pg\"]==\"0\"){
                \$pg =\"disabled='true'\";
            }
            if(\$_SESSION[\"pa\"]==\"0\"){
                \$pa =\"disabled='true'\";
            }
            if(\$_SESSION[\"pe\"]==\"0\"){
                \$pe =\"disabled='true'\";
            }
            ?>"
            . "<table  width=\"70%\" class=\"acordeon\" align=\"center\" ><tr><td onclick=\"muestra_oculta('dvFormulario')\">Formulario</td></tr></table>\n<div id='dvFormulario' >\n";

    $tabla = $divform . "<form name='form' id='form' action=''>\n<table border='0' align='center'>\n";

    $tablaInterna = "";
    $j = 1;
    $cargaCombos = "";
    for ($i = 0; $i < $nroFilas; $i++) {
        $nombre = $form['txtCol' . $i];
        $tipoDato = $form['txtTipoDat' . $i];
        $longitud = $form['txtLongitud' . $i];
        $comboSN = $form['cmbSN' . $i];
        $comboHTML = $form['cmbObjHTML' . $i];
        $comboTipoValidacion = $form['cmbTipoValidacion' . $i];
        $cmbRequerido = $form['cmbRequerido' . $i];
        $comboValidacion = $form['cmbVal' . $i];
        $comboPK = $form['cmbpk' . $i];

        $sqlDependiente = $form['sqlDependiente' . $i];

        if (sqlDependiente == '' or sqlDependiente == '') {
            
        }

        $evento = "";

        /*
          $columanNombre=$form[''];
          $columanNombre=$form[''];
          $columanNombre=$form[''];
          $columanNombre=$form[''];
         */

        $obj = generarObjHTML($comboHTML, $nombre, $longitud, $evento);
        if ($cmbRequerido == 'S') {
            $nom = strtoupper($nombre);
            $req = "<div id='dvReq$nom'><font color='red'>*</font></div>";
        } else {
            $nom = strtoupper($nombre);
            $req = "<div id='dvReq$nom'></div>";
        }


        if ($comboSN == 'S') {

            if ($j < $nroColumas) {
                $nombre = strtoupper($nombre);
                $nombre = str_replace("_", " ", $nombre);
                $tablaInterna.="\n\t\t <td> \n\t\t\t $nombre \n\t\t </td> \n\t\t <td>$req</td> \n\t\t <td> \n\t\t\t $obj \n\t\t </td>\n";
                $j++;
            } else {
                $nombre = strtoupper($nombre);
                $nombre = str_replace("_", " ", $nombre);
                $tablaInterna.="\n\t\t <td> \n\t\t\t $nombre \n\t\t </td> \n\t\t <td>$req</td> \n\t\t <td> \n\t\t\t $obj \n\t\t </td>\n";

                $tabla.="\t<tr> $tablaInterna \t</tr>\n";
                $tablaInterna = "";
                $j = 1;
            }
        }
    }



    if ($j <= $nroColumas) {
        $tabla.="\t <tr> \n\t\t\t $tablaInterna \t</tr>\n";
        $tablaInterna = "";
    }


    if ($cmbTipoInterface == 'form') {
//        $obj1 = generarObjHTML("button", "btnGuardar", "", "xajax_validarForm(xajax.getFormValues('form'),0)", "Guardar");
//        $obj2 = generarObjHTML("button", "btnActualizar", "", "xajax_validarForm(xajax.getFormValues('form'),1)", "Actualizar");
//        $obj3 = generarObjHTML("button", "btnEliminar", "", "xajax_confirmarEliminarForm(xajax.getFormValues('form'))", "Eliminar");
//        $obj4 = generarObjHTML("button", "btnCancelar", "", "xajax_limpiar(xajax.getFormValues('form'))", "Cancelar");
        $cl = $nroColumas * 2;
        $cl = $cl + 1;
        
        $obj1 = "<input type=\"button\" name=\"btnGuardar\" id=\"btnGuardar\" value=\"Guardar\" onclick=\"xajax_validarForm(xajax.getFormValues('form'),0)\" <?php echo \$pg; ?> />";
        $obj2 = "<input type=\"button\" name=\"btnActualizar\" id=\"btnActualizar\" value=\"Actualizar\" onclick=\"xajax_validarForm(xajax.getFormValues('form'),1)\" <?php echo \$pa; ?> />";
        $obj3 = "<input type=\"button\" name=\"btnEliminar\" id=\"btnEliminar\" value=\"Eliminar\" onclick=\"xajax_confirmarEliminarForm(xajax.getFormValues('form'))\" <?php echo \$pe; ?> />";
        $obj4 = "<input type=\"button\" name=\"btnCancelar\" id=\"btnCancelar\" value=\"Cancelar\" onclick=\"xajax_limpiar(xajax.getFormValues('form'))\" />";
        
        $tabla.="\t<tr> \n\t\t<td colspan='$cl' align='center'>\n
            \t\t\t <table align='center'> \n\t\t\t \t\t<tr>\n
            \t\t\t\t\t <td> \n\t\t\t\t\t\t\t $obj1 \n\t\t\t\t\t\t </td>\n
            \t\t\t\t\t <td> \n\t\t\t\t\t\t\t $obj2 \n\t\t\t\t\t\t </td>\n
            \t\t\t\t\t <td> \n\t\t\t\t\t\t\t $obj3 \n\t\t\t\t\t\t </td>\n
            \t\t\t\t\t <td> \n\t\t\t\t\t\t\t $obj4 \n\t\t\t\t\t\t </td>\n
            \t\t\t\t </tr>  \n\t\t\t\t  </table> \n\t\t </td> \n
            </tr> \n";
    } else {
        $cl = $nroColumas * 2;
        //$obj1 = generarObjHTML("button", "btnConsultar", "", "xajax_validarConsulta(xajax.getFormValues(form))", "Consultar");
        
         
          $obj1 = "<input type=\"button\" name=\"btnConsultar\" id=\"btnConsultar\" value=\"Consultar\" onclick=\"xajax_validarConsulta(xajax.getFormValues(form))\" <?php echo \$pc; ?> >";
        
        $tabla.="<tr> \n\t\t <td colspan='$cl' align='center'> \n\t\t\t $obj1 \n\t\t </td> \n </tr> \n";
    }

    $tabla.="</table> \n </form> "
            . " \n </div> ";

    $divconsulta = "<table width=\"70%\" class=\"acordeon\" align=\"center\" ><tr><td onclick='muestra_oculta(dvConsulta)' >Consulta</td></tr></table><div id='dvConsulta' >\n";

    $obj5 = generarObjHTML("button", "btnConsultar", "", "xajax_consultar(xajax.getFormValues('formQuery'))", "Consultar");

    $formCon = "<form id='formQuery'>"
            . "<table align=\"center\" class=\"campo\" >"
            . "<tr>"
            . "<td>Consultar:</td>"
            . "<td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td>"
            . "<td>$obj5</td>"
            . "</tr>"
            . "</table>"
            . "</form>";
    $tabla.=$divconsulta . " \n $formCon \n<center> \n\t <div id='dvRespuesta'> </div> \n\t <div id='dvPaginacion'></div> \n </center> \n</div> \n ";



    //$tabla.="</table>\n <center> \n\t <div id='dvResultado'> </div> \n\t <div id='dvPaginacion'></div> \n </center> \n </form>";
    $objResponse->assign("dvFormulario", "innerHTML", $tabla);

    $fileForm = fopen("./formularios/$txtNombreArchivo" . "_form.php", "w+");
    if (fwrite($fileForm, $tabla)) {
        $objResponse->alert("formulario creado...");
    }
    fclose($fileForm);
    $_SESSION['form'] = $form;
    $objResponse->script("xajax_generarFunciones()");
    $objResponse->script("xajax_generarPrincipal()");
    return $objResponse;
}

function generarObjHTML($tipo, $nombre, $longitud, $evento, $nmb = '') {
    $obj = "";
    if ($tipo == 'textBox') {
        $obj = "<input type='text' name='$nombre' id='$nombre' value='' onfocus='$evento' size='$longitud'>";
    } elseif ($tipo == 'listBox') {
        $obj = "<select name='$nombre' id='$nombre' onchange='$evento' size='$longitud'>";
        $obj.="<option value=''>Seleccione...</option>";
        $obj.="</select>";
    } elseif ($tipo == 'textarea') {
        $obj = "<textarea name='$nombre' id='$nombre' onchange='$evento' cols='$longitud'></textarea>";
    } elseif ($tipo == 'comboBox') {
        $obj = "<select name='$nombre' id='$nombre' onchange='$evento'>";
        $obj.="<option value=''>Seleccione...</option>";
        $obj.="</select>";
    } elseif ($tipo == 'checkBox') {
        $obj = "<label> <input type='checkbox' id='$nombre' name='$nombre' onchange='$evento' value='ON'>$nmb</label>";
    } elseif ($tipo == 'button') {
        $obj = "<input type='button' name='$nombre' id='$nombre' value='$nmb' onclick=\"$evento\" >";
    } elseif ($tipo == 'password') {
        $obj = "<input type='password' name='$nombre' id='$nombre' value='$nmb' onclick='$evento' >";
    } elseif ($tipo == 'hidden') {
        $obj = "<input type='hidden' name='$nombre' id='$nombre' value='$nmb' >";
    }


    return $obj;
}

function generarFunciones() {
    $form = $_SESSION['form'];
    $objResponse = new xajaxResponse();

    $nroFilas = $form['txtColumnas'];

    $txtNombreTabla = trim($form['txtNombreTabla']);
    $nroColumas = $form['txtNroColumnas'];
    $cmbTipoInterface = $form['cmbTipoInterface'];
    $txtNombreArchivo = trim($form['txtNombreArchivo']);
    $tablaInterna = "";
    $j = 1;


    $campos = "";
    $campoSql = "";
    $campoUpdate = "";
    $campoUpdatewhere = "";
    $campoInsert = "";
    $campoValues = "";

    $campoLimpiar = "";
    $campoSelect="";

    for ($i = 0; $i < $nroFilas; $i++) {
        $nombre = $form['txtCol' . $i];
        $tipoDato = $form['txtTipoDat' . $i];
        $longitud = $form['txtLongitud' . $i];
        $comboSN = $form['cmbSN' . $i];
        $comboHTML = $form['cmbObjHTML' . $i];

        $comboPK = $form['cmbpk' . $i];
        $cmbRequerido = $form['cmbRequerido' . $i];

        $evento = "";

        $campoLimpiar.="\$objResponse->assign(\"$nombre\",\"value\",\"\");\n";
        
        $campoSelect.="\$objResponse->assign(\"$nombre\",\"value\",\"\$nombre\");\n";

        if ($comboSN == 'S') { // si el campo se debe  mostrar en el form
            $nombre = $form['txtCol' . $i];
            $campos.="\$$nombre= strtoupper(trim(\$form['$nombre']));\n
                ";


            if ($comboPK == 'S') { // si es clave primaria, no se  inserta ni actaualiza
                if ($campoInsert == "") {
                    // $campoInsert.="$nombre";
                } else {
                    // $campoInsert.=",$nombre";
                }
            } else {
                if ($campoInsert == "") {
                    $campoInsert.="$nombre";
                } else {
                    $campoInsert.=",$nombre";
                }

                if ($campoValues == "") {
                    $campoValues.="'\$$nombre'";
                } else {
                    $campoValues.=",'\$$nombre'";
                }
            }




            // update
            if ($comboPK == 'S') { // si es clave primaria, no se  inserta ni actaualiza
                // codigo de actualizacion
                if ($campoUpdatewhere == "") {

                    $campoUpdatewhere.=" $nombre= '\$$nombre'\n";
                } else {
                    $campoUpdatewhere.=" and $nombre= '\$$nombre'\n";
                }
            } else {
                if ($campoUpdate == "") {
                    $campoUpdate.=" $nombre= '\$$nombre'\n";
                } else {
                    $campoUpdate.=", $nombre= '\$$nombre'\n";
                }
            }
            // validar los  datos
            if ($cmbRequerido == 'S') {
                if ($comboHTML == 'textBox' or $comboHTML == 'textarea' or $comboHTML == 'hidden' or $comboHTML == 'password') {
                    $nomb = strtoupper($nombre);
                    $nomb = str_replace("_", " ", $nomb);
                    $validar.="
                    if(strcasecmp(\$$nombre,'')==0 or  strcasecmp(\$$nombre,'seleccione')==0){
                    \t \$msg.=\"\\nINGRESE $nomb...\";
                    }
                ";
                } else {
                    $nomb = strtoupper($nombre);
                    $nomb = str_replace("_", " ", $nomb);
                    $validar.="
                  if(strcasecmp(\$$nombre,'')==0 or  strcasecmp(\$$nombre,'seleccione')==0){
                  \t \$msg.=\"\\nSELECCIONE $nomb...\";
                  }
                ";
                }
            }
        }
    }


    $funcionIngreso = "<?php\n

    function validarForm(\$form, \$opcion){
    $campos
    \t global \$enlace, \$objPaginacion, \$objComun;\n
    \t \$objResponse = new xajaxResponse();\n
    \t \$msg=\"\";
    $validar
    \t if(strlen(trim(\$msg))>0){
            \$objResponse->alert(\$msg);
            return \$objResponse;
        }else{
            if(\$opcion==0){ // inserta
                \$objResponse->call(\"xajax_ingresar\",\$form);
            }else{ // actualizar
                \$objResponse->call(\"xajax_actualizar\",\$form);
            }
        }
    \t return \$objResponse;\n
    }

    function ingresar(\$form){\n
    $campos
    \t global  \$objPaginacion, \$objComun;\n
    \$objDB = new Database();
    \$objDB->setParametrosBD(HOST, BASE, USER, PWD);
    \$objDB->getConexion();
    \t \$objResponse = new xajaxResponse();\n
    \t \$sqlInsert = \"insert into $txtNombreTabla ($campoInsert) values\" ;\n
    \t \$sqlInsert .= \"($campoValues);\" ;\n
    \t \$rs=\$objDB->query(\$sqlInsert);\n
    \t \$objResponse->alert(\"Registrado...\");
    \t return \$objResponse;\n
    }\n
    function actualizar(\$form){\n
    $campos
    \t global  \$objPaginacion, \$objComun;\n
    \$objDB = new Database();
    \$objDB->setParametrosBD(HOST, BASE, USER, PWD);
    \$objDB->getConexion();
    \t \$objResponse = new xajaxResponse();\n
    \t \$sqlUpdate = \"update  $txtNombreTabla set $campoUpdate where $campoUpdatewhere\" ;\n
    \t \$rs=\$objDB->query(\$sqlUpdate);\n
    \t \$objResponse->alert(\"Actualizado...\");
    \t return \$objResponse;\n
    }\n
    
function confirmarEliminarForm(\$form){\n
    \t global \$enlace, \$objPaginacion, \$objComun;\n
    \t \$objResponse = new xajaxResponse();\n
    \$objResponse->confirmCommands(1, \"Deseas eliminar el registro?\");
    \$objResponse->call(\"xajax_eliminar\",\$form);
    \t return \$objResponse;\n
    }\n
    
function eliminar(\$form){\n
    $campos
    \t global \$objPaginacion, \$objComun;\n
    \$objResponse = new xajaxResponse();
    \$objDB = new Database();
    \$objDB->setParametrosBD(HOST, BASE, USER, PWD);
    \$objDB->getConexion();
    \t \$objResponse = new xajaxResponse();\n
    \t \$sqlUpdate = \"update  $txtNombreTabla set activo=0 where $campoUpdatewhere\" ;\n
    \t \$rs=\$objDB->query(\$sqlUpdate);\n
    \t \$objResponse->alert(\"Desactivado...\");
    \t return \$objResponse;\n
    }\n

function limpiar(\$form){\n
    \t \$objResponse = new xajaxResponse();\n
$campoLimpiar
    \t return \$objResponse;\n
    }\n

function seleccionar(\$id){\n
    \t \$objResponse = new xajaxResponse();\n
    
    \$objDB = new Database();
    \$objDB->setParametrosBD(HOST, BASE, USER, PWD);
    \$objDB->getConexion();

    \$sql = \" select *    from $txtNombreTabla 
    where  XXXXXXXXXXXX  like '%\$query%' \";

    \$result = \$objDB->query(\$sql);
    \$numCols = \$objDB->getNumCols();

    \$ln=\$objDB->fetch_array(\$result);
    
$campoSelect
    
    \t return \$objResponse;\n
    }\n

function consultar(\$form) {
    \$query = trim(\$form[\"txtConsulta\"]);
    \$objResponse = new xajaxResponse();

    \$objDB = new Database();
    \$objDB->setParametrosBD(HOST, BASE, USER, PWD);
    \$objDB->getConexion();

    \$sql = \" select *    from $txtNombreTabla 
    where  XXXXXXXXXXXX  like '%\$query%' \";

    \$result = \$objDB->query(\$sql);
    \$numCols = \$objDB->getNumCols();

    \$nuevo = \"<img src='\".HOME.\"imagenes/page_white_text.png'/>\";
    \$nuevoLnk = \" style='cursor:pointer' onclick = 'xajax_nuevo()' \";

    \$tabla = \"<table border='0' width='70%'> <tr><td> <table border='0' align ='center' class='tablesorter' cellspacing='1'><thead><tr>\";
    \$arrTi = \$objDB->field_name(\$result);
    
    

    foreach (\$arrTi as \$ln) {
        \$campo = \$ln;
        \$tabla .=\"<th>\$campo</th>\";
    }
    \$tabla.=\" <th colspan='2' \$nuevoLnk >\$nuevo</th> </tr></thead><tbody>\";
    while (\$ln = \$objDB->fetch_array(\$result)) {
        \$id = \$ln[0];
        \$tb=\"<tr>\";
        for(\$i=0;\$i<\$numCols;\$i++){
            \$dato = \$ln[\$i];
            \$tb.=\"<td id = 'dv_\$i'.'_\$id'>\$dato</td>\";
        }
        \$actualizar = \"<img src='\".HOME.\"imagenes/page_white_edit.png'/>\";
        \$actalizarLnk = \" style='cursor:pointer' onclick = 'xajax_seleccionar(\$id)' \";
        \$eliminar = \"<img src='\".HOME.\"imagenes/cross.png'/>\";
        \$eliminarLnk = \" style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm(\$id)' \";
        \$tabla.=\$tb.\" <td \$actalizarLnk >\$actualizar</td><td \$eliminarLnk >\$eliminar</td>   </tr>\";
    }
    \$tabla.=\"</tbody></table> </td></tr></table> \";
    \$objResponse->script('function loadTabla(){\$(\"table\").tablesorter({ widgets: [\'zebra\']});  }  $(function() {\$(\"table\") .tablesorter({ widgets: [\'zebra\']});  });');
    \$objResponse->assign(\"dvRespuesta\", \"innerHTML\", \"\$tabla\");
    return \$objResponse;
}







    \$xajax->register(XAJAX_FUNCTION,\"validarForm\");\n
    \$xajax->register(XAJAX_FUNCTION,\"ingresar\");\n
    \$xajax->register(XAJAX_FUNCTION,\"actualizar\");\n
    \$xajax->register(XAJAX_FUNCTION,\"eliminar\");\n
    \$xajax->register(XAJAX_FUNCTION,\"limpiar\");\n
    \$xajax->register(XAJAX_FUNCTION,\"confirmarEliminarForm\");\n
    \$xajax->register(XAJAX_FUNCTION,\"consultar\");\n
    \$xajax->register(XAJAX_FUNCTION,\"seleccionar\");\n
    ?>";


    $fileForm = fopen("./funciones_xjx/$txtNombreArchivo" . "_xajax.php", "w+");
    if (fwrite($fileForm, $funcionIngreso)) {
        $objResponse->alert("funciones creadas...");
    }
    fclose($fileForm);
    // $objResponse->script("xajax_generarPrincipal()");
    return $objResponse;
}

function generarPrincipal() {
    $form = $_SESSION['form'];
    $objResponse = new xajaxResponse();
    $txtNombreArchivo = trim($form['txtNombreArchivo']);
    $tabla = "<?php\n
        session_start();
        include_once('empleo.config.php');
        include_once (HOME.'include/xajax_conf.php');
        include_once (HOME.'include/db.class.php');
        include_once (HOME.'include/obtenerPermiso.php');
        if(\$_SESSION[\"pm\"]==\"0\" or (\$_SESSION[\"aut_usuario\"]==\"\" or !isset(\$_SESSION[\"aut_usuario\"])) ){
            header(\"Location: login.php\");
            exit;
        }
        include_once(HOME.'funciones_xjx/$txtNombreArchivo"."_xajax.php');
        include_once (HOME.'include/xajax_conf_process.php');
        include_once (HOME.'include/cabecera.php');
        include_once (HOME.'include/menu.php');
        include_once(HOME.'formularios/$txtNombreArchivo"."_form.php');
        include_once(HOME.'include/pie.php');
    ?>";

    $txtNombreArchivo = strtolower($txtNombreArchivo);
    $fileForm = fopen("./$txtNombreArchivo.php", "w+");
    if (fwrite($fileForm, $tabla)) {
        $objResponse->alert("Principal creado...");
    }
    fclose($fileForm);

    return $objResponse;
}

$xajax->register(XAJAX_FUNCTION, "mostrarDatos");
$xajax->register(XAJAX_FUNCTION, "mostrarCampos");

$xajax->register(XAJAX_FUNCTION, "habilitarObjHTML");
$xajax->register(XAJAX_FUNCTION, "generarInterface");
$xajax->register(XAJAX_FUNCTION, "generarFunciones");
$xajax->register(XAJAX_FUNCTION, "generarPrincipal");

$xajax->register(XAJAX_FUNCTION, "habilitarRequerido");
$xajax->register(XAJAX_FUNCTION, "tipoValidacion");

$xajax->register(XAJAX_FUNCTION, "sqlDependiente");



$xajax->processRequest();
//$xajax->printJavascript("./lib/xajax_06");
$xajax->configure('javascript URI', './lib/xajax_05');
$xajax->printJavascript("./lib/xajax_05");
?>



<form action="" name="form" id="form">
    <input type="hidden" name="txtFilas" id="txtFilas" value="" />
    <input type="hidden" name="txtColumnas" id="txtColumnas" value="" />

    <table border="0" align="center">
        <tr>
            <td>Ingrese SQL:</td>
            <td></td>
            <td>
                <textarea name="txtSql" id="txtSql" rows="4" cols="40"></textarea>
            </td>
            <td></td>
        </tr>

        <tr>
            <td colspan="4" align="center">
                <input type="button" id="procesar" name="procesar" value="Procesar" onclick="xajax_mostrarDatos(xajax.getFormValues(form));"/>
            </td>
        </tr>
    </table>
    <br>
    <table border="0" align="center">
        <tr>
            <td>Seleccione Tipo de Interface:</td>
            <td></td>
            <td>
                <select name="cmbTipoInterface" id="cmbTipoInterface">
                    <option value="reporte">Reporte</option>
                    <option value="form">Formulario</option>
                </select>

            </td>
        </tr>
        <tr>
            <td>Nro de Columnas:</td>
            <td></td>
            <td>
                <input type="text" name="txtNroColumnas" id="txtNroColumnas" value="2" size="10" />
            </td>
        </tr>
        <tr>
            <td>Nombre de la tabla:</td>
            <td></td>
            <td>
                <input type="text" name="txtNombreTabla" id="txtNombreTabla" value="" size="20" />
            </td>
        </tr>
        <tr>
            <td>Nombre del archivo a generar:</td>
            <td></td>
            <td>
                <input type="text" name="txtNombreArchivo" id="txtNombreArchivo" value="" size="20" />
            </td>
        </tr>
    </table>

    <center>
        <div id="dvResultado"></div>
        <br>
        <div id="dvButton">
            <input type="button" value="GenerarInterface" name="btnGenerar" id="btnGenerar"  onclick="xajax_generarInterface(xajax.getFormValues('form'))"/>
        </div>
        <div id="dvFormulario"></div>
        <div id="dvFunciones"></div>
        <div id="dvPrincipal"></div>
    </center>
</form>