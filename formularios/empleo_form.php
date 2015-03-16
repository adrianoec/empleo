<?php
$pm = "";
$pc = "";
$pg = "";
$pa = "";
$pe = "";
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
<table width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr></table><div id='dvConsulta' >

    <form id='formQuery'><table align="center" class="campo" ><tr><td>Consultar:</td><td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td><td><input type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick="xajax_consultar(xajax.getFormValues('formQuery'))" ></td></tr></table></form> 
    <center> 
        <div id='dvRespuesta'> </div> 
        <div id='dvPaginacion'></div> 
    </center> 
</div> 
<table  width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvFormulario')">Formulario</td></tr></table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''>
        <table border='0' align='center'>
            <tr> 
                <td> 
                    CODIGO 
                </td> 
                <td><div id='dvReqCODIGO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='codigo' id='codigo' value='' onfocus='' size='40'> 
                </td>
</tr>
            <tr> 
                <td> 
                    NOMBRE 
                </td> 
                <td><div id='dvReqNOMBRE'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='nombre' id='nombre' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    DESCRIPCION 
                </td> 
                <td><div id='dvReqDESCRIPCION'><font color='red'>*</font></div></td> 
                <td> 
                    <textarea name='descripcion' id='descripcion' onchange='' cols='30' rows="4"></textarea> 
                </td>
</tr>
            <tr> 
                <td> 
                    SUELDO 
                </td> 
                <td><div id='dvReqSUELDO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='sueldo' id='sueldo' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    EMPRESA 
                </td> 
                <td><div id='dvReqCODIGO_EMPRESA'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbEmpresa ?> 
                </td>
</tr>
            <tr> 
                <td> 
                    ESTADO 
                </td> 
                <td><div id='dvReqESTADO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbEstado; ?> 
                </td>
            </tr>
            <tr> 
                <td> 
                    FECHA VIGENCIA 
                </td> 
                <td><div id='dvReqFECHA_VIGENCIA'><font color='red'>*</font></div></td> 
                <td> 
                    <div> <input class="tcal"  type='text' name='fecha_vigencia' id='fecha_vigencia' value='' onfocus='' size='40'> </div>
                </td>
</tr>
            <tr> 
                <td> 
                    DURACION CONTRATO 
                </td> 
                <td><div id='dvReqDURACION_CONTRATO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDuracion; ?> 
                </td>
            </tr>
            <tr> 
                <td> 
                    LOCALIZACION 
                </td> 
                <td><div id='dvReqLOCALIZACION'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='localizacion' id='localizacion' value='' onfocus='' size='40'> 
                </td>
</tr>
            <tr> 
                <td> 
                    DISPONIBILIDAD 
                </td> 
                <td><div id='dvReqDISPONIBILIDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDisponibilidad; ?> 
                </td>
            </tr>
            <tr> 

                <td> 
                    FECHA PUBLICACION 
                </td> 
                <td><div id='dvReqFECHA_PUBLICACION'><font color='red'>*</font></div></td> 
                <td> 
                    <div><input class="tcal" type='text' name='fecha_publicacion' id='fecha_publicacion' value='' onfocus='' size='40'> </div>
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
                                <input type="button" name="btnEliminar" id="btnEliminar" value="Eliminar" onclick="xajax_confirmarEliminarForm(xajax.getFormValues('form'))" <?php echo $pe; ?> /> 
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
