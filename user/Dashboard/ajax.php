<?php
session_start();
header("Content-type: text/html; charset=utf8");
error_reporting(0);
set_time_limit(0);
ini_set('memory_limit', -1);
ini_set('display_errors', 0);
if(!isset($_SESSION['rss_script_admin'])) {
header("location:login.php");
exit;
}
include('../include/config.php');
include('../include/connect.php');
include('include/functions.php');
include('include/setting.php');
include('include/general.class.php');
$general = new General;
$general->set_connection($mysqli);
$options = $general->get_all_options();
$case = make_safe(xss_clean($_GET['case']));
$action = make_safe(xss_clean($_POST['action'])); 
if ($case == 'change_heading_font') {
$selected_font = $_GET['selected_font'];
$selected_font_size = $_GET['selected_font_size'];
$selected_font_weight = $_GET['selected_font_weight'];
echo '<link href="http://fonts.googleapis.com/css?family='.$selected_font.'" rel="stylesheet" type="text/css">';
echo '<style>
.example-header {
	font-family: '.str_replace('+',' ',$selected_font).';
	background:#f5f5f5;
	padding:5px;
	font-size:'.$selected_font_size.'px;
	font-weight:'.$selected_font_weight.';
}
</style>';	
echo 'The quick brown fox jumps over the lazy dog';
}
if ($case == 'change_paragraph_font') {
$selected_font = $_GET['selected_font'];
$selected_font_size = $_GET['selected_font_size'];
$selected_font_weight = $_GET['selected_font_weight'];
echo '<link href="http://fonts.googleapis.com/css?family='.$selected_font.'" rel="stylesheet" type="text/css">';
echo '<style>
.example-paragraph {
	font-family: '.str_replace('+',' ',$selected_font).';
	background:#f5f5f5;
	padding:5px;
	font-size:'.$selected_font_size.'px;
	font-weight:'.$selected_font_weight.';
}
</style>';	
echo 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.';
}
if ($action == "sort_pages"){
	$records = $_POST['records'];
	$counter = 1;
	foreach ($records as $record) {
		$sql = "UPDATE pages SET page_order='$counter' WHERE id='$record'";
		$query = $mysqli->query($sql);
		$counter = $counter + 1;	
	}
}
if ($action == "clear_source_news"){
	$id = intval(make_safe(xss_clean($_POST['id'])));
	if ($id != 0) {
	$sql = "SELECT * FROM news WHERE source_id='$id'";
	$query = $mysqli->query($sql);
	while ($row = $query->fetch_assoc()) {
		if (!empty($row['thumbnail'])) {
			if (file_exists('../upload/news/'.$row['thumbnail'])) {
				@unlink('../upload/news/'.$row['thumbnail']);
			}
		}
		$mysqli->query("DELETE FROM news WHERE id='$row[id]'");
		$mysqli->query("UPDATE sources SET latest_activity='' WHERE id='$id'");
	}
	}
}
if ($action == "sort_links"){
	$records = $_POST['records'];
	$counter = 1;
	foreach ($records as $record) {
		$sql = "UPDATE links SET link_order='$counter' WHERE id='$record'";
		$query = $mysqli->query($sql);
		$counter = $counter + 1;	
	}
}
if ($action == "sort_cities"){
	$records = $_POST['records'];
	$counter = 1;
	foreach ($records as $record) {
		$sql = "UPDATE weather SET city_order='$counter' WHERE id='$record'";
		$query = $mysqli->query($sql);
		$counter = $counter + 1;	
	}
}

