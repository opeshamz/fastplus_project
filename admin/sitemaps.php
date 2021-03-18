<?php

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
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName">{{name}}</div>
            </div>
            </div>
          </script>
				<script id="empty-template" type="text/x-handlebars-template"><div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div></script>
			</div>
		</div>
		<!-- Page Header Ends                              -->
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
									<h3>
										<i class="fa fa-sitemap"></i> Sitemaps
									</h3>
								</div>
								<div style="margin: 50px;">
									<!-- begning of php new-->
									<?php

									$all = $mysqli->query("SELECT published,deleted FROM news WHERE published='1' AND deleted='0'");
									$news = $all->num_rows;
									if ($news > 0) {
									?>

										<table class="table">
											<thead>
												<tr>
													<th>Sitemap</th>
												</tr>
											</thead>
											<tbody>
												<?php
												if (isset($options['general_category_sitemap']) and $options['general_category_sitemap'] == 1) {
													$categories = $mysqli->query("SELECT id FROM categories");
													$categories_number = $categories->num_rows;
													if ($categories_number > 0) {
														$categories_sitemap_link = $options['general_siteurl'] . '/categories-sitemap.xml';
														$categories_sitemap = str_replace(':/', '://', str_replace('//', '/', ($categories_sitemap_link)));
												?>
														<tr>
															<td><a href="<?php echo $categories_sitemap; ?>" target="_BLANK"><?php echo $categories_sitemap; ?></a></td>
														</tr>
													<?php
													}
												}
												if (isset($options['general_sitemap_items'])) {
													$number = $options['general_sitemap_items'];
												} else {
													$number = 1000;
												}
												$sitemaps = ceil($news / $number);
												for ($c = 0; $c < $sitemaps; $c++) {
													$n = $c + 1;
													$sitemap_link = $options['general_siteurl'] . '/sitemap-' . $n . '.xml';
													$sitemap = str_replace(':/', '://', str_replace('//', '/', ($sitemap_link)));
													?>
													<tr>
														<td><a href="<?php echo $sitemap; ?>" target="_BLANK"><?php echo $sitemap; ?></a></td>
													</tr>
											<?php
												}
											}
											?>
											</tbody>
										</table>
										<?php

										?>


								</div>
								<!-- end of php new-->
							</div>





						</div>
					</div>
				</div>
				<!-- Container-fluid Ends-->
			</div>
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