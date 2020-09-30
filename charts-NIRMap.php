<!doctype html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" lang=""> <![endif]-->
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

<?php include 'sidebar.php' ?>

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
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="notification"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
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


            <div class="col-sm-8">
                <p style="font-size:24px; color:#444444; font-variant:small-caps; font-weight:450; margin-bottom:0px; margin-top:12px; ">
                    Crop Health Monitoring using IoT </p>

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
                        <li class="active">NIR Map Upload</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <form class="needs-validation" onsubmit="postImage(event)">
                <div class="container">
                    <div class="form-group">
                        <label for="nriMonth">Select Month</label>
                        <select class="form-control" id="nriMonth">
                            <option value=1 selected>January</option>
                            <option value=11>November</option>
                            <option value=12>December</option>
                        </select>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="nriImage" required onchange="getFileName()">
                        <label class="custom-file-label" for="nriImage" id="nriImageLabel">Choose file</label>
                        <div class="invalid-feedback">Please select NRI Image</div>
                    </div>
                    <div style="margin-top: 10px;">
                        <button class="btn btn-outline-dark btn-block" type="submit">Upload</button>
                    </div>
                </div>
            </form>
            <div class="container" style="display: flex; justify-content: left; margin-top: 30px">
                <button id="switch" onclick="switchToHealthMap()">Switch to Health Map >></button>
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
    var responseData;
    var isHealthMap = false;

    document.getElementById("ndvi_map").style.display = "none";
    document.getElementById("loader").style.display = "none";
    document.getElementById("switch").style.display = "none";

    function getFileName() {
        var filename = document.getElementById('nriImage').files[0].name;
        document.getElementById('nriImageLabel').innerHTML = filename;
    }

    function postImage(e) {
        document.getElementById("loader").style.display = "block";
        document.getElementById("ndvi_map").style.display = "none";
        var data = new FormData();
        data.append('nri_image', document.getElementById('nriImage').files[0]);
        data.append('month', parseInt(document.getElementById('nriMonth').selectedOptions[0].value));


        var xhr = new XMLHttpRequest();
        xhr.responseType = 'json';
        xhr.open('POST', 'http://128.199.184.77:8001/api/crohmi/ndvi/map/', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                responseData = xhr.response;
                document.getElementById("uploadedImage").src = xhr.response['nri_image'];
                document.getElementById("ndviImage").src = xhr.response['ndvi_image'];

                document.getElementById("ndvi_map").style.display = "block";
                document.getElementById("switch").style.display = "block";

                document.getElementById("loader").style.display = "none";
            }
        }
        xhr.send(data);

        xhr.onload = function () {
        }

        e.preventDefault();
    }

    function switchToHealthMap() {
        if (isHealthMap) {
            document.getElementById("uploadedImage").src = responseData['nri_image'];
            document.getElementById("ndviImage").src = responseData['ndvi_image'];
            document.getElementById("switch").innerText = "Switch to Health Map >>";
        } else {
            document.getElementById("uploadedImage").src = responseData['ndvi_image'];
            document.getElementById("ndviImage").src = responseData['health_map'];
            document.getElementById("switch").innerText = "Switch to NRI Map >>";
        }
        isHealthMap = !isHealthMap;
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
