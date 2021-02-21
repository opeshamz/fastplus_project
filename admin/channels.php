<?php
include('header.php');
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
	if (strpos($row['rss_link'],'/user/') != false) {
	$youtube_username = str_replace('/user/','',$u['path']);
	$baseUrl = 'https://www.googleapis.com/youtube/v3/';
	$apiKey = $options['api_youtube_apikey'];
	$link = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/channels?key='.$apiKey.'&forUsername='.$youtube_username.'&part=id'), true);
	$channelId = $link['items'][0]['id'];
	} else {
	$baseUrl = 'https://www.googleapis.com/youtube/v3/';
	$apiKey = $options['api_youtube_apikey'];
	$youtube_username = str_replace('/channel/','',$u['path']);	
	$channelId = $youtube_username;
	}
	$url = $baseUrl .'channels?' .
    'id=' . $channelId .
    '&part=contentDetails' . 
    '&key=' . $apiKey;
	$json = json_decode(file_get_contents($url), true);
	 
	$playlist = $json['items'][0]['contentDetails']['relatedPlaylists']['uploads'];
	 
	$url = $baseUrl .'playlistItems?' .
	 'part=snippet' .
	 '&maxResults=32'.
	 '&playlistId=' . $playlist .
	 '&pageToken='.$page.
	 '&key=' . $apiKey;
	$json = json_decode(file_get_contents($url), true);
