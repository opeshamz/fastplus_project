<?php
include('include/autoloader.php');
error_reporting(E_ERROR);
$case = make_safe(xss_clean($_GET['case']));
$action = make_safe(xss_clean($_POST['action']));
switch ($case) {
case 'article_vote_up';
$id = make_safe(xss_clean(intval($_POST['id'])));
$ip_address = getRealIpAddr();
$check = $mysqli->query("SELECT * FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address'");
if ($check->num_rows == 0) {
	$add = $mysqli->query("INSERT INTO news_votes (article_id,ip_address,up,down) VALUES ('$id','$ip_address','1','0')");
	$update = $mysqli->query("UPDATE news SET votes_up=votes_up+1 WHERE id='$id'");
	echo 1;
} else {
	$row = $check->fetch_assoc();
	if ($row['up'] == 1) {
		$delete = $mysqli->query("DELETE FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address' AND up='1'");
		$update = $mysqli->query("UPDATE news SET votes_up=votes_up-1 WHERE id='$id'");
		echo 2;
	} else {
		$delete = $mysqli->query("DELETE FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address' AND down='1'");
		$add = $mysqli->query("INSERT INTO news_votes (article_id,ip_address,up,down) VALUES ('$id','$ip_address','1','0')");
		$update = $mysqli->query("UPDATE news SET votes_down=votes_down-1 WHERE id='$id'");
		$update2 = $mysqli->query("UPDATE news SET votes_up=votes_up+1 WHERE id='$id'");
		echo 3;
	}
}
break;
case 'article_vote_down';
$id = make_safe(xss_clean(intval($_POST['id'])));
$ip_address = getRealIpAddr();
$check = $mysqli->query("SELECT * FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address'");
if ($check->num_rows == 0) {
	$add = $mysqli->query("INSERT INTO news_votes (article_id,ip_address,down,up) VALUES ('$id','$ip_address','1','0')");
	$update = $mysqli->query("UPDATE news SET votes_down=votes_down+1 WHERE id='$id'");
	echo 1;
} else {
	$row = $check->fetch_assoc();
	if ($row['down'] == 1) {
		$delete = $mysqli->query("DELETE FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address' AND down='1'");
		$update = $mysqli->query("UPDATE news SET votes_down=votes_down-1 WHERE id='$id'");
		echo 2;
	} else {
		$delete = $mysqli->query("DELETE FROM news_votes WHERE article_id='$id' AND ip_address='$ip_address' AND up='1'");
		$add = $mysqli->query("INSERT INTO news_votes (article_id,ip_address,down,up) VALUES ('$id','$ip_address','1','0')");
		$update = $mysqli->query("UPDATE news SET votes_up=votes_up-1 WHERE id='$id'");
		$update2 = $mysqli->query("UPDATE news SET votes_down=votes_down+1 WHERE id='$id'");
		echo 3;
	}
}
break;

case 'calendar';
$month = date('m');
$year = date('Y');
if(!empty($_GET['month'])) $month = intval($_GET['month']);
if(!empty($_GET['year'])) $year = intval($_GET['year']);
echo showMonth($month,$year,$language);
break;	


case 'megamenu_category';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
$category = $general->category($id);
foreach ($category AS $key=>$value) {
	$smarty->assign('category_'.$key,$value);
}
$sub_categories = $general->sub_categories($id,'category_order ASC');
$smarty->assign('sub_categories',$sub_categories);
if (isset($options['theme_display_trending_tags']) AND $options['theme_display_trending_tags'] == 1) {
$trending = $general->category_tags($id,6);
$smarty->assign('trending',$trending);
}
if (isset($options['theme_megamenu_news_number'])) {
	$megamenu_news_number = $options['theme_megamenu_news_number'];
} else {
	$megamenu_news_number = 8;
}
$news = $general->news_query("WHERE published='1' AND deleted='0' AND category_id='$id'",'id DESC',$megamenu_news_number);
$smarty->assign('news',$news);
$smarty->display('ajax-megamenu.html');
break;



case 'weather';
$id = make_safe(xss_clean($_POST['yahoo_weather_id']));
if (!empty($id)) {
$city = $general->city($id);
if ($city != 0) {
if ($options['weather_temperature_degree'] == 'f') {
$temperature_degree = 'f';	
} else {
$temperature_degree = 'c';		
}
$BASE_URL = "http://query.yahooapis.com/v1/public/yql";
$yql_query = 'select * from weather.forecast where woeid in (select woeid from geo.places(1) where woeid='.$city['yahoo_weather_id'].') and u="'.$temperature_degree.'"';
$yql_query_url = $BASE_URL . "?q=" . urlencode($yql_query) . "&format=json";
$session = curl_init($yql_query_url);
curl_setopt($session, CURLOPT_RETURNTRANSFER,true);
$json = curl_exec($session);
$weather =  json_decode($json,true);
$smarty->assign('temperature_degree',$temperature_degree);
$temp = $weather['query']['results']['channel']['item']['condition']['temp'];
$weather_code = $weather['query']['results']['channel']['item']['condition']['code'];
$weather_text = $weather['query']['results']['channel']['item']['condition']['text'];
$smarty->assign('temp',$temp);
$smarty->assign('weather_city',$city['city']);
$smarty->assign('weather_code',$weather_code);
$smarty->assign('weather_text',$weather_text);

if ($options['weather_display_next_days'] == 1) {
$forecast = $weather['query']['results']['channel']['item']['forecast'];
$smarty->assign('forecast',$forecast);
}
}
$smarty->display('ajax-weather.html');
}

break;
case 'vote';
if (isset($_POST) AND count($_POST) > 0) {
$poll_id = intval(make_safe(xss_clean($_POST['poll_id'])));
$answer_id = intval(make_safe(xss_clean($_POST['answer_id'])));
if (!empty($poll_id) AND !empty($answer_id)) {
$poll = $general->question($poll_id);
if ($poll != 0) {
$ip_address = intval(str_replace('.','',getRealIpAddr()));
$check_ip = $general->check_ip($ip_address);
if ($check_ip == 0) {
$datetime = time();
$sql = "INSERT INTO polls_votes (poll_id,answer_id,ip_address,datetime) VALUES ('$poll_id','$answer_id','$ip_address','$datetime')";	
$query = $mysqli->query($sql);
if ($query) {
echo 2;	
}
} else {
echo 1;
}
}
}
}
break;

case 'poll_result';
if (isset($_POST) AND count($_POST) > 0) {
$poll_id = intval(make_safe(xss_clean($_POST['poll_id'])));
$answers = $general->answers($poll_id);
$smarty->assign('answers',$answers);
$total_votes = $general->total_votes($poll_id);
$smarty->assign('total_votes',$total_votes);
$smarty->display('poll-result.html');
}
break;

case 'ajax_news_next_prev';
	if(isset($_GET))
	{
	$page = intval($_GET['page']);
	$cur_page = $page;
	$page -= 1;
	if (isset($options['theme_category_news_number'])) {
	$per_page = $options['theme_category_news_number'];
	} else {
	$per_page = 12;	
	}
	$smarty->assign('per_page',$per_page);
	$previous_btn = true;
	$next_btn = true;
	$start = $page * $per_page;
	$result_pag_data = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' ORDER BY id DESC LIMIT $start, $per_page");
	while ($row = $result_pag_data->fetch_assoc()) {
		$news[] = $row;
	}
	$smarty->assign('news',$news);


	$query_pag_num = "SELECT COUNT(*) AS count FROM news WHERE published='1' AND deleted='0'";
	$result_pag_num = $mysqli->query($query_pag_num);
	$row = $result_pag_num->fetch_assoc();
	$count = $row['count'];
	$smarty->assign('count',$count);
	$no_of_paginations = ceil($count / $per_page);

	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$paginations .= "<div class='paginations'><ul class='pager'>";


	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$paginations .= "<li rel='$pre' class='active nextpage next'><a href='javascript:void();'>$language[next_page]</a></li>";
	} else if ($previous_btn) {
		$paginations .= "<li class='inactive nextpage next disabled'><a href='javascript:void();'>$language[next_page]</a></li>";
	}

	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$paginations .= "<li rel='$nex' class='active previous '><a href='javascript:void();'>$language[previous_page]</a></li>";
	} else if ($next_btn) {
		$paginations .= "<li class='inactive previous disabled'><a href='javascript:void();'>$language[previous_page]</a></li>";
	}

	$pagi .= $paginations . "</ul></div>";  
	$smarty->assign('paginations',$pagi);
	}
	$smarty->display('ajax-news-scroll.html');
