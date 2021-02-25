<?php include('header.php'); ?>
<?php 
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'optimize_database';
if (isset($_POST['save'])) {
	$result = $mysqli->query("SHOW TABLES FROM $db_config[name]");
	while ($row = $result->fetch_row()) {
	$optimize = $mysqli->query("OPTIMIZE TABLE $row[0]");
	}
	if ($optimize) {
	$message = notification('success','Database Optimized Successfuly.');
	} else {
	$message = notification('danger','Error Happened.');
	}
}   
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-database"></i> Optimize Database</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="facebook_account">Are you sure that you want to Optimize the Database ?</label>
		  </div>
		  <button type="submit" name="save" class="btn btn-warning">Optimize Database</button>
		</form>
	
<?php 
break;
case 'clear_cache';
if (isset($_POST['save'])) {
	$folder = '../cache';
	$delete = empty_templates_cache($folder);
	if ($delete) {
	$message = notification('success','All Cache Files Are Cleared.');
	} else {
	$message = notification('danger','Error Happened.');
	}
}   
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-eraser"></i> Clear Cache</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="facebook_account">Are you sure that you want to clear all cached files ?</label>
		  </div>
		  <button type="submit" name="save" class="btn btn-danger">Clear Cache</button>
		</form>
	
<?php 
break;
case 'remove_old_news';
if (isset($_POST['save'])) {
	$period = intval($_POST['period']);
	$hits = intval($_POST['hits']);
	$no_image = intval($_POST['no_image']);
	$now = time();
	$delete_time = $now-$period;
	$where = "datetime < $delete_time";
	if ($hits > 0) {
	$where .= " AND hits < $hits";	
	}
	if ($no_image == 1) {
	$where .= " AND thumbnail=''";	
	}
	$sql = "SELECT * FROM news WHERE $where";
	$query = $mysqli->query($sql);
	$isthere = $query->num_rows;
	if ($isthere > 0) {
	while ($row = $query->fetch_assoc()) {
		if (!empty($row['thumbnail']) AND file_exists('../upload/news/'.$row['thumbnail'])) {
			@unlink('../upload/news/'.$row['thumbnail']);
		}
	}	
	}
	$delete = $mysqli->query("DELETE FROM news WHERE $where");
	$affected = $mysqli->affected_rows;
	if ($delete) {
	if ($affected == 0) {
	$message = notification('warning','There Are no News to Delete.');	
	} else {	
	$message = notification('success','All Selected News Are Cleared.');
	}
	} else {
	$message = notification('danger','Error Happened.');
	}
}   
?>

        <div class="page-header page-heading">
            <h1><i class="fa fa-trash"></i> Bulk Remove</h1>
        </div>
	<?php if (isset($message)) {echo $message;} else {echo notification('warning','Be careful, This Action can\'t be undo.');} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
		  <div class="row">
		  <div class="col-md-6">
			<label for="period">Select The Period</label>
			<select class="form-control" name="period" id="period">
				<option value="31104000">Older Than a Year</option>
				<option value="15552000">Older Than 6 months</option>
				<option value="7776000">Older Than 3 months</option>
				<option value="2592000">Older Than a month</option>
				<option value="1209600">Older Than 2 Weeks</option>
				<option value="604800">Older Than a Week</option>
				<option value="259200">Older Than 3 Days</option>				
			</select>
		  </div>
		  <div class="col-md-6">
			<label for="hits">Visits Number</label>
			<select class="form-control" name="hits" id="hits">
				<option value="0">Doesn't Matter</option>
				<option value="2">Less Than 2</option>
				<option value="5">Less Than 5</option>
				<option value="10">Less Than 10</option>
				<option value="25">Less Than 25</option>
			</select>
		  </div>
		  <div class="clear"></div>
		  </div>
		  </div>


		  <div class="form-group">
			<input type="checkbox" name="no_image" id="no_image" value="1" /> <span class="checkbox-label">Only News That Has No Image ?</span>
		  </div>
		  <button type="submit" name="save" class="btn btn-danger">Remove</button>
		</form>
	