?>
<div class="row">
<div class="col-xs-12">
<div class="alert alert-warning">There are (<b><?php echo $json['pageInfo']['totalResults']; ?></b>) Result(s) for <b><?php echo $row['title']; ?></b> Channel.</div>	
</div>
<?php
foreach($json['items'] as $item) {
?>
<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="youtube">
<div class="video">
<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube"><img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>" class="img-responsive" /></a></div>
<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube"><?php echo mb_substr($item['snippet']['title'],0,60,'UTF-8'); ?></a></div>
<div class="video-tools">
<div class="col-xs-6 first-action-div">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['snippet']['resourceId']['videoId']; ?>&site=youtube" class="text-info"><i class="fa fa-reorder"></i> Details</a>
</div>
<div class="col-xs-6 action-div" id="udm<?php echo $item['snippet']['resourceId']['videoId']; ?>">
<?php if (check_video_id($item['snippet']['resourceId']['videoId'],'youtube') == 0) { ?>
<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['snippet']['resourceId']['videoId']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id.','.$sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
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
echo '<a class="btn btn-default" href="channels.php?case=channel_videos&site=youtube&id='.$id.'&page='.$json['prevPageToken'].'">Previews</a>';	
} 
?>
</div>
<div class="col-xs-6 text-right">
<?php
if (isset($json['nextPageToken'])) {
echo '<a class="btn btn-default"  href="channels.php?case=channel_videos&site=youtube&id='.$id.'&page='.$json['nextPageToken'].'">Next</a>';	
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
$user = str_replace('/','',$u['path']);
$api_endpoint = 'http://vimeo.com/api/v2/' . $user;
$user = simplexml_load_string(curl_get($api_endpoint . '/info.xml'));
$videos = simplexml_load_string(curl_get($api_endpoint . '/videos.xml?page='.$page));
	$vid = object_to_array($videos);
	$vids = array_reverse($vid['video']);
	foreach ($vids as $item) {
	?>
<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="vimeo">
<div class="video">
<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo"><img src="<?php echo $item['thumbnail_large']; ?>" class="img-responsive" /></a></div>
<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo"><?php echo mb_substr($item['title'],0,60,'UTF-8'); ?></a></div>
<div class="video-tools">
<div class="col-xs-6 first-action-div">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=vimeo" class="text-info"><i class="fa fa-reorder"></i> Details</a>
</div>
<div class="col-xs-6 action-div" id="udm<?php echo $item['id']; ?>">
<?php if (check_video_id($item['id'],'vimeo') == 0) { ?>
<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['id']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id.','.$sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
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
$pages = $user_videos/20;
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
for ($i=1;$i<$page_number+1;$i++) {
if ($page == $i) {
echo '<a href="javascript:void();" class="btn btn-primary margin-right">'.$i.'</a>';	
} else {
echo '<a href="channels.php?case=channel_videos&id='.$id.'&site=vimeo&page='.$i.'" class="btn btn-default margin-right">'.$i.'</a>';	
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
$user = str_replace('/','',$u['path']);
$url = 'https://api.dailymotion.com/user/'.$user.'/videos?fields=allow_embed,description,duration,embed_url,id,thumbnail_240_url,title,created_time,tags,url&limit=24&page='.$page;
$videos = json_decode(file_get_contents($url), true);	
foreach(array_reverse($videos['list']) as $item) {
?>
<div class="col-md-3 col-sm-6 col-xs-12 video_box_channel" rel="dailymotion">
<div class="video">
<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion"><img src="<?php echo $item['thumbnail_240_url']; ?>" class="img-responsive" /></a></div>
<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion"><?php echo mb_substr($item['title'],0,60,'UTF-8'); ?></a></div>
<div class="video-tools">
<div class="col-xs-6 first-action-div">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=media_details&id=<?php echo $item['id']; ?>&site=dailymotion" class="text-info"><i class="fa fa-reorder"></i> Details</a>
</div>
<div class="col-xs-6 action-div" id="udm<?php echo $item['id']; ?>">
<?php if (check_video_id($item['id'],'dailymotion') == 0) { ?>
<a href="javascript:void();" class="import-channel-single-video text-danger" id="<?php echo $item['id']; ?>" scope="<?php echo $row['id']; ?>" rel="<?php echo $category_id.','.$sub_category_id; ?>"><i class="fa fa-refresh"></i> Import</a>
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
if (($page-1) > 0) {
$prev = $page-1;
?>
<a href="channels.php?case=channel_videos&id=<?php echo $id; ?>&site=dailymotion&page=<?php echo $prev; ?>" class="btn btn-default">Previous</a>	
<?php	
}
?>
</div>
<div class="col-xs-6 text-right">
<?php
if ($videos['has_more'] == 1) {
$next = $page+1;
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
$cc = explode(',',$category_id);
$main_category = $cc[0];
$sub_category = $cc[1];
$published = intval(make_safe(xss_clean($_POST['published'])));
$rss_link = make_safe(xss_clean($_POST['rss_link']));
$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
$source_domain = make_safe(xss_clean($_POST['source_domain']));
if (empty($title)) {
$message = notification('warning','Insert Channel Name Please.');
} elseif (empty($rss_link)) {
$message = notification('warning','Insert Channel Url Please.');
} elseif (empty($category_id)) {
$message = notification('warning','Choose a Category Please.');
} else {
$datetime = time();
$sql = "INSERT INTO sources (source_type,source_domain,title,rss_link,category_id,sub_category_id,news_number,auto_update,auto_update_period,add_time,latest_activity,published,banned_words,is_referal,referal_suffix,strip_tags,allowable_tags,thumbnail) VALUES 
							('video','$source_domain','$title','$rss_link','$main_category','$sub_category','$news_number','$auto_update','$auto_update_period','$datetime','$datetime','$published','','0','','0','','')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Source Added Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
?>
			<div class="page-header page-heading">
				<h1>Add New Video Channel
				<a href="channels.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Setting</a></li>
	<li role="presentation"><a href="#cron" aria-controls="cron" role="tab" data-toggle="tab">Cron Setting</a></li>
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
				foreach ($sites AS $key=>$value) {
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
			foreach ($categories AS $category) {
			?>
			<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;"><?php echo $category['category']; ?></option>
			<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
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
			for($i=1;$i<51;$i++) {
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
			for($t=7200;$t<86400;$t=$t+3600) {
			?>
			<option value="<?php echo $t; ?>"><?php echo ($t/3600); ?> Hours</option>
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
$cc = explode(',',$category_id);
$main_category = $cc[0];
$sub_category = $cc[1];
$published = intval(make_safe(xss_clean($_POST['published'])));
$rss_link = make_safe(xss_clean($_POST['rss_link']));
$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
$source_domain = make_safe(xss_clean($_POST['source_domain']));
if (empty($title)) {
$message = notification('warning','Insert Channel Name Please.');
} elseif (empty($rss_link)) {
$message = notification('warning','Insert Channel Link Please.');
} elseif (empty($category_id)) {
$message = notification('warning','Choose a Category Please.');
} else {
$sql = "UPDATE sources SET source_domain='$source_domain',title='$title',rss_link='$rss_link',category_id='$main_category',sub_category_id='$sub_category',news_number='$news_number',auto_update='$auto_update',auto_update_period='$auto_update_period',published='$published' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Channel Edited Successfully.');
} else {
$message = notification('danger','Error Happened.');
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
						<?php if (isset($message)) {echo $message;} ?>
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
				foreach ($sites AS $key=>$value) {
				?>
				<option value="<?php echo $key; ?>" <?php if ($source['source_domain'] == $key) {echo 'SELECTED';} ?>><?php echo $value; ?></option>	
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
			foreach ($categories AS $category) {
			?>
			<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;" <?php if ($source['category_id'] == $category['id'] AND $source['sub_category_id'] == 0) { ?>SELECTED<?php } ?>><?php echo $category['category']; ?></option>
			<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
			?>
			<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>" <?php if ($source['category_id'] == $category['id'] AND $source['sub_category_id'] == $sub['id']) { ?>SELECTED<?php } ?>> - <?php echo $sub['category']; ?></option>
			<?php			
			}			
			}
			?>
			</select>
		  </div>
		  <div class="form-group">
		  <label for="news_number">Videos State <span>*</span></label>
		   <div><input type="radio" name="published" value="1" <?php if ($source['published'] == 1) {echo 'CHECKED';} ?> /><span class="checkbox-label"> Published</span></div>
		   <div><input type="radio" name="published" value="0" <?php if ($source['published'] == 0) {echo 'CHECKED';} ?> /><span class="checkbox-label"> Draft (Review Before Publishing)</span></div>
		  </div>
		  <div class="form-group">
			<label for="news_number">Videos Number Per Grab <span>*</span></label>
			<select class="form-control" name="news_number" id="news_number">
			<?php 
			for($i=1;$i<51;$i++) {
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
			for($t=7200;$t<86400;$t=$t+3600) {
			?>
			<option value="<?php echo $t; ?>" <?php if ($source['auto_update_period'] == $t) { ?>SELECTED<?php } ?>><?php echo ($t/3600); ?> Hours</option>
			<?php			
			}
			?>
			<option value="86400"  <?php if ($source['auto_update_period'] == 86400) { ?>SELECTED<?php } ?>>1 Day</option>
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
if (!empty($row['thumbnail']) AND file_exists('../upload/news/'.$row['thumbnail'])) {
@unlink('../upload/news/'.$row['thumbnail']);	
}
$mysqli->query("DELETE FROM news WHERE id='$row[id]'");
}
}
$delete = $mysqli->query("DELETE FROM sources WHERE id='$id'");
if ($delete) {
$message = notification('success','Channel and All related Videos Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$source = $general->source($id);
?>
			<div class="page-header page-heading">
				<h1>Delete Channel
				<a href="channels.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done) AND get_source_news($id) > 0) { ?>
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
	<h1><i class="fa fa-th-large"></i> Video Channels
	<a href="channels.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM sources WHERE source_type='video' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','You didn\'t add any Channel. <a href="?case=add" class="alert-link">Add new Channel</a>.');
} else {
$pagination = new Pagination();
$pagination->setLink("?page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM sources WHERE source_type='video' ORDER BY id DESC ".$pagination->getLimitSql();
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
					if ($row['source_domain'] == 'youtube') {echo '<i class="fa fa-youtube youtube-color"></i>';}
					if ($row['source_domain'] == 'vimeo') {echo '<i class="fa fa-vimeo vimeo-color"></i>';}
					if ($row['source_domain'] == 'dailymotion') {echo '<i class="fa fa-youtube-play dailymotion-color"></i>';}
				?> 
				<a href="channels.php?case=channel_videos&id=<?php echo $row['id']; ?>&site=<?php echo $row['source_domain']; ?>"><b><?php echo $row['title']; ?></b></a> 
			</div>
			<div class="article-meta">
			<span><i class="fa fa-folder"></i> <?php echo get_category($row['category_id']); if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
			<?php if (get_source_videos($row['id']) > 0) { ?>
			<span class="empty-source"><a href="javascript:void();" rel="<?php echo $row['id']; ?>" class="empty-channel-link text-danger">Empty</a></span>
			<?php } ?>
			</div>
			</div>
			</td>
			<td class="hidden-xs"><?php echo ucwords($row['source_domain']); ?></td>
			<td class="hidden-xs"><?php echo get_source_videos($row['id']); ?></td>
			<td class="hidden-xs">
			<div class="text-muted"><?php echo date('Y-n-j h:i a',$row['add_time']); ?></div>
			<div class="text-success"><b><?php if ($row['latest_activity'] == 0) {echo 'Not Updated Yet';} else {echo date('Y-n-j h:i a',$row['latest_activity']);} ?></b></div>
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
include('footer.php');
?>