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
            </tr>
            <tr> 
                <td> 
                </td> 
                <td><div id='dvReqCODIGO_CANDIDATO'><font color='red'></font></div></td> 
                <td> 
                    <input type='hidden' name='codigo_candidato' id='codigo_candidato' value='' onfocus='' size='11'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    TITULO 
                </td> 
                <td><div id='dvReqTITULO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='titulo' id='titulo' value='' onfocus='' size='40'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    HORAS 
                </td> 
                <td><div id='dvReqHORAS'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' name='horas' id='horas' value='' onfocus='' size='20'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    FECHA INICIO 
                </td> 
                <td><div id='dvReqFECHA_INICIO'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' class="tcal" name='fecha_inicio' id='fecha_inicio' value=''  size='20' > 
                </td>
            </tr>
            <tr> 
                <td> 
                    FECHA FIN 
                </td> 
                <td><div id='dvReqFECHA_FIN'><font color='red'>*</font></div></td> 
                <td> 
                    <input type='text' class="tcal" name='fecha_fin' id='fecha_fin' value='' onfocus='' size='20'> 
                </td>
            </tr>
            <tr> 
                <td> 
                    TIPO NIVEL ACADEMICO 
                </td> 
                <td><div id='dvReqCODIGO_TIPO_NIVEL_ACADEMICO'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbNivel ?>
                </td>
            </tr>
            <tr> 
                <td> 
                    INSTITUCION 
                </td> 
                <td><div id='dvReqCODIGO_INSTITUCION'><font color='red'>*</font></div></td> 
                <td> 
                    <?php echo $cmbInstitucion ?>
                </td>
            </tr>
            <tr> 
            </tr>
            <tr> 
                <td colspan='5' align='center'>

                    <table align='center'> 
                        <tr>

                            <td> 
                                <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)"  /> 
                            </td>

                            <td> 
                                <input type="button" name="btnCerrar" id="btnCerrar" value="Cerrar" onclick="javascript:self.close();"  /> 
                            </td>

                        </tr>  
                    </table> 
                </td> 

            </tr> 
        </table> 
    </form>  
</div> 
<script type="text/javascript">
    document.form.firstname.focus();
</script>
