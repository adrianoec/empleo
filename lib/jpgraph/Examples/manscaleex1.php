<?php // content="text/plain; charset=utf-8"
require_once ('../src/jpgraph.php');
require_once ('../src/jpgraph_line.php');

$ydata = array(12,17,22,19,5,15);

$graph = new Graph(220,170);
$graph->SetScale("textlin",3,35);
$graph->yscale->ticks->Set(8,2);

$graph->title->Set('Manual scale, manual ticks');
$graph->title->SetFont(FF_FONT1,FS_BOLD);

$line = new LinePlot($ydata);
$graph->Add($line);

// Output graph
$graph->Stroke();

?>