<?php 
break;
case 'social';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Social');
}
$options = $general->get_options('Social'); 
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-twitter"></i> Social Setting</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="facebook_account">Facebook Page</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-facebook"></i></span>
				<input type="text" class="form-control" name="facebook_account" id="facebook_account" placeholder="https://facebook.com/yourpage" value="<?php echo $options['facebook_account']; ?>" />
			</div>
		  </div>
		  <div class="form-group">
			<label for="twitter_account">Twitter Account</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-twitter"></i></span>
				<input type="text" class="form-control" name="twitter_account" id="twitter_account" placeholder="http://twitter.com/your_id" value="<?php echo $options['twitter_account']; ?>" />
			</div>
		  </div>
		  <div class="form-group">
			<label for="google_plus_account">Google+ Account</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-google-plus"></i></span>
				<input type="text" class="form-control" name="google_plus_account" id="google_plus_account" placeholder="http://plus.google.com/account" value="<?php echo $options['google_plus_account']; ?>" />
			</div>
		  </div>
		  <div class="form-group">
			<label for="youtube_account">Youtube Channel</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-youtube"></i></span>
				<input type="text" class="form-control" name="youtube_account" id="youtube_account" placeholder="http://youtube.com/user/channel_name" value="<?php echo $options['youtube_account']; ?>" />
		    </div>
		  </div>
		  <div class="form-group">
			<label for="vimeo_account">Vimeo Channel</label>
			<div class="input-group">
				<span class="input-group-addon"><i class="fa fa-vimeo"></i></span>
				<input type="text" class="form-control" name="vimeo_account" id="vimeo_account" placeholder="http://vimeo.com/user_id" value="<?php echo $options['vimeo_account']; ?>" />
		    </div>
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
	
<?php 
break;
case 'comments';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Comments');
}
$options = $general->get_options('Comments'); 
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-comment"></i> Comments Setting</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<input type="hidden" name="display_comments" value="0" />
			<input type="checkbox" name="display_comments" id="display_comments" value="1" <?php if ($options['display_comments'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Display Comments ?</span>
		  </div>
		  <div class="form-group">
			<label for="comments_type">Comments Type</label>
			<div><input type="radio" name="comments_type" onclick="javascript:ShowComments('disqus_div');" value="disqus" <?php if ($options['comments_type'] == 'disqus') {echo 'CHECKED';} ?> /> <b>Disqus Comments</b></div>
			<div><input type="radio" name="comments_type" onclick="javascript:ShowComments('facebook_div');" value="facebook" <?php if ($options['comments_type'] == 'facebook') {echo 'CHECKED';} ?> /> <b>Facebook Comments</b></div>
		  </div>
		  <div id="disqus_div">
		  <div class="form-group">
			<label for="facebook_account">Disques Shortname</label>
			<input type="text" class="form-control" name="disques_shortname" id="disques_shortname" value="<?php echo $options['disques_shortname']; ?>" />
		  </div>
		  </div>
		  <div id="facebook_div">
		  <div class="form-group">
			<label for="facebook_colorscheme">Facebook Comments ColorScheme</label>
			<select class="form-control" name="facebook_colorscheme" id="facebook_colorscheme">
				<option value="light" <?php if ($options['facebook_colorscheme'] == 'light') {echo 'SELECTED';} ?>>Light</option>
				<option value="dark" <?php if ($options['facebook_colorscheme'] == 'dark') {echo 'SELECTED';} ?>>Dark</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="facebook_order_by">Facebook Comments Ordering</label>
			<select class="form-control" name="facebook_order_by" id="facebook_order_by">
				<option value="social" <?php if ($options['facebook_order_by'] == 'social') {echo 'SELECTED';} ?>>Social</option>
				<option value="reverse_time" <?php if ($options['facebook_order_by'] == 'reverse_time') {echo 'SELECTED';} ?>>Reverse Time</option>
				<option value="time" <?php if ($options['facebook_order_by'] == 'time') {echo 'SELECTED';} ?>>Time</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="facebook_num_posts">Facebook Comments Number</label>
			<input type="number" class="form-control" name="facebook_num_posts" id="facebook_num_posts" value="<?php echo $options['facebook_num_posts']; ?>" />
		  </div>
		  </div>
		  
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
	
<?php 
break;
case 'apis';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'API');
}
$options = $general->get_options('API'); 
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-key"></i> Api's Setting</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="recaptcha_public">ReCaptcha Public Key</label>
			<input type="text" class="form-control" name="recaptcha_public" id="recaptcha_public" value="<?php echo $options['recaptcha_public']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="recaptcha_private">ReCaptcha Private Key</label>
			<input type="text" class="form-control" name="recaptcha_private" id="recaptcha_private" value="<?php echo $options['recaptcha_private']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="youtube_apikey">YouTube API Key</label>
			<input type="text" class="form-control" name="youtube_apikey" id="youtube_apikey" value="<?php echo $options['youtube_apikey']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="facebook_admin_id">Facebook Admin ID</label>
			<input type="text" class="form-control" name="facebook_admin_id" id="facebook_admin_id" value="<?php echo $options['facebook_admin_id']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="twitter_account_username">Twitter Account Username</label>
			<input type="text" class="form-control" name="twitter_account_username" id="twitter_account_username" value="<?php echo $options['twitter_account_username']; ?>" placeholder="@username" />
		  </div>
		  <div class="form-group">
			<label for="ga_tracking_number">Google Analytics Tracking Number</label>
			<input type="text" class="form-control" name="ga_tracking_number" id="ga_tracking_number" value="<?php echo $options['ga_tracking_number']; ?>" placeholder="UA-64616308-1" />
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
	
