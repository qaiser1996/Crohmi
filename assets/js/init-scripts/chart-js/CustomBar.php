<?php
include '../../../php/conn.php';

	$finalres = [];
	$hours = [];
	$months = 6;
	$PoleA=$_POST['PoleA'];
	$PoleB=$_POST['PoleB'];

	if ($PoleA!=0){
		$sql = "SELECT AVG(".$_POST['page'].") as avg FROM `reading` WHERE (date >(CURDATE() - INTERVAL 1 MONTH)) AND PoleNo=".$PoleA;

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['avg']){
				array_unshift($hours,intval($row['avg']));
			}
			else {
				array_unshift($hours,0);
			}

		}
		for ($i=1; $i<$months;$i++){
			$j=$i+1;
			$sql = "SELECT AVG(".$_POST['page'].") as avg FROM `reading` WHERE (date>(CURDATE()- INTERVAL $j MONTH)) AND (date<(CURDATE()- INTERVAL $i MONTH)) AND PoleNo=".$PoleA;

			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				if ($row['avg']){
					array_unshift($hours,intval($row['avg']));
				}
				else{
					array_unshift($hours,0);
				}

			}
		}
	}
	else{
		$sql = "SELECT AVG(".$_POST['page'].") as avg FROM `reading` WHERE (date >(CURDATE() - INTERVAL 1 MONTH))";

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['avg']){
				array_unshift($hours,intval($row['avg']));
			}
			else {
				array_unshift($hours,0);
			}

		}
		for ($i=1; $i<$months;$i++){
			$j=$i+1;
			$sql = "SELECT AVG(".$_POST['page'].") as avg FROM `reading` WHERE (date>(CURDATE()- INTERVAL $j MONTH)) AND (date<(CURDATE()- INTERVAL $i MONTH))";

			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				if ($row['avg']){
					array_unshift($hours,intval($row['avg']));
				}
				else{
					array_unshift($hours,0);
				}

			}
		}
	}

	if ($PoleB!=0){
		$hours1 = [];
		$sql = "SELECT AVG(".$_POST['page1'].") as avg FROM `reading` WHERE (date >(CURDATE() - INTERVAL 1 MONTH)) AND PoleNo=".$PoleB;

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['avg']){
				array_unshift($hours1,intval($row['avg']));
			}
			else {
				array_unshift($hours1,0);
			}

		}
		for ($i=1; $i<$months;$i++){
			$j=$i+1;
			$sql = "SELECT AVG(".$_POST['page1'].") as avg FROM `reading` WHERE (date>(CURDATE()- INTERVAL $j MONTH)) AND (date<(CURDATE()- INTERVAL $i MONTH)) AND PoleNo=".$PoleB;

			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				if ($row['avg']){
					array_unshift($hours1,intval($row['avg']));
				}
				else{
					array_unshift($hours1,0);
				}

			}
		}
	}
	else{
		$hours1 = [];
		$sql = "SELECT AVG(".$_POST['page1'].") as avg FROM `reading` WHERE (date >(CURDATE() - INTERVAL 1 MONTH))";

		$result = mysqli_query($conn,$sql);
		if (mysqli_num_rows($result)>0){
			$row = mysqli_fetch_assoc($result);
			if ($row['avg']){
				array_unshift($hours1,intval($row['avg']));
			}
			else {
				array_unshift($hours1,0);
			}

		}
		for ($i=1; $i<$months;$i++){
			$j=$i+1;
			$sql = "SELECT AVG(".$_POST['page1'].") as avg FROM `reading` WHERE (date>(CURDATE()- INTERVAL $j MONTH)) AND (date<(CURDATE()- INTERVAL $i MONTH))";

			$result = mysqli_query($conn,$sql);
			if (mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				if ($row['avg']){
					array_unshift($hours1,intval($row['avg']));
				}
				else{
					array_unshift($hours1,0);
				}

			}
		}
	}





	array_push($finalres, $hours);
	array_push($finalres, $hours1);
	echo json_encode($finalres);


?>
