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
									<h3><i class="fa fa-th-large"></i> Video Channels

									</h3>
								</div>
								<div style="margin-right:50px; margin-left:50px;">
									<!-- begning of php new-->
									<?php

									if (!empty($_GET['case'])) {
										$case = make_safe($_GET['case']);
									} else {
										$case = '';
									}
									switch ($case) {
										case 'channel_videos';
											$site = make_safe(xss_clean($_GET['site']));
											switch ($site) {
												case 'youtube';
													$id = intval(make_safe(xss_clean($_GET['id'])));
													if (isset($_GET['page'])) {
														$page = make_safe($_GET['page']);
													} else {
														$page = '';
													}
													$sql = "SELECT * FROM sources WHERE id='$id'";
													$query = $mysqli->query($sql);
													$row = $query->fetch_assoc();
													$category_id = $row['category_id'];
													$sub_category_id = $row['sub_category_id'];
									?>
													<div class="page-header page-heading">
														<h1><i class="fa fa-youtube"></i> All Videos In <?php echo $row['title']; ?> Channel</h1>
													</div>
													<?php
													$u = parse_url($row['rss_link']);
													if (strpos($row['rss_link'], '/user/') != false) {
														$youtube_username = str_replace('/user/', '', $u['path']);
														$baseUrl = 'https://www.googleapis.com/youtube/v3/';
														$apiKey = $options['api_youtube_apikey'];
														$link = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?key=' . $apiKey . '&forUsername=' . $youtube_username . '&part=id'), true);
														$channelId = $link['items'][0]['id'];
													} else {
														$baseUrl = 'https://www.googleapis.com/youtube/v3/';
														$apiKey = $options['api_youtube_apikey'];
														$youtube_username = str_replace('/channel/', '', $u['path']);
														$channelId = $youtube_username;
													}
													$url = $baseUrl . 'channels?' .
														'id=' . $channelId .
														'&part=contentDetails' .
														'&key=' . $apiKey;
													$json = json_decode(file_get_contents($url), true);

													$playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];

													$url = $baseUrl . 'playlistItems?' .
														'part=snippet' .
														'&maxResults=32' .
														'&playlistId=' . $playlist .
														'&pageToken=' . $page .
														'&key=' . $apiKey;
													$json = json_decode(file_get_contents($url), true);
													?>
													<div class="row">
														<div class="col-xs-12">
															<div class="alert alert-warning">There are (<b><?php echo $json['pageInfo']['totalResults']; ?></b>) Result(s) for <b><?php echo $row['title']; ?></b> Channel.</div>
														</div>
														<?php
														foreach ($json['items'] as $item) {
														?>
															<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="youtube">
																<div class="video">
																	<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube"><img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>" class="img-responsive" /></a></div>
																	<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube"><?php echo mb_substr($item['snippet']['title'], 0, 60, 'UTF-8'); ?></a></div>
																	<div class="video-tools">
																		<div class="col-xs-6 first-action-div">
																			<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube" class="text-info"><i class="fa fa-reorder"></i> Details</a>
																		</div>
																		<div class="col-xs-6 action-div" id="udm<?php echo $item['snippet']['resourceId']['videoId']; ?>">
																			<?php if (check_video_id($item['snippet']['resourceId']['videoId'], 'youtube') == 0) { ?>
																				<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['snippet']['resourceId']['videoId']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id . ',' . $sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
																			<?php } else { ?>
																				<span class="text-success"><i class="fa fa-check"></i> Imported</span>
																			<?php
																			}
																			?>
																		</div>
																	</div>
																</div>
															</div>
														<?php
														}
														?>
													</div>
													<div class="col-xs-12 pages-line">
														<div class="row">
															<div class="col-xs-6">
																<?php
																if (isset($json['prevPageToken'])) {
																	echo '<a class="btn btn-default" href="channels.php?case=channel_videos&site=youtube&id=' . $id . '&page=' . $json['prevPageToken'] . '">Previews</a>';
																}
																?>
															</div>
															<div class="col-xs-6 text-right">
																<?php
																if (isset($json['nextPageToken'])) {
																	echo '<a class="btn btn-default"  href="channels.php?case=channel_videos&site=youtube&id=' . $id . '&page=' . $json['nextPageToken'] . '">Next</a>';
																}
																?>
															</div>
														</div>
													</div>
												<?php
													break;

												case 'vimeo';
													$id = intval(make_safe(xss_clean($_GET['id'])));
													if (isset($_GET['page'])) {
														$page = make_safe($_GET['page']);
													} else {
														$page = 1;
													}
													$sql = "SELECT * FROM sources WHERE id='$id'";
													$query = $mysqli->query($sql);
													$row = $query->fetch_assoc();
													$category_id = $row['category_id'];
													$sub_category_id = $row['sub_category_id'];
												?>
													<div class="page-header page-heading">
														<h1><i class="fa fa-vimeo"></i> All Videos In <?php echo $row['title']; ?> Channel</h1>
													</div>
													<?php
													$u = parse_url($row['rss_link']);
													$user = str_replace('/', '', $u['path']);
													$api_endpoint = 'http://vimeo.com/api/v2/' . $user;
													$user = simplexml_load_string(curl_get($api_endpoint . '/info.xml'));
													$videos = simplexml_load_string(curl_get($api_endpoint . '/videos.xml?page=' . $page));
													$vid = object_to_array($videos);
													$vids = array_reverse($vid['video']);
													foreach ($vids as $item) {
													?>
														<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="vimeo">
															<div class="video">
																<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo"><img src="<?php echo $item['thumbnail_large']; ?>" class="img-responsive" /></a></div>
																<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo"><?php echo mb_substr($item['title'], 0, 60, 'UTF-8'); ?></a></div>
																<div class="video-tools">
																	<div class="col-xs-6 first-action-div">
																		<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo" class="text-info"><i class="fa fa-reorder"></i> Details</a>
																	</div>
																	<div class="col-xs-6 action-div" id="udm<?php echo $item['id']; ?>">
																		<?php if (check_video_id($item['id'], 'vimeo') == 0) { ?>
																			<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['id']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id . ',' . $sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
																		<?php } else { ?>
																			<span class="text-success"><i class="fa fa-check"></i> Imported</span>
																		<?php
																		}
																		?>
																	</div>
																</div>
															</div>
														</div>
													<?php
													}
													?>
													<?php
													$user_videos = $user->user->total_videos_uploaded;
													$pages = $user_videos / 20;
													if (is_float($pages)) {
														$pages_number = ceil($pages);
													} else {
														$pages_number = $pages;
													}
													if ($pages_number >= 3) {
														$page_number = 3;
													} else {
														$page_number = $pages_number;
													}
													?>
													<div class="col-xs-12 pages-line">
														<div class="row">
															<?php
															for ($i = 1; $i < $page_number + 1; $i++) {
																if ($page == $i) {
																	echo '<a href="javascript:void();" class="btn btn-primary margin-right">' . $i . '</a>';
																} else {
																	echo '<a href="channels.php?case=channel_videos&id=' . $id . '&site=vimeo&page=' . $i . '" class="btn btn-default margin-right">' . $i . '</a>';
																}
															}
															?>
														</div>
													</div>
												<?php
													break;
												case 'dailymotion';
													$id = intval(make_safe(xss_clean($_GET['id'])));
													if (isset($_GET['page'])) {
														$page = make_safe($_GET['page']);
													} else {
														$page = 1;
													}
													$sql = "SELECT * FROM sources WHERE id='$id'";
													$query = $mysqli->query($sql);
													$row = $query->fetch_assoc();
													$category_id = $row['category_id'];
													$sub_category_id = $row['sub_category_id'];
												?>
													<div class="page-header page-heading">
														<h1><i class="fa fa-youtube-play"></i> All Videos In <?php echo $row['title']; ?> Channel</h1>
													</div>
													<?php
													$u = parse_url($row['rss_link']);
													$user = str_replace('/', '', $u['path']);
													$url = 'https://api.dailymotion.com/user/' . $user . '/videos?fields=allow_embed,description,duration,embed_url,id,thumbnail_240_url,title,created_time,tags,url&limit=24&page=' . $page;
													$videos = json_decode(file_get_contents($url), true);
													foreach (array_reverse($videos['list']) as $item) {
													?>
														<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="dailymotion">
															<div class="video">
																<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion"><img src="<?php echo $item['thumbnail_240_url']; ?>" class="img-responsive" /></a></div>
																<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion"><?php echo mb_substr($item['title'], 0, 60, 'UTF-8'); ?></a></div>
																<div class="video-tools">
																	<div class="col-xs-6 first-action-div">
																		<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion" class="text-info"><i class="fa fa-reorder"></i> Details</a>
																	</div>
																	<div class="col-xs-6 action-div" id="udm<?php echo $item['id']; ?>">
																		<?php if (check_video_id($item['id'], 'dailymotion') == 0) { ?>
																			<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['id']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id . ',' . $sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
																		<?php } else { ?>
																			<span class="text-success"><i class="fa fa-check"></i> Imported</span>
																		<?php
																		}
																		?>
																	</div>
																</div>
															</div>
														</div>
													<?php
													}
													?>
													<div class="col-xs-12 pages-line">
														<div class="row">
															<div class="col-xs-6">
																<?php
																if (($page - 1) > 0) {
																	$prev = $page - 1;
																?>
																	<a href="channels.php?case=channel_videos&id=<?php echo $id; ?>&site=dailymotion&page=<?php echo $prev; ?>" class="btn btn-default">Previous</a>
																<?php
																}
																?>
															</div>
															<div class="col-xs-6 text-right">
																<?php
																if ($videos['has_more'] == 1) {
																	$next = $page + 1;
																?>
																	<a href="channels.php?case=channel_videos&id=<?php echo $id; ?>&site=dailymotion&page=<?php echo $next; ?>" class="btn btn-default">Next</a>
																<?php
																}
																?>
															</div>
														</div>
													</div>
											<?php
													break;
												default;
											}
											break;
										case 'add';
											if (isset($_POST['submit'])) {
												$title = make_safe(xss_clean($_POST['title']));
												$category_id = make_safe(xss_clean($_POST['category_id']));
												$cc = explode(',', $category_id);
												$main_category = $cc[0];
												$sub_category = $cc[1];
												$published = intval(make_safe(xss_clean($_POST['published'])));
												$rss_link = make_safe(xss_clean($_POST['rss_link']));
												$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
												$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
												$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
												$source_domain = make_safe(xss_clean($_POST['source_domain']));
												if (empty($title)) {
													$message = notification('warning', 'Insert Channel Name Please.');
												} elseif (empty($rss_link)) {
													$message = notification('warning', 'Insert Channel Url Please.');
												} elseif (empty($category_id)) {
													$message = notification('warning', 'Choose a Category Please.');
												} else {
													$datetime = time();
													$sql = "INSERT INTO sources (source_type,source_domain,title,rss_link,category_id,sub_category_id,news_number,auto_update,auto_update_period,add_time,latest_activity,published,banned_words,is_referal,referal_suffix,strip_tags,allowable_tags,thumbnail) VALUES 
							                        ('video','$source_domain','$title','$rss_link','$main_category','$sub_category','$news_number','$auto_update','$auto_update_period','$datetime','$datetime','$published','','0','','0','','')";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Source Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											?>
											<div class="page-header page-heading">
												<h1>Add New Video Channel
													<a href="channels.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">

												<ul class="nav nav-tabs" role="tablist">
													<li class="nav-item" role="presentation" class="active"><a href="#basic" class="nav-link active" aria-controls="basic" role="tab" data-toggle="tab">Basic Setting</a></li>
													<li class="nav-item" role="presentation"><a href="#cron" class="nav-link" aria-controls="cron" role="tab" data-toggle="tab">Cron Setting</a></li>
												</ul>

												<div class="tab-content">
													<div role="tabpanel" class="tab-pane active" id="basic">
														<div class="form-group">
															<label for="title">Channel Name <span>*</span></label>
															<input type="text" class="form-control" name="title" id="title" />
														</div>
														<div class="form-group">
															<label for="source_domain">Video Site <span>*</span></label>
															<select name="source_domain" id="source_domain" class="form-control">
																<?php
																$sites = video_sites();
																foreach ($sites as $key => $value) {
																?>
																	<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
																<?php
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<label for="rss_link">Channel Url <span>*</span></label>
															<input type="text" class="form-control" name="rss_link" id="rss_link" />
														</div>
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
															<label for="news_number">Videos State <span>*</span></label>
															<div><input type="radio" name="published" value="1" CHECKED /><span class="checkbox-label"> Published</span></div>
															<div><input type="radio" name="published" value="0" /><span class="checkbox-label"> Draft (Review Before Publishing)</span></div>
														</div>
														<div class="form-group">
															<label for="news_number">Videos Number Per Grab <span>*</span></label>
															<select class="form-control" name="news_number" id="news_number">
																<?php
																for ($i = 1; $i < 51; $i++) {
																?>
																	<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>


													<div role="tabpanel" class="tab-pane" id="cron">
														<div class="form-group">
															<input type="checkbox" name="auto_update" id="auto_update" value="1" /> <span class="checkbox-label">Auto Update Channel ?</span>
														</div>
														<div class="form-group" id="auto_update_period_div">
															<label for="auto_update_period">Auto Update Period</label>
															<select class="form-control" name="auto_update_period" id="auto_update_period">
																<option value="1800">30 Minutes</option>
																<option value="2700">45 Minutes</option>
																<option value="3600">1 Hour</option>
																<?php
																for ($t = 7200; $t < 86400; $t = $t + 3600) {
																?>
																	<option value="<?php echo $t; ?>"><?php echo ($t / 3600); ?> Hours</option>
																<?php
																}
																?>
																<option value="86400">1 Day</option>
																<option value="172800">2 Days</option>
																<option value="259200">3 Days</option>
															</select>
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
												$title = make_safe(xss_clean($_POST['title']));
												$category_id = make_safe(xss_clean($_POST['category_id']));
												$cc = explode(',', $category_id);
												$main_category = $cc[0];
												$sub_category = $cc[1];
												$published = intval(make_safe(xss_clean($_POST['published'])));
												$rss_link = make_safe(xss_clean($_POST['rss_link']));
												$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
												$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
												$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
												$source_domain = make_safe(xss_clean($_POST['source_domain']));
												if (empty($title)) {
													$message = notification('warning', 'Insert Channel Name Please.');
												} elseif (empty($rss_link)) {
													$message = notification('warning', 'Insert Channel Link Please.');
												} elseif (empty($category_id)) {
													$message = notification('warning', 'Choose a Category Please.');
												} else {
													$sql = "UPDATE sources SET source_domain='$source_domain',title='$title',rss_link='$rss_link',category_id='$main_category',sub_category_id='$sub_category',news_number='$news_number',auto_update='$auto_update',auto_update_period='$auto_update_period',published='$published' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$message = notification('success', 'Channel Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$source = $general->source($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Channel
													<a href="channels.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">

												<ul class="nav nav-tabs" role="tablist">
													<li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Setting</a></li>
													<li role="presentation"><a href="#cron" aria-controls="cron" role="tab" data-toggle="tab">Cron Setting</a></li>
												</ul>

												<div class="tab-content">
													<div role="tabpanel" class="tab-pane active" id="basic">

														<div class="form-group">
															<label for="title">Channel Name <span>*</span></label>
															<input type="text" class="form-control" name="title" id="title" value="<?php echo $source['title']; ?>" />
														</div>
														<div class="form-group">
															<label for="source_domain">Video Site <span>*</span></label>
															<select name="source_domain" id="source_domain" class="form-control">
																<?php
																$sites = video_sites();
																foreach ($sites as $key => $value) {
																?>
																	<option value="<?php echo $key; ?>" <?php if ($source['source_domain'] == $key) {
																											echo 'SELECTED';
																										} ?>><?php echo $value; ?></option>
																<?php
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<label for="rss_link">Channel Url <span>*</span></label>
															<input type="text" class="form-control" name="rss_link" id="rss_link" value="<?php echo $source['rss_link']; ?>" />
														</div>
														<div class="form-group">
															<label for="category_id">Category <span>*</span></label>
															<select class="form-control" name="category_id" id="category_id">
																<?php
																$categories = $general->main_categories('category_order ASC');
																foreach ($categories as $category) {
																?>
																	<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;" <?php if ($source['category_id'] == $category['id'] and $source['sub_category_id'] == 0) { ?>SELECTED<?php } ?>><?php echo $category['category']; ?></option>
																	<?php
																	$subs = $general->sub_categories($category['id'], 'category_order ASC');
																	foreach ($subs as $sub) {
																	?>
																		<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>" <?php if ($source['category_id'] == $category['id'] and $source['sub_category_id'] == $sub['id']) { ?>SELECTED<?php } ?>> - <?php echo $sub['category']; ?></option>
																<?php
																	}
																}
																?>
															</select>
														</div>
														<div class="form-group">
															<label for="news_number">Videos State <span>*</span></label>
															<div><input type="radio" name="published" value="1" <?php if ($source['published'] == 1) {
																													echo 'CHECKED';
																												} ?> /><span class="checkbox-label"> Published</span></div>
															<div><input type="radio" name="published" value="0" <?php if ($source['published'] == 0) {
																													echo 'CHECKED';
																												} ?> /><span class="checkbox-label"> Draft (Review Before Publishing)</span></div>
														</div>
														<div class="form-group">
															<label for="news_number">Videos Number Per Grab <span>*</span></label>
															<select class="form-control" name="news_number" id="news_number">
																<?php
																for ($i = 1; $i < 51; $i++) {
																?>
																	<option value="<?php echo $i; ?>" <?php if ($source['news_number'] == $i) { ?>SELECTED<?php } ?>><?php echo $i; ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>
													<div role="tabpanel" class="tab-pane" id="cron">
														<div class="form-group">
															<input type="checkbox" name="auto_update" id="auto_update" value="1" <?php if ($source['auto_update'] == 1) { ?>CHECKED<?php } ?> /> <span class="checkbox-label">Auto Update Channel ?</span>
														</div>
														<div class="form-group" id="auto_update_period_div">
															<label for="auto_update_period">Auto Update Period</label>
															<select class="form-control" name="auto_update_period" id="auto_update_period">
																<option value="1800" <?php if ($source['auto_update_period'] == 1800) { ?>SELECTED<?php } ?>>30 Minutes</option>
																<option value="2700" <?php if ($source['auto_update_period'] == 2700) { ?>SELECTED<?php } ?>>45 Minutes</option>
																<option value="3600" <?php if ($source['auto_update_period'] == 3600) { ?>SELECTED<?php } ?>>1 Hour</option>
																<?php
																for ($t = 7200; $t < 86400; $t = $t + 3600) {
																?>
																	<option value="<?php echo $t; ?>" <?php if ($source['auto_update_period'] == $t) { ?>SELECTED<?php } ?>><?php echo ($t / 3600); ?> Hours</option>
																<?php
																}
																?>
																<option value="86400" <?php if ($source['auto_update_period'] == 86400) { ?>SELECTED<?php } ?>>1 Day</option>
																<option value="172800" <?php if ($source['auto_update_period'] == 172800) { ?>SELECTED<?php } ?>>2 Days</option>
																<option value="259200" <?php if ($source['auto_update_period'] == 259200) { ?>SELECTED<?php } ?>>3 Days</option>
															</select>
														</div>
													</div>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'delete';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['delete'])) {
												$sql = "SELECT * FROM news WHERE source_id='$id'";
												$query = $mysqli->query($sql);
												if ($query->num_rows > 0) {
													while ($row = $query->fetch_assoc()) {
														if (!empty($row['thumbnail']) and file_exists('../upload/news/' . $row['thumbnail'])) {
															@unlink('../upload/news/' . $row['thumbnail']);
														}
														$mysqli->query("DELETE FROM news WHERE id='$row[id]'");
													}
												}
												$delete = $mysqli->query("DELETE FROM sources WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Channel and All related Videos Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$source = $general->source($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Channel
													<a href="channels.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done) and get_source_news($id) > 0) { ?>
													<div class="alert alert-warning">The Channel <b><?php echo $source['title']; ?></b> Contains <b><?php echo get_source_news($id); ?></b> Video(s). Do You Want To Delete this Channel and all Related Videos ?</div>
												<?php } else { ?>
													<div class="alert alert-warning">The Channel <b><?php echo $source['title']; ?></b> is Empty. Process to Delete ?</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="channels.php" class="btn btn-default">Back To Channels</a>
												<?php } else { ?>
													<a href="channels.php" class="btn btn-default">Cancel</a>
													<button type="submit" name="delete" class="btn btn-danger">Delete</button>
												<?php } ?>
											</form>
										<?php
											break;
										default;
										?>
											<div class="page-header page-heading">
												<h3>
													<a href="channels.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
												</h3>
											</div>
											<?php
											$page = 1;
											$size = 20;
											if (isset($_GET['page'])) {
												$page = (int) $_GET['page'];
											}
											$sqls = "SELECT * FROM sources WHERE source_type='video' ORDER BY id DESC";
											$query = $mysqli->query($sqls);
											$total_records = $query->num_rows;
											if ($total_records == 0) {
												echo notification('warning', 'You didn\'t add any Channel. <a href="?case=add" class="alert-link">Add new Channel</a>.');
											} else {
												$pagination = new Pagination();
												$pagination->setLink("?page=%s");
												$pagination->setPage($page);
												$pagination->setSize($size);
												$pagination->setTotalRecords($total_records);
												$get = "SELECT * FROM sources WHERE source_type='video' ORDER BY id DESC " . $pagination->getLimitSql();
												$q = $mysqli->query($get);
											?>
												<table width="100%" cellpadding="5" cellspacing="0" class="table">
													<thead>
														<tr>
															<th>Channel</th>
															<th>Site</th>
															<th class="hidden-xs">Videos</th>
															<th class="hidden-xs">Add / Latest Update</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php
														while ($row = $q->fetch_assoc()) {
														?>
															<tr>
																<td width="400">
																	<div class="the-source">
																		<div class="article-title">
																			<?php
																			if ($row['source_domain'] == 'youtube') {
																				echo '<i class="fa fa-youtube youtube-color"></i>';
																			}
																			if ($row['source_domain'] == 'vimeo') {
																				echo '<i class="fa fa-vimeo vimeo-color"></i>';
																			}
																			if ($row['source_domain'] == 'dailymotion') {
																				echo '<i class="fa fa-youtube-play dailymotion-color"></i>';
																			}
																			?>
																			<a href="channels.php?case=channel_videos&id=<?php echo $row['id']; ?>&site=<?php echo $row['source_domain']; ?>"><b><?php echo $row['title']; ?></b></a>
																		</div>
																		<div class="article-meta">
																			<span><i class="fa fa-folder"></i> <?php echo get_category($row['category_id']);
																												if ($row['sub_category_id'] != 0) {
																													echo ' &rarr; ' . get_category($row['sub_category_id']);
																												} ?></span>
																			<?php if (get_source_videos($row['id']) > 0) { ?>
																				<span class="empty-source"><a href="javascript:void();" rel="<?php echo $row['id']; ?>" class="empty-channel-link text-danger">Empty</a></span>
																			<?php } ?>
																		</div>
																	</div>
																</td>
																<td class="hidden-xs"><?php echo ucwords($row['source_domain']); ?></td>
																<td class="hidden-xs"><?php echo get_source_videos($row['id']); ?></td>
																<td class="hidden-xs">
																	<div class="text-muted"><?php echo date('Y-n-j h:i a', $row['add_time']); ?></div>
																	<div class="text-success"><b><?php if ($row['latest_activity'] == 0) {
																										echo 'Not Updated Yet';
																									} else {
																										echo date('Y-n-j h:i a', $row['latest_activity']);
																									} ?></b></div>
																</td>
																<td align="right">
																	<a class="media_grab btn btn-primary btn-xs" href="javascript:void();" id="<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Grab"><span class="fa fa-refresh"></span></a>
																	<a class="btn btn-default btn-xs" href="channels.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
																	<a class="btn btn-danger btn-xs" href="channels.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
																</td>
															</tr>
														<?php
														}
														?>
													</tbody>
												</table>
									<?php
												echo $pagination->create_links();
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