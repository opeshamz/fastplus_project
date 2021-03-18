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
										<i class="fa fa-file"></i> Pages
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
												$title = make_safe(xss_clean(htmlspecialchars($_POST['title'], ENT_QUOTES)));
												$place = make_safe(xss_clean(intval($_POST['place'])));
												$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
												$seo_keywords = htmlspecialchars($_POST['seo_keywords'], ENT_QUOTES);
												$seo_description = htmlspecialchars($_POST['seo_description'], ENT_QUOTES);
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif (empty($content)) {
													$message = notification('warning', 'Write Some content Please.');
												} else {
													$sql = "INSERT INTO pages (title,content,place,seo_keywords,seo_description,page_order) VALUES ('$title','$content','$place','$seo_keywords','$seo_description','0')";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Page Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
									?>
											<div class="page-header page-heading">
												<h1>Add Page
													<a href="pages.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="form-group">
													<label for="title">Title <span>*</span></label>
													<input type="text" class="form-control" name="title" id="title" />
												</div>
												<div class="form-group">
													<label for="place">Position <span>*</span></label>
													<select name="place" id="place" class="form-control">
														<option value="0">Header Top Menu</option>
														<option value="1">Footer Menu</option>
													</select>
												</div>
												<div class="form-group">
													<label for="content">content</label>
													<textarea class="form-control wysiwyg" name="content" id="content" rows="15"></textarea>
												</div>
												<div class="form-group">
													<label for="seo_keywords">SEO Keywords <span>*</span></label>
													<input type="text" class="form-control tags" name="seo_keywords" id="seo_keywords" />
												</div>
												<div class="form-group">
													<label for="seo_description">SEO Description</label>
													<textarea class="form-control" name="seo_description" id="seo_description" rows="3"></textarea>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'edit';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean(htmlspecialchars($_POST['title'], ENT_QUOTES)));
												$place = make_safe(xss_clean(intval($_POST['place'])));
												$content = htmlspecialchars($_POST['content'], ENT_QUOTES);
												$seo_keywords = htmlspecialchars($_POST['seo_keywords'], ENT_QUOTES);
												$seo_description = htmlspecialchars($_POST['seo_description'], ENT_QUOTES);
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif (empty($content)) {
													$message = notification('warning', 'Write Some content Please.');
												} else {
													$sql = "UPDATE pages SET title='$title',content='$content',place='$place',seo_keywords='$seo_keywords',seo_description='$seo_description' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Page Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$page = $general->page($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Page
													<a href="pages.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="form-group">
													<label for="title">Title <span>*</span></label>
													<input type="text" class="form-control" name="title" id="title" value="<?php echo $page['title']; ?>" />
												</div>
												<div class="form-group">
													<label for="place">Position <span>*</span></label>
													<select name="place" id="place" class="form-control">
														<option value="0" <?php if ($page['place'] == 0) {
																				echo 'SELECTED';
																			} ?>>Header Top Menu</option>
														<option value="1" <?php if ($page['place'] == 1) {
																				echo 'SELECTED';
																			} ?>>Footer Menu</option>
													</select>
												</div>
												<div class="form-group">
													<label for="content">Content</label>
													<textarea class="wysiwyg form-control" name="content" id="content" rows="15"><?php echo htmlspecialchars_decode($page['content'], ENT_QUOTES); ?></textarea>
												</div>
												<div class="form-group">
													<label for="seo_keywords">SEO Keywords <span>*</span></label>
													<input type="text" class="form-control tags" name="seo_keywords" id="seo_keywords" value="<?php echo $page['seo_keywords']; ?>" />
												</div>
												<div class="form-group">
													<label for="seo_description">SEO Description</label>
													<textarea class="form-control" name="seo_description" id="seo_description" rows="3"><?php echo $page['seo_description']; ?></textarea>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'delete';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['delete'])) {
												$delete = $mysqli->query("DELETE FROM pages WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Page Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$pages = $general->pages($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Page
													<a href="pages.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done)) { ?>
													<div class="alert alert-warning">Are you sure to Delete the Page : <b><?php echo htmlspecialchars_decode($pages['title'], ENT_QUOTES); ?></b> ?</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="pages.php" class="btn btn-default">Back To Pages</a>
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
													<a href="pages.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
												</h3>
											</div>
											<?php
											$pages = $general->pages('page_order ASC');
											if ($pages == 0) {
												echo notification('warning', 'You didn\'t add any Page. <a href="?case=add" class="alert-link">Add new Page</a>.');
											} else {
											?>
												<div class="categories-header">
													<div class="col-xs-9">Title</div>
													<div class="col-xs-3"></div>
												</div>
												<div id="sort_pages">
													<ul>
														<?php
														foreach ($pages as $page) {
														?>
															<li id="records_<?php echo $page['id']; ?>" class="category_li" title="Drag To Re-Order">
																<div class="col-xs-9"><span class="fa fa-file"></span> <?php echo $page['title']; ?></div>
																<div class="col-xs-3 text-right">
																	<a href="pages.php?case=edit&id=<?php echo $page['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
																	<a href="pages.php?case=delete&id=<?php echo $page['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
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