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

<div > <center><h3>Registro de Empleador</h3></center></div>

<table width="70%" class="acordeon" align="center" >
    <tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr>
</table>
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

<table  width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvFormulario')">Formulario</td></tr></table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''>
        <table border='0' align='center' cellspacing="5px">
            <tr> 
                <td class="td_textox"> 
                    C&oacute;digo 
                </td> 
                <td><div id='dvReqCODIGO'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='codigo' id='codigo' value='' onfocus='' size='40' readonly="true"> 
                </td>
            </tr>
            <tr>
                <td class="td_textox"> 
                    Raz&oacute; Social
                </td> 
                <td><div id='dvReqRAZON_SOCIAL'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='razon_social' id='razon_social' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> 
                    Direcci&oacute; 
                </td> 
                <td><div id='dvReqCODIGO_DIRECCION'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='direccion' id='direccion' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr>
                <td class="td_textox"> 
                    Representante 
                </td> 
                <td><div id='dvReqREPRESENTANTE'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='representante' id='representante' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> 
                    Email 
                </td> 
                <td><div id='dvReqEMAIL'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='email' id='email' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr>
                <td class="td_textox"> 
                    Telefono Principal 
                </td> 
                <td><div id='dvReqTELEFONO1'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='telefono1' id='telefono1' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 

                <td class="td_textox"> 
                    Telefono Secundario 
                </td> 
                <td><div id='dvReqTELEFONO2'></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='telefono2' id='telefono2' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td colspan='5' align='center'>

                    <table align='center'> 
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