<html>

<body>


<!-- Left Panel -->

<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu"
                    aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <!-- LOGO IS HERE, DO CHANGE -->
            <a class="navbar-brand" href="index.html"><img style="width:120px" src="images/logo1.png" alt="Logo"
                                                           title="Crop Health Monitoring via IoT"></a>
            <a class="navbar-brand hidden" href="index.html"><img src="images/logo2.png" alt="Logo"></a>
        </div>

        <div style="" id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="index.php"> <i class="menu-icon fa fa-dashboard"></i> Home </a>
                </li>
                <h3 class="menu-title"> Graphs </h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>IoT Data</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-AirMois.php">Humidity</a></li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-AirTemp.php">Air Temperature</a>
                        </li>
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-SoilMois.php">Soil Moisture</a>
                        </li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-SoilTemp.php">Soil Temperature</a>
                        </li>
                    </ul>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Drone Imagery Data</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="viewNDVI.php">Monthly Results - NDVI</a>
                        </li>
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="viewNRI.php">Monthly Results - NIR</a>
                        </li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="maps-ndvi.php">Satellite Map</a></li>
                    </ul>
                </li>
                <li>
                    <a href="charts-Custom.php"> <i class="menu-icon fa fa-area-chart"></i></i>Comparative Analysis </a>
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-bar-chart"></i>Predictive Analytic</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="menu-icon fa fa-line-chart"></i><a href="charts-NIRMap.php">Upload NRI Map</a>
                        </li>
                        <li><i class="menu-icon fa fa-area-chart"></i><a href="charts-HealthMap.php">Health Map</a></li>
                    </ul>
                </li>

                <h3 class="menu-title">Database</h3><!-- /.menu-title -->
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false"> <i class="menu-icon fa fa-table"></i>Data Archives</a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-table"></i><a href="tables-data.php">IoT Data Archive</a></li>
                        <li><i class="fa fa-table"></i><a href="tables-air.php">Air Data Archive</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

<!-- Left Panel -->
</body>
</html>
