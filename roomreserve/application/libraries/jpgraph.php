<?php

class Jpgraph {
	public function __construct()
	{
		
	}
	
	public function linechart($ydata, $title="line chart")
	{
		require_once 'jpgraph-3.5.0b1/src/jpgraph.php';
		require_once 'jpgraph-3.5.0b1/src/jpgraph_line.php';
		
		//create the graph. these two calls are always required
		//Graph(width, height)
		$graph = new Graph(350,250,"auto",600);
		$graph->SetScale("intint");
		
		//setup title
		$graph->title->Set($title);
		$graph->xaxis->title->Set("xaxis title");
		$graph->yaxis->title->Set("yaxis title");
		//create the linear plot
		$lineplot = new LinePlot($ydata);
		$lineplot->SetColor("blue");
		
		//Add the plot to the graph
		$graph->Add($lineplot);
		
		return $graph;
		//does PHP5 return a reference automatically?
	}
	public function barchart($xdata, $ydata, $title1, $title2)
	{
		require_once 'jpgraph-3.5.0b1/src/jpgraph.php';
		require_once 'jpgraph-3.5.0b1/src/jpgraph_bar.php';
		
		// Create the graph and setup the basic parameters
		$graph = new Graph(1000 , 800,'auto');
		//SetMargin L,R,U,D
		$graph->img->SetMargin(40,30,100,200);
		//setscale x,y
		$graph->SetScale("textint");
		$graph->SetFrame(false,'white',1);
		//$graph->SetColor('lightblue');
		$graph->SetMarginColor('lightblue');
		
		// Setup graph title ands fonts
		$graph->title->Set("รายงานสถิติการใช้ห้อง".$title1);
		//$graph->title->SetFont(FF_FONT2,FS_BOLD);
		$graph->title->SetFont(FF_THSARA,FS_BOLD,20);
		$graph->subtitle->Set($title2);
		$graph->subtitle->SetFont(FF_THSARA,FS_BOLD,20);
		
		//------------------  x zone  ------------------
		//$a = $gDateLocale->GetShortMonth();
		//$graph->xaxis->SetTickLabels($a);
		//$graph->xaxis->SetColor('darkblue','black');
		//$graph->xaxis->SetTitle('ปกกYear 2002','center');
		$graph->xaxis->SetTitleMargin(10);
		$graph->xaxis->title->SetFont(FF_THSARA,FS_BOLD,16);
		//	$datax = array("x1หนึ่งสองสามสี่ห้าหกเจ็ด","x2","x3","x4","x5");
		$graph->xaxis->SetTickLabels($xdata);
		$graph->xaxis->SetFont(FF_THSARA,FS_BOLD,16);
		$graph->xaxis->SetLabelAngle(90);
		//------------------  end x zone  ---------------
		
		//------------------  y zone  ------------------
		//	$datay = array(7,19,11,4,20);
		// Add some grace to the top so that the scale doesn't
		// end exactly at the max value.
		$graph->yaxis->scale->SetGrace(10);
		// Setup "hidden" y-axis by given it the same color
		// as the background (this could also be done by setting the weight
		// to zero)
		//$graph->yaxis->SetColor('lightblue','darkblue');
		$graph->yaxis->SetFont(FF_THSARA,FS_BOLD,16);
		$graph->ygrid->SetColor('gray');
		//------------------  end y zone  ---------------
		
		
		// Create a bar pot
		$bplot = new BarPlot($ydata);
		$bplot->SetFillColor('darkblue');
		//$bplot->SetColor('darkblue');
		$bplot->SetWidth(0.5);
		$bplot->SetShadow('darkgray');
		
		// Setup the values that are displayed on top of each bar
		// Must use TTF fonts if we want text at an arbitrary angle
		$bplot->value->Show();
		$bplot->value->SetFont(FF_THSARA,FS_NORMAL,18);
		$bplot->value->SetFormat('$%d');
		//$bplot->value->SetColor('darkred');
		$bplot->value->SetAngle(45);
		$graph->Add($bplot);
		
		return $graph;
		// Finally stroke the graph
		//$graph->Stroke();
	}
}