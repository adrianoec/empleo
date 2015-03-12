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
<table width="70%" class="acordeon" align="center" ><tr><td onclick='muestra_oculta(dvConsulta)' >Consulta</td></tr></table>

<div id='dvConsulta' >
    <form id='formQuery'><table align="center" class="campo" ><tr><td>Consultar:</td><td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td><td><input type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick='xajax_consultar(xajax.getFormValues('formQuery'))' ></td></tr></table></form> 
    <center> 
        <div id='dvRespuesta'> </div> 
        <div id='dvPaginacion'></div> 
    </center> 
</div> 

<table  width="70%" class="acordeon" align="center" ><tr><td onclick='muestra_oculta(dvFormulario)'>Formulario</td></tr></table>
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

                <td> 
                    FECHA NACIMIENTO 
                </td> 
                <td><div id='dvReqFECHA_NACIMIENTO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='fecha_nacimiento' id='fecha_nacimiento' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    GENERO 
                </td> 
                <td><div id='dvReqGENERO'><font color='red'>*</font></div></td> 
                <td> 
                    <select name='genero' id='genero' onchange=''><option value=''>Seleccione...</option></select> 
                </td>

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

                <td> 
                    CODIGO DIRECCION 
                </td> 
                <td><div id='dvReqCODIGO_DIRECCION'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='codigo_direccion' id='codigo_direccion' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    ARCHIVO 
                </td> 
                <td><div id='dvReqARCHIVO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='archivo' id='archivo' value='' onfocus='' size='40'> 
                </td>

                <td> 
                    CODIGO GRUPO ETNICO 
                </td> 
                <td><div id='dvReqCODIGO_GRUPO_ETNICO'><font color='red'>*</font></div></td> 
                <td> 
                    <select name='codigo_grupo_etnico' id='codigo_grupo_etnico' onchange=''><option value=''>Seleccione...</option></select> 
                </td>
            </tr>
            <tr> 

                <td> 
                    DISPONIBILIDAD 
                </td> 
                <td><div id='dvReqDISPONIBILIDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='disponibilidad' id='disponibilidad' value='' onfocus='' size='40'> 
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



<table width="70%" class="acordeon" align="center" ><tr><td onclick='muestra_oculta(dvEstudios)' >Estudios Realizados</td></tr></table>
<div id='dvEstudios' >
    <form id="formestudio" name="" >
        <table border="0" align="center" >
            <tr>
                <td>
                    Titulo Obtenido
                </td>
                <td>
                    Nro horas
                </td>
                <td>
                    Fecha Inicio
                </td>
                <td>
                    Fecha Fin
                </td>
            </tr>
            <tr>

                <td>
                    <input type="text" name="txtTitulo" id="txtTitulo" value="" size="60"/>
                </td>
                <td>
                    <input type="text" name="txtHoras" id="txtHoras" value="" size="20"/>
                </td>
                <td>
                    <input type="text" name="txtFechaInicio" id="txtFechaInicio" value="" size="30"/>
                </td>
                <td>
                    <input type="text" name="txtFechaFin" id="txtFechaFin" value="" size="30"/>
                </td>
            </tr>
        </table>
    </form>
</div>
<table width="70%" class="acordeon" align="center" ><tr><td onclick='muestra_oculta(dvExperiencia)' >Experiencia Laboral</td></tr></table>
<div id='dvExperiencia' >

</div>