
<?php
$response = array( 
    'status' => 0, 
    'message' => 'Form submission failed, please try again.' 
); 
$target_dir = "images/uploads/";
$target_file = '';
$month = '';
$uploadOk = 1;
$imageFileType = '';
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
	$month = $_POST['nirMonth'];
	$target_dir = $target_dir.$month.'/';
	$temp = explode(".", $_FILES["nirImage"]["name"]);
	$newfilename = round(microtime(true)) . '.' . end($temp);
	
	$target_file = $target_dir.$newfilename;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    $check = getimagesize($_FILES["nirImage"]["tmp_name"]);
    if($check !== false) {
		//response['message'] = "File is an image - " . $check["mime"] . ".";
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
}

if(!file_exists($target_dir)){
        mkdir($target_dir, 0777, true);
}

// Check file size
#if ($_FILES["nirImage"]["size"] > 500000) {
#    echo "Sorry, your file is too large.";
#    $uploadOk = 0;
#}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG, & PNG files are allowed.".$imageFileType;
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["nirImage"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["nirImage"]["name"]). " has been uploaded.";
    }
    else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
