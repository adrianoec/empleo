<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>

</html>
<script >
	function loadTabla() {
		$("table").tablesorter({
			widgets : ['zebra']
		});
	}  $(function() {
		$("table").tablesorter({
			widgets : ['zebra']
		});
	});

	function muestra_oculta(id) {
            
   
		if (document.getElementById) {//se obtiene el id
			var el = document.getElementById(id);
			//se define la variable "el" igual a nuestro div
			el.style.display = (el.style.display == 'none') ? 'block' : 'none';
			//damos un atributo display:none que oculta el div
		}
	}

	function muestra_disabled(id) {
		if (document.getElementById) {//se obtiene el id
			var el = document.getElementById(id);
			//se define la variable "el" igual a nuestro div
			el.style.display = (el.disabled == 'disabled') ? '' : 'disabled';
			//damos un atributo display:none que oculta el div
		}
	}

	function loading(id) {
		// var userInput = document.getElementById('userInput').value;
		document.getElementById(id).innerHTML = '<img src="./imagenes/loading.gif"/>';
	}

	/*************************************************************/
	/************************* MENU ******************************/
	/*************************************************************/
	//variable global para controles dropdown
	var menu = $("ul.dropdown");

	//control de eventos
	$(this.document).ready(function() {
		menu.mouseover(function() {
			displayOptions($(this).find("li"));
		});
		menu.mouseout(function() {
			hideOptions($(this));
		});
	})
	//funcion que MUESTRA todos los elementos del menu
	function displayOptions(e) {
		e.show();
	}

	//funcion que OCULTA los elementos del menu
	function hideOptions(e) {
		e.find("li").hide();
		e.find("li.active").show();
	}

	/*************************************************************/
	/********************  FIN MENU ******************************/
	/*************************************************************/
</script>
