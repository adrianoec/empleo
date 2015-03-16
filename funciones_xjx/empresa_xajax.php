<?php


    function validarForm($form, $opcion){
    $codigo= strtoupper(trim($form['codigo']));

                $razon_social= strtoupper(trim($form['razon_social']));

                $codigo_direccion= strtoupper(trim($form['codigo_direccion']));

                $representante= strtoupper(trim($form['representante']));

                $email= strtoupper(trim($form['email']));

                $telefono1= strtoupper(trim($form['telefono1']));

                $telefono2= strtoupper(trim($form['telefono2']));

                
    	 global $enlace, $objPaginacion, $objComun;

    	 $objResponse = new xajaxResponse();

    	 $msg="";
    
                    if(strcasecmp($codigo,'')==0 or  strcasecmp($codigo,'seleccione')==0){
                    	 $msg.="\nINGRESE CODIGO...";
                    }
                
                    if(strcasecmp($razon_social,'')==0 or  strcasecmp($razon_social,'seleccione')==0){
                    	 $msg.="\nINGRESE RAZON SOCIAL...";
                    }
                
                    if(strcasecmp($codigo_direccion,'')==0 or  strcasecmp($codigo_direccion,'seleccione')==0){
                    	 $msg.="\nINGRESE CODIGO DIRECCION...";
                    }
                
                    if(strcasecmp($representante,'')==0 or  strcasecmp($representante,'seleccione')==0){
                    	 $msg.="\nINGRESE REPRESENTANTE...";
                    }
                
                    if(strcasecmp($email,'')==0 or  strcasecmp($email,'seleccione')==0){
                    	 $msg.="\nINGRESE EMAIL...";
                    }
                
                    if(strcasecmp($telefono1,'')==0 or  strcasecmp($telefono1,'seleccione')==0){
                    	 $msg.="\nINGRESE TELEFONO1...";
                    }
                
    	 if(strlen(trim($msg))>0){
            $objResponse->alert($msg);
            return $objResponse;
        }else{
            if($opcion==0){ // inserta
                $objResponse->call("xajax_ingresar",$form);
            }else{ // actualizar
                $objResponse->call("xajax_actualizar",$form);
            }
        }
    	 return $objResponse;

    }

    function ingresar($form){

    $codigo= strtoupper(trim($form['codigo']));

                $razon_social= strtoupper(trim($form['razon_social']));

                $codigo_direccion= strtoupper(trim($form['codigo_direccion']));

                $representante= strtoupper(trim($form['representante']));

                $email= strtoupper(trim($form['email']));

                $telefono1= strtoupper(trim($form['telefono1']));

                $telefono2= strtoupper(trim($form['telefono2']));

                
    	 global  $objPaginacion, $objComun;

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    	 $objResponse = new xajaxResponse();

    	 $sqlInsert = "insert into empresa (razon_social,codigo_direccion,representante,email,telefono1,telefono2) values" ;

    	 $sqlInsert .= "('$razon_social','$codigo_direccion','$representante','$email','$telefono1','$telefono2');" ;

    	 $rs=$objDB->query($sqlInsert);

    	 $objResponse->alert("Registrado...");
    	 return $objResponse;

    }

    function actualizar($form){

    $codigo= strtoupper(trim($form['codigo']));

                $razon_social= strtoupper(trim($form['razon_social']));

                $codigo_direccion= strtoupper(trim($form['codigo_direccion']));

                $representante= strtoupper(trim($form['representante']));

                $email= strtoupper(trim($form['email']));

                $telefono1= strtoupper(trim($form['telefono1']));

                $telefono2= strtoupper(trim($form['telefono2']));

                
    	 global  $objPaginacion, $objComun;

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    	 $objResponse = new xajaxResponse();

    	 $sqlUpdate = "update  empresa set  razon_social= '$razon_social'
, codigo_direccion= '$codigo_direccion'
, representante= '$representante'
, email= '$email'
, telefono1= '$telefono1'
, telefono2= '$telefono2'
 where  codigo= '$codigo'
" ;

    	 $rs=$objDB->query($sqlUpdate);

    	 $objResponse->alert("Actualizado...");
    	 return $objResponse;

    }

    
function confirmarEliminarForm($form){

    	 global $enlace, $objPaginacion, $objComun;

    	 $objResponse = new xajaxResponse();

    $objResponse->confirmCommands(1, "Deseas eliminar el registro?");
    $objResponse->call("xajax_eliminar",$form);
    	 return $objResponse;

    }

    