break;
case 'ajax_category_next_prev';
	if(isset($_GET))
	{
	$page = intval($_GET['page']);
	$category_id = intval($_GET['category_id']);
	$main_id = intval($_GET['main_id']);
	$smarty->assign('category_id',$category_id);
	$smarty->assign('main_id',$main_id);
	$cur_page = $page;
	$page -= 1;
	if (isset($options['theme_category_news_number'])) {
	$per_page = $options['theme_category_news_number'];
	} else {
	$per_page = 12;	
	}
	$smarty->assign('per_page',$per_page);
	$previous_btn = true;
	$next_btn = true;
	$start = $page * $per_page;
	if ($main_id == 0) {
		$category_sql = "AND category_id='$category_id'";
	} else {
		$category_sql = "AND sub_category_id='$category_id'";
	}
	$result_pag_data = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' $category_sql ORDER BY id DESC LIMIT $start, $per_page");
	while ($row = $result_pag_data->fetch_assoc()) {
		$news[] = $row;
	}
	$smarty->assign('news',$news);


	$query_pag_num = "SELECT COUNT(*) AS count FROM news WHERE published='1' AND deleted='0' $category_sql";
	$result_pag_num = $mysqli->query($query_pag_num);
	$row = $result_pag_num->fetch_assoc();
	$count = $row['count'];
	$smarty->assign('count',$count);
	$no_of_paginations = ceil($count / $per_page);

	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$paginations .= "<div class='paginations'><ul class='pager'>";


	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$paginations .= "<li rel='$pre' class='active nextpage next'><a href='javascript:void();'>$language[next_page]</a></li>";
	} else if ($previous_btn) {
		$paginations .= "<li class='inactive nextpage next disabled'><a href='javascript:void();'>$language[next_page]</a></li>";
	}

	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$paginations .= "<li rel='$nex' class='active previous '><a href='javascript:void();'>$language[previous_page]</a></li>";
	} else if ($next_btn) {
		$paginations .= "<li class='inactive previous disabled'><a href='javascript:void();'>$language[previous_page]</a></li>";
	}

	$pagi .= $paginations . "</ul></div>";  
	$smarty->assign('paginations',$pagi);
	}
	$smarty->display('ajax-category-news.html');
