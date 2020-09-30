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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

    <title>Overlaying an Image Map Type</title>
    <style>
        /* Always set the map height explicitly to define the size of the div
         * element that contains the map. */
        #map {
            height: 800px;
        }

        /* Optional: Makes the sample page fill the window. */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }
    </style>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCrvECKXyuCwA5sBu0ld4MI8fGyvLs3kxE"></script>

    <script type="text/javascript">
        let months = ["January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"];

        let isVisible = true;
        let currentSrc = "";

        function changeIframe() {
            let iframe = document.getElementById('monthIframe');
            if (isVisible) {
                iframe.src = 'images/none.html';
                isVisible = false;
            } else {
                isVisible = true;
                iframe.src = currentSrc;
            }
        }

        let xhr = new XMLHttpRequest();
        xhr.responseType = 'json';
        xhr.open('GET', 'http://128.199.184.77:8001/api/crohmi/satellite/image/', true);
        xhr.onreadystatechange = function () {
            if (xhr.readyState === 4) {
                responseData = xhr.response;
                let monthDiv = document.getElementById('monthSelect');
                let iframe = document.getElementById('monthIframe');
                monthDiv.onchange = function (e) {
                    let response = responseData;
                    let option = e.target[e.target['selectedIndex'].toString()];

                    for (let i in response) {
                        if (option.value === response[i]['month'].toString()) {
                            let month = months[option.value - 1];
                            currentSrc = `images/${month}/index.html#${month}/gmaps.embed`;
                            iframe.src = currentSrc;
                            isVisible = true;
                        }
                    }
                }
                for (let counter in responseData) {
                    if (counter === '0') {
                        let month = months[responseData[0]['month'] - 1];
                        currentSrc = `images/${month}/index.html#${month}/gmaps.embed`;
                        iframe.src = currentSrc;
                    }
                    let satelliteImage = responseData[counter];
                    let option = document.createElement('option');
                    option.value = satelliteImage['month'];
                    option.innerHTML = months[option.value - 1];
                    monthDiv.appendChild(option);
                }
            }
        }
        xhr.send();

        xhr.onload = function () {
        }
    </script>

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
                        <li class="active">Map</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div id="no-show" hidden></div>
        <div class="row">
            <div class="col-md-9">
                <div class="form-group">
                    <select class="form-control" id="monthSelect">
                    </select>
                </div>
            </div>
            <div class="col-md-2 offset-1">
                <div id="floating-panel" style="margin-bottom: 10px">
                    <input type="button" value="Toggle visibility"
                           onclick="changeIframe()"></input>
                </div>
            </div>
        </div>
        <iframe id="monthIframe" src=""
                style="width: 100%; height: 450px;">
        </iframe>
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>


</body>

</html>
