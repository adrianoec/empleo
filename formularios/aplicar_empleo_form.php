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

   <table width = "70%" class="acordeon" align="center" >
       <tr>
           <td onclick="muestra_oculta('dvFormulario')">Consulta</td>
       </tr>
   </table>
    <div id='dvFormulario' >
        <form name='form' id='form' action=''>
            <table border='0' align='center'>
                <tr> 
                    <td> TITULO </td> 
                    <td><div id='dvReqTITULO'></div></td> 
                    <td> 
                        <input type='text' name='titulo' id='titulo' value='' onfocus='' size='40'> 
                    </td>
                </tr>
                <tr> 
                    <td> DESCRIPCION </td> 
                    <td><div id='dvReqDESCRIPCION'></div></td> 
                    <td> 
                        <input type='text' name='descripcion' id='descripcion' value='' onfocus='' size='40'> 
                    </td>
                </tr>
                <tr> 
                    <td> SUELDO </td> 
                    <td><div id='dvReqSUELDO'></div></td> 
                    <td> 
                        <input type='text' name='sueldo' id='sueldo' value='' onfocus='' size='20'> 
                    </td>
                </tr>
                <tr> 
                    <td> LOCALIZACION </td> 
                    <td><div id='dvReqLOCALIZACION'></div></td> 
                    <td> 
                        <input type='text' name='localizacion' id='localizacion' value='' onfocus='' size='20'> 
                    </td>
                </tr>
                <tr> 
                </tr>
                <tr> 
                    <td colspan='2' align='center'> 
                        <input type="button" name="btnConsultar" id="btnConsultar" value="Consultar" onclick="xajax_validarForm(xajax.getFormValues('form'))" <?php echo $pc; ?> > 
                    </td> 
                </tr> 
            </table> 
        </form>  
    </div> 
   <center>
       <div id="dvRespuesta"></div>
   </center>