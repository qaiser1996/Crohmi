<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

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
                            <li class="active">Custom Chart</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">
				<div class="row">
					<div class="col-lg-6">
						<div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Select first parameter</label></div>
							<div class="col-12 col-md-9">
								<select name="param1" id="param1" class="form-control">
									<option selected value="air_temperature">Air Temperature</option>
									<option value="air_moisture">Humidity</option>
									<option value="soil_temperature">Soil Temperature</option>
									<option value="soil_moisture">Soil Moisture</option>
								</select>
							</div>
						</div>
					</div>

					<div class="col-lg-6">
						<div class="row form-group">
							<div class="col col-md-3"><label for="select1" class=" form-control-label">Select second parameter</label></div>
							<div class="col-12 col-md-9">
								<select name="param2" id="param2" class="form-control">
                                    <option selected value="air_temperature">Air Temperature</option>
                                    <option value="air_moisture">Humidity</option>
                                    <option value="soil_temperature">Soil Temperature</option>
                                    <option value="soil_moisture">Soil Moisture</option>
								</select>
							</div>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-lg-6">
						<div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Select 30 days chart type:</label></div>
							<div class="col-12 col-md-9">
								<select name="select" id="select2" class="form-control">
									<option selected="selected" value="line">Line Chart</option>
									<option value="bar">Bar Chart</option>
								</select>
							</div>
						</div>
					</div>
					<div class="col-lg-6">
						<div class="row form-group">
							<div class="col col-md-3"><label for="select1" class=" form-control-label">Select 3 months chart type:</label></div>
							<div class="col-12 col-md-9">
								<select name="select1" id="select3" class="form-control">
									<option value="line">Line Chart</option>
									<option selected="selected" value="bar">Bar Chart</option>
								</select>
							</div>
						</div>
					</div>
				</div>


                <div class="row">
                    <div class="col-lg-6">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select Pole No:</label></div>
                            <div class="col-12 col-md-9">
                                <select name="select" id="polNo1" class="form-control">
                                    <option selected="selected" value="all">All Poles</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="row form-group">
                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select Pole No:</label></div>
                            <div class="col-12 col-md-9">
                                <select name="select" id="polNo2" class="form-control">
                                    <option selected="selected" value="all">All Poles</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

				<div class="row">
					<div class="col-lg-12">
						<div class="row form-group">
							<div class="col col-md-3"><label for="select" class=" form-control-label">Select Regression Type:</label></div>
							<div class="col-12 col-md-9">
								<select name="select" id="regressionType" class="form-control">
									<option selected="selected" value="poln1">Linear Regression</option>
									<option value="poln2">Polynomial Regression - (n=2)</option>
									<option value="poln3">Polynomial Regression - (n=3)</option>
								</select>
							</div>
						</div>
					</div>
				</div>

                <div class="row" style="padding-bottom:12px;">
					<button id="GoButton" style="margin:auto; color:#111111"> Go </button>
				</div>

				<div class="row">

                    <div class="col-lg-6">
                        <div class="card" id="CustLine">
                            <div class="card-body" id="sales-chart-div">
                                <h4 class="mb-3">Last 30 days comparison grouped by 1 day interval</h4>
                                <canvas height="150px" id="sales-chart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                    <div class="col-lg-6">
                        <div class="card" id="CustBar">
                            <div class="card-body" id="barChart-div">
                                <h4 class="mb-3">Last 3 months comparison grouped by 10 days interval</h4>
                                <canvas height="150px" id="barChart"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->


                </div>

            </div><!-- .animated -->

            <div class="row">

                    <div class="col-lg-6">
                        <div class="card" id="CustLine">
                            <div class="card-body" id="sales-chart-cor-div">
                                <h4 class="mb-3">Corresponding Correlation </h4>
                                <canvas height="150px" id="cor1"></canvas>
                            </div>
                        </div>
                    </div><!-- /# column -->

                     <div class="col-lg-6">
                        <div class="card" id="CustBar">
                            <div class="card-body" id="barChart-cor-div">
                                <h4 class="mb-3">Corresponding Correlation </h4>
                                <canvas height="150px" id="cor2"></canvas>
                            </div>
                        </div>
                    </div> -->


                </div>

            </div><!-- .animated -->

        </div><!-- .content -->


    </div><!-- /#right-panel -->

    <!-- Right Panel -->


    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/numeric/1.2.6/numeric.min.js"></script>
    <script src="assets/js/main.js"></script>
    <!--  Chart js -->
    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>


    <script src="assets/js/init-scripts/chart-js/chartjs-Custom.js"></script>

</body>

</html>
