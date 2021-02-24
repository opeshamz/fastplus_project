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

	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/bootstrap-theme.min.css">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="assets/css/jasny-bootstrap.min.css">
	<link href="assets/js/plugins/morris/morris.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="assets/css/bootstrap-colorpicker.css">
	<link href="assets/css/bootstrap-toggle.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
	
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/jquery-ui.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/ajax_ops.min.js"></script>
	<script src="assets/js/ajax_ops-modals.min.js"></script>
	<script src="assets/js/jasny-bootstrap.min.js"></script>
	<script src="assets/js/bootstrap-tagsinput.min.js"></script>
	<script src="assets/js/jquery_checkall.js"></script>
	<script src="assets/js/plugins/morris/raphael.min.js"></script>
	<script src="assets/js/plugins/morris/morris.min.js"></script>
	<script src="assets/js/plugins/tinymce/tinymce.min.js"></script>
	<script src="assets/js/plugins/tinymce/tinymce-function.js"></script>
	<script src="assets/js/bootstrap-toggle.min.js"></script>
	<script src="assets/js/bootstrap-colorpicker.min.js"></script>
	<script src="assets/js/functions.js"></script>

	
<!-- script end-->
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="./"><span class="fa fa-rss"></span> <span class="mini-brand">RSS</span>-Script <span class="mini-brand">LV</span></a>
            </div>

            <div class="collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li <?php if ($currenttab == 'index.php') { ?>class="active"<?php } ?>><a href="index.php"><span class="fa fa-dashboard"></span> Dashboard</a></li>
					
					<li class="dropdown">
					  <a href="javascript:void();" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-cogs"></span> Setting <b class="caret"></b></a>
					  <ul class="dropdown-menu">
						<li><a href="setting.php?case=general">General Setting</a></li>
						<li><a href="setting.php?case=theme">Theme Setting</a></li>
						<li><a href="setting.php?case=apis">API's Setting</a></li>
						<li><a href="setting.php?case=mail">Mail Setting</a></li>
						<li><a href="setting.php?case=social">Social Setting</a></li>
						<li><a href="setting.php?case=comments">Comments Setting</a></li>
						<li class="divider"></li>
						<li><a href="setting.php?case=clear_cache">Clear Cache</a></li>
						<li><a href="setting.php?case=optimize_database">Optimize Database</a></li>
						<li class="divider"></li>
						<li><a href="setting.php?case=remove_old_news">Bulk Remove</a></li>
					  </ul>
					</li>
                </ul>
				<ul class="nav navbar-nav navbar-right">
					<li <?php if ($currenttab == 'change_password.php') { ?>class="active"<?php } ?>><a href="change_password.php"><span class="fa fa-lock"></span> Change Password</a></li>
					<li><a href="../" target="_BLANK"><span class="fa fa-desktop"></span> Front-End</a></li>
					<li><a href="javascript:ConfirmLogOut();"><span class="fa fa-sign-out"></span> Logout</a></li>
                </ul>
            </div><!--.nav-collapse -->
        </div>
    </nav>
<div class="container-fluid">
<div class="row">
<div class="col-sm-2">
<div class="list-group">
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