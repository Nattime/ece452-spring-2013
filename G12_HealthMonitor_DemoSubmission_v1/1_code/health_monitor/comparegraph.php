<?php
include 'core/init.php';
global $profile_data;
if(fopen('user_data/files/' . $user_data['username'] . '.csv', 'r') >= 0){
$datay = array();
$datax = array();
$fp = fopen('user_data/files/' . $user_data['username'] . '.csv', 'r');
while($csv_line = fgetcsv($fp,1024)){
	for($i = 0, $j = count($csv_line); $i < $j; $i++){
		if($i == 12){
			if(is_numeric($csv_line[$i]) === true){
				$datay[] = $csv_line[$i];
			}
		}else if($i == 4){
			if(empty($csv_line[$i]) === false){
				$array = date_parse($csv_line[$i]);
				if(empty($array['month']) === false){
					$date = $array['month'] . '/' . $array['day'];
					$datax[] = $date;
				}
			}
		}
	}
}

$datay2 = array();
$datax2 = array();
$fp = fopen('user_data/files/' . $profile_data['username'] . '.csv', 'r');
echo $fp;
die();
while($csv_line = fgetcsv($fp,1024)){
	for($i = 0, $j = count($csv_line); $i < $j; $i++){
		if($i == 12){
			if(is_numeric($csv_line[$i]) === true){
				$datay2[] = $csv_line[$i];
			}
		}else if($i == 4){
			if(empty($csv_line[$i]) === false){
				$array = date_parse($csv_line[$i]);
				if(empty($array['month']) === false){
					$date = $array['month'] . '/' . $array['day'];
					$datax2[] = $date;
				}
			}
		}
	}
}

//$comma_separated_y = implode(", ", $datay);
//$comma_separated_x = implode(", ", $datax);

//print_r($datax);
//echo '<br />';
//print_r($datay);

// content="text/plain; charset=utf-8"
require_once ('jpgraph/jpgraph.php');
require_once ('jpgraph/jpgraph_line.php');


// Setup the graph
$graph = new Graph(500,450);
$graph->SetScale("textlin");

$theme_class=new UniversalTheme;

$graph->SetTheme($theme_class);
$graph->img->SetAntiAliasing(false);
$graph->title->Set('Compare Graph');
$graph->SetBox(false);

$graph->img->SetAntiAliasing();

$graph->yaxis->HideZeroLabel();
$graph->yaxis->HideLine(false);
$graph->yaxis->HideTicks(false,false);

$graph->xgrid->Show();
$graph->xgrid->SetLineStyle("solid");
$graph->xaxis->SetTickLabels($datax);
$graph->xgrid->SetColor('#E3E3E3');

// Create the first line
$p1 = new LinePlot($datay);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend($user_data['first_name'] . '\'s Calories');

$graph->legend->SetFrameWeight(1);

// Create the 2nd line
$p1 = new LinePlot($datay);
$graph->Add($p1);
$p1->SetColor("#6495ED");
$p1->SetLegend($user_data['first_name'] . '\'s Calories');

$graph->legend->SetFrameWeight(1);

// Output line
$graph->Stroke();
}else{
	echo 'You have not uploaded any data yet. graph';
}
?>