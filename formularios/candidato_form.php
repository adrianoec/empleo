<?php
$pm = "";
$pc = "";
$pg = "";
$pa = "";
$pe = "";
$_SESSION["codigo_candidato"] = "0";
if ($_SESSION["pm"] == "0") {
    $pm = "disabled='true'";
}
if ($_SESSION["pc"] == "0") {
    $pc = "disabled='true'";
}
if ($_SESSION["pg"] == "0") {
    $pg = "disabled='true'";
}
if ($_SESSION["pa"] == "0") {
    $pa = "disabled='true'";
}
if ($_SESSION["pe"] == "0") {
    $pe = "disabled='true'";
}

/* submit form */


if ($_POST["btna"] == "guardar") {
    $archivo = strtoupper($_POST["archivo"]);
    $nombres = strtoupper($_POST["nombres"]);
    $apellidos = strtoupper($_POST["apellidos"]);
    $cedula = strtoupper($_POST["cedula"]);
    $fecha_nacimiento = strtoupper($_POST["fecha_nacimiento"]);
    $genero = strtoupper($_POST["genero"]);
    $telefono = strtoupper($_POST["telefono"]);
    $movil = strtoupper($_POST["movil"]);
    $archivoh = strtoupper($_POST["archivoh"]);
    $hoja = strtoupper($_POST["hoja"]);
    $cmbGrupoEtnicof = strtoupper($_POST["cmbGrupoEtnico"]);
    $cmbDisponibilidadf = strtoupper($_POST["cmbDisponibilidad"]);
    $btna = strtoupper($_POST["btna"]);
    $nombrefoto = "./repositorio/foto-" . $cedula . ".jpg";
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $nombrefoto)) {
        //$nombrefoto = $_SERVER["DOCUMENT_ROOT"]."/repositorio/$nombrefoto";
        $nombrefoto = "./repositorio/foto-" . $cedula . ".jpg";
    } else {
        $nombrefoto = "";
    }
    $nombrehoja = "./repositorio/hoja-" . $cedula . ".doc";
    if (move_uploaded_file($_FILES["archivoh"]["tmp_name"], $nombrehoja)) {
        $nombrehoja = "./repositorio/hoja-" . $cedula . ".doc";
    } else {
        $nombrehoja = "";
    }
    $form = array("archivo" => $archivo,
        "nombres" => $nombres,
        "apellidos" => $apellidos,
        "cedula" => $cedula,
        "fecha_nacimiento" => $fecha_nacimiento,
        "genero" => $genero,
        "telefono" => $telefono,
        "movil" => $movil,
        "archivo" => $nombrehoja,
        "foto" => $nombrefoto,
        "cmbGrupoEtnico" => $cmbGrupoEtnicof,
        "cmbDisponibilidad" => $cmbDisponibilidadf
    );

    echo "<script >  xajax_ingresar('" . json_encode($form) . "')</script>";
}
if ($_POST["btna"] == "actualizar") {
    $codigo = strtoupper($_POST["codigo"]);
    $archivo = strtoupper($_POST["archivo"]);
    $nombres = strtoupper($_POST["nombres"]);
    $apellidos = strtoupper($_POST["apellidos"]);
    $cedula = strtoupper($_POST["cedula"]);
    $fecha_nacimiento = strtoupper($_POST["fecha_nacimiento"]);
    $genero = strtoupper($_POST["genero"]);
    $telefono = strtoupper($_POST["telefono"]);
    $movil = strtoupper($_POST["movil"]);
    $archivoh = strtoupper($_POST["archivoh"]);
    $hoja = strtoupper($_POST["hoja"]);
    $foto = strtoupper($_POST["foto"]);
    $cmbGrupoEtnicof = strtoupper($_POST["cmbGrupoEtnico"]);
    $cmbDisponibilidadf = strtoupper($_POST["cmbDisponibilidad"]);
    $btna = strtoupper($_POST["btna"]);
    $nombrefoto = "./repositorio/foto-" . $cedula . ".jpg";
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $nombrefoto)) {
        //$nombrefoto = $_SERVER["DOCUMENT_ROOT"]."/repositorio/$nombrefoto";
        $nombrefoto = "./repositorio/foto-" . $cedula . ".jpg";
    } else {
        $nombrefoto = "";
    }
    $nombrehoja = "./repositorio/hoja-" . $cedula . ".doc";
    if (move_uploaded_file($_FILES["archivoh"]["tmp_name"], $nombrehoja)) {
        $nombrehoja = "./repositorio/hoja-" . $cedula . ".doc";
    } else {
        $nombrehoja = "";
    }
    $form = array(
        "codigo" => $codigo,
        "archivo" => $archivo,
        "nombres" => $nombres,
        "apellidos" => $apellidos,
        "cedula" => $cedula,
        "fecha_nacimiento" => $fecha_nacimiento,
        "genero" => $genero,
        "telefono" => $telefono,
        "movil" => $movil,
        "archivo" => $nombrehoja,
        "foto" => $nombrefoto,
        "cmbGrupoEtnico" => $cmbGrupoEtnicof,
        "cmbDisponibilidad" => $cmbDisponibilidadf
    );

    echo "<script >  xajax_actualizar('" . json_encode($form) . "')</script>";
}
?>

<div > <center><h3>REgistro Perfil del Aspirante</h3></center></div>

<table width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr></table>

<div id='dvConsulta' >
    <form id='formQuery'><table align="center" class="campo" >
            <tr><td class="td_textox">Consultar:</td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input  class="textbox"  type='text' id='txtConsulta' name='txtConsulta' value='' />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                <td><input class="css_button" type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick="xajax_consultar(xajax.getFormValues('formQuery'))" ></td>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
            </tr>
        </table>
    </form> 
    <center> 
        <div id='dvRespuesta'> </div> 
        <div id='dvPaginacion'></div> 
    </center> 