if ($action == "sort_pages"){
	$records = $_POST['records'];
	$counter = 1;
	foreach ($records as $record) {
		$sql = "UPDATE pages SET page_order='$counter' WHERE id='$record'";
		$query = $mysqli->query($sql);
		$counter = $counter + 1;	
	}
}
if ($action == "sort_category"){
	$records = $_POST['records'];
	$counter = 1;
	foreach ($records as $record) {
		$sql = "UPDATE categories SET category_order='$counter' WHERE id='$record'";
		$query = $mysqli->query($sql);
		$counter = $counter + 1;	
	}
}
if ($action == "remove_image") {
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$sql = "SELECT thumbnail FROM news WHERE id='$id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (file_exists('../upload/news/'.$row['thumbnail'])) {
		@unlink('../upload/news/'.$row['thumbnail']);
	}
	$mysqli->query("UPDATE news SET thumbnail='' WHERE id='$id'");
}
if ($action == "remove_category_image") {
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$sql = "SELECT image FROM categories WHERE id='$id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (file_exists('../upload/categories/'.$row['image'])) {
		@unlink('../upload/categories/'.$row['image']);
	}
	$mysqli->query("UPDATE categories SET image='' WHERE id='$id'");
}
if ($action == "remove_source_image") {
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$sql = "SELECT thumbnail FROM sources WHERE id='$id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (file_exists('../upload/sources/'.$row['thumbnail'])) {
		@unlink('../upload/sources/'.$row['thumbnail']);
	}
	$mysqli->query("UPDATE sources SET thumbnail='' WHERE id='$id'");
}
if ($action == "remove_poll_image") {
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$sql = "SELECT image FROM polls WHERE id='$id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (file_exists('../upload/polls/'.$row['image'])) {
		@unlink('../upload/polls/'.$row['image']);
	}
	$mysqli->query("UPDATE polls SET image='' WHERE id='$id'");
}
if ($action == "news_grab") {
	
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$start_time = time();
	$sql = "SELECT * FROM sources WHERE id='$id' LIMIT 1";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	$category_id = $row['category_id'];
	$sub_category_id = $row['sub_category_id'];
	$source_id = $row['id'];
	$rss_link = $row['rss_link'];
	$news_number = $row['news_number'];
	$published = $row['published'];
	$import_full_post = $row['import_full_post'];
	$day = date('j');
	$month = date('n');
	$year = date('Y');
	include('include/autoloader.php');
		$feed = new SimplePie();
		$feed->set_useragent('Mozilla/4.0 '.SIMPLEPIE_USERAGENT);
		$feed->set_feed_url($rss_link);
		$feed->strip_htmltags(false);
		$feed->force_feed(true);
		$feed->init(); 
		$feed->handle_content_type();
		$array = array_reverse($feed->get_items(0,$news_number));
			foreach ($array AS $item) {
				$link = $item->get_permalink();
				if (strpos($link,'feedproxy') != false) {
				$orig = $item->get_item_tags('http://rssnamespace.org/feedburner/ext/1.0','origLink');
				$permalink = $orig[0]['data'];
				} else {
				$permalink = $link;
				}
				$title = htmlspecialchars($item->get_title(), ENT_QUOTES);
				if (mb_strlen(strip_tags($item->get_content()),'UTF-8') > mb_strlen(strip_tags($item->get_description()),'UTF-8')) {
				$details = $item->get_content();					
				} else {
				$details = $item->get_description();
				}
				$datetime = time();
				
				if (check_item_url($permalink) == 0) {
				if ($enclosure = $item->get_enclosure())
				{
				$image = $enclosure->get_link();
				if (empty($image)) {
				$image = $enclosure->get_thumbnail();
				}
				if (empty($image)) {
				$image = get_first_image($item->get_content());
				if (empty($image)) {
				$image = get_first_image($item->get_description());
				}
				} else {
				$image = $enclosure->get_link();
				if (empty($image)) {
				$image = $enclosure->get_thumbnail();
				}
				}
				} else {
				$image = get_first_image($item->get_content());
				if (empty($image)) {
				$image = get_first_image($item->get_description());
				}
				}
				if (!empty($image)) {
				$head = array_change_key_case(get_headers("$image", TRUE));
				$filesize = $head['content-length'];	
				if ($filesize > 1024) {		
				$filetype = strtolower(substr(strrchr($image,'.'),1));
				if (in_array($filetype,array('jpg','jpeg','png','gif'))) {
				$filename = 'image_'.time().'_'.rand(0000000,99999999).'.'.$filetype;
				$up = file_put_contents('../upload/news/'.$filename,file_get_contents($image));
				$filename = $filename;
				} else {
				$filename = 'image_'.time().'_'.rand(0000000,99999999).'.jpg';
				$up = file_put_contents('../upload/news/'.$filename,file_get_contents($image));
				$filename = $filename;
				}
				} else {
				$filename = '';
				}
				} else {
				$filename = '';	
				}
				$enc_details = htmlspecialchars($details,ENT_QUOTES);
				$tags = title_to_keywords($item->get_title());
				$source_domain = get_domain($permalink);
				$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,title,permalink,category_id,sub_category_id,source_id,details,datetime,published,thumbnail,day,month,year,tags,video_id,duration,votes_up,votes_down,featured,deleted,hits) 
													  VALUES ('rss','$source_domain','$title','$permalink','$category_id','$sub_category_id','$source_id','$enc_details','$datetime','$published','$filename','$day','$month','$year','$tags','0','0','0','0','0','0','0')");
				}
			}
	
	$now = time();
	$mysqli->query("UPDATE sources SET latest_activity='$now' WHERE id='$id'");
}


