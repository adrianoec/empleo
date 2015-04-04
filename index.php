<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
if ($_SESSION["aut_usuario"] == "" or ! isset($_SESSION["aut_usuario"])) {
    header("location: login.php");
}
include_once ('empleo.config.php');
include_once (HOME . 'include/xajax_conf.php');
include_once (HOME . 'include/db.class.php');
include_once (HOME . 'include/xajax_conf_process.php');
include_once (HOME . 'include/cabecera.php');
include_once (HOME . 'include/menu.php');
?>

<div id="">
    <center>
    <img src="imagenes/oficios-masculinos.jpg" width="700" height="525" alt="oficios-masculinos"/>
    </center>
</div>
<?php


include_once (HOME . 'include/pie.php');
?>