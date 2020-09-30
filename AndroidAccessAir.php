<?php
include 'assets/php/conn.php';

	$hours = [];
	$sql = "select AVG(airMoisture) as avg
			from reading
			WHERE date > (NOW()- INTERVAL 1 HOUR)";

	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		if ($row['avg']){
			array_push($hours,[24,intval($row['avg'])]);
		}
		else {
			array_push($hours,[24,0]);
		}

	}
	for ($i=1; $i<24;$i++){
		$j=$i+1;
		$sql = "select AVG(airMoisture)  as avg
			from reading
			WHERE date BETWEEN NOW()- INTERVAL $j HOUR AND NOW() - INTERVAL $i HOUR";

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['avg']){
				array_push($hours,[24 - $i,intval($row['avg'])]);
			}
			else{
				array_push($hours,[24-$i,0]);
			}

		}
	}
	echo json_encode($hours);


?>
