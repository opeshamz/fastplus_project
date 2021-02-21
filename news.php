<?php
include('include/autoloader.php');
$smarty->assign('is_news',1);
$slug = make_safe(xss_clean($_GET['slug']));
$ur = explode('?',curPageURL());
if (count($ur) != 0) {
parse_str($ur[1],$params);	
}
$id = intval(make_safe(xss_clean($params['uid'])));
$smarty->assign('is_article',1);
$article = $general->article($id);
foreach ($article AS $key=>$value) {
$smarty->assign('article_'.$key,$value);	
}
$next_query = $mysqli->query("SELECT id,title,thumbnail,source_id FROM news WHERE id=(SELECT min(id) FROM news WHERE id > $id)");
if ($next_query->num_rows != 0) {
$smarty->assign('is_next',1);
$next = $next_query->fetch_assoc();
foreach ($next AS $key=>$value) {
	$smarty->assign('next_'.$key,$value);
}
}
$previous_query = $mysqli->query("SELECT id,title,thumbnail,source_id FROM news WHERE id=(SELECT max(id) FROM news WHERE id < $id)");
if ($previous_query->num_rows != 0) {
$smarty->assign('is_previous',1);
$previous = $previous_query->fetch_assoc();
foreach ($previous AS $key=>$value) {
	$smarty->assign('previous_'.$key,$value);
}
}
$ip_address = getRealIpAddr();

$smarty->assign('ip',$ip_address);
if (!empty($article['tags'])) {
	$tags = explode(',',$article['tags']);
	$smarty->assign('tags',$tags);
}
if (isset($options['theme_related_news_number'])) {$related_number = $options['theme_related_news_number'];} else {$related_number = 6;}
$related = $general->related($article['id'],$article['category_id'],$article['title'],$related_number);

$sitelink = $options['general_siteurl'].'/news/'.slugit(htmlspecialchars_decode($article['title'],ENT_QUOTES)).'?uid='.$article['id'];
$sitelink = str_replace(':/','://',str_replace('//','/',$sitelink));
$smarty->assign('article_sitelink',$sitelink);
$thumbnail_link = $options['general_siteurl'].'/upload/news/'.$article['thumbnail'];
$thumbnail_link = str_replace(':/','://',str_replace('//','/',$thumbnail_link));
$smarty->assign('article_thumbnail_link',$thumbnail_link);
$smarty->assign('related',$related);
$whatsapp_share = urlencode(htmlspecialchars_decode($article['title'],ENT_QUOTES).' '.$sitelink);
$smarty->assign('whatsapp_share',$whatsapp_share);
$smarty->assign('seo_title',htmlspecialchars_decode($article['title'],ENT_QUOTES));
$smarty->assign('seo_keywords',$article['tags']);
$smarty->assign('seo_description',mb_substr(strip_tags(htmlspecialchars_decode($article['details'],ENT_QUOTES)),0,255,'UTF-8'));
$smarty->display('article.html');
?>