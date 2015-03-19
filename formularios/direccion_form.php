<?php 
        $pm="";
$pc="";
$pg="";
$pa="";
$pe="";
            if($_SESSION["pm"]=="0"){
                $pm ="disabled='true'";
            }
            if($_SESSION["pc"]=="0"){
                $pc ="disabled='true'";
            }
            if($_SESSION["pg"]=="0"){
                $pg ="disabled='true'";
            }
            if($_SESSION["pa"]=="0"){
                $pa ="disabled='true'";
            }
            if($_SESSION["pe"]=="0"){
                $pe ="disabled='true'";
            }
            ?><table  width="70%" class="acordeon" align="center" ><tr><td onclick="muestra_oculta('dvFormulario')">Formulario</td></tr></table>
<div id='dvFormulario' >
<form name='form' id='form' action=''>
<table border='0' align='center'>
	<tr> 
		 <td> 
			 CODIGO 
		 </td> 
		 <td><div id='dvReqCODIGO'><font color='red'>*</font></div></td> 
		 <td> 
			 <input type='text' name='codigo' id='codigo' value='' onfocus='' size='11'> 
		 </td>

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

		 <td> 
			 CODIGO CIUDAD 
		 </td> 
		 <td><div id='dvReqCODIGO_CIUDAD'><font color='red'>*</font></div></td> 
		 <td> 
			 <select name='codigo_ciudad' id='codigo_ciudad' onchange=''><option value=''>Seleccione...</option></select> 
		 </td>
 	</tr>
	 <tr> 
			 
		 <td> 
			 CODIGO CANDIDATO 
		 </td> 
		 <td><div id='dvReqCODIGO_CANDIDATO'><font color='red'>*</font></div></td> 
		 <td> 
			 <select name='codigo_candidato' id='codigo_candidato' onchange=''><option value=''>Seleccione...</option></select> 
		 </td>
 	</tr>
	<tr> 
		<td colspan='5' align='center'>

            			 <table align='center'> 
			 		<tr>

            					 <td> 
							 <input type="button" name="btnGuardar" id="btnGuardar" value="Guardar" onclick="xajax_validarForm(xajax.getFormValues('form'),0)" <?php echo $pg; ?> /> 
						 </td>

            					 <td> 
							 <input type="button" name="btnActualizar" id="btnActualizar" value="Actualizar" onclick="xajax_validarForm(xajax.getFormValues('form'),1)" <?php echo $pa; ?> /> 
						 </td>

            					 <td> 
							 <input type="button" name="btnEliminar" id="btnEliminar" value="Eliminar" onclick="xajax_confirmarEliminarForm(xajax.getFormValues('form'))" <?php echo $pe; ?> /> 
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
 </div> <table width="70%" class="acordeon" align="center" ><tr><td onclick='muestra_oculta(dvConsulta)' >Consulta</td></tr></table><div id='dvConsulta' >
 
 <form id='formQuery'><table align="center" class="campo" ><tr><td>Consultar:</td><td><input type='text' id='txtConsulta' name='txtConsulta' value='' /></td><td><input type='button' name='btnConsultar' id='btnConsultar' value='Consultar' onclick="xajax_consultar(xajax.getFormValues('formQuery'))" ></td></tr></table></form> 
<center> 
	 <div id='dvRespuesta'> </div> 
	 <div id='dvPaginacion'></div> 
 </center> 
</div> 
 