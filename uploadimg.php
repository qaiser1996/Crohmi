<?php
if (isset($_POST['submit'])){
	$file = $_FILES['file'];
	
	$fileName = $_FILES['file']['name'];
	$fileTmpName = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileError = $_FILES['file']['error'];
	$fileType = $_FILES['file']['type'];
	
	$fileName1 = $_FILES['file1']['name'];
	$fileTmpName1 = $_FILES['file1']['tmp_name'];
	$fileSize1 = $_FILES['file1']['size'];
	$fileError1 = $_FILES['file1']['error'];
	$fileType1 = $_FILES['file1']['type'];
	
	
	$fileExt = explode('.', $fileName);
	$fileActualExt = strtolower(end($fileExt));
	
	$fileExt1 = explode('.', $fileName1);
	$fileActualExt1 = strtolower(end($fileExt1));
	
	$allowed = array("jpg","png","jpeg","JPG");
	
	if (in_array($fileActualExt,$allowed)){
		if ($fileError===0){
			if($fileSize < 50000000){
				$fileNameNew = $_POST['name'].".".$fileActualExt;
				$fileDestination = 'images/uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				$command = 'python images/uploads/NDVIextraction.py images/uploads/'.$fileNameNew;
				$output = shell_exec($command);
				print($output);
				
			}
			else{
				echo "File too big";
			}
		}else{
			echo "Error uploading file";
		}
		
		
	}else{
		echo "Invalid file type, Only jpeg and png images allowed";
	}
	
	if (in_array($fileActualExt1,$allowed)){
		if ($fileError1===0){
			if($fileSize1 < 50000000){
				$fileNameNew1 = $_POST['name']."Optical."."jpg";
				$fileDestination1 = 'images/uploads/'.$fileNameNew1;
				move_uploaded_file($fileTmpName1, $fileDestination1);
				
				
			}
			else{
				echo "\nOptical File too big";
			}
		}else{
			echo "\nError uploading Optical file";
		}
		
		
	}else{
		echo "\nInvalid file type, Only jpeg and png images allowed";
	}
	
}

?>