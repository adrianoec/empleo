<?php // content="text/plain; charset=utf-8"
require_once ('../src/jpgraph.php');
require_once ('../src/jpgraph_pie.php');

$data = array(40,60,21,33);

$graph = new PieGraph(300,200);
$graph->SetShadow();

$graph->title->Set("A simple Pie plot");

$p1 = new PiePlot($data);
$graph->Add($p1);
$graph->Stroke();

?>


