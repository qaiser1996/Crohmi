<?php
include '../../../php/conn.php';

	$res = [];
	$p1 = $_POST['p1'];
	$p2 = $_POST['p2'];
	$p3 = $_POST['p3'];
	$sql = "select COUNT(".$_POST['page'].") as cnt
			from reading
			WHERE date >= (NOW() - INTERVAL 1 MONTH )
			AND ".$_POST['page']." <= $p1";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		array_push($res,intval($row['cnt']));
	}
	else{
		array_push($res,0);
	}



	$sql = "select COUNT(".$_POST['page'].") as cnt
			from reading
			WHERE date >= (NOW() - INTERVAL 1 MONTH )
			AND ".$_POST['page']." <= $p2
			AND ".$_POST['page']." > $p1";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		array_push($res,intval($row['cnt']));
	}
	else{
		array_push($res,0);
	}


	$sql = "select COUNT(".$_POST['page'].") as cnt
			from reading
			WHERE date >= (NOW() - INTERVAL 1 MONTH )
			AND ".$_POST['page']." <= $p3
			AND ".$_POST['page']." > $p2";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		array_push($res,intval($row['cnt']));
	}
	else{
		array_push($res,0);
	}


	$sql = "select COUNT(".$_POST['page'].") as cnt
			from reading
			WHERE date >= (NOW() - INTERVAL 1 MONTH )
			AND ".$_POST['page']." > $p3";
	$result = mysqli_query($conn,$sql);
	if (mysqli_num_rows($result)>0){
		$row = mysqli_fetch_assoc($result);
		array_push($res,intval($row['cnt']));
	}
	else{
		array_push($res,0);
	}



	echo json_encode($res);
?>
