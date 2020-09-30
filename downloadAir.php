<?php
include 'assets/php/conn.php';

if(isset($_GET["downbutton"])){
	header('Content-Type:text/csv; charset=UTF-8');
	header('Content-Disposition: attachment; filename=data.csv');
	$output = fopen("php://output","w");
	fputcsv($output, array("ID","Date/Time","NH3","CO","NO2", "C3H8","C4H10","CH4","H2", "C2H5OH","latitude", "longitude", "Pole no"));
if (!empty($_GET['from']) and !empty($_GET['to'])){
		$sql = 'Select * FROM readingair where date>"'.$_GET["from"].' 00:00:00" and date<"'.$_GET["to"].' 00:00:00" ORDER BY date DESC';
	}
	else{
		$sql = "Select * FROM readingair ORDER BY date DESC";
	}
	$result= mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		$row['date']=DateTime::createFromFormat('Y-m-d H:i:s', date($row['date']))->format('Y.m.d H:i:s');
		fputcsv($output,$row);
	}
	fclose($output);
}

?>
