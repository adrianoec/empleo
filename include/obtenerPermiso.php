<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$path_info = pathinfo($_SERVER['PHP_SELF']);

$conjuntoPermisos = getPermiso($path_info['basename']);
$_SESSION["pm"] = $conjuntoPermisos["m"];
$_SESSION["pc"] = $conjuntoPermisos["c"];
$_SESSION["pg"] = $conjuntoPermisos["g"];
$_SESSION["pa"] = $conjuntoPermisos["a"];
$_SESSION["pe"] = $conjuntoPermisos["e"];

function getPermiso($pagina) {
    $objDB = new Database();
    $objDB->setParametrosBD(HOST, BASE, USER, PWD);
    $objDB->getConexion();
    $perfil = $_SESSION["aut_perfil"];
    $sql = "select  b.pagina, a.acceso_menu, a.acceso_consulta, a.acceso_guardar, a.acceso_actualizar, a.acceso_eliminar 
    from empleo.permiso as a inner join empleo.pagina as b
    on a.codigo_pagina = b.codigo 
    and a.estado=1
    and a.codigo_rol = $perfil   and lower(b.pagina) = lower('$pagina') limit 1";
    $rs = $objDB->query($sql);

    if ($objDB->getNumRows() > 0) {
        $ln = $objDB->fetch_array($rs);
        $menu = $ln["acceso_menu"];
        $consulta = $ln["acceso_consulta"];
        $guardar = $ln["acceso_guardar"];
        $actualizar = $ln["acceso_actualizar"];
        $eliminar = $ln["acceso_eliminar"];
        if (strlen(trim($eliminar)) == 0) {
            $eliminar = "0";
        }
        if (strlen(trim($menu)) == 0) {
            $menu = "0";
        }
        if (strlen(trim($consulta)) == 0) {
            $consulta = "0";
        }
        if (strlen(trim($guardar)) == 0) {
            $guardar = "0";
        }
        if (strlen(trim($actualizar)) == 0) {
            $actualizar = "0";
        }
    } else {
        $menu = "0";
        $consulta = "0";
        $guardar = "0";
        $actualizar = "0";
        $eliminar = "0";
    }
    return array("m" => "$menu", "c" => "$consulta", "g" => "$guardar", "a" => "$actualizar", "e" => "$eliminar");
}
