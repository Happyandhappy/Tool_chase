<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Chasedata portal</title>
    <!-- Favicon-->
    <link rel="icon" href="https://www.chasedatacorp.com/Content/img/shared/favicon.png" type="image/x-icon">

 	<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="assets/vendors/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="assets/vendors/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="assets/vendors/animate-css/animate.css" rel="stylesheet" />

    <!-- Wait Me Css -->
    <link href="assets/vendors/waitme/waitMe.css" rel="stylesheet" />
    
    <!-- JQuery DataTable Css -->
    <link href="assets/vendors/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- Custom Css -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="assets/css/all-themes.css" rel="stylesheet" />

    <!-- Custom CSS -->
    <link href="assets/css/custom.css" rel="stylesheet" />
</head>
<body class="theme-light-blue">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->

    <!-- Page Loader -->
    <div class="page-loader" style="display: none;">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- #END# Page Loader -->


    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>
    <!-- #END# Overlay For Sidebars -->


    <!-- Top Bar -->
    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="main.php">
                    <img src="https://www.chasedatacorp.com/Content/img/shared/logo-header.png" height="35">
                    <!-- ChaseData Portal -->
                </a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse">
                <ul class="nav navbar-nav navbar-right">
                    <!-- Tasks -->
                    <li class="dropdown">
                        <a href="logout.php">
                            <i class="material-icons">settings_power</i>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- #Top Bar -->



    <!-- #Top Bar -->
    <section>
        <!-- Left Sidebar -->
        <aside id="leftsidebar" class="sidebar">
            <!-- Menu -->
            <div class="menu">
                <ul class="list">
                    <li class="header">MAIN NAVIGATION</li>

                    <!-- Home menu -->
                    <li class="<?php if ($page == 'Home') echo 'active' ?>">
                        <a href="main.php">
                            <i class="material-icons">home</i>
                            <span>Home</span>
                        </a>
                    </li>

                    <!-- Credentials menu -->
                    <li class="<?php if ($page == 'Cred') echo 'active' ?>">
                        <a href="settings.php">
                            <i class="material-icons">settings</i>
                            <span>Change Credentials</span>
                        </a>
                    </li>
                    
                    <!-- Account menu -->
                    <!-- <li class="<?php if ($page == 'Account') echo 'active' ?>">
                        <a href="account.php">
                            <i class="material-icons">vpn_key</i>
                            <span>Account</span>
                        </a>
                    </li> -->

                    <!-- Logout menu -->
                    <li>
                        <a href="logout.php">
                            <i class="material-icons">settings_power</i>
                            <span>Log Out</span>
                        </a>
                    </li>
                </ul>
            </div>
            <!-- #Menu -->
        </aside>
        <!-- #END# Left Sidebar -->
    </section>
