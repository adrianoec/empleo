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
<div > <center><h3>Registro de Empleos</h3></center></div>
<table width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvConsulta')" >Consulta</td></tr></table><div id='dvConsulta' >

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
                <td class="td_textox"> C&oacute;digo </td> 
                <td><div id='dvReqCODIGO'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='codigo' id='codigo' value='' onfocus='' size='40' readonly="true"> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Nombre </td> 
                <td><div id='dvReqNOMBRE'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='nombre' id='nombre' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox">  Descripci&oacute;n </td> 
                <td><div id='dvReqDESCRIPCION'><font color='red'>*</font></div></td> 
                <td> 
                    <textarea  class="textareax" name='descripcion' id='descripcion' onchange='' cols='30' rows="4"></textarea> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Sueldo  </td> 
                <td><div id='dvReqSUELDO'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='sueldo' id='sueldo' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Empresa  </td> 
                <td><div id='dvReqCODIGO_EMPRESA'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbEmpresa ?> 
                </td>
            </tr>

            <tr> 
                <td class="td_textox"> Fecha Expiraci&oacute;n  </td> 
                <td><div id='dvReqFECHA_VIGENCIA'><font color='red'>*</font></div></td> 
                <td> 
                    <div> <input class="tcal"  type='text' name='fecha_vigencia' id='fecha_vigencia' value='' onfocus='' size='20'> </div>
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Duraci&oacute;n Contrato </td> 
                <td><div id='dvReqDURACION_CONTRATO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDuracion; ?> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Localizaci&oacute;n  </td> 
                <td><div id='dvReqLOCALIZACION'><font color='red'>*</font></div></td> 
                <td> 
                    <input  class="textbox" type='text' name='localizacion' id='localizacion' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Disponibilidad </td> 
                <td><div id='dvReqDISPONIBILIDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbDisponibilidad; ?> 
                </td>
            </tr>
            <tr> 
                <td class="td_textox"> Fecha Publicaci&oacute;n  </td> 
                <td><div id='dvReqFECHA_PUBLICACION'><font color='red'>*</font></div></td> 
                <td> 
                    <div><input class="tcal" type='text' name='fecha_publicacion' id='fecha_publicacion' value='<?php echo date("Y-m-d") ?>' onfocus='' size='20' readonly="true"> </div>
                </td>
            </tr>
            <tr> 
                <td colspan='5' align='center'><br/>
                    <table align='center' width="80%"> 
                        <tr>
                            <td> 
                                <input  class="css_button" type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)" <?php echo $pg; ?> /> 
                            </td>
                            <td> 
                                <input  class="css_button" type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="xajax_validarForm(xajax.getFormValues('form'), 1)" <?php echo $pa; ?> /> 
                            </td>
                            <td> 
                                <input  class="css_button" type="button" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="xajax_limpiar(xajax.getFormValues('form'))" <?php echo $pe; ?> /> 
                            </td>
                        </tr>  
                    </table> 
                </td> 
            </tr> 
        </table> 
    </form>  
</div> 
