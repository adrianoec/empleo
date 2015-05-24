<?php

include_once('empleo.config.php');
include_once (HOME . 'include/db.class.php');
include ("lib/jpgraph/src/jpgraph.php");
include ("lib/jpgraph/src/jpgraph_pie.php");
include ("lib/jpgraph/src/jpgraph_pie3d.php");


$objDB = new Database();
$objDB->setParametrosBD(HOST, BASE, USER, PWD);
$objDB->getConexion();
$fdesde = $_REQUEST["desde"];
$fhasta = $_REQUEST["hasta"];

$sql = "Select count(*) as cantidad , a.nombre as empleo
    from empleo as a inner join candidato_empleo as b 
    on a.codigo = b.empleo_codigo inner join candidato as c
    on b.candidato_codigo =c.codigo  inner join empresa as d
    on a.codigo_empresa = d.codigo
    and a.estado =1
    and b.fecha_aplicacion >='$fdesde'
    and b.fecha_aplicacion <='$fhasta'
    group by 2 limit 10
    ;
        ";
$rs = $objDB->query($sql);

if ($objDB->getNumRows() > 0) {
    while ($ln = $objDB->fetch_array($rs)) {
        $data[] = $ln["cantidad"];
        $nombres[] = $ln["empleo"];
    }
} else {
    $data = array(1);
    $nombres = array("na");
}


$graph = new PieGraph(550, 300, "auto");
$graph->img->SetAntiAliasing();
$graph->SetMarginColor('gray');
//$graph->SetShadow();
// Setup margin and titles
$graph->title->Set("Top Empleos: $fdesde  al $fhasta ");

//$data = array(40, 60, 21, 33, 333);

$p1 = new PiePlot3D($data);
$p1->SetSize(0.35);
$p1->SetCenter(0.5);

// Setup slice labels and move them into the plot
$p1->value->SetFont(FF_FONT1, FS_BOLD);
$p1->value->SetColor("black");
$p1->SetLabelPos(0.2);

//$nombres = array("pepe", "luis", "miguel", "alberto", "adriano");
$p1->SetLegends($nombres);

// Explode all slices
$p1->ExplodeAll();

$graph->Add($p1);
$graph->Stroke();
?> 