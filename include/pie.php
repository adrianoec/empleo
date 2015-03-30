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
            widgets: ['zebra']
        });
    }
    $(function () {
        $("table").tablesorter({
            widgets: ['zebra']
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

    /************************************************************/
    messageObj = new DHTML_modalMessage();	// We only create one object of this class
    messageObj.setShadowOffset(5);	// Large shadow
    function displayMessage(url, largo, alto)
    {

        messageObj.setSource(url);
        messageObj.setCssClassMessageBox(false);
        messageObj.setSize(largo, alto);
        messageObj.setShadowDivVisible(true);	// Enable shadow for these boxes
        messageObj.display();
    }
    function displayStaticMessage(messageContent, cssClass, largo, alto)
    {
        messageObj.setHtmlContent(messageContent);
        messageObj.setSize(largo, alto);
        messageObj.setCssClassMessageBox(cssClass);
        messageObj.setSource(false);	// no html source since we want to use a static message here.
        messageObj.setShadowDivVisible(false);	// Disable shadow for these boxes	
        messageObj.display();


    }

    function closeMessage()
    {
        messageObj.close();
    }

    /*************************************************************/
    /*************************************************************/


    /*************************************************************/
    /************************* MENU ******************************/
    /*************************************************************/
    //variable global para controles dropdown
    var menu = $("ul.dropdown");

    //control de eventos
    $(this.document).ready(function () {
        menu.mouseover(function () {
            displayOptions($(this).find("li"));
        });
        menu.mouseout(function () {
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


    var dp_cal;
    function show_calendar(id) {
        //alert(id);
        dp_cal = new Epoch('epoch_popup', 'popup', document.getElementById(id));

    }
    ;

    function popitup(url,name,h,w) {
        newwindow = window.open(url, name, 'height='+h+',width='+w);
        if (window.focus) {
            newwindow.focus()
        }
        return false;
    }
   
</script>
