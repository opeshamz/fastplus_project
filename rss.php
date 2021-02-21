<?php
error_reporting(E_ERROR);
include ('include/config.php');
include ('include/connect.php');
include ('include/functions.php');
include ('include/rss.php');
include('include/general.class.php');
		$general = new General;
		$general->set_connection($mysqli);
		$general_setting = $general->get_options('General');
		$siteurl = $general_setting['siteurl'];
		$site_title = $general_setting['seo_title'];
		$site_description = $general_setting['seo_description'];
		if (isset($general_setting['rss_news_number']) OR $general_setting['rss_news_number'] != 0) {
		$news_number = $general_setting['rss_news_number'];
		} else {
		$news_number = 10;
		}
		$feed = new RSS();
		$feed->title       = "$site_title";
		$feed->link        = "$siteurl";
		$feed->description = "$site_description";
		$result = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' ORDER BY id DESC LIMIT $news_number");
		if ($result->num_rows > 0) {
		while($row = $result->fetch_assoc())
		{
			$sitelink = $siteurl.'/news/'.slugit(htmlspecialchars_decode($row['title'],ENT_QUOTES)).'?uid='.$row['id'];
			$sitelink = str_replace(':/','://',str_replace('//','/',$sitelink));
			$thumbnail_link = $siteurl.'/upload/news/'.$row['thumbnail'];
			$thumbnail_link = str_replace(':/','://',str_replace('//','/',$thumbnail_link));
			$shortdes = mb_substr(strip_tags(htmlspecialchars_decode($row['details'], ENT_QUOTES)),0,255,'UTF-8');
			$item = new RSSItem();
			$item->title = htmlspecialchars_decode($row['title'], ENT_QUOTES);
			$item->link  = "$sitelink";
			$item->description = "<![CDATA[ $shortdes ]]>";
			if (!empty($row['thumbnail'])) {
			$thumb = "$thumbnail_link";	
			$item->enclosure($thumb, 'image/jpg', '');	
			}
			$item->PubDate = date('D, d M Y H:i:s ',$row['datetime']);
			$feed->addItem($item);
		}
		}
		echo $feed->serve();
		

?>