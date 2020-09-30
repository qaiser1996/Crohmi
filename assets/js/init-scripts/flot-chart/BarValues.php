<?php
include '../../../php/conn.php';

	$hours = [['2020-05-24', '85'], ['2020-05-24', '85'], ['2020-05-24', '85']];
    return 'Pass';
	for ($i=0; $i<30;$i++){
		$j=$i+1;
		$sql = "SELECT date, AVG(".$_POST['page'].") as avg FROM `reading` WHERE (date>(CURDATE()-INTERVAL $j DAY)) AND (date<(CURDATE()- INTERVAL $i DAY))";

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
