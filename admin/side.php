<?php
session_start();
if(!isset($_SESSION['rss_script_admin'])) {
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

	<link rel="icon" href="asset/images/favicon.ico" type="image/x-icon">
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
	  <!-- script start-->
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
var $window = $(window);
var nav = $('.fixed-button');
    $window.scroll(function(){
        if ($window.scrollTop() >= 200) {
         nav.addClass('active');
     }
     else {
         nav.removeClass('active');
     }
 });
</script>
<!-- script end-->
</head>
<body>

<div id="pcoded" class="pcoded">
<nav class="navbar header-navbar pcoded-header iscollapsed" header-theme="theme1" pcoded-header-position="fixed">
                <div class="navbar-wrapper">

                    <div class="navbar-logo" logo-theme="theme1">
                        <a class="mobile-menu" id="mobile-collapse" href="#!">
                            <i class="ti-menu"></i>
                        </a>
                        <a class="mobile-search morphsearch-search" href="#">
                            <i class="ti-search"></i>
                        </a>
                        <a href="index.html">
                            <img class="img-fluid" src="assets/images/logo.png" alt="Theme-Logo">
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

                            <li class="">
                                <a href="#!" onclick="javascript:toggleFullScreen()">
                                    <i class="ti-fullscreen"></i>
                                </a>
                            </li>
                        </ul>
                        <ul class="nav-right">
                            <li class="header-notification">
                                <a href="#!">
                                    <i class="ti-bell"></i>
                                    <span class="badge bg-c-pink"></span>
                                </a>
                                <ul class="show-notification">
                                    <li>
                                        <h6>Notifications</h6>
                                        <label class="label label-danger">New</label>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">John Doe</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-3.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Joseph William</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="media">
                                            <img class="d-flex align-self-center img-radius" src="assets/images/avatar-4.jpg" alt="Generic placeholder image">
                                            <div class="media-body">
                                                <h5 class="notification-user">Sara Soudein</h5>
                                                <p class="notification-msg">Lorem ipsum dolor sit amet, consectetuer elit.</p>
                                                <span class="notification-time">30 minutes ago</span>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                            <li class="user-profile header-notification">
                                <a href="#!">
                                    <img src="assets/images/avatar-4.jpg" class="img-radius" alt="User-Profile-Image">
                                    <span>John Doe</span>
                                    <i class="ti-angle-down"></i>
                                </a>
                                <ul class="show-notification profile-notification">
                                    <li>
                                        <a href="#!">
                                            <i class="ti-settings"></i> Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-user"></i> Profile
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-email"></i> My Messages
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <i class="ti-lock"></i> Lock Screen
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
</div>
        
        
<div class="container-fluid">
<div class="row">
<div class="col-sm-2">
<div class="list-group" style="margin-top:100px;">
  <a href="index.php" class="list-group-item <?php if ($currenttab == 'index.php') {echo 'active';} ?>"><span class="fa fa-dashboard fa-fw"></span>Dashboard</a>
  <a href="categories.php" class="list-group-item <?php if ($currenttab == 'categories.php') {echo 'active';} ?>"><span class="fa fa-folder fa-fw"></span>Categories</a>
  <a href="sources.php" class="list-group-item <?php if ($currenttab == 'sources.php') {echo 'active';} ?>"><span class="fa fa-rss fa-fw"></span>Sources</a>
  <a href="channels.php" class="list-group-item <?php if ($currenttab == 'channels.php') {echo 'active';} ?>"><span class="fa fa-th-large fa-fw"></span>Channels</a>
  <a href="news.php" class="list-group-item <?php if ($currenttab == 'news.php') {echo 'active';} ?>"><span class="fa fa-newspaper-o fa-fw"></span>News</a>
  <a href="videos.php" class="list-group-item <?php if ($currenttab == 'videos.php') {echo 'active';} ?>"><span class="fa fa-youtube-play fa-fw"></span>Videos</a>
  <a href="weather.php" class="list-group-item <?php if ($currenttab == 'weather.php') {echo 'active';} ?>"><span class="fa fa-sun-o fa-fw"></span>Weather</a>
  <a href="polls.php" class="list-group-item <?php if ($currenttab == 'polls.php') {echo 'active';} ?>"><span class="fa fa-pie-chart fa-fw"></span>Polls</a>
  <a href="pages.php" class="list-group-item <?php if ($currenttab == 'pages.php') {echo 'active';} ?>"><span class="fa fa-file fa-fw"></span>Pages</a>
  <a href="links.php" class="list-group-item <?php if ($currenttab == 'links.php') {echo 'active';} ?>"><span class="fa fa-link fa-fw"></span>Links</a>
  <a href="advertisements.php" class="list-group-item <?php if ($currenttab == 'advertisements.php') {echo 'active';} ?>"><span class="fa fa-photo fa-fw"></span>Ads</a>
  <a href="sitemaps.php" class="list-group-item <?php if ($currenttab == 'sitemaps.php') {echo 'active';} ?>"><span class="fa fa-sitemap fa-fw"></span>Sitemaps</a>
</div>
</div>
<div class="col-sm-10">
<div id="log"></div> 



