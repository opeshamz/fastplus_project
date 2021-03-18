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
								<li><a href="video_ads.php">video_ads</a></li>
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
										<i class="fa fa-picture-o"></i> Advertisements
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
												$ad_type = make_safe(xss_clean(htmlspecialchars($_POST['ad_type'], ENT_QUOTES)));
												$place = make_safe(xss_clean(htmlspecialchars($_POST['place'], ENT_QUOTES)));
												if ($ad_type == 'code') {
													$data_ad_client = make_safe(xss_clean($_POST['data_ad_client']));
													$data_ad_slot = make_safe(xss_clean($_POST['data_ad_slot']));
												} else {
													$link = make_safe(xss_clean($_POST['link']));
												}
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif ($ad_type == 'code' and empty($data_ad_client)) {
													$message = notification('warning', 'Insert Ad Client Please.');
												} elseif ($ad_type == 'banner' and empty($link)) {
													$message = notification('warning', 'Insert Ad Link Please.');
												} else {
													if (!empty($_FILES['image']['name'])) {
														$up = new fileDir('../upload/ads/');
														$thumbnail = $up->upload($_FILES['image']);
													} else {
														$thumbnail = '';
													}
													$sql = "INSERT INTO advertisements (title,ad_type,link,image,place,data_ad_client,data_ad_slot,active) VALUES ('$title','$ad_type','$link','$thumbnail','$place','$data_ad_client','$data_ad_slot','1')";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Advertisement Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
									?>
											<div class="page-header page-heading">
												<h1>Add Advertisement
													<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
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
													<label for="place">Place <span>*</span></label>
													<select name="place" class="form-control" id="place">
														<?php
														$places = ads_places();
														foreach ($places as $key => $value) {
														?>
															<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="ad_type">Ad Type <span>*</span></label>
													<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_link');" value="banner" CHECKED /> Banner</div>
													<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_code');" value="code" /> Code</div>
												</div>
												<div id="ad_code">
													<div class="form-group">
														<label for="data_ad_client">Adsense AD Client <span>*</span></label>
														<input type="text" class="form-control" name="data_ad_client" id="data_ad_client" />
													</div>
													<div class="form-group">
														<label for="data_ad_slot">Adsense AD Slot <span>*</span></label>
														<input type="text" class="form-control" name="data_ad_slot" id="data_ad_slot" />
													</div>
												</div>
												<div id="ad_link">
													<div class="form-group">
														<label for="link">Link <span>*</span></label>
														<input type="text" class="form-control" name="link" id="link" />
													</div>
													<div class="form-group">
														<label for="image">Image <span>*</span></label>
														<div class="fileinput fileinput-new input-group" data-provides="fileinput">
															<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
															<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
															<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
													</div>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'edit';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean(htmlspecialchars($_POST['title'], ENT_QUOTES)));
												$ad_type = make_safe(xss_clean(htmlspecialchars($_POST['ad_type'], ENT_QUOTES)));
												$place = make_safe(xss_clean(htmlspecialchars($_POST['place'], ENT_QUOTES)));
												if ($ad_type == 'code') {
													$data_ad_client = make_safe(xss_clean($_POST['data_ad_client']));
													$data_ad_slot = make_safe(xss_clean($_POST['data_ad_slot']));
												} else {
													$link = make_safe(xss_clean($_POST['link']));
												}
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif ($ad_type == 'code' and empty($data_ad_client)) {
													$message = notification('warning', 'Insert Ad Client Please.');
												} elseif ($ad_type == 'banner' and empty($link)) {
													$message = notification('warning', 'Insert Ad Link Please.');
												} else {
													if (!empty($_FILES['image']['name'])) {
														$up = new fileDir('../upload/ads/');
														$thumbnail = $up->upload($_FILES['image']);
														$up->delete("$_POST[old_image]");
													} else {
														$thumbnail = $_POST['old_image'];
													}
													$sql = "UPDATE advertisements SET title='$title',data_ad_client='$data_ad_client',data_ad_slot='$data_ad_slot',ad_type='$ad_type',place='$place',link='$link',image='$thumbnail' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Advertisement Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$ad = $general->ad($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Advertisement
													<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="form-group">
													<label for="title">Title <span>*</span></label>
													<input type="text" class="form-control" name="title" id="title" value="<?php echo $ad['title']; ?>" />
												</div>
												<div class="form-group">
													<label for="place">Place <span>*</span></label>
													<select name="place" class="form-control" id="place">
														<?php
														$places = ads_places();
														foreach ($places as $key => $value) {
														?>
															<option value="<?php echo $key; ?>" <?php if ($ad['place'] == $key) {
																									echo 'SELECTED';
																								} ?>><?php echo $value; ?></option>
														<?php
														}
														?>
													</select>
												</div>
												<div class="form-group">
													<label for="ad_type">Ad Type <span>*</span></label>
													<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_link');" value="banner" <?php if ($ad['ad_type'] == 'banner') {
																																							echo 'CHECKED';
																																						} ?> /> Banner</div>
													<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_code');" value="code" <?php if ($ad['ad_type'] == 'code') {
																																						echo 'CHECKED';
																																					} ?> /> Code</div>
												</div>
												<div id="ad_code">
													<div class="form-group">
														<label for="data_ad_client">Adsense AD Client <span>*</span></label>
														<input type="text" class="form-control" name="data_ad_client" id="data_ad_client" value="<?php echo $ad['data_ad_client']; ?>" />
													</div>
													<div class="form-group">
														<label for="data_ad_slot">Adsense AD Slot <span>*</span></label>
														<input type="text" class="form-control" name="data_ad_slot" id="data_ad_slot" value="<?php echo $ad['data_ad_slot']; ?>" />
													</div>
												</div>
												<div id="ad_link">
													<div class="form-group">
														<label for="link">Link <span>*</span></label>
														<input type="text" class="form-control" name="link" id="link" value="<?php echo $ad['link']; ?>" />
													</div>
													<div class="form-group">
														<label for="image">Image <span>*</span></label>
														<div class="fileinput fileinput-new input-group" data-provides="fileinput">
															<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
															<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
															<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
														</div>
														<?php if (!empty($ad['image'])) { ?>
															<p>Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/ads/<?php echo $ad['image']; ?>' class='img-responsive' />"><?php echo $ad['image']; ?></a></p>
														<?php } ?>
													</div>
												</div>
												<input type="hidden" name="old_image" value="<?php echo $ad['image']; ?>" />
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'delete';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['delete'])) {
												$delete = $mysqli->query("DELETE FROM advertisements WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Advertisement Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$ad = $general->ad($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Advertisement
													<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done)) { ?>
													<div class="alert alert-warning">Are you sure to Delete the Advertisement : <b><?php echo htmlspecialchars_decode($ad['title'], ENT_QUOTES); ?></b> ?</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="advertisements.php" class="btn btn-default">Back To Advertisement</a>
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
													<a href="advertisements.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
												</h3>
											</div>
											<?php
											$ads = $general->ads('id DESC');
											if ($ads == 0) {
												echo notification('warning', 'You didn\'t add any Ad. <a href="?case=add" class="alert-link">Add new Ad</a>.');
											} else {
											?>
												<table class="table">
													<thead>
														<tr>
															<th>Title</th>
															<th>Type</th>
															<th>Place</th>
															<th>Smarty Code</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($ads as $ad) {
														?>
															<tr>
																<td><?php echo $ad['title']; ?></td>
																<td><?php echo $ad['ad_type']; ?></td>
																<td><?php echo $ad['place']; ?></td>
																<td><?php echo "{'" . $ad['place'] . "'|get_ad}"; ?></td>
																<td class="text-right">
																	<a href="advertisements.php?case=edit&id=<?php echo $ad['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
																	<a href="advertisements.php?case=delete&id=<?php echo $ad['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
																</td>
															</tr>
														<?php
														}
														?>
													</tbody>
												</table>
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