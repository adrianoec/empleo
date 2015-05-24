<?php


session_start();
include_once ('empleo.config.php');
include_once (HOME . 'include/xajax_conf.php');
include_once (HOME . 'include/db_conf.php');

function salir() {
	$objResponse = new xajaxResponse();
	session_destroy();
	//$objResponse->waitFor("sleep(38)", 10);
	$objResponse -> redirect("login.php");
	return $objResponse;
}
$xajax -> register(XAJAX_FUNCTION, "salir");

include_once (HOME . 'include/xajax_conf_process.php');

?>
<script>xajax_salir();</script>