if ($case == "video_details"){
$id = make_safe(xss_clean($_GET['id']));
$site = make_safe(xss_clean($_GET['site']));
?>
<div class="modal-dialog" id="media-details">
		<div class="modal-content">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h4 class="modal-title">Video Details</h4>
		</div>
		<div class="modal-body">
			<div class="embed-responsive embed-responsive-16by9">
			<?php if ($site == 'youtube') { ?>
			<iframe src="http://www.youtube.com/embed/<?php echo $id; ?>"></iframe>
			<?php } elseif ($site == 'vimeo') { ?>
			<iframe src="https://player.vimeo.com/video/<?php echo $id; ?>"></iframe>
			<?php } else { ?>
			<div class="alert alert-warning">DailyMotion Videos Can't Load in Ajax Modals. you can watch the selected video by clicking dailymotion.com link <a href="http://www.dailymotion.com/video/<?php echo $id; ?>" class="alert-link" target="_BLANK">Watch Video</a></div>
			<?php } ?>
			</div>
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
		</div>
</div>
<?php
}



if ($action == "media_channel_import") {
	
	$id = abs(intval($_POST['id']));
	if (empty($id)) {
	header("location:login.php");
	}
	$start_time = time();
	$sql = "SELECT * FROM sources WHERE id='$id' LIMIT 1";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	$category_id = $row['category_id'];
	$sub_category_id = $row['sub_category_id'];
	$source_id = $row['id'];
	$rss_link = $row['rss_link'];
	$published = $row['published'];
	$news_number = $row['news_number'];
	$day = date('j');
	$month = date('n');
	$year = date('Y');
	
	if ($row['source_domain'] == 'youtube') {
	$u = parse_url($rss_link);
	if (strpos($rss_link,'/user/') != false) {
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
	 '&maxResults=' .$news_number.
	 '&playlistId=' . $playlist .
	 '&key=' . $apiKey;
	$json = json_decode(file_get_contents($url), true);
	foreach(array_reverse($json['items']) as $video) {
		$video_id = $video['snippet']['resourceId']['videoId'];
		$video_title = htmlspecialchars($video['snippet']['title'],ENT_QUOTES);
		$video_details = htmlspecialchars($video['snippet']['description'],ENT_QUOTES);
		if (!empty($video['snippet']['thumbnails']['standard']['url'])) {
		$video_thumbnail = $video['snippet']['thumbnails']['standard']['url'];
		} else {
		$video_thumbnail = $video['snippet']['thumbnails']['high']['url'];	
		}
		$video_youtube_url = 'http://www.youtube.com/watch?v='.$video_id;
		if (check_video_id($video_id,'youtube') == 0) {
		$videt = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$video_id.'&part=contentDetails&key='.$apiKey), true);
		$video_duration = $videt['items'][0]['contentDetails']['duration'];
		$duration = youtube_duration($video_duration);
		$datetime = time();
		if (!empty($video_thumbnail)) {
		$thumb = 'youtube_'.$video_id.'.jpg';
		$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		if (count($video['snippet']['tags']) > 0) {
			$tags = implode(',',$video['snippet']['tags']);
		} else {
			$tags = title_to_keywords($video['snippet']['title']);
		}
		//$publish_time = youtube_date_to_unix($video['snippet']['publishedAt']);
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES 
												   ('video','youtube','$video_id','$source_id','$category_id','$sub_category_id','$video_title','$video_details','$video_youtube_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
		}
	}	
	}
	
	
	
	if ($row['source_domain'] == 'vimeo') {
	$u = parse_url($rss_link);
	$user = str_replace('/','',$u['path']);
	$api_endpoint = 'http://vimeo.com/api/v2/' . $user;
	$user = simplexml_load_string(curl_get($api_endpoint . '/info.xml'));
	// if this user isn't updated before then import all his videos
	if ($row['latest_activity'] == $row['add_time']) {
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
	for ($i=$page_number;$i>0;$i--) {
	$videos = simplexml_load_string(curl_get($api_endpoint . '/videos.xml?page='.$i));
	$vid = object_to_array($videos);
	$vids = array_reverse($vid['video']);
	foreach ($vids as $video) {
	$title = htmlspecialchars($video['title'],ENT_QUOTES);	
	$description = htmlspecialchars($video['description'],ENT_QUOTES);
    if (count(explode(',',$video['tags'])) > 0) {
	$tags = $video['tags'];		
	} else { 	
	$tags = title_to_keywords($title);	
	}
	$permalink = $video['url'];	
	$duration = $video['duration'];	
	$vimeo_id = $video['id'];	
	$vimeo_user_id = $video['user_id'];
	$thumbnail = $video['thumbnail_large'];	
	$privacy = $video['embed_privacy'];
	if (check_video_id($vimeo_id,'vimeo') == 0) {
	$datetime = time();
	$day = date('j');
	$month = date('n');
	$year = date('Y');
	if ($privacy == 'anywhere') {
	if (!empty($thumbnail)) {
	$filetype = strtolower(substr(strrchr($thumbnail,'.'),1));
	$thumb = 'vimeo_'.$vimeo_id.'.'.$filetype;
	$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($thumbnail));	
	} else {
	$thumb = '';	
	}
	//$publish_time = vimeo_date_to_unix($video['upload_date']);
	$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES ('video','vimeo','$vimeo_id','$source_id','$category_id','$sub_category_id','$title','$description','$permalink','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
	}
	}
	}
	}
	// if this user is updated before then import only new videos
	} else {
	$videos = simplexml_load_string(curl_get($api_endpoint . '/videos.xml'));
	$vid = object_to_array($videos);
	$vids = array_reverse($vid['video']);
	foreach ($vids as $video) {
	$title = addslashes(htmlspecialchars($video['title'],ENT_QUOTES));	
	$description = addslashes(htmlspecialchars($video['description'],ENT_QUOTES));	
	if (count(explode(',',$video['tags'])) > 0) {
	$tags = $video['tags'];		
	} else { 	
	$tags = title_to_keywords($title);	
	}
	$permalink = $video['url'];	
	$duration = $video['duration'];	
	$vimeo_id = $video['id'];	
	$vimeo_user_id = $video['user_id'];
	$thumbnail = $video['thumbnail_large'];	
	$privacy = $video['embed_privacy'];	
	if (check_video_id($vimeo_id,'vimeo') == 0) {	
	$datetime = time();
	$day = date('j');
	$month = date('n');
	$year = date('Y');
	if ($privacy == 'anywhere') {
	if (!empty($thumbnail)) {
	$filetype = strtolower(substr(strrchr($thumbnail,'.'),1));
	$thumb = 'vimeo_'.$vimeo_id.'.'.$filetype;
	$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($thumbnail));	
	} else {
	$thumb = '';	
	}
	//$publish_time = vimeo_date_to_unix($video['upload_date']);
	$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES ('video','vimeo','$vimeo_id','$source_id','$category_id','$sub_category_id','$title','$description','$permalink','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
	}
	}
	}
	}		
	}
	
	
	
	if ($row['source_domain'] == 'dailymotion') {
	$u = parse_url($rss_link);
	$user = str_replace('/','',$u['path']);
	$url = 'https://api.dailymotion.com/user/'.$user.'/videos?fields=allow_embed,description,duration,embed_url,id,thumbnail_720_url,thumbnail_url,title,created_time,tags,url&limit='.$news_number;
	$videos = json_decode(file_get_contents($url), true);	
	foreach(array_reverse($videos['list']) as $video) {
		if ($video['allow_embed'] == 1) {
		$video_id = $video['id'];
		if (check_video_id($video_id,'dailymotion') == 0) {
		$video_title = htmlspecialchars($video['title'],ENT_QUOTES);
		$video_details = htmlspecialchars($video['description'],ENT_QUOTES);
		if (isset($video['thumbnail_720_url']) AND !empty($video['thumbnail_720_url'])) {
		$video_thumbnail = $video['thumbnail_720_url'];
		} else {
		$video_thumbnail = $video['thumbnail_url'];	
		}
		$video_dailymotion_url = $video['url'];
		$duration = $video['duration'];
		$datetime = time();
		if (!empty($video_thumbnail)) {
		$filetype = strtolower(substr(strrchr($video_thumbnail,'.'),1));
		$thumb = 'dailymotion_'.$video_id.'.'.$filetype;
		$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		if (count($video['tags']) > 0) {
			$tags = implode(',',$video['tags']);
		} else {
			$tags = title_to_keywords($video['title']);
		}
		//$publish_time = $video['created_time'];
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES ('video','dailymotion','$video_id','$source_id','$category_id','$sub_category_id','$video_title','$video_details','$video_dailymotion_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
		}
		}
	}
	}	
	$now = time();
	$mysqli->query("UPDATE sources SET latest_activity='$now' WHERE id='$id'");
	
}


// import single video
if ($action == "import_single_youtube_video") {
	$id = make_safe($_POST['id']);
	$category = make_safe($_POST['category']);
	$cc = explode(',',$category);
	$category_id = $cc[0];
$sub_category_id = 0+$cc[1];
	if (empty($id)) {
	header("location:login.php");
	}
		$baseUrl = 'https://www.googleapis.com/youtube/v3/';
		$apiKey = $options['api_youtube_apikey'];
		$url = $baseUrl .'videos?' .
				'id=' .$id.
				'&part=snippet' . 
				'&key=' . $apiKey;
		$json = json_decode(file_get_contents($url), true);

		if (count($json['items']) == 0) {
		echo 'failure';	
		} else {			
		$video_title = htmlspecialchars($json['items'][0]['snippet']['title'],ENT_QUOTES);
		$video_details = htmlspecialchars($json['items'][0]['snippet']['description'],ENT_QUOTES);
		if (!empty($json['items'][0]['snippet']['thumbnails']['standard']['url'])) {
		$video_thumbnail = $json['items'][0]['snippet']['thumbnails']['standard']['url'];
		} else {
		$video_thumbnail = $json['items'][0]['snippet']['thumbnails']['high']['url'];	
		}
		$video_youtube_url = 'http://www.youtube.com/watch?v='.$id;
		$videt = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$id.'&part=contentDetails&key='.$apiKey), true);
		$video_duration = $videt['items'][0]['contentDetails']['duration'];
		$duration = youtube_duration($video_duration);
		if (check_video_id($id,'youtube') == 0) {
		$datetime = time();
		$day = date('j');
		$month = date('n');
		$year = date('Y');
		if (!empty($video_thumbnail)) {
		$thumb = 'youtube_'.$id.'.jpg';
		$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		if (count($json['items'][0]['snippet']['tags']) > 0) {
			$tags = implode(',',$json['items'][0]['snippet']['tags']);
		} else {
			$tags = title_to_keywords($json['items'][0]['snippet']['title']);
		}
		//$publish_time = youtube_date_to_unix($json['items'][0]['snippet']['publishedAt']);
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES ('video','youtube','$id','0','$category','$sub_category_id','$video_title','$video_details','$video_youtube_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','1','0','0','0','0','0')");
		if ($insert) {
		echo 'success';	
		} else {
		echo 'failure';	
		}
		} else {
		echo 'failure';	
		}
		}
}


if ($action == "import_single_dailymotion_video") {
	$id = make_safe($_POST['id']);
	$category = make_safe($_POST['category']);
	$cc = explode(',',$category);
	$category_id = $cc[0];
	$sub_category_id = 0+$cc[1];
	if (empty($id)) {
	header("location:login.php");
	}
		$url = 'https://api.dailymotion.com/video/'.$id.'?fields=allow_embed,description,duration,embed_url,id,thumbnail_720_url,thumbnail_url,title,created_time,tags,url';
		$json = json_decode(file_get_contents($url), true);

		if (count($json) == 0) {
		echo 'failure';	
		} else {
		if ($json['allow_embed'] == 1) {
		$video_id = $json['id'];			
		$video_title = htmlspecialchars($json['title'],ENT_QUOTES);
		$video_details = htmlspecialchars($json['description'],ENT_QUOTES);
		if (!empty($json['thumbnail_720_url'])) {
		$video_thumbnail = $json['thumbnail_720_url'];
		} else {
		$video_thumbnail = $json['thumbnail_url'];	
		}
		$video_youtube_url = $json['url'];	
		if (check_video_id($id,'dailymotion') == 0) {
		$datetime = time();
		$day = date('j');
		$month = date('n');
		$year = date('Y');
		if (!empty($video_thumbnail)) {
		$thumb = 'dailymotion_'.$id.'.jpg';
		$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		$duration = $json['duration'];	
		if (count($json['tags']) > 0) {
			$tags = implode(',',$json['tags']);
		} else {
			$tags = title_to_keywords($json['title']);
		}
		$video_dailymotion_url = $json['url'];
		//$publish_time = $json['created_time'];
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,featured,deleted,votes_up,votes_down,hits) VALUES ('video','dailymotion','$id','$category_id','$sub_category_id','$video_title','$video_details','$video_dailymotion_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','1','0','0','0','0','0')");
		if ($insert) {
		echo 'success';	
		} else {
		echo 'failure';	
		}
		} else {
		echo 'failure';	
		}
		}
		}
}


if ($action == "import_channel_single_video") {
if (isset($_POST)) {
		$site = make_safe(xss_clean($_POST['site']));
		$category = make_safe(xss_clean($_POST['category']));
		$cc = explode(',',$category);
		$category_id = $cc[0];
		$sub_category_id = $cc[1];
		$source_id = make_safe(xss_clean(intval($_POST['source_id'])));			
		$id = make_safe(xss_clean($_POST['id']));
		$datetime = time();
		$day = date('j');
		$month = date('n');
		$year = date('Y');
		if (empty($id)) {
		echo 'failure';	
		} else {
			switch ($site) {
				case 'youtube';
				if (check_video_id($id,'youtube') > 0) {
				echo 'failure';	
				} else {
				$baseUrl = 'https://www.googleapis.com/youtube/v3/';
				$apiKey = $options['api_youtube_apikey'];
				$url = $baseUrl.'videos?'.
						'id='.$id.
						'&part=snippet'. 
						'&key='.$apiKey;
				$json = json_decode(file_get_contents($url), true);
				if (count($json['items']) == 0) {
				echo 'failure';	
				} else {
				$video_title = htmlspecialchars($json['items'][0]['snippet']['title'],ENT_QUOTES);
				$video_details = htmlspecialchars($json['items'][0]['snippet']['description'],ENT_QUOTES);
				if (!empty($json['items'][0]['snippet']['thumbnails']['standard']['url'])) {
				$video_thumbnail = $json['items'][0]['snippet']['thumbnails']['standard']['url'];
				} else {
				$video_thumbnail = $json['items'][0]['snippet']['thumbnails']['high']['url'];	
				}
				$video_youtube_url = 'http://www.youtube.com/watch?v='.$id;
				$videt = json_decode(file_get_contents('https://www.googleapis.com/youtube/v3/videos?id='.$id.'&part=contentDetails&key='.$apiKey), true);
				$video_duration = $videt['items'][0]['contentDetails']['duration'];
				$duration = youtube_duration($video_duration);
				if (!empty($video_thumbnail)) {
				$thumb = 'youtube_'.$id.'.jpg';
				$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
				} else {
				$thumb = '';	
				}
				if (count($json['items'][0]['snippet']['tags']) > 0) {
					$tags = implode(',',$json['items'][0]['snippet']['tags']);
				} else {
					$tags = title_to_keywords($json['items'][0]['snippet']['title']);
				}
				//$publish_time = youtube_date_to_unix($json['items'][0]['snippet']['publishedAt']);
				$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,category_id,sub_category_id,source_id,title,details,permalink,datetime,thumbnail,duration,day,month,year,published,tags,featured,deleted,votes_up,votes_down,hits) VALUES ('video','youtube','$id','$category_id','$sub_category_id','$source_id','$video_title','$video_details','$video_youtube_url','$datetime','$thumb','$duration','$day','$month','$year','1','$tags','0','0','0','0','0')");
				if ($insert) {
					echo 'success';	
				} else {
					echo 'failure';	
				}
				} 
				}
				break;
				case 'vimeo';
				if (check_video_id($id,'vimeo') > 0) {
				echo 'failure';	
				} else {
				$video = simplexml_load_string(curl_get('http://vimeo.com/api/v2/video/'.$id.'.xml'));
				if (!isset($video->video->id)) {				
					echo 'failure';	
				} else {
					$video_id = $video->video->id;
					$video_title = htmlspecialchars(str_replace("'",'',$video->video->title),ENT_QUOTES);
					$video_details = htmlspecialchars(str_replace("'",'',$video->video->description),ENT_QUOTES);
					$video_thumbnail = $video->video->thumbnail_large;
					$video_url = $video->video->url;
					$duration = $video->video->duration;
					if (!empty($video->video->tags)) {
						$tags = $video->video->tags;
					} else {
						$tags = title_to_keywords($video->video->title);
					}
					//$publish_time = vimeo_date_to_unix($video->video->upload_date);
					if (!empty($video_thumbnail)) {
					$thumb = 'vimeo_'.$video_id.'.jpg';
					$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
					} else {
					$thumb = '';	
					}
				$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,category_id,sub_caegory_id,source_id,title,details,permalink,datetime,thumbnail,duration,day,month,year,published,tags,featured,deleted,votes_up,votes_down,hits) VALUES ('video','vimeo','$video_id','$category_id','$sub_category_id','$source_id','$video_title','$video_details','$video_url','$datetime','$thumb','$duration','$day','$month','$year','1','$tags','0','0','0','0','0')");
				if ($insert) {
					echo 'success';	
				} else {
					echo 'failure';	
				}
				}
				}
				break;
				case 'dailymotion';
				if (check_video_id($id,'dailymotion') > 0) {
				echo 'failure';	
				} else {
				$url = 'https://api.dailymotion.com/video/'.$id.'?fields=allow_embed,description,duration,embed_url,id,thumbnail_720_url,thumbnail_url,title,created_time,tags,url';
				$video = json_decode(file_get_contents($url), true);
				if (count($video) == 0) {
					echo 'failure';	
				} else {
					$video_id = $video['id'];
					$video_title = htmlspecialchars($video['title'],ENT_QUOTES);
					$video_details = htmlspecialchars($video['description'],ENT_QUOTES);
					if (!empty($video['thumbnail_720_url'])) {
					$video_thumbnail = $video['thumbnail_720_url'];
					} else {
					$video_thumbnail = $video['thumbnail_url'];	
					}
					$video_url = $video['url'];
					$duration = $video['duration'];
					if (count($video['tags']) > 0) {
						$tags = implode(',',$video['tags']);
					} else {
						$tags = title_to_keywords($video['title']);
					}
					//$publish_time = $video['created_time'];
					if (!empty($video_thumbnail)) {
					$thumb = 'dailymotion_'.$video_id.'.jpg';
					$up = file_put_contents('../upload/news/'.$thumb,file_get_contents($video_thumbnail));	
					} else {
					$thumb = '';	
					}
				$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,category_id,sub_category_id,source_id,title,details,permalink,datetime,thumbnail,duration,day,month,year,published,tags,featured,deleted,votes_up,votes_down,hits) VALUES ('video','dailymotion','$video_id','$category_id','$sub_category_id','$source_id','$video_title','$video_details','$video_url','$datetime','$thumb','$duration','$day','$month','$year','1','$tags','0','0','0','0','0')");
				if ($insert) {
					echo 'success';	
				} else {
					echo 'failure';	
				}
				}
				}
				break;
				default;
			}
		}	 	
		}
}
