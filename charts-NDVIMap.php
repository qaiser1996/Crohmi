<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Crop Health Monitoring</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="licon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

</head>

<body>

	<!-- Left Panel -->

    <?php include 'sidebar.php'?>

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
        <header id="header" class="header">

            <div class="header-menu">

                <div class="col-sm-4">
                    <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                    <div class="header-left">
                        <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">0</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 0 Notification</p><!--
                                <a class="dropdown-item media bg-flat-color-1" href="#">
                                <i class="fa fa-check"></i>
                                <p>Server #1 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-4" href="#">
                                <i class="fa fa-info"></i>
                                <p>Server #2 overloaded.</p>
                            </a>
                                <a class="dropdown-item media bg-flat-color-5" href="#">
                                <i class="fa fa-warning"></i>
                                <p>Server #3 overloaded.</p>
                            </a>-->
                            </div>
                        </div>
                    </div>

                </div>



                <div class="col-sm-8" >
                    <p style="font-size:24px; color:#444444; font-variant:small-caps; font-weight:450; margin-bottom:0px; margin-top:12px; "> Crop Health Monitoring using IoT </p>

                </div>
            </div>

        </header><!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li class="active">NDVI Map Upload</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
            		<div class="container">
            			<div class="form-group">
  							<label for="nriMonth">Select Month</label>
							<select class="form-control" name="ndviMonth" id="ndviMonth">
							<option value="January" selected>January</option>
      						<option value="November">November</option>
      						<option value="December">December</option>
    						</select>
 						</div>

            			<div class="custom-file">
  							<input type="file" class="custom-file-input" name="ndviImage" id="ndviImage" required onchange="getFileName()">
  							<label class="custom-file-label" for="nriImage" id="nirImageLabel">Choose file</label>
  							<div class="invalid-feedback">Please select NIR Image</div>
						</div>
						<div style="margin-top: 10px;">
							<button class="btn btn-outline-dark btn-block" type="button" name="submit" id="upload">Upload</button>
						</div>
            		</div>
            	<div class="container" style="margin-top: 10px" id="ndvi_map">
            		<img src="" style="width: 40%;" id="uploadedImage">
            		<i class="fa fa-arrow-right" style="font-size: 25px; width: 10%; padding-left: 8%"></i>
            		<img src="" style="width: 40%; float: right;" id="ndviImage">
            	</div>
            	<div container="contianer" id="loader" style="margin-left: 48%; margin-top: 100px">
            		<i class="fa fa-spinner fa-pulse" style="font-size: 40px"></i>
            	</div>
            </div><!-- .animated -->
        </div><!-- .content -->
    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>
    <script type="text/javascript">
    	document.getElementById("ndvi_map").style.display = "none";
    	document.getElementById("loader").style.display = "none";
    	function getFileName() {
    		 var filename = document.getElementById('ndviImage').files[0].name;
    		 document.getElementById('nirImageLabel').innerHTML = filename;
    	}

		jQuery(document).ready(function ($) {
		$('#upload').on('click', function() {
			var file_data = $('#ndviImage').prop('files')[0];
			document.getElementById("loader").style.display = "block";
			var form_data = new FormData();
			form_data.append('ndviImage', file_data);
			form_data.append('ndviMonth', $( "#ndviMonth option:selected" ).val());
			form_data.append('submit', '1');
			$.ajax({
				url: 'upload_ndvi.php', // point to server-side PHP script
				dataType: 'text',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,
				type: 'post',
				success: function(php_script_response){
					alert(php_script_response);
					document.getElementById("loader").style.display = "none";
				}
			 });
		});
		});

		/*jQuery(document).ready(function ($) {
		$("#uploadForm").on('submit', function(e){
		document.getElementById("loader").style.display = "block";
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: 'upload.php',
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            cache: false,
            processData:false,
            beforeSend: function(){
				console.log("Sending...")
                $('.submitBtn').attr("disabled","disabled");
                $('#uploadForm').css("opacity",".5");
            },
            success: function(response){
			console.log(response);
                $('.statusMsg').html('');
                if(response.status == 1){
                    $('#uploadForm')[0].reset();
                    $('.statusMsg').html('<p class="alert alert-success">'+response.message+'</p>');
                }else{
                    $('.statusMsg').html('<p class="alert alert-danger">'+response.message+'</p>');
                }
                $('#uploadForm').css("opacity","");
                $(".submitBtn").removeAttr("disabled");
            }
				});
			});
		});*/

		/*function postImage(e) {

			var data = new FormData();
			data.append('nir_image', document.getElementById('nriImage').files[0]);
			data.append('month', parseInt(document.getElementById('nriMonth').selectedOptions[0].value));



			/*var xhr = new XMLHttpRequest();
			xhr.responseType = 'json';
			xhr.open('POST', 'uploadimg.php', true);
			xhr.onreadystatechange = function () {
				if (xhr.readyState == 4) {
					document.getElementById("uploadedImage").src = xhr.response['nir_image'];
					document.getElementById("nirImage").src = xhr.response['ndvi_image'];
					document.getElementById("ndvi_map").style.display = "block";
    				document.getElementById("loader").style.display = "none";
    			}
			}
			xhr.send(data);

			xhr.onload = function() {}

			e.preventDefault();
		}*/
	</script>

    <!--  flot-chart js -->
    <script src="vendors/flot/excanvas.min.js"></script>
    <script src="vendors/flot/jquery.flot.js"></script>
    <script src="vendors/flot/jquery.flot.pie.js"></script>
    <script src="vendors/flot/jquery.flot.time.js"></script>
    <script src="vendors/flot/jquery.flot.stack.js"></script>
    <script src="vendors/flot/jquery.flot.resize.js"></script>
    <script src="vendors/flot/jquery.flot.crosshair.js"></script>
    <script src="assets/js/init-scripts/flot-chart/curvedLines.js"></script>
    <script src="assets/js/init-scripts/flot-chart/flot-tooltip/jquery.flot.tooltip.min.js"></script>
    <script src="assets/js/init-scripts/flot-chart/flot-chart-SoilTemp.js"></script>

</body>

</html>
