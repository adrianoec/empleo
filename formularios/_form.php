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
		 <td><div id='dvReqCODIGO'></div></td> 
		 <td> 
			 <input type='text' name='codigo' id='codigo' value='' onfocus='' size='11'> 
		 </td>

		 <td> 
			 CODIGO CANDIDATO 
		 </td> 
		 <td><div id='dvReqCODIGO_CANDIDATO'></div></td> 
		 <td> 
			 <input type='text' name='codigo_candidato' id='codigo_candidato' value='' onfocus='' size='11'> 
		 </td>
 	</tr>
	<tr> 
		 <td> 
			 TITULO 
		 </td> 
		 <td><div id='dvReqTITULO'></div></td> 
		 <td> 
			 <input type='text' name='titulo' id='titulo' value='' onfocus='' size='384'> 
		 </td>

		 <td> 
			 HORAS 
		 </td> 
		 <td><div id='dvReqHORAS'></div></td> 
		 <td> 
			 <input type='text' name='horas' id='horas' value='' onfocus='' size='11'> 
		 </td>
 	</tr>
	<tr> 
		 <td> 
			 FECHA INICIO 
		 </td> 
		 <td><div id='dvReqFECHA_INICIO'></div></td> 
		 <td> 
			 <input type='text' name='fecha_inicio' id='fecha_inicio' value='' onfocus='' size='19'> 
		 </td>

		 <td> 
			 FECHA FIN 
		 </td> 
		 <td><div id='dvReqFECHA_FIN'></div></td> 
		 <td> 
			 <input type='text' name='fecha_fin' id='fecha_fin' value='' onfocus='' size='19'> 
		 </td>
 	</tr>
	<tr> 
		 <td> 
			 CODIGO TIPO NIVEL ACADEMICO 
		 </td> 
		 <td><div id='dvReqCODIGO_TIPO_NIVEL_ACADEMICO'></div></td> 
		 <td> 
			 <select name='codigo_tipo_nivel_academico' id='codigo_tipo_nivel_academico' onchange=''><option value=''>Seleccione...</option></select> 
		 </td>

		 <td> 
			 CODIGO INSTITUCION 
		 </td> 
		 <td><div id='dvReqCODIGO_INSTITUCION'></div></td> 
		 <td> 
			 <select name='codigo_institucion' id='codigo_institucion' onchange=''><option value=''>Seleccione...</option></select> 
		 </td>
 	</tr>
	 <tr> 
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
 