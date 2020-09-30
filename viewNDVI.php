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
                            <li class="active">NDVI Map</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


		<div class="accordion" id="accordionExample">
		<?php

		$images = scandir("images/uploads/ndvi/", 1);

		$imageNames = array();
		for($i=0;$i<count($images)-2;$i++){
			$name = explode(".",$images[$i])[0];
			array_push($imageNames,$name);

		}
        $Months = array("February","March","April","May","June","July","August","September","October","November","December","January");
        $MonthsDesc = array("February 2020","March 2020","April 2019","May 2019","June 2019","July 2019","August 2019","September 2019","October 2019","November 2019","December 2019", "January 2020");

		$Num  = array("One","Two","Three","Four","Five","Six","Seven","Eight","Nine","Ten","Eleven","Twelve");


		for($i=count($Months)-1; $i>=0;$i--){
			$found = False;
			foreach ($images as $key => $val) {
					   if (strstr($val,$Months[$i])){
							$found = True;
			   }
			}
			if($found){
				echo '<div class="card">
				<div class="card-header" id="heading'.$Num[$i].'">
				  <h5 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$Num[$i].'" aria-expanded="true" aria-controls="collapse'.$Num[$i].'">
					  '.$MonthsDesc[$i].'
					  </button>
				  </h5>
				</div>
				<div id="collapse'.$Num[$i].'" class="collapse" aria-labelledby="heading'.$Num[$i].'" data-parent="#accordionExample">
				  <div class="card-body">';

				  foreach ($images as $key => $val) {
					   if (strstr($val,$Months[$i])){
							echo '<div class="col-lg-4">
							<img width="90%" style="float:left; margin: 5% 5% 0% 5%;" src="images/uploads/ndvi/'.$val.'"></img>
							<div style="clear:left"></div><div style="background:rgba(0,0,0,0.1); margin:0% 5% 5% 5%; padding:4px; text-align:center; font-size:22px;"><Button style = "margin: 5px" onclick=\'downloadFile("'."images/uploads/ndvi/".$val.'")\'>View</Button><Button style = "margin: 5px" ><a href="' . "images/uploads/ndvi/" . $val . '" download>Download</a></Button></div>
							</div>';
					   }
					}
					echo '</div>
				  <div style="clear:left"></div>
				</div>
			  </div>';

			}
		}

		/*
		for($i=0;$i<count($images)-2;$i++){
			$fileName = explode(".",$images[$i]);

			if (in_array($fileName[0], $Months)){
				echo '<div class="card">
				<div class="card-header" id="heading'.$Num[$i].'">
				  <h5 class="mb-0">
					<button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapse'.$Num[$i].'" aria-expanded="true" aria-controls="collapse'.$Num[$i].'">
					  '.$fileName[0].'
					  </button>
				  </h5>
				</div>
				<div id="collapse'.$Num[$i].'" class="collapse" aria-labelledby="heading'.$Num[$i].'" data-parent="#accordionExample">
				  <div class="card-body">
					<img width="25%" style="float:left; margin: 5% 10% 5% 15%;" src="images/uploads/'.$images[$i].'"></img>
					<img width="25%" style="float:left; margin: 5% 15% 5% 10%;" src="images/uploads/'.$fileName[0].'NDVI.jpg"></img>
				  </div>
				</div>
			  </div>';



			}
		}*/
		?>

	</div>



    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>

	<script type="text/javascript">
		function deleteFile(fileName){

			var filename = fileName;
			var xhttp = new XMLHttpRequest();
			  xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
				  alert("File Deleted Successfully!")
				  location.reload();
				}
			  };
			  xhttp.open("GET", "delete.php?filename="+fileName, true);
			  xhttp.send();

		}

		function downloadFile(fileName){
			location.replace(fileName);
		}
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
