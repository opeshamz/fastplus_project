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
										<i class="fa fa-pie-chart"></i> Polls
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
										case 'setting';
											$polls = $general->polls('id DESC');
											if (isset($_POST['save'])) {
												$message = $general->set_options($_POST, 'Polls');
											}
											$options = $general->get_options('Polls');
									?>

											<div class="page-header page-heading">
												<h1><i class="fa fa-cog"></i> Poll Setting
													<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>

												</h1>
											</div>
											<?php
											if ($polls == 0) {
												echo notification('warning', 'You haven\'t created any poll. <a href="?case=add" class="alert-link">Create New Poll</a>');
											} else {
											?>
												<?php if (isset($message)) {
													echo $message;
												} ?>
												<form role="form" method="POST" action="">
													<div class="form-group">
														<input type="hidden" name="display_poll_widget" value="0" />
														<input type="checkbox" name="display_poll_widget" id="display_poll_widget" value="1" <?php if (isset($options['display_poll_widget']) and $options['display_poll_widget'] == 1) {
																																					echo 'CHECKED';
																																				} ?> /> <span class="checkbox-label">Display Poll Widget ?</span>
													</div>
													<div id="poll-widget-div">
														<div class="form-group">
															<label for="poll_question_id">Select Poll Question</label>
															<select name="poll_question_id" id="poll_question_id" class="form-control">
																<?php

																foreach ($polls as $question) {
																?>
																	<option value="<?php echo $question['id']; ?>" <?php if ($options['poll_question_id'] == $question['id']) {
																														echo 'SELECTED';
																													} ?>><?php echo $question['question']; ?></option>
																<?php
																}
																?>
															</select>
														</div>
													</div>
													<button type="submit" name="save" class="btn btn-primary">Save</button>
												</form>
											<?php } ?>

										<?php
											break;
										case 'add';
											if (isset($_POST['submit'])) {
												$question = make_safe(xss_clean($_POST['question']));
												if (empty($question)) {
													$message = notification('warning', 'Insert Poll Question Please.');
												} else {
													if (!empty($_FILES['thumbnail']['name'])) {
														$up = new fileDir('../upload/polls/');
														$thumbnail = $up->upload($_FILES['thumbnail']);
													} else {
														$thumbnail = '';
													}
													$sql = "INSERT INTO polls (question,image) VALUES ('$question','$thumbnail')";
													$query = $mysqli->query($sql);
													if ($query) {
														$poll_id = $mysqli->insert_id;
														$answers = $_POST['answer'];
														if (count($answers) > 0) {
															for ($i = 0; $i < count($answers); $i++) {
																$answer = $answers[$i];
																$mysqli->query("INSERT INTO polls_answers (poll_id,answer) VALUES ('$poll_id','$answer')");
															}
														}
														$message = notification('success', 'Poll Added Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
										?>
											<div class="page-header page-heading">
												<h1>Add New Poll
													<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="form-group">
													<label for="question">Poll Question <span>*</span></label>
													<input type="text" class="form-control" name="question" id="question" />
												</div>
												<div class="form-group no-bottom-border">
													<label for="category_id">Image</label>
													<div class="fileinput fileinput-new input-group" data-provides="fileinput">
														<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
														<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
														<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
												</div>
												<div class="form-group">
													<label for="answer">Poll Answers <span>*</span></label>
													<div class="old_answers">
														<input type="text" class="form-control" name="answer[]" />
													</div>
													<div class="another_answer">

													</div>
													<p><a href="javascript:void();" onclick="javascript:AddMoreInputs();">Add More Answers</a></p>
												</div>
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'edit';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['submit'])) {
												$question = make_safe(xss_clean($_POST['question']));
												if (empty($question)) {
													$message = notification('warning', 'Insert Poll Question Please.');
												} else {
													if (!empty($_FILES['thumbnail']['name'])) {
														$up = new fileDir('../upload/polls/');
														$thumbnail = $up->upload($_FILES['thumbnail']);
														$up->delete("$_POST[old_thumbnail]");
													} else {
														$thumbnail = $_POST['old_thumbnail'];
													}
													$sql = "UPDATE polls SET question='$question',image='$thumbnail' WHERE id='$id'";
													$query = $mysqli->query($sql);
													if ($query) {
														$answers = $_POST['answer'];
														if (count($answers) > 0) {
															for ($i = 0; $i < count($answers); $i++) {
																$answer = $answers[$i];
																$mysqli->query("INSERT INTO polls_answers (poll_id,answer) VALUES ('$id','$answer')");
															}
														}
														$old_answers = $_POST['old_answer'];
														$old_answers_id = $_POST['old_answer_id'];
														if (count($old_answers_id) > 0) {
															for ($b = 0; $b < count($old_answers_id); $b++) {
																$old_answer = $old_answers[$b];
																$old_answer_id = $old_answers_id[$b];
																if (empty($old_answer)) {
																	$mysqli->query("DELETE FROM polls_answers WHERE id='$old_answer_id'");
																} else {
																	$mysqli->query("UPDATE polls_answers SET answer='$old_answer' WHERE id='$old_answer_id'");
																}
															}
														}
														$message = notification('success', 'Poll Edited Successfully.');
													} else {
														$message = notification('danger', 'Error Happened.');
													}
												}
											}
											$question = $general->question($id);
										?>
											<div class="page-header page-heading">
												<h1>Edit Poll
													<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="" enctype="multipart/form-data">
												<div class="form-group">
													<label for="question">Poll Question <span>*</span></label>
													<input type="text" class="form-control" name="question" id="question" value="<?php echo $question['question']; ?>" />
												</div>
												<div class="form-group no-bottom-border">
													<label for="thumbnail">Thumbnail</label>
													<div class="fileinput fileinput-new input-group" data-provides="fileinput">
														<div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
														<span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
														<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
													</div>
													<?php if (!empty($question['image'])) { ?>
														<p><a href="javascript:void();" class="delete-poll-image" id="<?php echo $question['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/polls/<?php echo $question['image']; ?>' class='img-responsive' />"><?php echo $question['image']; ?></a></p>
													<?php } ?>
												</div>
												<div class="form-group">
													<label for="answer">Poll Answers <span>*</span></label>
													<div class="old_answers">
														<?php
														$query = $mysqli->query("SELECT * FROM polls_answers WHERE poll_id='$id'");
														if ($query->num_rows > 0) {
															while ($row = $query->fetch_assoc()) {
														?>
																<input type="text" class="form-control" name="old_answer[]" value="<?php echo $row['answer']; ?>" />
																<input type="hidden" name="old_answer_id[]" value="<?php echo $row['id']; ?>" />
														<?php
															}
														}
														?>
													</div>
													<div class="another_answer">

													</div>
													<p><a href="javascript:void();" onclick="javascript:AddMoreInputs();">Add More Answers</a></p>
												</div>
												<input type="hidden" name="old_thumbnail" value="<?php echo $question['image']; ?>" />
												<button type="submit" name="submit" class="btn btn-primary">Save</button>
											</form>
										<?php
											break;
										case 'result';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											$question = $general->question($id);
											$answers = $general->answers($id);
										?>
											<div class="page-header page-heading">
												<h1><i class="fa fa-pie-chart"></i> <?php echo $question['question']; ?>
													<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
													<a href="polls.php?case=edit&id=<?php echo $id; ?>" class="btn btn-warning btn-sm pull-right"><span class="fa fa-edit"></span></a>
													<a href="polls.php?case=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm pull-right"><span class="fa fa-trash"></span></a>
												</h1>
											</div>
											<?php if ($answers == 0) {
												echo notification('warning', 'You Didn\'t Add any Answers For this Question.');
											} else { ?>
												<div class="row">
													<div class="col-md-8">
														<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
															<thead>
																<tr>
																	<th>Answer</th>
																	<th>Votes</th>
																	<th>Percent</th>
																</tr>
															</thead>
															<tbody>
																<?php
																foreach ($answers as $ans) {
																?>
																	<tr>
																		<td><?php echo $ans['answer']; ?></td>
																		<td><?php echo answer_count_votes($ans['id']); ?></td>
																		<td><?php echo number_format((answer_count_votes($ans['id']) * 100) / get_poll_votes($id), 2, '.', ''); ?>%</td>
																	</tr>
																<?php
																}
																?>
														</table>
													</div>
													<div class="col-md-4">
														<script>
															$(function() {
																Morris.Donut({
																	element: 'pollresult',
																	data: [
																		<?php
																		foreach ($answers as $answer) {
																		?> {
																				value: <?php echo answer_count_votes($answer['id']); ?>,
																				label: '<?php echo $answer['answer']; ?>',
																				formatted: '<?php echo number_format((answer_count_votes($answer['id']) * 100) / get_poll_votes($id), 2, '.', ''); ?>%'
																			},
																		<?php } ?>
																	],
																	resize: true,
																	backgroundColor: '#fff',
																	labelColor: '#aaa',
																	colors: [
																		'#0BA462',
																		'#39B580',
																		'#67C69D',
																		'#95D7BB'
																	],
																	formatter: function(x, data) {
																		return data.formatted;
																	}
																});
															});
														</script>

														<div id="pollresult"></div>
													</div>
												</div>
											<?php } ?>

										<?php
											break;
										case 'delete';
											$id = abs(intval(make_safe(xss_clean($_GET['id']))));
											if (isset($_POST['delete'])) {
												$mysqli->query("DELETE FROM poll_answers WHERE poll_id='$id'");
												$mysqli->query("DELETE FROM poll_votes WHERE poll_id='$id'");
												$delete = $mysqli->query("DELETE FROM polls WHERE id='$id'");
												if ($delete) {
													$message = notification('success', 'Poll and Related Answers and Votes Deleted Successfully.');
													$done = true;
												} else {
													$message = notification('danger', 'Error Happened.');
												}
											}
											$poll = $general->question($id);
										?>
											<div class="page-header page-heading">
												<h1>Delete Poll
													<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
												</h1>
											</div>
											<?php if (isset($message)) {
												echo $message;
											} ?>
											<form role="form" method="POST" action="">
												<?php if (empty($done)) { ?>
													<div class="alert alert-warning">Are You Sure that you want to Delete the Poll : <?php echo $poll['question']; ?> With all Related Answers and Votes ?</div>
												<?php } ?>
												<?php if ($done) { ?>
													<a href="polls.php" class="btn btn-default">Back To Polls</a>
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
													<a href="polls.php?case=setting" class="btn btn-default btn-sm pull-right"><span class="fa fa-cog"></span></a>
													<a href="polls.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
												</h3>
											</div>
											<?php
											$polls = $general->polls('id DESC');
											if ($polls == 0) {
												echo notification('warning', 'You didn\'t add any Poll. <a href="?case=add">Add new Poll</a>.');
											} else {
											?>
												<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
													<thead>
														<tr>
															<th>Question</th>
															<th class="hidden-xs">Answers</th>
															<th class="hidden-xs">Votes</th>
															<th></th>
														</tr>
													</thead>
													<tbody>
														<?php
														foreach ($polls as $question) {
														?>
															<tr>
																<td><i class="fa fa-question-circle has-image"></i> <?php echo $question['question']; ?></td>
																<td class="hidden-xs"><?php echo get_poll_answers($question['id']); ?></td>
																<td class="hidden-xs"><?php echo get_poll_votes($question['id']); ?></td>
																<td align="right">
																	<a href="polls.php?case=result&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-warning"><span class="fa fa-pie-chart"></span></a>
																	<a href="polls.php?case=edit&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
																	<a href="polls.php?case=delete&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
																</td>
															</tr>
														<?php
														}
														?>
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