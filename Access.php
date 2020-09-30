<?php
ob_start();
include "assets/php/conn.php";

$sql = "Select * FROM register where name='".$_POST['name']."' and Password='".$_POST['pass']."'";


$result = mysqli_query($conn, $sql);

if($result){
	if (mysqli_num_rows($result)>0){
		session_start();
		$_SESSION['access']=true;
		header("Location:tables-data.php");
	}
	else{
		header("Location:page-Download-form.php");
	}
}
else{
	header("Location:page-Download-form.php");
}

ob_end_flush();

?>

