<?php

        session_start();
        include_once('empleo.config.php');
        include_once (HOME.'include/xajax_conf.php');
        include_once (HOME.'include/db.class.php');
        include_once (HOME.'include/obtenerPermiso.php');
        if($_SESSION["pm"]=="0" or ($_SESSION["aut_usuario"] == "" or ! isset($_SESSION["aut_usuario"])) ){
            header("Location: login.php");
            exit;
        }
        
        include_once (HOME.'include/funciones.class.php');
        include_once(HOME.'funciones_xjx/permiso_xajax.php');
        include_once (HOME.'include/xajax_conf_process.php');
        include_once (HOME.'include/cabecera.php');
        include_once (HOME.'include/menu.php');
        include_once(HOME.'formularios/permiso_form.php');
        include_once(HOME.'include/pie.php');
    ?>