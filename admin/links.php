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
								</li>
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
										<i class="fa fa-link"></i> Links
									</h3>
								</div>
								<div style="margin: 50px;">
									<!-- begning of php new-->
									<?php

									if (!empty($_GET['case'])) {
										$case = make_safe($_GET['case']);
									} else {
										$case = '';
									}
									switch ($case) {
										case 'add';
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean($_POST['title']));
												$link = make_safe(xss_clean($_POST['link']));
												$published = intval(make_safe(xss_clean($_POST['published'])));
												$target = make_safe(xss_clean($_POST['target']));
												$place = make_safe(xss_clean(intval($_POST['place'])));
												$nofollow = intval(make_safe(xss_clean($_POST['nofollow'])));
												if (empty($title)) {
													$message = notification('warning', 'Insert Title Please.');
												} elseif (empty($link)) {
													$message = notification('warning', 'Insert Link Please.');
												} else {
													$sql = "INSERT INTO links (title,link,published,target,nofollow,place,link_order) VALUES ('$title','$link','$published','$target','$nofollow','$place','0')";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Link Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
									?>
											<div class="page-header page-heading">
												<h1>Add New Link
													<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<div class="form-group">
													<label for="title">Link Title <span>*</span></label>
													<input type="text" class="form-control" name="title" id="title" />
												</div>
												<div class="form-group">
													<label for="title">Link URL <span>*</span></label>
													<input type="text" class="form-control" name="link" id="link" />
												</div>
												<div class="form-group">
													<label for="place">Place <span>*</span></label>
													<select name="place" id="place" class="form-control">
														<option value="0">Header Top Menu</option>
														<option value="1">Footer Menu</option>
													</select>
												</div>
												<div class="form-group">
													<label for="target">Link Target</label>
													<select name="target" id="target" class="form-control">
														<option value="_NEW">New Page</option>
														<option value="_SELF">Self Page</option>
													</select>
												</div>
												<div class="form-group">
													<input type="hidden" name="nofollow" value="0" />
													<input type="checkbox" name="nofollow" id="nofollow" value="1" /> <span class="checkbox-label">Add nofollow=nofollow to this Link ?</span>
												</div>
												<div class="form-group">
													<input type="hidden" name="published" value="0" />
													<input type="checkbox" name="published" id="published" value="1" /> <span class="checkbox-label">Publish This Link ?</span>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'edit';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean($_POST['title']));
												$link = make_safe(xss_clean($_POST['link']));
												$place = make_safe(xss_clean(intval($_POST['place'])));
												$published = intval(make_safe(xss_clean($_POST['published'])));
												$target = make_safe(xss_clean($_POST['target']));
												$nofollow = intval(make_safe(xss_clean($_POST['nofollow'])));
												if (empty($title)) {
													$message = notification('warning', 'Insert Title Please.');
												} elseif (empty($link)) {
													$message = notification('warning', 'Insert Link Please.');
												} else {
													$sql = "UPDATE links SET title='$title',link='$link',published='$published',target='$target',nofollow='$nofollow',place='$place' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Link Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$link = $general->link($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Link
													<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<div class="form-group">
													<label for="title">Link Title <span>*</span></label>
													<input type="text" class="form-control" name="title" id="title" value="<?php echo $link['title']; ?>" />
												</div>
												<div class="form-group">
													<label for="title">Link URL <span>*</span></label>
													<input type="text" class="form-control" name="link" id="link" value="<?php echo $link['link']; ?>" />
												</div>
												<div class="form-group">
													<label for="place">Place <span>*</span></label>
													<select name="place" id="place" class="form-control">
														<option value="0" <?php if ($link['place'] == 0) {
																				echo 'SELECTED';
																			} ?>>Header Top Menu</option>
														<option value="1" <?php if ($link['place'] == 1) {
																				echo 'SELECTED';
																			} ?>>Footer Menu</option>
													</select>
												</div>
												<div class="form-group">
													<label for="target">Link Target</label>
													<select name="target" id="target" class="form-control">
														<option value="_NEW" <?php if ($link['target'] == '_NEW') {
																					echo 'SELECTED';
																				} ?>>New Page</option>
														<option value="_SELF" <?php if ($link['target'] == '_SELF') {
																					echo 'SELECTED';
																				} ?>>Self Page</option>
													</select>
												</div>
												<div class="form-group">
													<input type="hidden" name="nofollow" value="0" />
													<input type="checkbox" name="nofollow" id="nofollow" value="1" <?php if ($link['nofollow'] == 1) {
																														echo 'CHECKED';
																													} ?> /> <span class="checkbox-label">Add nofollow=nofollow to this Link ?</span>
												</div>
												<div class="form-group">
													<input type="hidden" name="published" value="0" />
													<input type="checkbox" name="published" id="published" value="1" <?php if ($link['published'] == 1) {
																															echo 'CHECKED';
																														} ?> /> <span class="checkbox-label">Publish This Link ?</span>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'delete';
											$id = intval($_GET['id']);
											if (isset($_POST['delete'])) {
												$delete = $mysqli->query("DELETE FROM links WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Link Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$link = $general->link($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Link
													<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done)) { ?>
													<div class="alert alert-warning">Are you Sure that you want to delete the Link : <b><?php echo $link['title']; ?></b> ?</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="links.php" class="btn btn-default">Back To links</a>
												<?php } else { ?>
													<button type="submit" name="delete" class="btn btn-danger">Delete</button>
												<?php } ?>
											</form>
										<?php
											break;
										default;
										?>
											<div class="page-header page-heading">
												<h3>
													<a href="links.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
												</h3>
											</div>
											<?php
											$links = $general->links('link_order ASC');
											if ($links == 0) {
												echo notification('warning', 'You didn\'t add any Link. <a href="?case=add">Add new Link</a>.');
											} else {
											?>
												<div class="categories-header">
													<div class="col-xs-9 col-sm-5">Title</div>
													<div class="col-sm-2 hidden-xs">Target</div>
													<div class="col-sm-2 hidden-xs">nofollow</div>
													<div class="col-xs-3"></div>
												</div>
												<div id="sort_links">
													<ul>
														<?php
														foreach ($links as $link) {
														?>
															<li id="records_<?php echo $link['id']; ?>" class="category_li" title="Drag To Re-Order">
																<div class="col-xs-9 col-sm-5"><span class="fa fa-link"></span> <?php echo $link['title']; ?></div>
																<div class="col-sm-2 hidden-xs"><?php echo strtolower(str_replace('_', '', $link['target'])) . ' page'; ?></div>
																<div class="col-sm-2 hidden-xs"><?php if ($link['nofollow'] == 0) {
																									echo '<i class="fa fa-close text-danger"></i>';
																								} else {
																									echo '<i class="fa fa-check text-success"></i>';
																								} ?></div>
																<div class="col-xs-3 text-right">
																	<a href="links.php?case=edit&id=<?php echo $link['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
																	<a href="links.php?case=delete&id=<?php echo $link['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
																</div>
															</li>
														<?php
														}
														?>
													</ul>
												</div>
									<?php
											}
									}

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
							<p class="mb-0">Copyright © 2021 Poco. All rights reserved.</p>
						</div>
						<div class="col-md-6">
							<p class="pull-right mb-0">Hand-crafted & made with<i class="fa fa-heart"></i></p>
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