<?php include 'assets/php/conn.php';
?>
<?php
if (isset($_GET['dat'])){
	$dat = $_GET['dat'];
	$airM = $_GET['airm'];
	$airT = $_GET['airt'];
	$soilM[1] = $_GET['soilm1'];
	$soilT[1] = $_GET['soilt1'];
	$soilM[2] = $_GET['soilm2'];
	$soilT[2] = $_GET['soilt2'];
	$soilM[3] = $_GET['soilm3'];
	$soilT[3] = $_GET['soilt3'];
	$soilM[4] = $_GET['soilm4'];
	$soilT[4] = $_GET['soilt4'];
	$soilM[5] = $_GET['soilm5'];
	$soilT[5] = $_GET['soilt5'];
	$lat = $_GET['lat'];
	$lng = $_GET['lng'];
	$pn1 = $_GET['pn1'];
	$pn2 = $_GET['pn2'];
	$pn3 = $_GET['pn3'];
	$pn4 = $_GET['pn4'];
	$pn5 = $_GET['pn5'];

	// AIR VALUES
	$nh3 = $_GET['nh3'];
	$co = $_GET['co'];
	$no2 = $_GET['no2'];
	$c3h8 = $_GET['c3h8'];
	$c4h10 = $_GET['c4h10'];
	$ch4 = $_GET['ch4'];
	$h2 = $_GET['h2'];
	$c2h5oh = $_GET['c2h5oh'];

	if ($pn1==1){
	    $sql = "INSERT INTO readingair VALUES(null,NOW(),$nh3,$co,$no2,$c3h8,$c4h10,$ch4,$h2,$c2h5oh,'$lat','$lng',$pn1);";
    	if (!mysqli_query($conn,$sql)){
    		echo "Error at air 1";
    	}
    	echo $sql;

	}


	$sql = "INSERT INTO readingall VALUES(null,NOW(),$airM,$airT,$soilM[1],$soilT[1],'$lat','$lng',$pn1);";
	if (!mysqli_query($conn,$sql)){
		echo "Error at 6";
	}
	echo $sql;

	$sql = "INSERT INTO readingall VALUES(null,NOW(),$airM,$airT,$soilM[2],$soilT[2],'$lat','$lng',$pn2);";
	if (!mysqli_query($conn,$sql)){
		echo "Error at 7";
	}
	echo $sql;

	$sql = "INSERT INTO readingall VALUES(null,NOW(),$airM,$airT,$soilM[3],$soilT[3],'$lat','$lng',$pn3);";
	if (!mysqli_query($conn,$sql)){
		echo "Error at 8";
	}
	echo $sql;

	$sql = "INSERT INTO readingall VALUES(null,NOW(),$airM,$airT,$soilM[4],$soilT[4],'$lat','$lng',$pn4);";
	if (!mysqli_query($conn,$sql)){
		echo "Error at 9";
	}
	echo $sql;

	$sql = "INSERT INTO readingall VALUES(null,NOW(),$airM,$airT,$soilM[5],$soilT[5],'$lat','$lng',$pn5);";
	if (!mysqli_query($conn,$sql)){
		echo "Error at 10";
	}
	echo $sql;



	for ($i=1; $i<=5; $i++){
		if ($soilM[$i]>100 or $soilM[$i]<0){
			$soilM[$i]="null";
			echo "Soil moisture $i set to null ";
		}

		if ($soilT[$i]>80 or $soilT[$i]<-20){
			$soilT[$i]="null";
			echo "Soil temperature $i set to null ";
		}
	}

	if ($airM>100 or $airM<0){
		$airM="null";
		echo "Air Moisture set to null";
	}

	if ($airT>80 or $airT<-20){
		$airT="null";
		echo "Air Temperature set to null";
	}


	$sql = "INSERT INTO reading VALUES(null,NOW(),$airM,$airT,$soilM[1],$soilT[1],'$lat','$lng',$pn1);";
	echo $sql;
	if ($soilM[1]!=999 and $soilT[1]!=999){
		if(!($result=mysqli_query($conn,$sql))){
			echo 'Error at 1 ';
			echo $result;
		}
	}
	$sql = "INSERT INTO reading VALUES(null,NOW(),$airM,$airT,$soilM[2],$soilT[2],'$lat','$lng',$pn2);";
	if ($soilM[2]!=999 and $soilT[2]!=999){
		if(!mysqli_query($conn,$sql)){
			echo 'Error at 2 ';
		}
	}
	$sql = "INSERT INTO reading VALUES(null,NOW(),$airM,$airT,$soilM[3],$soilT[3],'$lat','$lng',$pn3);";
	if ($soilM[3]!=999 and $soilT[3]!=999){
		if(!mysqli_query($conn,$sql)){
			echo 'Error at 3 ';
		}
	}
	$sql = "INSERT INTO reading VALUES(null,NOW(),$airM,$airT,$soilM[4],$soilT[4],'$lat','$lng',$pn4);";
	if ($soilM[4]!=999 and $soilT[4]!=999){
		if(!mysqli_query($conn,$sql)){
			echo 'Error at 4 ';
		}
	}
	$sql = "INSERT INTO reading VALUES(null,NOW(),$airM,$airT,$soilM[5],$soilT[5],'$lat','$lng',$pn5);";
	if ($soilM[5]!=999 and $soilT[5]!=999){
		if(!mysqli_query($conn,$sql)){
			echo 'Error at 5 ';
		}
	}


}
else{
	header('Location: index.html');
}
?>