function eliminar($form){

    $codigo= strtoupper(trim($form['codigo']));

                $razon_social= strtoupper(trim($form['razon_social']));

                $codigo_direccion= strtoupper(trim($form['codigo_direccion']));

                $representante= strtoupper(trim($form['representante']));

                $email= strtoupper(trim($form['email']));

                $telefono1= strtoupper(trim($form['telefono1']));

                $telefono2= strtoupper(trim($form['telefono2']));

                
    	 global $objPaginacion, $objComun;

    $objResponse = new xajaxResponse();
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    	 $objResponse = new xajaxResponse();

    	 $sqlUpdate = "update  empresa set activo=0 where  codigo= '$codigo'
" ;

    	 $rs=$objDB->query($sqlUpdate);

    	 $objResponse->alert("Desactivado...");
    	 return $objResponse;

    }


function limpiar($form){

    	 $objResponse = new xajaxResponse();

$objResponse->assign("codigo","value","");
$objResponse->assign("razon_social","value","");
$objResponse->assign("codigo_direccion","value","");
$objResponse->assign("representante","value","");
$objResponse->assign("email","value","");
$objResponse->assign("telefono1","value","");
$objResponse->assign("telefono2","value","");

    	 return $objResponse;

    }


function seleccionar($id){

    	 $objResponse = new xajaxResponse();

    
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from empresa 
    where  XXXXXXXXXXXX  like '%$query%' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $ln=$objDB->fetch_array($result);
    
$objResponse->assign("codigo","value","$nombre");
$objResponse->assign("razon_social","value","$nombre");
$objResponse->assign("codigo_direccion","value","$nombre");
$objResponse->assign("representante","value","$nombre");
$objResponse->assign("email","value","$nombre");
$objResponse->assign("telefono1","value","$nombre");
$objResponse->assign("telefono2","value","$nombre");

    
    	 return $objResponse;

    }


function consultar($form) {
    $query = trim($form["txtConsulta"]);
    $objResponse = new xajaxResponse();

    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();

    $sql = " select *    from empresa 
    where  XXXXXXXXXXXX  like '%$query%' ";

    $result = $objDB->query($sql);
    $numCols = $objDB->getNumCols();

    $nuevo = "<img src='".HOME."imagenes/page_white_text.png'/>";
    $nuevoLnk = " style='cursor:pointer' onclick = 'xajax_nuevo()' ";

    $tabla = "<table border='0' width='70%'> <tr><td> <table border='0' align ='center' class='tablesorter' cellspacing='1'><thead><tr>";
    $arrTi = $objDB->field_name($result);
    
    

    foreach ($arrTi as $ln) {
        $campo = $ln;
        $tabla .="<th>$campo</th>";
    }
    $tabla.=" <th colspan='2' $nuevoLnk >$nuevo</th> </tr></thead><tbody>";
    while ($ln = $objDB->fetch_array($result)) {
        $id = $ln[0];
        $tb="<tr>";
        for($i=0;$i<$numCols;$i++){
            $dato = $ln[$i];
            $tb.="<td id = 'dv_$i'.'_$id'>$dato</td>";
        }
        $actualizar = "<img src='".HOME."imagenes/page_white_edit.png'/>";
        $actalizarLnk = " style='cursor:pointer' onclick = 'xajax_seleccionar($id)' ";
        $eliminar = "<img src='".HOME."imagenes/cross.png'/>";
        $eliminarLnk = " style='cursor:pointer' onclick = 'xajax_confirmarEliminarForm($id)' ";
        $tabla.=$tb." <td $actalizarLnk >$actualizar</td><td $eliminarLnk >$eliminar</td>   </tr>";
    }
    $tabla.="</tbody></table> </td></tr></table> ";
    $objResponse->script('function loadTabla(){$("table").tablesorter({ widgets: [\'zebra\']});  }  $(function() {$("table") .tablesorter({ widgets: [\'zebra\']});  });');
    $objResponse->assign("dvRespuesta", "innerHTML", "$tabla");
    return $objResponse;
}







    $xajax->register(XAJAX_FUNCTION,"validarForm");

    $xajax->register(XAJAX_FUNCTION,"ingresar");

    $xajax->register(XAJAX_FUNCTION,"actualizar");

    $xajax->register(XAJAX_FUNCTION,"eliminar");

    $xajax->register(XAJAX_FUNCTION,"limpiar");

    $xajax->register(XAJAX_FUNCTION,"confirmarEliminarForm");

    $xajax->register(XAJAX_FUNCTION,"consultar");

    $xajax->register(XAJAX_FUNCTION,"seleccionar");

    ?>