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
                <td><div id='dvReqCODIGO'><font color='red'></font></div></td> 
                <td> 
                    <input type='hidden' name='codigo' id='codigo' value='' onfocus='' size='11'> 
                </td>

                <td> 
                </td> 
                <td><div id='dvReqCODIGO_CANDIDATO'><font color='red'></font></div></td> 
                <td> 
                    <input type='hidden' name='codigo_candidato' id='codigo_candidato' value='' onfocus='' size='11'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    CALLE PRINCIPAL 
                </td> 
                <td><div id='dvReqCALLE_PRINCIPAL'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='calle_principal' id='calle_principal' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    CALLE SECUNDARIA 
                </td> 
                <td><div id='dvReqCALLE_SECUNDARIA'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='calle_secundaria' id='calle_secundaria' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    NRO 
                </td> 
                <td><div id='dvReqNRO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='nro' id='nro' value='' onfocus='' size='20'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    REFERENCIA 
                </td> 
                <td><div id='dvReqREFERENCIA'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='referencia' id='referencia' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    PAIS 
                </td> 
                <td><div id='dvReqCODIGO_PAIS'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbPais; ?>
                </td>
            </tr>
            <tr> 
                <td> 
                    PROVINCIA 
                </td> 
                <td><div id='dvReqCODIGO_PROVINCIA'><font color='red'>*</font></div></td> 
                <td> 
                    <div id="dvProvincia">
                        <select name='codigo_provincia' id='codigo_provincia' onchange=''><option value=''>Seleccione el Pais</option></select> 
                    </div>
                </td>
            </tr>
            <tr> 
                <td> 
                    CIUDAD 
                </td> 
                <td><div id='dvReqCODIGO_CIUDAD'><font color='red'>*</font></div></td> 
                <td> 
                    <div id="dvCiudad">
                        <select name='codigo_ciudad' id='codigo_ciudad' onchange=''><option value=''>Seleccione la Provincia</option></select> 
                    </div>
                </td>
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