<?php
session_start();
if (!isset($_SESSION['rss_script_admin'])) {
    header("location:login.php");
    exit;
}
error_reporting(E_ERROR);
include("../include/config.php");
include("../include/connect.php");
include("include/functions.php");
include("include/general.class.php");
include("include/upload.class.php");
include("include/pagination.php");
include("include/nocsrf.php");
$general = new General;
$general->set_connection($mysqli);
$options = $general->get_all_options();
$parts = Explode('/', $_SERVER["PHP_SELF"]);
$currenttab = $parts[count($parts) - 1];
$draft_news = $general->count_draft_news('rss');
$draft_videos = $general->count_draft_news('video');
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RSS Script LV | Dashboard</title>
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" rel="stylesheet">
    <!-- Required Fremwork -->
    <link rel="stylesheet" type="text/css" href="asset/css/bootstrap/css/bootstrap.min.css">
    <!-- themify-icons line icon -->
    <link rel="stylesheet" type="text/css" href="asset/icon/themify-icons/themify-icons.css">
    <!-- ico font -->
    <link rel="stylesheet" type="text/css" href="asset/icon/icofont/css/icofont.css">
    <!-- Style.css -->
    <link rel="stylesheet" type="text/css" href="asset/css/style.css">
    <link rel="stylesheet" type="text/css" href="asset/css/jquery.mCustomScrollbar.css">
    <link rel="stylesheet" href="asset/css/style.css">
    
    <!-- script start-->
    <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
    <script type="text/javascript" src="asset/js/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="asset/js/jquery-ui/jquery-ui.min.js"></script>
    <script type="text/javascript" src="asset/js/popper.js/popper.min.js"></script>
    <script type="text/javascript" src="asset/js/bootstrap/js/bootstrap.min.js"></script>
    <!-- jquery slimscroll js -->
    <script type="text/javascript" src="asset/js/jquery-slimscroll/jquery.slimscroll.js"></script>
    <!-- modernizr js -->
    <script type="text/javascript" src="asset/js/modernizr/modernizr.js"></script>
    <!-- am chart -->
    <script src="asset/pages/widget/amchart/amcharts.min.js"></script>
    <script src="asset/pages/widget/amchart/serial.min.js"></script>
    <!-- Todo js -->
    <script type="text/javascript " src="asset/pages/todo/todo.js "></script>
    <!-- Custom js -->
    <script type="text/javascript" src="asset/pages/dashboard/custom-dashboard.js"></script>
    <script type="text/javascript" src="asset/js/script.js"></script>
    <script type="text/javascript " src="asset/js/SmoothScroll.js"></script>
    <script src="asset/js/pcoded.min.js"></script>
    <script src="asset/js/demo-12.js"></script>
    <script src="asset/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script>
        
        if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
    </script>
    <!-- script end-->
    <script src="asset/js/raphael/raphael.min.js"></script>
    <script src="asset/js/morris.js/morris.js"></script>
    <!-- Custom js -->
   
  
</head>

<body>
<div class="theme-loader">
    <div class="ball-scale">
        <div class='contain'>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
            <div class="ring"><div class="frame"></div></div>
        </div>
    </div>
</div>

    <div id="pcoded" class="pcoded">
        <div class="pcoded-overlay-box"></div>
        <div class="pcoded-container navbar-wrapper">

            <nav class="navbar header-navbar pcoded-header">
                <div class="navbar-wrapper">

                    <div class="navbar-logo">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.html">
                            <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo" />
                        </a>
                        <a class="mobile-options">
                            <i class="ti-more"></i>
                        </a>
                    </div>

                    <div class="navbar-container container-fluid">
                        <ul class="nav-left">
                            <li>
                                <div class="sidebar_toggle"><a href="javascript:void(0)"><i class="ti-menu"></i></a></div>
                            </li>

                            <li>
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                           
                            <li class="user-profile header-notification">
                                <a href="#!">
                                  
                                    <span>John Doe</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    
                                    <li>
                                        <a href="#">
                                        <i class="fas fa-key"></i></i>Change password 
                                        </a>
                                    </li>
                                    
                                    
                                   
                                    <li>
                                        <a href="auth-normal-sign-in.html">
                                            <i class="ti-layout-sidebar-left"></i> Logout
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>

                    </div>
                </div>
            </nav>

            <div class="pcoded-main-container">
                <div class="pcoded-wrapper">
                    <nav class="pcoded-navbar">
                        <div class="sidebar_toggle"><a href="#"><i class="icon-close icons"></i></a></div>
                        <div class="pcoded-inner-navbar main-menu mt-4">
                            
                            
                        <ul class="pcoded-item pcoded-left-item">
                        <li class="active">
                                    <a href="index.php" class="sidenav">
                                        <span class="pcoded-micon"><i class="fas fa-list"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Dashboard</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="sitelist.php" class="sidenav">
                                        <span class="pcoded-micon"><i class="fas fa-list"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Website list</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="create.php" class="sidenav">
                                        <span class="pcoded-micon"><i class="fas fa-plus-square"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Create website</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="index.html" class="sidenav">
                                        <span class="pcoded-micon"><i class="ti-home"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">DFY</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="index.html" class="sidenav">
                                        <span class="pcoded-micon"><i class="fas fa-video"></i><b>D</b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Traning</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="index.html" class="sidenav">
                                        <span class="pcoded-micon"><i class="fas fa-phone-square"></i><b></b></span>
                                        <span class="pcoded-mtext" data-i18n="nav.dash.main">Support</span>
                                        <span class="pcoded-mcaret"></span>
                                    </a>
                                </li>

                            </ul>


                        </div>
                    </nav>

                </div>
            </div>
        </div>
    