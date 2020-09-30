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
                        <li class="active">Soil Moisture</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content mt-3">
        <div class="animated fadeIn">


            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Last week's data grouped by 8 hours interval</h4>
                            <div class="flot-container">
                                <div id="flotBar" style="width:100%;height:275px;"></div>
                            </div>
                        </div>
                    </div><!-- /# card -->
                </div><!-- /# column -->

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Last day's data grouped by 1 hour interval</h4>
                            <div class="flot-container">
                                <div id="flotCurve" style="width:100%;height:275px;"></div>
                            </div>
                        </div>
                    </div><!-- /# card -->
                </div><!-- /# column -->
            </div><!-- /# row -->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4> Real Time Data </h4>
                        </div>
                    </div>
                </div>
            </div>


            <div class="form-group">
                <label for="node">Select node to view data:</label>
                <select class="form-control" id="node">
                    <option value=1 selected>1</option>
                    <option value=2>2</option>
                    <option value=3>3</option>
                    <option value=4>4</option>
                    <option value=5>5</option>
                    <option value=6>6</option>
                    <option value=7>7</option>
                    <option value=8>8</option>
                    <option value=9>9</option>
                </select>
            </div>
            <script src="vendors/jquery/dist/jquery.min.js"></script>

            <script type="text/javascript">
                $(document).ready(function () {
                    for (let counter = 2; counter <= 9; counter++) {
                        $(`#node${counter}`).css('display', 'none');
                    }
                })

                $('#node').on('click', function () {
                    var node_no = $(this).val();
                    for (let counter = 1; counter <= 9; counter++) {
                        if (counter !== node_no) {
                            $(`#node${counter}`).css('display', 'none');
                        }
                    }
                    $(`#node${node_no}`).css('display', 'block');
                });
            </script>

            <div class="row">
                <div class="col-lg-6" style="margin:auto" id="node1">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 1</h4>
                            <div class="flot-container">
                                <div id="nodechart1" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- /# column -->

                <div class="col-lg-6" style="margin:auto" id="node2">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 2</h4>
                            <div class="flot-container">
                                <div id="nodechart2" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node3">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 3</h4>
                            <div class="flot-container">
                                <div id="nodechart3" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node4">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 4</h4>
                            <div class="flot-container">
                                <div id="nodechart4" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node5">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 5</h4>
                            <div class="flot-container">
                                <div id="nodechart5" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node6">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 6</h4>
                            <div class="flot-container">
                                <div id="nodechart6" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node7">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 7</h4>
                            <div class="flot-container">
                                <div id="nodechart7" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node8">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 8</h4>
                            <div class="flot-container">
                                <div id="nodechart8" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" style="margin:auto" id="node9">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="mb-3">Node 9</h4>
                            <div class="flot-container">
                                <div id="nodechart9" class="cpu-load"></div>
                            </div>
                        </div>
                    </div>
                </div><!-- /# column -->
            </div><!-- /# row -->


        </div><!-- .animated -->
    </div><!-- .content -->


</div><!-- /#right-panel -->

<!-- Right Panel -->


<script src="vendors/jquery/dist/jquery.min.js"></script>
<script src="vendors/popper.js/dist/umd/popper.min.js"></script>
<script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="assets/js/main.js"></script>

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
<script src="assets/js/init-scripts/flot-chart/flot-chart-SoilMois.js"></script>
<script src="assets/js/init-scripts/flot-chart/jquery.flot.axislabels.js"></script>

</body>

</html>
