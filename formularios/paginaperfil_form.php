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
<div id='dvFormulario' ><br/><br/>
    <form name='form' id='form' action=''>
        <center>
            <label> PERFIL 
                <select name='perfil' id='perfil' onchange='xajax_mostrar(this.value)' >
                    <option value=''>Seleccione...</option>
                    <?php
                    echo mostrarPerfiles();
                    ?>
                </select></label>
        </center>
<br/><br/>
        <table border='0' align='center'>


            <tr>
                <td colspan="3">

                    <table>


                        <tr>
                            <td>SIN ASIGNAR</td>
                            <td></td>
                            <td>ASIGNADOS</td>
                        </tr>
                        <tr>
                            <td><div id="dvNoAsignados">
                                
                                    <select name='cmbNoAsignado' id='cmbNoAsignado' multiple ='multiple' size='15'  width='200' style='width: 200px' >
                                <option value='' >No Existen Paginas</option>
                                </select>
                                </div></td>

                            <td rowspan="2"> <div id="dvAcciones">
                                
                                </div> </td>
                            <td> <div id="dvAsignados">
                                    <select name='cmbAsignado' id='cmbAsignado' multiple ='multiple' size='15'  width='200' style='width: 200px' >
                                <option value='' >No Existen Paginas</option>
                                </select>
                                </div> </td>
                        </tr>
                    </table>

                </td>
            </tr>
            <tr>
                <td colspan='5' align='center'></td>

            </tr>
        </table>
    </form>
</div>


