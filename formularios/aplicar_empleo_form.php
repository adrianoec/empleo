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
<div > <center><h3>Reporte Empleos Disponibles</h3></center></div>
   <table width = "70%" class="acordeon" align="center" >
       <tr>
           <td onclick="muestra_oculta('dvFormulario')">Consulta</td>
       </tr>
   </table>
    <div id='dvFormulario' >
        <form name='form' id='form' action=''>
            <table border='0' align='center' cellspacing="8px">
                <tr> 
                    <td class="td_textox"> Titulo / Descripci&oacute;n </td> 
                    <td><div id='dvReqTITULO'></div></td> 
                    <td> 
                        <input class="textbox_esp" type='text' name='titulo' id='titulo' value='' onfocus='' size='40'> 
                    </td>
                
                 
                    <td class="td_textox"> Sueldo / Localizaci&oacute;n </td> 
                    <td><div id='dvReqSUELDO'></div></td> 
                    <td> 
                        <input class="textbox_esp" type='text' name='sueldo' id='sueldo' value='' onfocus='' size='20'> 
                    </td>
                </tr>

                <tr> 
                    <td colspan='6' align='center'> 
                        <input class="css_button" type="button" name="btnConsultar" id="btnConsultar" value="Consultar" onclick="xajax_validarForm(xajax.getFormValues('form'))" <?php echo $pc; ?> > 
                    </td> 
                </tr> 
            </table> 
        </form>  
    </div> 
   <center>
       <div id="dvRespuesta"></div>
   </center>