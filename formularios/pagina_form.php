<?php
if($_SESSION["pm"]=="0"){
    $pm ="disabled=\"true\"";
}
if($_SESSION["pc"]=="0"){
    $pc ="disabled=\"true\"";
}
if($_SESSION["pg"]=="0"){
    $pg ="disabled=\"true\"";
}
if($_SESSION["pa"]=="0"){
    $pa ="disabled=\"true\"";
}
if($_SESSION["pe"]=="0"){
    $pe ="disabled=\"true\"";
}
?>
<table class ='acordeon' width="100%">
    <tr>
        <td onclick="muestra_oculta('dvFormulario')" style="cursor: pointer">Formulario</td>
    </tr>
</table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''>
        <table border='' align='center' class="campo" >
            <tr>
                <td class="campo"> DESCRIPCION </td>
                <td class="dato"><div id='dvReqDESCRIPCION'></div></td>
                <td class="dato" >				<textarea name='descripcion' id='descripcion' onchange='' cols='30'></textarea></td>
            </tr>
            <tr>
                <td class="campo">  PAGINA PHP </td>
                <td  class="dato">
                    <div id='dvReqPAGINA'>
                        <font color='red'>*</font>
                    </div></td>
                <td  class="dato">
                    <input type='text' name='pagina' id='pagina' value='' onfocus='' size='40'>
                </td>
            </tr>

            <tr>
                <td class="campo"> NOMBRE EN MENU </td>
                <td  class="dato">
                    <div id='dvReqMENU'>
                        <font color='red'>*</font>
                    </div></td>
                <td  class="dato"><input type='text' name='menu' id='menu' value='' onfocus='' size='40'></td>
            </tr>

            <tr>
                <td class="campo"> ARBOL </td>
                <td  class="dato">
                    <div id='dvReqPADRE'>
                        <font color='red'>*</font>
                    </div></td>
                <td  class="dato">
                    <select name='padre' id='padre' onchange=''>
                        <option value=''>Seleccione...</option>
                        <option value='0'>Nuevo Arbol</option>
                        <?php
                        echo mostrarPadres();
                        ?>

                    </select></td>
            </tr>
            <tr>

                <td class="campo"> ES PADRE </td>
                <td  class="dato">
                    <div id='dvReqACTIVO'>
                        <font color='red'>*</font>
                    </div></td>
                <td  class="dato">
                    <select name='es_padre' id='es_padre' onchange=''>
                        <option value=''>Seleccione...</option>
                        <option value='1'>Si</option>
                        <option value='0'>No</option>
                    </select></td>
            </tr>
            <tr>
                <td class="campo">  ORDEN </td>
                <td  class="dato">
                    <div id='dvReqORDEN'>
                        <font color='red'>*</font>
                    </div></td>
                <td  class="dato">
                    <input type='text' name='orden' id='orden' value='' onfocus='' size='20'>
                    <input type='hidden' name='codigo' id='codigo' value=''>
                </td>
            </tr>
            <tr>
                <td colspan='5' align='center'  class="dato">
                    <table align='center'>
                        <tr>

                            <td>
                                <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'), 0)" <?php echo $pg ?> >
                            </td>

                            <td>
                                <input type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="xajax_validarForm(xajax.getFormValues('form'), 1)" <?php echo $pa ?> >
                            </td>

                            <td>
                                <input type="button" name="btnEliminar" id="btnEliminar" value="Eliminar" onclick="xajax_confirmarEliminarForm(xajax.getFormValues('form'))" <?php echo $pe ?> >
                            </td>

                            <td>
                                <input type="button" name="btnCancelar" id="btnCancelar" value="Cancelar" onclick="xajax_limpiar(xajax.getFormValues('form'))" >
                            </td>

                        </tr>
                    </table></td>

            </tr>
        </table>
    </form>
</div>
<table width="100%" style="cursor: pointer" class="acordeon">
    <tr>
        <td onclick="muestra_oculta('dvConsulta')"  >Consulta</td>
    </tr>
</table>
<div id='dvConsulta' >

    <form id='formQuery'>
        <table align="center" class="campo">
            <tr>
                <td class="campo">Consultar:</td><td>
                    <input type='text' id='txtConsulta' name='txtConsulta' value='' />
                </td>
                <td class="dato">
                    <input type="button" name="btnConsultar" id="btnConsultar" value="Consultar" onclick="xajax_consultar(xajax.getFormValues('formQuery'))"  <?php echo $pc ?>  >
                </td>
            </tr>
        </table>
    </form>
    <center>
        <div id='dvRespuesta'></div>
        <div id='dvPaginacion'></div>
    </center>
</div>
