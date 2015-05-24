<?php // content="text/plain; charset=utf-8"

require_once ('../src/jpgraph.php');
require_once ('../src/jpgraph_led.php');

// By default each "LED" circle has a radius of 3 pixels
$led = new DigitalLED74();
$led->StrokeNumber('0123456789. ABCDEFGHIJKL',LEDC_STEELBLUE);



?>
