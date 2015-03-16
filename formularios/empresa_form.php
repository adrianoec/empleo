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
<table width="70%" class="acordeon" align="center" >
    <tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr>
</table>
<div id='dvConsulta' >

    <form id='formQuery'><table align="center" class="campo" ><tr><td>Consultar:</td><td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td><td><input type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick='xajax_consultar(xajax.getFormValues('formQuery'))' ></td></tr></table></form> 
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

                <td> 
                    RAZON SOCIAL 
                </td> 
                <td><div id='dvReqRAZON_SOCIAL'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='razon_social' id='razon_social' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    DIRECCION 
                </td> 
                <td><div id='dvReqCODIGO_DIRECCION'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='codigo_direccion' id='codigo_direccion' value='' onfocus='' size='40'> 
                </td>

                <td> 
                    REPRESENTANTE 
                </td> 
                <td><div id='dvReqREPRESENTANTE'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='representante' id='representante' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    EMAIL 
                </td> 
                <td><div id='dvReqEMAIL'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='email' id='email' value='' onfocus='' size='40'> 
                </td>

                <td> 
                    TELEFONO1 
                </td> 
                <td><div id='dvReqTELEFONO1'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='telefono1' id='telefono1' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 

                <td> 
                    TELEFONO2 
                </td> 
                <td><div id='dvReqTELEFONO2'></div></td> 
                <td> 
                    <input type='text' name='telefono2' id='telefono2' value='' onfocus='' size='40'> 
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