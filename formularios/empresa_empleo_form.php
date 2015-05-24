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

if ($_REQUEST["btnConsultar"] == "Consultar") {
    $fchdesde = $_REQUEST["desde"];
    $fchhasta = $_REQUEST["hasta"];

    echo "<script> xajax_validarForm('$fchdesde','$fchhasta') </script>";
}

/* * ************************************************* */
?>
<div > <center><h3>Reporte Aspirantes a Empleo</h3></center></div>
<table width = "70%" class="acordeon" align="center" >
    <tr>
        <td onclick="muestra_oculta('dvFormulario')">Consulta</td>

    <center><img src="grafica.php?desde=<?php echo $fchdesde; ?>&hasta=<?php echo $fchhasta; ?>" id="pie" /></center>
</tr>
</table>
<div id='dvFormulario' >
    <form name='form' id='form' action=''>
        <table border='0' align='center' cellspacing="8px">
            <tr> 
                <td class="td_textox"> Fecha Desde </td> 
                <td><div id=''></div></td> 
                <td> 
                    <input class="tcal" type='text' name='desde' id='desde' value='<?php echo (strlen(trim($fchdesde)) > 0) ? $fchdesde : date("Y-m-d") ?>' onfocus='' size='20'> 
                </td>


                <td class="td_textox"> Fecha Hasta </td> 
                <td><div id=''></div></td> 
                <td> 
                    <input class="tcal" type='text' name='hasta' id='hasta' value='<?php echo (strlen(trim($fchhasta)) > 0) ? $fchhasta : date("Y-m-d") ?>' onfocus='' size='20'> 
                </td>
            </tr>

            <tr> 
                <td colspan='6' align='center'> 
                    <input class="css_button" type="submit" name="btnConsultar" id="btnConsultar" value="Consultar" onclick="" <?php echo $pc; ?> > 
                </td> 
            </tr> 
        </table> 
    </form>  
</div> 
<center>
    <div id="dvRespuesta"></div>
</center>