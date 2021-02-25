<?php
error_reporting(E_ERROR);
include('../include/config.php');
include('functions.php');
?>
<!DOCTYPE html>
<html>
<head>
    <!-- Script Charset -->
	<meta charset="UTF-8">
	<!-- Style Viewport for Responsive purpose -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- The Script Base URL -->
		<title>RSS-Script LV | Installation</title>
		<!-- CSS Files -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<link rel="stylesheet" href="css/bootstrap-theme.min.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
		<!-- Javascript Files -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
	</head>
	<body>
	<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-push-4 logo"><i class="fa fa-rss"></i> RSS-Script LV</div>
	</div>
	<div class="row">
<?php
	switch($_GET['step']) {
	case 'finish';
	$mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
	$user = $mysqli->query("SELECT * FROM admin WHERE id='1'");
	$row = $user->fetch_assoc();
	?>
	<div class="content">
	<div class="steps row">
		<div class="col-xs-2"><span><i class="fa fa-smile-o"></i> Welcome</span></div>
		<div class="col-xs-2"><span><i class="fa fa-database"></i> Check Connection</span></div>
		<div class="col-xs-2"><span><i class="fa fa-server"></i> Install Database</span></div>
		<div class="col-xs-2"><span><i class="fa fa-cogs"></i> Configurations</span></div>
		<div class="col-xs-2"><span class="selected-span"><i class="fa fa-check"></i> Finish</span></div>
	</div>
	<div class="step-content">
	<div class="page-header page-heading">
		<h1>Finish</h1>
	</div>
	<div class="alert alert-success">Congratulation, you have installed the script successfully.</div>
	<p>to enter your site dashboard <a href="../admin/">Dashboard</a>.
	Use the following details : <br />
	Username : <code>admin</code><br />
	Password : <code>demo</code></p>
	<div class="alert alert-warning">For Security Purposes, Change the Password As Soon As Possible.</div>
	<div class="alert alert-warning">For Security Purposes, You Should Delete or Rename the <b>install folder</b>.</div>
	<div class="action-div">
	<a href="../admin/" class="btn btn-success pull-right">Dashboard</a>
	</div>
	</div>
	</div>
	<?php
	break;
	
	case 'configurations';
	$mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
	$mysqli->set_charset("utf8");
	function get_options($set) {
	global $mysqli;
	$options = array();
	$query = $mysqli->query("SELECT * FROM options WHERE option_set='$set' ORDER BY id ASC");
	while ($row = $query->fetch_assoc()) {
		$options[$row["option_name"]] = $row["option_value"];
	}  
	return $options;
	}
	function set_options($data,$set) {
	unset($data['save']);
	global $mysqli;
	foreach ($data AS $key=>$value) {
	$check = $mysqli->query("SELECT option_name FROM options WHERE option_name='$key'");
	$value = $mysqli->real_escape_string(htmlspecialchars($value,ENT_QUOTES));	
	if ($check->num_rows == 0) {
	$excute = $mysqli->query("INSERT INTO options (option_name,option_value,option_default,option_set) VALUES ('$key','$value','$value','$set')");	
	} else {
	$excute = $mysqli->query("UPDATE options SET option_value='$value' WHERE option_name='$key'");		
	}
	if ($excute) {
	$message = notification('success','All Changes Saved.');
	} else {
	$message = notification('danger','Error Happened.');
	}
	}
	return $message;
	}
	if (isset($_POST['save'])) {
	$message = set_options($_POST,'General');
	}
	?>
	<div class="content">
	<div class="steps row">
		<div class="col-xs-2"><span><i class="fa fa-smile-o"></i> Welcome</span></div>
		<div class="col-xs-2"><span><i class="fa fa-database"></i> Check Connection</span></div>
		<div class="col-xs-2"><span><i class="fa fa-server"></i> Install Database</span></div>
		<div class="col-xs-2"><span class="selected-span"><i class="fa fa-cogs"></i> Configurations</span></div>
		<div class="col-xs-2"><span><i class="fa fa-check"></i> Finish</span></div>
	</div>
	<div class="step-content">
	<div class="page-header page-heading">
		<h1>Configurations</h1>
	</div>
	<?php 
	$options = get_options('General');
	if (isset($message)) {echo $message;}
	?>
	<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="siteurl">Site Url</label>
			<input type="text" class="form-control" name="siteurl" id="siteurl" placeholder="http://www.domain.com" value="<?php echo str_replace('/install/install.php?step=configurations','',curPageURL()); ?>" />
		  </div>
		  <div class="form-group">
			<label for="seo_title">Site Name</label>
			<input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="your site title" value="<?php echo $options['seo_title']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="site_language">Site Language</label>
			<select name="site_language" id="site_language" class="form-control">
				<?php
				$lpath = '../languages/';
				$lresults = glob($lpath . "*");
					foreach ($lresults as $lresult) {
						if ($lresult === '.' or $lresult === '..') continue;
						if(is_dir($lresult)) {
						
						echo "
						<option value='".str_replace($lpath,'',$lresult)."' ";
						if (isset($options['site_language']) AND $options['site_language'] == str_replace($lpath,'',$lresult)) {
						echo 'SELECTED';
						}
						echo ">".ucfirst(str_replace($lpath,'',$lresult))."</option>";		
						}
						}
						?>						
			</select>
		   </div>
		   <div class="form-group">
			<label for="site_theme">Site Theme</label>
			<select name="site_theme" id="site_theme" class="form-control">
				<?php
				$path = '../themes/';
				$results = glob($path . "*");
					foreach ($results as $result) {
						if ($result === '.' or $result === '..') continue;
						if(is_dir($result)) {
						
						echo "
						<option value='".str_replace($path,'',$result)."'";
						if (isset($options['site_theme']) AND $options['site_theme'] == str_replace($path,'',$result)) {
						echo 'SELECTED';
						}
						echo ">".ucfirst(str_replace($path,'',$result))."</option>";		
						}
						}
						?>						
			</select>
		   </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
	<div class="action-div">
	<a href="install.php?step=finish" class="btn btn-default pull-right">Finish</a>
	</div>
	</div>
	</div>
	<?php		
	break;
	case 'install_database';
		$mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);
		$mysqli->set_charset("utf8");
		$admin_table = "CREATE TABLE IF NOT EXISTS `admin` (
					  `id` int(1) NOT NULL,
					  `username` varchar(40) NOT NULL,
					  `password` varchar(255) NOT NULL,
					  PRIMARY KEY (`id`)
					) ENGINE=MyISAM DEFAULT CHARSET=utf8;
					";
		
		$admin_data = "INSERT INTO `admin` (`id`, `username`, `password`) VALUES (1, 'admin', '4253dfc1e6a2e8626f13696efe4f3c4ba4fc036a9dc31082639b9984bdd09150')";
		
		$advertisement_table = "CREATE TABLE IF NOT EXISTS `advertisements` (
								  `id` int(12) NOT NULL AUTO_INCREMENT,
								  `title` varchar(255) NOT NULL,
								  `ad_type` varchar(20) NOT NULL,
								  `data_ad_client` varchar(255) NOT NULL,
								  `data_ad_slot` varchar(255) NOT NULL,
								  `image` varchar(255) NOT NULL,
								  `link` varchar(255) NOT NULL,
								  `place` varchar(20) NOT NULL,
								  `active` int(1) NOT NULL,
								  PRIMARY KEY (`id`)
								) ENGINE=MyISAM DEFAULT CHARSET=utf8";
		
		$categories_table = "CREATE TABLE IF NOT EXISTS `categories` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `main_id` int(12) NOT NULL,
							  `category` varchar(255) NOT NULL,
							  `image` varchar(255) NOT NULL,
							  `color` varchar(7) NOT NULL,
							  `seo_keywords` varchar(255) NOT NULL,
							  `seo_description` varchar(255) NOT NULL,
							  `category_order` int(12) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";
						
		$links_table = "CREATE TABLE IF NOT EXISTS `links` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `title` varchar(255) NOT NULL,
							  `link` varchar(255) NOT NULL,
							  `nofollow` int(1) NOT NULL,
							  `target` varchar(10) NOT NULL,
							  `published` int(1) NOT NULL,
							  `link_order` int(12) NOT NULL,
							  `place` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";
						
		$news_table = "CREATE TABLE IF NOT EXISTS `news` (
						  `id` int(12) NOT NULL AUTO_INCREMENT,
						  `source_type` varchar(40) NOT NULL,
						  `source_domain` varchar(255) NOT NULL,
						  `title` varchar(255) NOT NULL,
						  `permalink` tinytext NOT NULL,
						  `details` text NOT NULL,
						  `thumbnail` varchar(255) NOT NULL,
						  `category_id` int(12) NOT NULL,
						  `sub_category_id` int(12) NOT NULL,
						  `source_id` int(12) NOT NULL,
						  `datetime` int(12) NOT NULL,
						  `day` int(2) NOT NULL,
						  `month` int(2) NOT NULL,
						  `year` int(4) NOT NULL,
						  `hits` int(12) NOT NULL,
						  `votes_up` int(12) NOT NULL,
						  `votes_down` int(12) NOT NULL,
						  `published` int(1) NOT NULL,
						  `deleted` int(1) NOT NULL,
						  `tags` varchar(255) NOT NULL,
						  `featured` int(1) NOT NULL,
						  `video_id` varchar(255) NOT NULL,
						  `duration` int(12) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8";

		$news_votes_table = "CREATE TABLE IF NOT EXISTS `news_votes` (
						  `id` int(12) NOT NULL AUTO_INCREMENT,
						  `article_id` int(12) NOT NULL,
						  `ip_address` varchar(30) NOT NULL,
						  `up` int(1) NOT NULL,
						  `down` int(1) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
						
		$options_table = "CREATE TABLE IF NOT EXISTS `options` (
						  `id` int(12) NOT NULL AUTO_INCREMENT,
						  `option_name` varchar(100) NOT NULL,
						  `option_value` text NOT NULL,
						  `option_default` text NOT NULL,
						  `option_set` varchar(100) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
						
		$options_data = "INSERT INTO `options` (`id`, `option_name`, `option_value`, `option_default`, `option_set`) VALUES
							(1, 'siteurl', 'http://site.com', 'http://site.com', 'General'),
							(2, 'seo_title', 'RSS-Script LV', 'RSS-Script LV', 'General'),
							(3, 'seo_keywords', 'keyword1,keyword2', 'keyword1,keyword2', 'General'),
							(4, 'seo_description', 'some words as description', 'some words as description', 'General'),
							(5, 'category_sitemap', '1', '1', 'General'),
							(6, 'sitemap_news_number', '200', '200', 'General'),
							(7, 'display_comments', '1', '1', 'Comments'),
							(8, 'disques_shortname', 'nwafd', 'nwafd', 'Comments'),
							(9, 'facebook_account', 'http://facebook.com/rss_script', 'http://facebook.com/rss_script', 'Social'),
							(10, 'twitter_account', 'http://facebook.com/rss_script', 'http://facebook.com/rss_script', 'Social'),
							(11, 'google_plus_account', 'http://facebook.com/rss_script', 'http://facebook.com/rss_script', 'Social'),
							(12, 'youtube_account', 'http://facebook.com/rss_script', 'http://facebook.com/rss_script', 'Social'),
							(13, 'youtube_apikey', '', '', 'Api'),
							(14, 'site_theme', 'default', 'default', 'General'),
							(15, 'category_news_number', '20', '', 'Theme'),
							(16, 'source_news_number', '', '', 'Theme'),
							(17, 'search_news_number', '20', '', 'Theme'),
							(18, 'related_news_number', '6', '1', 'Theme'),
							(19, 'top_news_number', '5', '1', 'Theme'),
							(20, 'heading_font', 'Play', 'Anton', 'Theme'),
							(21, 'paragraph_font', 'Ubuntu', 'Allerta', 'Theme'),
							(22, 'heading_font_size', '18', '20', 'Theme'),
							(23, 'heading_font_weight', 'bold', 'normal', 'Theme'),
							(24, 'paragraph_font_size', '14', '14', 'Theme'),
							(25, 'paragraph_font_weight', 'normal', 'normal', 'Theme'),
							(26, 'display_next_days', '0', '1', 'Weather'),
							(27, 'temperature_degree', 'c', 'f', 'Weather'),
							(28, 'allow_lazyload', '1', '0', 'Theme'),
							(29, 'display_megamenu', '1', '1', 'Theme'),
							(30, 'megamenu_news_number', '3', '12', 'Theme'),
							(31, 'mobile_weather_widget', '0', '0', 'Theme'),
							(32, 'recaptcha_public', '', '', 'API'),
							(33, 'recaptcha_private', '', '', 'API'),
							(34, 'mobile_poll_widget', '1', '1', 'Theme'),
							(35, 'mobile_topnews_widget', '0', '0', 'Theme'),
							(36, 'mobile_archive_widget', '0', '0', 'Theme'),
							(37, 'mobile_social_widget', '1', '1', 'Theme'),
							(38, 'display_breadcrumb', '1', '1', 'Theme'),
							(39, 'site_language', 'english', 'english', 'General'),
							(40, 'rss_news_number', '10', '10', 'General'),
							(41, 'vimeo_account', 'http://vimeo.com', 'http://vimeo.com', 'Social'),
							(42, 'display_sections_categories', '1', '1', 'Theme'),
							(43, 'sections_categories', '4,8,12', '4,12', 'Theme'),
							(44, 'sections_content_type_rss', '1', '1', 'Theme'),
							(45, 'sections_content_type_video', '1', '1', 'Theme'),
							(46, 'sections_content_style', '3', '1', 'Theme'),
							(47, 'tab_weather_widget', '1', '1', 'Theme'),
							(48, 'tab_poll_widget', '0', '0', 'Theme'),
							(49, 'tab_topnews_widget', '0', '0', 'Theme'),
							(50, 'tab_archive_widget', '0', '0', 'Theme'),
							(51, 'tab_social_widget', '1', '1', 'Theme'),
							(52, 'comments_type', 'facebook', 'facebook', 'Comments'),
							(53, 'facebook_colorscheme', 'light', 'dark', 'Comments'),
							(54, 'facebook_order_by', 'time', 'time', 'Comments'),
							(55, 'facebook_num_posts', '5', '3', 'Comments'),
							(56, 'mail_method', 'mail', 'mail', 'Mail'),
							(57, 'send_email', '', '', 'Mail'),
							(58, 'smtp_host', '', '', 'Mail'),
							(59, 'smtp_port', '', '', 'Mail'),
							(60, 'smtp_username', '', '', 'Mail'),
							(61, 'smtp_password', '', '', 'Mail'),
							(62, 'display_poll_widget', '0', '0', 'Polls')";
										
		$pages_table = "CREATE TABLE IF NOT EXISTS `pages` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `title` varchar(255) NOT NULL,
							  `content` text NOT NULL,
							  `place` int(1) NOT NULL,
							  `page_order` int(12) NOT NULL,
							  `seo_keywords` varchar(255) NOT NULL,
							  `seo_description` text NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";

		$polls_table = "CREATE TABLE IF NOT EXISTS `polls` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `question` varchar(255) NOT NULL,
							  `image` varchar(255) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";
							
		$polls_answers_table = "CREATE TABLE IF NOT EXISTS `polls_answers` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `poll_id` int(12) NOT NULL,
							  `answer` varchar(255) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";

		$polls_votes_table = "CREATE TABLE IF NOT EXISTS `polls_votes` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `poll_id` int(12) NOT NULL,
							  `answer_id` int(12) NOT NULL,
							  `ip_address` int(12) NOT NULL,
							  `datetime` int(12) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";
							
		$sources_table = "CREATE TABLE IF NOT EXISTS `sources` (
							  `id` int(12) NOT NULL AUTO_INCREMENT,
							  `source_type` varchar(30) NOT NULL,
							  `source_domain` varchar(255) NOT NULL,
							  `title` varchar(255) NOT NULL,
							  `rss_link` varchar(255) NOT NULL,
							  `category_id` int(12) NOT NULL,
							  `sub_category_id` int(12) NOT NULL,
							  `thumbnail` varchar(255) NOT NULL,
							  `news_number` int(12) NOT NULL,
							  `add_time` int(12) NOT NULL,
							  `latest_activity` int(12) NOT NULL,
							  `banned_words` text NOT NULL,
							  `is_referal` int(1) NOT NULL,
							  `referal_suffix` varchar(255) NOT NULL,
							  `auto_update` int(1) NOT NULL,
							  `auto_update_period` int(12) NOT NULL,
							  `strip_tags` int(1) NOT NULL,
							  `allowable_tags` varchar(255) NOT NULL,
							  `published` int(1) NOT NULL,
							  PRIMARY KEY (`id`)
							) ENGINE=MyISAM DEFAULT CHARSET=utf8";
							
		$weather_table = "CREATE TABLE IF NOT EXISTS `weather` (
						  `id` int(12) NOT NULL AUTO_INCREMENT,
						  `yahoo_weather_id` varchar(20) NOT NULL,
						  `city` varchar(255) NOT NULL,
						  `published` int(1) NOT NULL,
						  `city_order` int(12) NOT NULL,
						  PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8";
						
		$weather_data = "INSERT INTO `weather` (`id`, `yahoo_weather_id`, `city`, `published`, `city_order`) VALUES
												(1, '638242', 'Berlin / Germany', 1, 1),
												(2, '1105779', 'Sydney / Australia', 1, 2)";
		
		?>
		<div class="content">
	<div class="steps row">
		<div class="col-xs-2"><span><i class="fa fa-smile-o"></i> Welcome</span></div>
		<div class="col-xs-2"><span><i class="fa fa-database"></i> Check Connection</span></div>
		<div class="col-xs-2"><span class="selected-span"><i class="fa fa-server"></i> Install Database</span></div>
		<div class="col-xs-2"><span><i class="fa fa-cogs"></i> Configurations</span></div>
		<div class="col-xs-2"><span><i class="fa fa-check"></i> Finish</span></div>
	</div>
	<div class="step-content">
	<div class="page-header page-heading">
		<h1>Install Database Tables</h1>
	</div>
	<table class="table">
	<thead>
	<tr>
		<th>Table</th>
		<th class="text-right">Installed</th>
	</tr>
	</thead>
	<tbody>
	<?php
		echo '<tr><td>admin table</td><td class="text-right">';
		if ($mysqli->query($admin_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>admin data</td><td class="text-right">';
		if ($mysqli->query($admin_data)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>advertisement table</td><td class="text-right">';
		if ($mysqli->query($advertisement_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>categories table</td><td class="text-right">';
		if ($mysqli->query($categories_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>links table</td><td class="text-right">';
		if ($mysqli->query($links_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>news table</td><td class="text-right">';
		if ($mysqli->query($news_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>options table</td><td class="text-right">';
		if ($mysqli->query($options_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>options data</td><td class="text-right">';
		if ($mysqli->query($options_data)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>pages table</td><td class="text-right">';
		if ($mysqli->query($pages_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>polls table</td><td class="text-right">';
		if ($mysqli->query($polls_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>polls answers table</td><td class="text-right">';
		if ($mysqli->query($polls_answers_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>polls votes table</td><td class="text-right">';
		if ($mysqli->query($polls_votes_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>sources table</td><td class="text-right">';
		if ($mysqli->query($sources_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>weather table</td><td class="text-right">';
		if ($mysqli->query($weather_table)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
		echo '<tr><td>weather demo data</td><td class="text-right">';
		if ($mysqli->query($weather_data)) {
			echo '<i class="fa fa-check text-success"></i> Success';
		} else {
			echo '<i class="fa fa-remove text-danger"></i> Failed';
		}
		echo '</td></tr>';
	?>
	</tbody>
	</table>
	<div class="action-div">
	<a href="install.php?step=install_database" class="btn btn-danger pull-left">Install Again</a>
	<a href="install.php?step=configurations" class="btn btn-default pull-right">Configurations</a>
	</div>
	</div>
	</div>
<?php
		
	break;	
	case 'check_connection';
		$mysqli = new mysqli($db_config['host'], $db_config['user'], $db_config['pass'], $db_config['name']);

?>
	<div class="content">
	<div class="steps row">
		<div class="col-xs-2"><span><i class="fa fa-smile-o"></i> Welcome</span></div>
		<div class="col-xs-2"><span class="selected-span"><i class="fa fa-database"></i> Check Connection</span></div>
		<div class="col-xs-2"><span><i class="fa fa-server"></i> Install Database</span></div>
		<div class="col-xs-2"><span><i class="fa fa-cogs"></i> Configurations</span></div>
		<div class="col-xs-2"><span><i class="fa fa-check"></i> Finish</span></div>
	</div>
	<div class="step-content">
	<div class="page-header page-heading">
		<h1>Checking Database Connection</h1>
	</div>
	<?php
	/* check connection */
	if (mysqli_connect_errno()) {
		echo notification('danger','The script isn\'t connected to Database. Please check your <b>config.php</b> file and insert correct details to continue.');
			echo '<div class="action-div">
				<a href="install.php?step=check_connection" class="btn btn-danger pull-right">Check Again</a>
			</div>';
			} else {
		echo notification('success','The script is connected to Database.');
		echo '<div class="action-div">
				<a href="install.php?step=install_database" class="btn btn-default pull-right">Install Database Tables</a>
			</div>';
	}
	?>
	</div>
	</div>
<?php
break;	
default;
?>
	<div class="content">
	<div class="steps row">
		<div class="col-xs-2"><span class="selected-span"><i class="fa fa-smile-o"></i> Welcome</span></div>
		<div class="col-xs-2"><span><i class="fa fa-database"></i> Check Connection</span></div>
		<div class="col-xs-2"><span><i class="fa fa-server"></i> Install Database</span></div>
		<div class="col-xs-2"><span><i class="fa fa-cogs"></i> Configurations</span></div>
		<div class="col-xs-2"><span><i class="fa fa-check"></i> Finish</span></div>
	</div>
	<div class="step-content">
	<div class="page-header page-heading">
		<h1>Welcome to RSS-Script Installation Process</h1>
	</div>
	<p>Please Be Sure that you have insert the correct <b>database</b> details in <code>config.php</code> file which is located at <code>include/config.php</code><br />
<pre>$db_config = array(
	'host' => 'localhost',
	'user' => 'your_database_username',
	'pass' => 'your_database_password',
	'name' => 'your_database_name'
);
</pre>
	</p>
	<p>Also there are some folders which should be writable <code>CHMOD to 0777 or 0755</code><br />
	<ul>
	<li><i class="fa fa-folder"></i> cache</li>
	<li><i class="fa fa-folder-open"></i> upload
		<ul>
			<li><i class="fa fa-folder"></i> ads</li>
			<li><i class="fa fa-folder"></i> categories</li>
			<li><i class="fa fa-folder"></i> polls</li>
			<li><i class="fa fa-folder"></i> news</li>
			<li><i class="fa fa-folder"></i> sources</li>
		</ul>
	</li>
	</ul>
	</p>
	<div class="action-div">
	<a href="install.php?step=check_connection" class="btn btn-default pull-right">Check Database Connection</a>
	</div>
	</div>
	</div>
<?php	
	}
?>
	</div>
	</div>
</body>
</html>