</div> 

<table  width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvFormulario')">Candidato</td></tr></table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''  enctype="multipart/form-data" method="post" >
        <table border='0' align='center' cellspacing="5px">
            <tr> 
                <td  class="td_textox">Codigo</td> 
                <td><div id='dvReqCODIGO'><font color='red'></font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='codigo' id='codigo' value='' onfocus='' size='40' disabled="true"> 
                </td>
                <td rowspan="9">&nbsp;&nbsp;&nbsp;</td>
                <td rowspan="6">
                    <div class="td_textox">Foto </div> 
                    <div>
                        <img  src="<?php echo $nombrefoto; ?>" id="foto" name="foto" alt="foto" height="100" width="100"/> 
                    </div> 
                    <div>
                        <input name="archivo" id="archivo" type="file" size="35"  />
                    </div> 
                </td> 
            </tr>
            <tr>
                <td class="td_textox">Nombres </td> 
                <td><div id='dvReqNOMBRES'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='nombres' id='nombres' value='<?php echo $nombres; ?>' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox">Apellidos</td> 
                <td><div id='dvReqAPELLIDOS'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='apellidos' id='apellidos' value='<?php echo $apellidos; ?>' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox">Cedula Identidad</td> 
                <td><div id='dvReqCECULA'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='cedula' id='cedula' value='<?php echo $cedula; ?>' onfocus='' size='40'> 
                </td>
            </tr>
            <tr>
                <td  class="td_textox"> Fecha Nacimiento</td> 
                <td><div id='dvReqFECHA_NACIMIENTO'><font color='red'>*</font></div></td> 
                <td> 
                    <input   type='text' class="tcal" name='fecha_nacimiento' id='fecha_nacimiento' value='<?php echo $fecha_nacimiento; ?>' onfocus='' size='20'> 
                </td>
            </tr>
            <tr> 
                <td  class="td_textox">  Genero </td> 
                <td><div id='dvReqGENERO'><font color='red'>*</font></div></td> 
                <td> 
                    <select name='genero' id='genero' onchange=''>
                        <option value=''>Seleccione</option>
                        <option value='F'>Femenino</option>
                        <option value='M'>Masculino</option>
                    </select> 
                </td>
            </tr>
            <tr>
                <td  class="td_textox"> Telefono </td> 
                <td><div id='dvReqTELEFONO'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='telefono' id='telefono' value='<?php echo $telefono; ?>' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td  class="td_textox">  Movil  </td> 
                <td><div id='dvReqMOVIL'></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='movil' id='movil' value='<?php echo $movil; ?>' onfocus='' size='40'> 
                </td>
                <td rowspan="3" >
                    <div  class="td_textox">Hoja de Vida </div> 

                    <div>
                        <input  class="textbox_esp" type="text" name="hoja" id="hoja" value="<?php echo $nombrehoja; ?>" disabled="true" size='40'/>
                    </div> 
                    <div>
                        <input  name="archivoh" id="archivoh" type="file" size="35" placeholder="Seleccione Archivo" />
                    </div> 
                </td> 
            </tr>
            <tr> 
                <td class="td_textox"> Grupo Etnico  </td> 
                <td><div id='dvReqCODIGO_GRUPO_ETNICO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbGrupoEtnico ?> 
                </td>
            </tr>
            <tr>
                <td class="td_textox">Disponibilidad</td> 
                <td><div id='dvReqDISPONIBILIDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDisponibilidad ?>
                </td>
                
            </tr>
            <tr> 
                <td colspan='5' align='center'>
                    <br/>
                    <input type="hidden" name="btna" id="btna" value="" />
                    <table align='center' width="80%"> 
                        <tr>
                            <td> 
                                <input class="css_button" type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)" <?php echo $pg; ?> /> 

                            </td>
                            <td> 
                                <input class="css_button" type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="xajax_validarForm(xajax.getFormValues('form'), 1)" <?php echo $pa; ?> /> 

                            </td>

                            <td> 
                                <input class="css_button" type="button" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="xajax_limpiar(xajax.getFormValues('form'))" /> 
                            </td>
                        </tr>  
                    </table> 
                </td> 
            </tr> 
        </table> 
    </form>  

</div> 

<table width="70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvDireccion')" >Direcciones </td>
        <td align="right">
            <img src="imagenes/add.png" width="16" height="16" alt="add" 
                 onclick="return popitup('./direccion_aux.php', 'estudio', 400, 500);
                 "     
                 /> 
        </td>
    </tr>
</table>
<center> 
    <div id='dvDireccion' ></div>
</center> 

<!-- onclick="displayMessage('./estudio_aux.php', 450, 300);
    return false" -->
<table width="70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvEstudios')" >Estudios Realizados</td>
        <td align="right">
            <img src="imagenes/add.png" width="16" height="16" alt="add" 
                 onclick="return popitup('./estudio_aux.php', 'estudio', 400, 500);
                 "     
                 /> 
        </td>
    </tr>
</table>
<center> 
    <div id='dvEstudios' ></div>
</center> 

<table width="70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvExperiencia')" >Experiencia Laboral</td> 
        <td align="right">
            <img src="imagenes/add.png" width="16" height="16" alt="add" 
                 onclick="return popitup('./experiencia_aux.php', 'estudio', 500, 500);
                 "     
                 /> 
        </td>
    </tr>
</table>
<center> 
    <div id='dvExperiencia' > </div>
</center>
