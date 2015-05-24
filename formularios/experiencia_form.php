<?php
if ($_SESSION["codigo_candidato"] == 0) {
    echo "<script>self.close();</script>";
}
if ($_GET["codigo"] > 0) {
    /* actualizacion */
    $codigo = $_GET["codigo"] ; 
    echo "<script>xajax_seleccionar($codigo);</script>";
}

?>
<table  width="70%" class="acordeon" align="center" >
    <tr><td onclick="muestra_oculta('dvFormulario')">Formulario</td></tr>
</table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''>
        <table border='0' align='center'>
            <tr> 
                <td> 

                </td> 
                <td><div id='dvReqCODIGO'></div></td> 
                <td> 
                    <input type='hidden' name='codigo' id='codigo' value='' onfocus='' size='11'> 
                </td>

                <td> 

                </td> 
                <td><div id='dvReqCODIGO_CANDIDATO'></div></td> 
                <td> 
                    <input type='hidden' name='candidato' id='candidato' value='' onfocus='' size='11'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    FECHA INICIO 
                </td> 
                <td><div id='dvReqFECHA_INICIO'></div></td> 
                <td> 
                    <input type='text'  class="tcal" name='fecha_inicio' id='fecha_inicio' value='' onfocus='' size='19'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    FECHA FIN 
                </td> 
                <td><div id='dvReqFECHA_FIN'></div></td> 
                <td> 
                    <input type='text'  class="tcal"  name='fecha_fin' id='fecha_fin' value='' onfocus='' size='19'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    EMPRESA 
                </td> 
                <td><div id='dvReqEMPRESA'></div></td> 
                <td> 
                     <input type='text'   name='empresa' id='empresa' value='' onfocus='' size='40' > 
                </td>
            </tr>
            <tr> 
                <td> 
                    CARGO 
                </td> 
                <td><div id='dvReqCARGO'></div></td> 
                <td> 
                    <input type='text' name='cargo' id='cargo' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    TAREAS 
                </td> 
                <td><div id='dvReqTAREAS'></div></td> 
                <td> 
                    <textarea name='tareas' id='tareas' onchange='' cols='30' rows="5"></textarea> 
                </td>
            </tr>
            <tr> 
                <td> 
                    NRO EMPLEADOS 
                </td> 
                <td><div id='dvReqNRO_EMPLEADOS'></div></td> 
                <td> 
                    <input type='text' name='nro_empleados' id='nro_empleados' value='' onfocus='' size='11'> 
                </td>
            </tr>
            <tr> 
            </tr>
            <tr> 
                <td colspan='5' align='center'>

                    <table align='center'> 
                        <tr>

                            <td> 
                                <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)" /> 
                            </td>

                            <td> 
                                <input type="button" name="btnCerrar" id="btnCerrar" value="Cerrar" onclick="javascript:self.close();" /> 
                            </td>

                        </tr>  
                    </table> 
                </td> 

            </tr> 
        </table> 
    </form>  
</div> 