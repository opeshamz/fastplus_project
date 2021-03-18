<?php

/*error_reporting(E_ERROR);
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
$draft_videos = $general->count_draft_news('video');*/
include('controllers/videosubmit.php');
//include('controllers/imageadssubmit.php')
?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assetss/images/favicon.png" type="image/x-icon">
    <link rel="shortcut icon" href="assetss/images/favicon.png" type="image/x-icon">
    <title>viral grove</title>
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="assetss/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="assetss/css/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="assetss/css/feather-icon.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/animate.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="assetss/css/chartist.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/date-picker.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/prism.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/material-design-icon.css">
    <link rel="stylesheet" type="text/css" href="assetss/css/pe7-icon.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/style.css">
    <link id="color" rel="stylesheet" href="assetss/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="assetss/css/responsive.css">
    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>
</head>

<body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
        <div class="typewriter">
            <h1>New Era Admin Loading..</h1>
        </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <!-- Page Header Start-->

        <div class="page-main-header">
            <div class="main-header-right">
                <div class="main-header-left text-center">
                    <div class="logo-wrapper"><a href="index.php"><img src="assetss/images/logo/logo.png" alt=""></a></div>
                </div>
                <div class="mobile-sidebar">
                    <div class="media-body text-right switch-sm">
                        <label class="switch ml-3"><i class="font-primary" id="sidebar-toggle" data-feather="align-center"></i></label>
                    </div>
                </div>
                <div class="vertical-mobile-sidebar"><i class="fa fa-bars sidebar-bar"> </i></div>
                <div class="nav-right col pull-right right-menu">
                    <ul class="nav-menus">
                        <li>

                        </li>
                        <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>




                        <li class="onhover-dropdown"> <span class="media user-header"><img class="img-fluid" src="assetss/images/dashboard/user.png" alt=""></span>
                            <ul class="onhover-show-div profile-dropdown">
                                <li class="gradient-primary">
                                    <h5 class="f-w-600 mb-0">Elana Saint</h5><span>Web Designer</span>
                                </li>
                                <li><i data-feather="user"></i><a href="">logout </a></li>
                                <li><i data-feather="message-square"> </i><a href="">Change password</a>

                            </ul>
                        </li>
                    </ul>
                    <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
                </div>
                <script id="result-template" type="text/x-handlebars-template">
                    <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><i class="pe-7s-home"></i></div>
            <div class="ProfileCard-details">c
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
                <script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
            </div>
        </div>
        Page Header Ends -->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="iconsidebar-menu">
                <div class="sidebar">
                    <ul class="iconMenu-bar custom-scrollbar">
                        <li><a class="bar-icons" href="javascript:void(0)">
                                <!--img(src='../assets/images/menu/home.png' alt='')--><i class="pe-7s-home"></i><span>General </span>
                            </a>
                            <ul class="iconbar-mainmenu custom-scrollbar">
                                <li class="iconbar-header">Dashboard</li>
                                <li>
                                    <a href="index.php">Default</a>
                                </li>
                                <li><a href="categories.php">categories</a></li>
                                <li><a href="sources.php">sources</a></li>
                                <li><a href="channels.php">channels</a></li>
                                <li><a href="news.php">new</a></li>
                                <li><a href="videos.php">video</a></li>
                                <li><a href="video_ads.php">video ads</a></li>
                                <li><a href="manage_video_ads.php">manage video ads</a></li>
                                <li><a href="weather.php">weather</a></li>
                                <li><a href="polls.php">polls</a></li>
                                <li><a href="pages.php">pages</a></li>
                                <li><a href="links.php">links</a></li>
                                <li><a href="advertisements.php">advertisments</a></li>
                                <li><a href="sitemaps.php">sitemaps</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- Page Sidebar Ends-->

            <div class="page-body">

                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5><i class="fas fa-video"></i>Video ads</h5>

                                    <?php
                                    include('controllers/sucess.php');
                                    include('controllers/error.php');
                                    /*if (count($sucess) > 0) : ?>
                                        <div class="sucess" style="color: green; text-align:center; width:70px; background-color:green;">
                                            <?php foreach ($sucess as $sucess) : ?>
                                                <h3><?php echo $sucess ?></h3>
                                            <?php endforeach ?>
                                        </div>
                                    <?php endif */ ?>

                                </div>
                                <div style="margin-right:50px; margin-left:50px; margin-bottom:30px;">
                                    <!-- begning of php new-->



                                    <p></p>
                                    <form action="" method="POST" enctype="multipart/form-data">

                                        <div>
                                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-ads" role="tab" aria-controls="pills-home" aria-selected="true">Ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-image" role="tab" aria-controls="pills-profile" aria-selected="false">Images ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-google" role="tab" aria-controls="pills-profile" aria-selected="false">Google ads</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-cta" role="tab" aria-controls="pills-contact" aria-selected="false">CTAs</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-button" role="tab" aria-controls="pills-contact" aria-selected="false">Buy buttons</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="pills-contact-tab" data-toggle="pill" href="#pills-option" role="tab" aria-controls="pills-contact" aria-selected="false">Optin form</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" id="pills-tabContent">
                                                <!-- ads-->
                                                <div class="tab-pane fade show active" id="pills-ads" role="tabpanel" aria-labelledby="pills-home-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Ads title</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="title" class="form-control form-control" placeholder="Ads title" require>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Ads name</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="name" class="form-control form-control" placeholder="Ads name" require>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Upload video</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="video" class="form-control form-control" placeholder="Upload video" require>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Thumbnail</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="thumbnail" class="form-control form-control" placeholder="Thumbnail" require>
                                                        </div>
                                                        <div style="margin:20px;">
                                                            <button type="submit" name="submitads" class="btn btn-primary">submit</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- images ads-->
                                                <div class="tab-pane fade" id="pills-image" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select name="imagedisplay" class="form-control" id="sel1">
                                                                <option value="Begining of video">Begining of video</option>
                                                                <option value="End">End</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Adertising Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="text" name="ads_link" class="form-control form-control" placeholder="Adertising Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Adertising Image</label>
                                                        <div class="col-sm-10">
                                                            <input type="file" name="ads_image" class="form-control form-control" placeholder="Adertising Image">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Position</label>
                                                        <div class="col-sm-10">
                                                            <select name="imageposition" class="form-control" id="sel1">
                                                                <option value="Top left">Top left</option>
                                                                <option value="Top">Top</option>
                                                                <option value="Top right">Top right</option>
                                                                <option value="Right">Right</option>
                                                                <option value="Buttom right">Buttom right</option>
                                                                <option value="Buttom">Buttom</option>
                                                                <option value="Buttom left">Buttom left</option>
                                                                <option value="Left">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin:20px;">
                                                        <button type="submit" name="submitImageads" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <!-- google ads-->
                                                <div class="tab-pane fade" id="pills-google" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Adertising Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="adertising_link" class="form-control form-control" placeholder="Adertising Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Adertising VAST Tag</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="adertising_link" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div style="margin:20px;">
                                                        <button type=" submit" name="googlesubmit" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <!-- ctas-->
                                                <div class="tab-pane fade" id="pills-cta" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select name="ctadisplay" class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="Begining">Begining of video</option>
                                                                <option value="End of video">End of video</option>
                                                                <option value="Top right">Top right</option>
                                                                <option value="After">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">cta text</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="cta_text" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Redirect link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="redirectlink" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Text color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" name="textcolor" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Button color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" name="buttoncolor" class="form-control form-control" placeholder="Adertising VAST Tag">
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Position</label>
                                                        <div class="col-sm-10">
                                                            <select name="cta_position" class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="top left">Top left</option>
                                                                <option value="top">Top</option>
                                                                <option value="top right">Top right</option>
                                                                <option value="right">Right</option>
                                                                <option value="buttom right">Buttom right</option>
                                                                <option value="buttom">Buttom</option>
                                                                <option value="buttom left">Buttom left</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin:20px;">
                                                        <button type="submit" name="submitcta" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <!-- buy butons-->
                                                <div class="tab-pane fade" id="pills-button" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select name="button_display" class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="Begining">Begining of video</option>
                                                                <option value="End of video">End of video</option>
                                                                <option value="Top right">Top right</option>
                                                                <option value="After">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Redirect Link</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="button_link" class="form-control form-control" placeholder="Redirect Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <h5 class="p-1">Select button</h5>
                                                        <div class="d-flex flex-column mb-3">
                                                            <div class="p-2">
                                                                <div class="d-flex flex-row">
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="" class="form-check-input" name="optradio">Style 1
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle1">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="2.png" class="form-check-input" name="optradio">Style 2
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle2">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="3.png" class="form-check-input" name="optradio">Style 3
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle3">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="4.png" class="form-check-input" name="optradio">Style 4
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle4">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="5.png" class="form-check-input" name="optradio" data-toggle="modal" data-target="#mystyle5">Style 5
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle5">Info</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="p-2">
                                                                <div class="d-flex flex-row">
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="6.png" class="form-check-input" name="optradio">Style 6
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle6">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="7.png" class="form-check-input" name="optradio">Style 7
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle7">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="8.png" class="form-check-input" name="optradio">Style 8
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle8">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="9.png" class="form-check-input" name="optradio">Style 9
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle9">Info</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="p-2 colonm">
                                                                        <div class="form-check">
                                                                            <label class="form-check-label">
                                                                                <input type="radio" name="button_style" value="10.png" class="form-check-input" name="optradio">Style 10
                                                                            </label>
                                                                        </div>
                                                                        <div>
                                                                            <button type="button" class="btn btn-outline-info" data-toggle="modal" data-target="#mystyle10">Info</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">position</label>
                                                        <div class="col-sm-10">
                                                            <select name="button_position" class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="top left">Top left</option>
                                                                <option value="top">Top</option>
                                                                <option value="top right">Top right</option>
                                                                <option value="right">Right</option>
                                                                <option value="bottom right">Buttom right</option>
                                                                <option value="bottom">Bottom</option>
                                                                <option value="buttom left">Bottom left</option>
                                                                <option value="left">Left</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin:20px;">
                                                        <button type="submit" name="submitbuybutton" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                                <!-- optin form-->
                                                <div class="tab-pane fade" id="pills-option" role="tabpanel" aria-labelledby="pills-contact-tab">
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Display</label>
                                                        <div class="col-sm-10">
                                                            <select name="opt_display" class=" form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="Begining">Begining of video </option>
                                                                <option value="end">End of video</option>
                                                                <option value="top right">Top right</option>
                                                                <option value="after">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">CTA text</label>
                                                        <div class="col-sm-10">
                                                            <input type="Text" name="optin_text" class="form-control form-control" placeholder="Redirect Link">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">Text color</label>
                                                        <div class="col-sm-10">
                                                            <input type="color" name="optin_color" class="form-control form-control" placeholder="Text color">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comment">Custom code</label>
                                                        <textarea style="width:;" class="form-control" name="custom_code" rows="4" id="comment"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-2 col-form-label">position</label>
                                                        <div class="col-sm-10">
                                                            <select name="optin_position" class="form-control" id="sel1">
                                                                <option>Select position</option>
                                                                <option value="Begining of video">Begining of video </option>
                                                                <option value="End of video">End of video</option>
                                                                <option value="Top right">Top right</option>
                                                                <option value="After">After</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div style="margin:20px;">
                                                        <button type="submit" name="submitoptin" class="btn btn-primary">submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>




                                    <!-- end of php new-->

                                </div>




                            </div>
                        </div>
                    </div>
                    <!-- Container-fluid Ends-->
                </div>
                <!-- models atart-->
                <!-- style 1-->
                <div class="modal fade" id="mystyle1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Modal Heading</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/1.png" width="100%; height:100% " alt="style 1">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 1 end-->

                <!-- style 2 begin-->
                <div class="modal fade" id="mystyle2">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">Style 2</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/2.png" width="100%; height:100% " alt="style 2">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 2 end-->
                <!-- style 3 beg-->
                <div class="modal fade" id="mystyle3">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 3</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/3.png" width="100%; height:100% " alt="style 3">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 3 end-->
                <!-- style 4 beg-->
                <div class="modal fade" id="mystyle4">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 4</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/4.png" width="100%; height:100% " alt="style 4">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 4 end-->
                <!-- style 5 beg-->
                <div class="modal fade" id="mystyle5">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 5</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/5.png" width="100%; height:100% " alt="style 5">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 5 end-->
                <!-- style 6 beg-->
                <div class="modal fade" id="mystyle6">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 6</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/6.png" width="100%; height:100% " alt="style 6">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 6 end-->
                <!-- style 7 beg-->
                <div class="modal fade" id="mystyle7">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 7</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/7.png" width="100%; height:100% " alt="style 7">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 8 beg-->
                <!-- style 8 end-->
                <div class="modal fade" id="mystyle8">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 8</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/8.png" width="100%; height:100% " alt="style 8">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style 9 beg-->
                <!-- style  9 end-->
                <div class="modal fade" id="mystyle9">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 9</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/9.png" width="100%; height:100% " alt="style 9">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style  10 beg-->
                <div class="modal fade" id="mystyle10">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">style 10</h4>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <img src="buy-buttons/10.png" width="100%; height:100% " alt="style 10">
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- style  10 end-->





                <!-- models ends-->
                <!-- footer start-->


                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6 footer-copyright">
                                <p class="mb-0">Copyright © 2021 viralgrove </p>
                            </div>
                            <div class="col-md-6">
                                <p class="pull-right mb-0">Powered By viralgrove <i class="fa fa-heart"></i></p>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
    </div>
    <!-- latest jquery-->
    <script src="assetss/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="assetss/js/bootstrap/popper.min.js"></script>
    <script src="assetss/js/bootstrap/bootstrap.js"></script>
    <!-- feather icon js-->
    <script src="assetss/js/icons/feather-icon/feather.min.js"></script>
    <script src="assetss/js/icons/feather-icon/feather-icon.js"></script>
    <!-- Sidebar jquery-->
    <script src="assetss/js/sidebar-menu.js"></script>
    <script src="assetss/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="assetss/js/chat-menu.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="assetss/js/script.js"></script>
    <script src="assetss/js/theme-customizer/customizer.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
</body>

</html>