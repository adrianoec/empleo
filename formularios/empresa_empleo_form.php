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
<div > <center><h3>Reporte Aspirantes a Empleo</h3></center></div>
   <table width = "70%" class="acordeon" align="center" >
       <tr>
           <td onclick="muestra_oculta('dvFormulario')">Consulta</td>
       </tr>
   </table>
    <div id='dvFormulario' >
        <form name='form' id='form' action=''>
            <table border='0' align='center' cellspacing="8px">
                <tr> 
                    <td class="td_textox"> Fecha Desde </td> 
                    <td><div id='dvReqTITULO'></div></td> 
                    <td> 
                        <input class="tcal" type='text' name='desde' id='desde' value='<?php echo date("Y-m-d")?>' onfocus='' size='40'> 
                    </td>
                
                 
                    <td class="td_textox"> Fecha Hasta </td> 
                    <td><div id='dvReqSUELDO'></div></td> 
                    <td> 
                        <input class="tcal" type='text' name='hasta' id='hasta' value='<?php echo date("Y-m-d")?>' onfocus='' size='20'> 
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