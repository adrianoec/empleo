<?php
$pm = "";
$pc = "";
$pg = "";
$pa = "";
$pe = "";
$_SESSION["codigo_candidato"]="0";
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
?>
<table width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr></table>

<div id='dvConsulta' >
    <form id='formQuery'><table align="center" class="campo" >
            <tr><td>Consultar:</td>
                <td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td>
                <td><input type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick="xajax_consultar(xajax.getFormValues('formQuery'))" ></td></tr></table></form> 
    <center> 
        <div id='dvRespuesta'> </div> 
        <div id='dvPaginacion'></div> 
    </center> 
</div> 

<table  width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvFormulario')">Candidato</td></tr></table>
<div id='dvFormulario' >
    <form name='form' id='form' action='' enctype="multipart/form-data">
        <table border='0' align='center'>
            <tr> 
                <td> 
                    CODIGO 
                </td> 
                <td><div id='dvReqCODIGO'><font color='red'></font></div></td> 
                <td> 
                    <input type='text' name='codigo' id='codigo' value='' onfocus='' size='40' disabled="true"> 
                </td>
            </tr>
            <tr>
                <td> 
                    NOMBRES 
                </td> 
                <td><div id='dvReqNOMBRES'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='nombres' id='nombres' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    APELLIDOS 
                </td> 
                <td><div id='dvReqAPELLIDOS'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='apellidos' id='apellidos' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr>
                <td> 
                    FECHA NACIMIENTO 
                </td> 
                <td><div id='dvReqFECHA_NACIMIENTO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' class="tcal" name='fecha_nacimiento' id='fecha_nacimiento' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    GENERO 
                </td> 
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
                <td> 
                    TELEFONO 
                </td> 
                <td><div id='dvReqTELEFONO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='telefono' id='telefono' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    MOVIL 
                </td> 
                <td><div id='dvReqMOVIL'></div></td> 
                <td> 
                    <input type='text' name='movil' id='movil' value='' onfocus='' size='40'> 
                </td>

            </tr>
            <tr>

                <td> 
                    ARCHIVO 
                </td> 
                <td><div id='dvReqARCHIVO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type="file" name="txtFile" id="txtFile" value="" />
                </td>

            </tr>
            <tr> 


                <td> 
                    GRUPO ETNICO 
                </td> 
                <td><div id='dvReqCODIGO_GRUPO_ETNICO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbGrupoEtnico ?> 
                </td>

            </tr>
            <tr>
                <td> 
                    DISPONIBILIDAD 
                </td> 
                <td><div id='dvReqDISPONIBILIDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDisponibilidad ?>
                </td>
            </tr>




            <tr> 
                <td colspan='5' align='center'>

                    <table align='center'> 
                        <tr>

                            <td> 
                                <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)" <?php echo $pg; ?> /> 
                            </td>

                            <td> 
                                <input type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="xajax_validarForm(xajax.getFormValues('form'), 1)" <?php echo $pa; ?> /> 
                            </td>

                            <td> 
                                <input type="button" name="btnEliminar" id="btnEliminar" value="Eliminar" onclick="xajax_confirmarEliminarForm(xajax.getFormValues('form'))"  <?php echo $pe; ?> /> 

                            </td>

                            <td> 
                                <input type="button" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="xajax_limpiar(xajax.getFormValues('form'))" /> 
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
                 onclick="return popitup('./direccion_aux.php', 'estudio', 300, 400);"     
                 /> 
        </td>
    </tr>
</table>
<center> 
    <div id='dvDireccion' >

    </div>
</center> 

<!-- onclick="displayMessage('./estudio_aux.php', 450,300); return false" -->
<table width="70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvEstudios')" >Estudios Realizados</td>
        <td align="right">
            <img src="imagenes/add.png" width="16" height="16" alt="add" 
                 onclick="return popitup('./estudio_aux.php', 'estudio', 300, 400);"     
                 /> 
        </td>

    </tr>
</table>
<center> 
    <div id='dvEstudios' >

    </div>
</center> 

<table width="70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvExperiencia')" >Experiencia Laboral</td> 
        <td align="right">
            <img src="imagenes/add.png" width="16" height="16" alt="add" 
                 onclick="return popitup('./experiencia_aux.php', 'estudio', 400, 400);"     
                 /> 
        </td>
    </tr>
</table>
<center> 
    <div id='dvExperiencia' >

    </div>
</center> 