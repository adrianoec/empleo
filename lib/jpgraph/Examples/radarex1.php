<?php // content="text/plain; charset=utf-8"
require_once ('../src/jpgraph.php');
require_once ('../src/jpgraph_radar.php');
require_once ('../src/jpgraph_iconplot.php');

// Some data to plot
$data = array(55,80,46,71,95);

// Create the graph and the plot
$graph = new RadarGraph(250,200);
$plot = new RadarPlot($data);

// Add the plot and display the graph
$graph->Add($plot);
$graph->Stroke();
?>