break;
case 'ajax_search_next_prev';
	if(isset($_GET))
	{
	$page = intval($_GET['page']);
	$q = make_safe(xss_clean(htmlspecialchars($_GET['q'],ENT_QUOTES)));
	$smarty->assign('q',$q);
	$cur_page = $page;
	$page -= 1;
	if (isset($options['theme_search_news_number'])) {
	$per_page = $options['theme_search_news_number'];
	} else {
	$per_page = 12;	
	}
	$smarty->assign('per_page',$per_page);
	$previous_btn = true;
	$next_btn = true;
	$start = $page * $per_page;
	$result_pag_data = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' AND title LIKE '%$q%' ORDER BY id DESC LIMIT $start, $per_page");
	while ($row = $result_pag_data->fetch_assoc()) {
		$news[] = $row;
	}
	$smarty->assign('news',$news);


	$query_pag_num = "SELECT COUNT(*) AS count FROM news WHERE published='1' AND deleted='0' AND title LIKE '%$q%'";
	$result_pag_num = $mysqli->query($query_pag_num);
	$row = $result_pag_num->fetch_assoc();
	$count = $row['count'];
	$smarty->assign('count',$count);
	$no_of_paginations = ceil($count / $per_page);

	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$paginations .= "<div class='paginations'><ul class='pager'>";


	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$paginations .= "<li rel='$pre' class='active nextpage next'><a href='javascript:void();'>$language[next_page]</a></li>";
	} else if ($previous_btn) {
		$paginations .= "<li class='inactive nextpage next disabled'><a href='javascript:void();'>$language[next_page]</a></li>";
	}

	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$paginations .= "<li rel='$nex' class='active previous '><a href='javascript:void();'>$language[previous_page]</a></li>";
	} else if ($next_btn) {
		$paginations .= "<li class='inactive previous disabled'><a href='javascript:void();'>$language[previous_page]</a></li>";
	}

	$pagi .= $paginations . "</ul></div>";  
	$smarty->assign('paginations',$pagi);
	}
	$smarty->display('ajax-search-news.html');
