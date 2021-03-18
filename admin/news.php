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
				<div class="sidebar" style="background-color: red !important;">
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
										<i class="fa fa-newspaper-o"></i> Published News

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
												$details = htmlspecialchars($_POST['details'], ENT_QUOTES);
												$category_id = make_safe(xss_clean($_POST['category_id']));
												$cc = explode(',', $category_id);
												$main_category = $cc[0];
												$sub_category = $cc[1];
												$tags = htmlspecialchars($_POST['tags'], ENT_QUOTES);
												$published = make_safe(xss_clean(intval($_POST['published'])));
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif (empty($details)) {
													$message = notification('warning', 'Write Some Details Please.');
												} elseif (empty($category_id)) {
													$message = notification('warning', 'Choose a Category Please.');
												} else {
													if (!empty($_FILES['thumbnail']['name'])) {
														$up = new fileDir('../upload/news/');
														$thumbnail = $up->upload($_FILES['thumbnail']);
													} else {
														$thumbnail = '';
													}
													$datetime = time();
													$day = date('j');
													$month = date('n');
													$year = date('Y');
													$domain = get_domain($options['general_siteurl']);
													$sql = "INSERT INTO news (source_type,source_domain,title,details,category_id,sub_category_id,tags,thumbnail,datetime,published,day,month,year,hits,video_id,duration,source_id,deleted,featured,votes_up,votes_down,permalink) VALUES 
						 ('rss','$domain','$title','$details','$main_category','$sub_category','$tags','$thumbnail','$datetime','$published','$day','$month','$year','0','0','0','0','0','0','0','0','')";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Article Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
									?>
											<div class="page-header page-heading">
												<h1>Add Article
													<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-9">
														<div class="form-group">
															<label for="title">Title <span>*</span></label>
															<input type="text" class="form-control" name="title" id="title" />
														</div>

														<div class="form-group">
															<label for="details">Details</label>
															<textarea class="wysiwyg form-control" name="details" id="details" rows="15"></textarea>
														</div>
													</div>
													<div class="col-md-9">
														<div class="form-group">
															<label for="category_id">Category <span>*</span></label>
															<select class="form-control" name="category_id" id="category_id">
																<?php
																$categories = $general->main_categories('category_order ASC');
																foreach ($categories as $category) {
																?>
																	<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;"><?php echo $category['category']; ?></option>
																	<?php
																	$subs = $general->sub_categories($category['id'], 'category_order ASC');
																	foreach ($subs as $sub) {
																	?>
																		<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>"> - <?php echo $sub['category']; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<label class="col-sm-2 col-form-label">Adertising Image</label>
															<div class="col-sm-10">
																<input type="file" name="thumbnail">
															</div>
														</div>
														<div class="form-group">
															<label for="tags">Tags <span>*</span></label>
															<input type="text" class="form-control tags" name="tags" id="tags" />
														</div>
														<div class="form-group">
															<input type="checkbox" name="published" id="published" value="1" /> <span class="checkbox-label">Publish Article ?</span>
														</div>

														<button type="submit" name="submit" class="btn btn-primary">Save</button>
													</div>
												</div>
											</form>
										<?php
											break;
										case 'edit';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean(htmlspecialchars($_POST['title'], ENT_QUOTES)));
												$details = htmlspecialchars($_POST['details'], ENT_QUOTES);
												$category_id = make_safe(xss_clean($_POST['category_id']));
												$cc = explode(',', $category_id);
												$main_category = $cc[0];
												$sub_category = $cc[1];
												$tags = htmlspecialchars($_POST['tags'], ENT_QUOTES);
												$published = make_safe(xss_clean(intval($_POST['published'])));
												if (empty($title)) {
													$message = notification('warning', 'Insert The Title Please.');
												} elseif (empty($details)) {
													$message = notification('warning', 'Write Some Details Please.');
												} elseif (empty($category_id)) {
													$message = notification('warning', 'Choose a Category Please.');
												} else {
													if (!empty($_FILES['thumbnail']['name'])) {
														$up = new fileDir('../upload/news/');
														$thumbnail = $up->upload($_FILES['thumbnail']);
														$up->delete("$_POST[old_thumbnail]");
													} else {
														$thumbnail = $_POST['old_thumbnail'];
													}
													$sql = "UPDATE news SET title='$title',details='$details',category_id='$main_category',sub_category_id='$sub_category',thumbnail='$thumbnail',tags='$tags',published='$published' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Article Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$news = $general->news($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Article
													<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="row">
													<div class="col-md-9">
														<div class="form-group">
															<label for="title">Title <span>*</span></label>
															<input type="text" class="form-control" name="title" id="title" value="<?php echo $news['title']; ?>" />
														</div>

														<div class="form-group">
															<label for="details">Details <span>*</span></label>
															<textarea class="wysiwyg form-control" name="details" id="details" rows="15"><?php echo htmlspecialchars_decode($news['details'], ENT_QUOTES); ?></textarea>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<input type="checkbox" name="published" id="published" value="1" <?php if ($news['published'] == 1) {
																																	echo 'CHECKED';
																																} ?> /> <span class="checkbox-label">Publish Article ?</span>
														</div>
														<div class="form-group">
															<label for="category_id">Category <span>*</span></label>
															<select class="form-control" name="category_id" id="category_id">
																<?php
																$categories = $general->main_categories('category_order ASC');
																foreach ($categories as $category) {
																?>
																	<option value="<?php echo $category['id']; ?>,0" <?php if ($news['category_id'] == $category['id'] and $news['sub_category_id'] == 0) {
																															echo 'SELECTED';
																														} ?> style="font-weight:bold;"><?php echo $category['category']; ?></option>
																	<?php
																	$subs = $general->sub_categories($category['id'], 'category_order ASC');
																	foreach ($subs as $sub) {
																	?>
																		<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>" <?php if ($news['category_id'] == $category['id'] and $news['sub_category_id'] == $sub['id']) {
																																						echo 'SELECTED';
																																					} ?>> - <?php echo $sub['category']; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<label for="tags">Tags</label>
															<input type="text" class="form-control tags" name="tags" id="tags" value="<?php if (!empty($news['tags'])) {
																																			echo $news['tags'];
																																		} else {
																																			echo title_to_keywords($news['title']);
																																		} ?>" />
														</div>
														<div class="form-group">
															<label for="category_id">Featured Image</label>
															<div class="fileinput fileinput-new input-group" data-provides="fileinput">
																<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
																<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists"><i class="fa fa-folder-open"></i></span><input type="file" name="thumbnail"></span>
																<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="fa fa-remove"></i></a>
															</div>
															<?php if (!empty($news['thumbnail'])) { ?>
																<p><a href="javascript:void();" class="delete-image" id="<?php echo $news['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/news/<?php echo $news['thumbnail']; ?>' class='img-responsive' />"><?php echo $news['thumbnail']; ?></a></p>
															<?php } ?>
														</div>



														<input type="hidden" name="old_thumbnail" value="<?php echo $news['thumbnail']; ?>" />
														<button type="submit" name="submit" class="btn btn-primary">Save</button>
													</div>

												</div>
											</form>
										<?php
											break;
										case 'delete';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['unpublish'])) {
												$delete = $mysqli->query("UPDATE news SET published='0',deleted='1' WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Article Have Been Unpublished Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											if (isset($_POST['delete'])) {
												$sql = "SELECT * FROM news WHERE id='$id'";
												$query = $mysqli->query($sql);
												if ($query->num_rows > 0) {
													$row = $query->fetch_assoc();
													if (!empty($row['thumbnail']) and file_exists('../upload/news/' . $row['thumbnail'])) {
														@unlink('../upload/news/' . $row['thumbnail']);
													}
												}
												$delete = $mysqli->query("DELETE FROM news WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Article Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$news = $general->news($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Article
													<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done)) { ?>
													<div class="alert alert-warning">You Can Either <b>Unpublish</b> or <b>Delete</b> the Article : <b><?php echo htmlspecialchars_decode($news['title'], ENT_QUOTES); ?></b>. If you Choose to Delete you Can't Undo this Action Later.</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="news.php" class="btn btn-default">Back To News</a>
												<?php } else { ?>
													<button type="submit" name="unpublish" class="btn btn-warning">Unpublish</button>
													<button type="submit" name="delete" class="btn btn-danger">Permanent Delete</button>
												<?php } ?>
											</form>
										<?php
											break;
										case 'search';
											$q = make_safe(xss_clean($_GET['q']));
										?>
											<div class="page-header page-heading">
												<h1 class="row">
													<div class="col-md-6"><i class="fa fa-search"></i> Search For <?php echo $q; ?> In News</div>
													<div class="col-md-6">
														<div class="pull-right search-form">
															<form method="GET" action="news.php">
																<div class="input-group">
																	<input type="hidden" name="case" value="search" />
																	<input type="text" name="q" class="form-control" placeholder="Search" value="<?php echo $q; ?>" />
																	<span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
																</div>
															</form>
														</div>
														<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
														<a href="news.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted News"><span class="fa fa-trash"></span></a>
														<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
													</div>
												</h1>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND title LIKE '%$q%' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No Results.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?case=search&page=%s&q=$q");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND title LIKE '%$q%' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
													<thead>
														<tr>
															<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
															<th>Details</th>
															<th class="hidden-xs">Image</th>
															<th class="hidden-xs">Content</th>
															<th width="80"></th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($row = $q->fetch_assoc()) {
														?>
															<tr>
																<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																<td>
																	<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																	<div class="article-meta">
																		<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
																		<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																		<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																		<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																	</div>
																</td>
																<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
																<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
																<td align="right">
																	<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																	<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																</td>
															</tr>
														<?php
														}
														?>
													</tbody>
												</table>
												<div class="news-actions">
													<div class="row">
														<div class="col-xs-12"><?php echo $pagination->create_links(); ?></div>
													</div>
												</div>
											<?php
											}
											break;
										case 'category';
											$id = intval(make_safe(xss_clean($_GET['id'])));
											$sub_id = intval(make_safe(xss_clean($_GET['sub_id'])));
											if (isset($_POST['delete']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
													$res = $mysqli->query($sql);
													if ($res) {
														$message = notification('success', 'The Selected News Was Deleted Successfully.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											if ($sub_id == 0) {
												$category = $general->category($id);
											} else {
												$category = $general->category($sub_id);
											}
											?>
											<div class="page-header page-heading">
												<h1><i class="fa fa-reorder"></i> News About <?php echo $category['category']; ?></h1>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND category_id='$id' AND sub_category_id='$sub_id' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No Published News About ' . $category['category'] . '.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?case=category&id=$id&sub_id=$sub_id&page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND category_id='$id' AND sub_category_id='$sub_id' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<form role="form" method="POST" action="">
													<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
														<thead>
															<tr>
																<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
																<th>Details</th>
																<th class="hidden-xs">Image</th>
																<th class="hidden-xs">Content</th>
																<th width="80"></th>
															</tr>
														</thead>
														<tbody>
															<?php
															while ($row = $q->fetch_assoc()) {
															?>
																<tr>
																	<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																	<td>
																		<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																		<div class="article-meta">
																			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
																			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																		</div>
																	</td>
																	<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
																	<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
																	<td align="right">
																		<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																		<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<div class="news-actions">
														<div class="row">
															<div class="col-sm-3 col-md-4">
																<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
															</div>
															<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
														</div>
													</div>
												</form>
											<?php
											}
											break;
										case 'source';
											$id = intval(make_safe(xss_clean($_GET['id'])));
											if (isset($_POST['delete']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
													$res = $mysqli->query($sql);
													if ($res) {
														$message = notification('success', 'The Selected News Was Deleted Successfully.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											$source = $general->source($id);
											?>
											<div class="page-header page-heading">
												<h1><i class="fa fa-rss"></i> <?php if ($id == 0) {
																					echo 'Private News';
																				} else {
																					echo 'News From ' . $source['title'];
																				} ?></h1>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND source_id='$id' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No Published News From ' . $source['title'] . '.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?case=source&id=$id&page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND source_id='$id' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<form role="form" method="POST" action="">
													<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
														<thead>
															<tr>
																<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
																<th>Details</th>
																<th class="hidden-xs">Image</th>
																<th class="hidden-xs">Content</th>
																<th width="80"></th>
															</tr>
														</thead>
														<tbody>
															<?php
															while ($row = $q->fetch_assoc()) {
															?>
																<tr>
																	<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																	<td>
																		<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																		<div class="article-meta">
																			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
																			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																		</div>
																	</td>
																	<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
																	<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
																	<td align="right">
																		<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																		<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<div class="news-actions">
														<div class="row">
															<div class="col-sm-3 col-md-4">
																<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
															</div>
															<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
														</div>
													</div>
												</form>
											<?php
											}
											break;
										case 'deleted';
											if (isset($_POST['restore']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "UPDATE news SET published='1',deleted='0' WHERE id='$del_id'";
													$res = $mysqli->query($sql);
													if ($res) {
														$message = notification('success', 'The Selected News Was Restored Successfully.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											if (isset($_POST['delete']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "SELECT id,thumbnail FROM news WHERE id='$del_id'";
													$query = $mysqli->query($sql);
													$row = $query->fetch_assoc();
													if (file_exists('../upload/news/' . $row['thumbnail'])) {
														@unlink('../upload/news/' . $row['thumbnail']);
													}
													$delete = $mysqli->query("DELETE FROM news WHERE id='$del_id'");
													if ($delete) {
														$message = notification('success', 'The Selected News Was Deleted Permanently.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											?>
											<div class="page-header page-heading">
												<h1 class="row">
													<div class="col-md-6"><i class="fa fa-trash"></i> Deleted News</div>
													<div class="col-md-6">
														<div class="pull-right search-form">
															<form method="GET" action="news.php">
																<div class="input-group">
																	<input type="hidden" name="case" value="search" />
																	<input type="text" name="q" class="form-control" placeholder="Search">
																	<span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
																</div>
															</form>
														</div>
														<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
														<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
													</div>
												</h1>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='rss' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No Deleted News.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?case=deleted&page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='rss' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<form role="form" method="POST" action="">
													<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
														<thead>
															<tr>
																<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
																<th>Details</th>
																<th class="hidden-xs">Image</th>
																<th class="hidden-xs">Content</th>
																<th width="80"></th>
															</tr>
														</thead>
														<tbody>
															<?php
															while ($row = $q->fetch_assoc()) {
															?>
																<tr>
																	<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																	<td>
																		<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																		<div class="article-meta">
																			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
																			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																		</div>
																	</td>
																	<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
																	<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
																	<td align="right">
																		<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																		<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<div class="news-actions">
														<div class="row">
															<div class="col-sm-3 col-md-4">
																<button type="submit" name="restore" class="btn btn-success"><span class="fa fa-refresh"></span> Restore</button>
																<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Permanent Delete</button>
															</div>
															<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
														</div>
													</div>
												</form>
											<?php
											}
											break;
										case 'review';
											if (isset($_POST['publish']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "UPDATE news SET published='1',deleted='0' WHERE id='$del_id'";
													$res = $mysqli->query($sql);
													if ($res) {
														$message = notification('success', 'The Selected News Was Published Successfully.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											if (isset($_POST['delete']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "SELECT id,thumbnail FROM news WHERE id='$del_id'";
													$query = $mysqli->query($sql);
													$row = $query->fetch_assoc();
													if (file_exists('../upload/news/' . $row['thumbnail'])) {
														@unlink('../upload/news/' . $row['thumbnail']);
													}
													$delete = $mysqli->query("DELETE FROM news WHERE id='$del_id'");
													if ($delete) {
														$message = notification('success', 'The Selected News Was Deleted Permanently.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											?>
											<div class="page-header page-heading">
												<h1 class="row">
													<div class="col-md-6"><i class="fa fa-edit"></i> Need Review News</div>
													<div class="col-md-6">
														<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
													</div>
												</h1>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='rss' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No News to Review.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?case=review&page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='rss' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<form role="form" method="POST" action="">
													<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
														<thead>
															<tr>
																<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
																<th>Details</th>
																<th class="hidden-xs">Image</th>
																<th class="hidden-xs">Content</th>
																<th width="80"></th>
															</tr>
														</thead>
														<tbody>
															<?php
															while ($row = $q->fetch_assoc()) {
															?>
																<tr>
																	<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																	<td>
																		<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																		<div class="article-meta">
																			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
																			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																		</div>
																	</td>
																	<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
																	<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
																	<td align="right">
																		<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																		<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<div class="news-actions">
														<div class="row">
															<div class="col-sm-3 col-md-4">
																<button type="submit" name="publish" class="btn btn-success"><span class="fa fa-refresh"></span> Publish</button>
																<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Permanent Delete</button>
															</div>
															<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
														</div>
													</div>
												</form>
											<?php
											}
											break;
										default;
											if (isset($_POST['delete']) and isset($_POST['id'])) {
												$ids = $_POST['id'];
												$count = count($ids);
												for ($i = 0; $i < $count; $i++) {
													$del_id = $ids[$i];
													$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
													$res = $mysqli->query($sql);
													if ($res) {
														$message = notification('success', 'The Selected News Was Deleted Successfully.');
													} else {
														$message = notification('error', 'Error Happened');
													}
												}
											}
											?>
											<div class="page-header page-heading">
												<h3 class="row">

													<div class="col-md-7">
														<div class="pull-right search-form">
															<form method="GET" action="news.php">
																<div class="input-group">
																	<input type="hidden" name="case" value="search" />
																	<input type="text" name="q" class="form-control" placeholder="Search">
																	<span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
																</div>
															</form>
														</div>
														<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
														<a href="news.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted News"><span class="fa fa-trash"></span></a>
														<a href="news.php?case=review" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Need Review News"><span class="fa fa-edit"></span></a>
													</div>
												</h3>
											</div>
											<?php
											if (isset($message)) {
												echo $message;
											}
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'There Are No Published News.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<form role="form" method="POST" action="">
													<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
														<thead>
															<tr>
																<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
																<th>Details</th>
																<th class="hidden-xs">Image</th>
																<th class="hidden-xs">Content</th>
																<th width="80"></th>
															</tr>
														</thead>
														<tbody>
															<?php
															while ($row = $q->fetch_assoc()) {
															?>
																<tr>
																	<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
																	<td>
																		<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'], ENT_QUOTES); ?></a></div>
																		<div class="article-meta">
																			<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {
																																									echo ' &rarr; ' . get_category($row['sub_category_id']);
																																								} ?></span>
																			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
																			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a', $row['datetime']); ?></span>
																			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
																		</div>
																	</td>
																	<td class="hidden-xs" width="150"><?php echo check_image($row['thumbnail']); ?></td>
																	<td class="hidden-xs" width="150"><?php echo check_content($row['details']); ?></td>
																	<td align="right">
																		<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																		<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																	</td>
																</tr>
															<?php
															}
															?>
														</tbody>
													</table>
													<div class="news-actions">
														<div class="row">
															<div class="col-sm-2 col-md-3"><button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button></div>
															<div class="col-sm-10 col-md-9"><?php echo $pagination->create_links(); ?></div>
														</div>
													</div>
												</form>
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
			<div>
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