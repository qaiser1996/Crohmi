<?php
include 'assets/php/conn.php';

	$hours = [];
	$sql = "SELECT date, AVG(soilMoisture) as avg FROM `reading` WHERE (date >(CURDATE()))";

	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		if ($row['avg']){
			array_push($hours,[DateTime::createFromFormat('Y-m-d H:i:s', date($row['date']))->format('U')*1000,intval($row['avg'])]);
		}
		else {
			array_push($hours,[DateTime::createFromFormat('Y-m-d', date('Y-m-d'))->format('U')*1000,0]);
		}

	}
	for ($i=0; $i<30;$i++){
		$j=$i+1;
		$sql = "SELECT date, AVG(soilMoisture) as avg FROM `reading` WHERE (date>(CURDATE()-INTERVAL $j DAY)) AND (date<(CURDATE()- INTERVAL $i DAY))";
		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['date']){
				array_push($hours,[DateTime::createFromFormat('Y-m-d H:i:s', date($row['date']))->format('U')*1000,intval($row['avg'])]);
			}
			else{
				array_push($hours,[DateTime::createFromFormat('Y-m-d', date('Y-m-d',strtotime("-$j days")))->format('U')*1000,0]);
			}

		}
	}
	echo json_encode($hours);


?>