break;
case 'ajax_archive_next_prev';
	if(isset($_GET))
	{
	$page = $_GET['page'];
	$day = $_GET['d'];
	$month = $_GET['m'];
	$year = $_GET['y'];
	$smarty->assign('day',$day);
	$smarty->assign('month',$month);
	$smarty->assign('year',$year);
	$cur_page = $page;
	$page -= 1;
	if (isset($options['theme_search_news_number'])) {
	$per_page = $options['theme_search_news_number'];
	} else {
	$per_page = 12;	
	}
	$smarty->assign('per_page',$per_page);
	$previous_btn = true;
	$next_btn = true;
	$start = $page * $per_page;
	$result_pag_data = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' AND day='$day' AND month='$month' AND year='$year' ORDER BY id DESC LIMIT $start, $per_page");
	while ($row = $result_pag_data->fetch_assoc()) {
		$news[] = $row;
	}
	$smarty->assign('news',$news);


	$query_pag_num = "SELECT COUNT(*) AS count FROM news WHERE published='1' AND deleted='0' AND day='$day' AND month='$month' AND year='$year'";
	$result_pag_num = $mysqli->query($query_pag_num);
	$row = $result_pag_num->fetch_assoc();
	$count = $row['count'];
	$smarty->assign('count',$count);
	$no_of_paginations = ceil($count / $per_page);

	if ($cur_page >= 7) {
		$start_loop = $cur_page - 3;
		if ($no_of_paginations > $cur_page + 3)
			$end_loop = $cur_page + 3;
		else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) {
			$start_loop = $no_of_paginations - 6;
			$end_loop = $no_of_paginations;
		} else {
			$end_loop = $no_of_paginations;
		}
	} else {
		$start_loop = 1;
		if ($no_of_paginations > 7)
			$end_loop = 7;
		else
			$end_loop = $no_of_paginations;
	}
	$paginations .= "<div class='paginations'><ul class='pager'>";


	if ($previous_btn && $cur_page > 1) {
		$pre = $cur_page - 1;
		$paginations .= "<li rel='$pre' class='active nextpage next'><a href='javascript:void();'>$language[next_page]</a></li>";
	} else if ($previous_btn) {
		$paginations .= "<li class='inactive nextpage next disabled'><a href='javascript:void();'>$language[next_page]</a></li>";
	}

	if ($next_btn && $cur_page < $no_of_paginations) {
		$nex = $cur_page + 1;
		$paginations .= "<li rel='$nex' class='active previous '><a href='javascript:void();'>$language[previous_page]</a></li>";
	} else if ($next_btn) {
		$paginations .= "<li class='inactive previous disabled'><a href='javascript:void();'>$language[previous_page]</a></li>";
	}

	$pagi .= $paginations . "</ul></div>";  
	$smarty->assign('paginations',$pagi);
	}
	$smarty->display('ajax-archive-news.html');
break;
default;	
}
?>