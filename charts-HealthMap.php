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
                        <li class="active">Health Map</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">
            <div class="container" style="justify-content: center; display: flex;">
                <h5>Showing Health Map for latest NRI Images uploaded</h5>
            </div>

            <div class="form-group">
                <label for="node">Select month:</label>
                <select class="form-control" id="month">
                    <option value=1 selected>January</option>
                    <option value=11>November</option>
                    <option value=12>December</option>
                </select>
            </div>

            <div class="container" style="margin-top: 10px" id="ndvi_map">
                <img src="" style="width: 40%;" id="ndviImage">
                <i class="fa fa-arrow-right" style="font-size: 25px; width: 10%; padding-left: 8%"></i>
                <img src="" style="width: 40%; float: right;" id="healthMap">
            </div>
            <div class="container" id="loader" style="margin-left: 48%; margin-top: 100px">
                <i class="fa fa-spinner fa-pulse" style="font-size: 40px"></i>
            </div>
        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script type="text/javascript">
    document.getElementById("ndvi_map").style.display = "none";
    document.getElementById("loader").style.display = "block";

    var data = [];
    getLastHealthMap();

    function getLastHealthMap() {
        var xhr = new XMLHttpRequest();
        xhr.responseType = 'json';
        xhr.open('GET', 'http://128.199.184.77:8001/api/crohmi/ndvi/map/?distinct=month');
        xhr.send();
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                data = xhr.response;
                document.getElementById("ndvi_map").style.display = "block";
                document.getElementById("loader").style.display = "none";

                var obj = data.find(ele => {
                    return ele["month"] === 1;
                });
                document.getElementById("ndviImage").src = obj['ndvi_image'];
                document.getElementById("healthMap").src = obj['health_map'];
            }
        }
    }

    $('#month').on('click', function () {
        var month = $(this).val();
        console.log(month);
        console.log(data);
        var obj = data.find(ele => {
            return ele["month"] === parseInt(month);
        });

        console.log(obj);

        document.getElementById("ndviImage").src = obj["ndvi_image"];
        document.getElementById("healthMap").src = obj["health_map"];
    });
</script>

<!--  flot-chart js -->
</body>

</html>