<?php 
break;

case 'mail';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Mail');
}
$options = $general->get_options('Mail'); 
?>

        <div class="page-header page-heading">
            <h1><i class="fa fa-envelope"></i> Mail Setting</h1>
        </div>
		<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label>
			<input type="hidden" name="enable_contact_page" value="0" />
			<input data-toggle="toggle" data-size="mini" type="checkbox" name="enable_contact_page" id="enable_contact_page" value="1" <?php if (isset($options['enable_contact_page']) AND $options['enable_contact_page'] == 1) {echo 'CHECKED';} ?> /> Enable Contact Page ?
			</label>
		  </div>
		  <div class="form-group">
			<label for="reciption_email">Reciption E-Mail</label>
			<input type="text" class="form-control" name="reciption_email" id="reciption_email" value="<?php echo $options['reciption_email']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="mail_method">Send Mail Method</label>
			<div><input type="radio" name="mail_method" onclick="javascript:ShowDiv('mail_div');" value="mail" <?php if ($options['mail_method'] == 'mail') {echo 'CHECKED';} ?> /> <b>PHP Mail Function</b></div>
			<div><input type="radio" name="mail_method" onclick="javascript:ShowDiv('smtp_div');" value="smtp" <?php if ($options['mail_method'] == 'smtp') {echo 'CHECKED';} ?> /> <b>SMTP</b> (Recommended)</div>
		  </div>
		  <div id="mail_div">
		  <div class="form-group">
			<label for="send_email">E-Mail</label>
			<input type="text" class="form-control" name="send_email" id="send_email" value="<?php echo $options['send_email']; ?>" />
		  </div>
		  </div>
		  <div id="smtp_div">
		  <div class="form-group">
			<label for="smtp_host">SMTP Host</label>
			<input type="text" class="form-control" name="smtp_host" id="smtp_host" value="<?php echo $options['smtp_host']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="smtp_port">SMTP Port</label>
			<input type="text" class="form-control" name="smtp_port" id="smtp_port" value="<?php echo $options['smtp_port']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="smtp_username">SMTP Username</label>
			<input type="text" class="form-control" name="smtp_username" id="smtp_username" value="<?php echo $options['smtp_username']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="smtp_password">SMTP Password</label>
			<input type="text" class="form-control" name="smtp_password" id="smtp_password" value="<?php echo $options['smtp_password']; ?>" />
		  </div>
		  
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
<?php 
break;
case 'theme';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Theme');
}
$general_s = $general->get_options('General');
$options = $general->get_options('Theme');
include('../themes/'.$general_s['site_theme'].'/options.php');
break;

default;
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'General');
}
$options = $general->get_options('General'); 
?>
        <div class="page-header page-heading">
            <h1><i class="fa fa-cog"></i> General Setting</h1>
        </div>
		<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="siteurl">Site Url</label>
			<input type="text" class="form-control" name="siteurl" id="siteurl" placeholder="http://www.domain.com" value="<?php echo $options['siteurl']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="seo_title">Site Name</label>
			<input type="text" class="form-control" name="seo_title" id="seo_title" placeholder="your site title" value="<?php echo $options['seo_title']; ?>" />
		  </div>
		  
		  <div class="form-group">
			<label for="seo_keywords">SEO Keywords</label>
			<input type="text" class="form-control tags" name="seo_keywords" id="seo_keywords" placeholder="news,rss,feeds" value="<?php echo $options['seo_keywords']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="seo_description">SEO Description</label>
			<textarea class="form-control" name="seo_description" id="seo_description" rows="3" placeholder="some words about the site .. don't exceed 255 character."><?php echo $options['seo_description']; ?></textarea>
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
		  <div class="form-group">
			<input type="hidden" name="category_sitemap" value="0" />
			<input type="checkbox" name="category_sitemap" id="category_sitemap" value="1" <?php if ($options['category_sitemap'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Include Categories in Sitemap ?</span>
		  </div>
		  <div class="form-group">
			<label for="sitemap_news_number">Number Of Items Per Sitemap</label>
			<input type="text" class="form-control" name="sitemap_news_number" id="sitemap_news_number" placeholder="10000" value="<?php echo $options['sitemap_news_number']; ?>" />
			<p class="help">If you leave it blank, the default is : 10000 per sitemap.</p>
		  </div>
		  <div class="form-group">
			<label for="rss_news_number">Number Of Items In RSS Page</label>
			<input type="text" class="form-control" name="rss_news_number" id="rss_news_number" placeholder="10" value="<?php echo $options['rss_news_number']; ?>" />
			<p class="help">If you leave it blank, the default is : 10 items.</p>
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
<?php } ?>
<?php include('footer.php'); ?>
 