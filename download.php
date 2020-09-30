<?php
include 'assets/php/conn.php';

if(isset($_GET["downbutton"])){

	$output = fopen("php://output","w");
	fputcsv($output, array("ID","Date/Time","Air Moisture","Air Temperature","Soil Moisture", "Soil Temperature"));
	if (!empty($_GET['from']) and !empty($_GET['to'])){
		$sql = 'Select * FROM reading where date>"'.$_GET["from"].' 00:00:00" and date<"'.$_GET["to"].' 00:00:00" ORDER BY date DESC';
	}
	else{
		$sql = "Select * FROM reading ORDER BY date DESC";
	}
	$result= mysqli_query($conn, $sql);
	while ($row = mysqli_fetch_assoc($result)){
		$row['date']=DateTime::createFromFormat('Y-m-d H:i:s', date($row['date']))->format('Y.m.d H:i:s');
		fputcsv($output,$row);
	}
	fclose($output);

	header('Content-Type:text/csv; cjarset=utf-8');
	header('Content-Disposition: attachment; filename=data.csv');
}

?>
