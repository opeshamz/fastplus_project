<?php
include('include/autoloader.php');
set_time_limit(60000*60);
	$start_time = time();
	$sql = "SELECT * FROM sources WHERE auto_update='1' ORDER BY auto_update_period ASC";
	$query = $mysqli->query($sql);
	if ($query->num_rows != 0) {
	while ($row = $query->fetch_assoc()) {
	$next_update = $row['latest_activity']+$row['auto_update_period'];
	if (time() >= $next_update) {
	$id = $row['id'];
	$category_id = $row['category_id'];
	$sub_category_id = $row['sub_category_id'];
	$source_id = $row['id'];
	$rss_link = $row['rss_link'];
	$news_number = $row['news_number'];
	$published = $row['published'];
	$source_type = $row['source_type'];
	$import_full_post = $row['import_full_post'];
	$day = date('j');
	$month = date('n');
	$year = date('Y');
	if ($source_type == 'rss') {
	require_once('include/autoload.php');
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
				$up = file_put_contents('upload/news/'.$filename,file_get_contents($image));
				$filename = $filename;
				} else {
				$filename = 'image_'.time().'_'.rand(0000000,99999999).'.jpg';
				$up = file_put_contents('upload/news/'.$filename,file_get_contents($image));
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
				$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,title,permalink,category_id,sub_category_id,source_id,details,datetime,published,thumbnail,day,month,year,tags,video_id,duration,featured,deleted,votes_up,votes_down,hits) 
													  VALUES ('rss','$source_domain','$title','$permalink','$category_id','$sub_category_id','$source_id','$enc_details','$datetime','$published','$filename','$day','$month','$year','$tags','0','0','0','0','0','0','0')");
				}
			}
	}
	if ($source_type == 'video') {
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
		$up = file_put_contents('upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		if (count($video['snippet']['tags']) > 0) {
			$tags = implode(',',$video['snippet']['tags']);
		} else {
			$tags = title_to_keywords($video['snippet']['title']);
		}
		//$publish_time = youtube_date_to_unix($video['snippet']['publishedAt']);
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,deleted,featured,votes_up,votes_down,hits) VALUES 
												   ('video','youtube','$video_id','$source_id','$category_id','$sub_category_id','$video_title','$video_details','$video_youtube_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
		}
	}	
	}
	
	
	
	if ($row['source_domain'] == 'vimeo') {
	$u = parse_url($rss_link);
	$user = str_replace('/','',$u['path']);
	$api_endpoint = 'http://vimeo.com/api/v2/' . $user;
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
	$up = file_put_contents('upload/news/'.$thumb,file_get_contents($thumbnail));	
	} else {
	$thumb = '';	
	}
	//$publish_time = vimeo_date_to_unix($video['upload_date']);
	$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,deleted,featured,votes_up,votes_down,hits) VALUES ('video','vimeo','$vimeo_id','$source_id','$category_id','$sub_category_id','$title','$description','$permalink','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
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
		$up = file_put_contents('upload/news/'.$thumb,file_get_contents($video_thumbnail));	
		} else {
		$thumb = '';	
		}
		if (count($video['tags']) > 0) {
			$tags = implode(',',$video['tags']);
		} else {
			$tags = title_to_keywords($video['title']);
		}
		//$publish_time = $video['created_time'];
		$insert = $mysqli->query("INSERT INTO news (source_type,source_domain,video_id,source_id,category_id,sub_category_id,title,details,permalink,datetime,thumbnail,duration,tags,day,month,year,published,deleted,featured,votes_up,votes_down,hits) VALUES ('video','dailymotion','$video_id','$source_id','$category_id','$sub_category_id','$video_title','$video_details','$video_dailymotion_url','$datetime','$thumb','$duration','$tags','$day','$month','$year','$published','0','0','0','0','0')");
		}
		}
	}
	}
	}
	}
	$now = time();
	$mysqli->query("UPDATE sources SET latest_activity='$now' WHERE id='$id'");
	}
}
?>