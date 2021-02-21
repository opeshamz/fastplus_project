<?php
include('include/autoloader.php');
$smarty->assign('is_page',1);
$slug = make_safe(xss_clean($_GET['slug']));
$ur = explode('?',curPageURL());
if (count($ur) != 0) {
parse_str($ur[1],$params);	
}
$id = intval(make_safe(xss_clean($params['pid'])));

$page = $general->page($id);
foreach ($page AS $key=>$value) {
$smarty->assign('page_'.$key,$value);	
}

$smarty->assign('seo_title',htmlspecialchars_decode($page['title'],ENT_QUOTES));
$smarty->assign('seo_keywords',title_to_keywords($page['title']));
$smarty->assign('seo_description',mb_substr(strip_tags(htmlspecialchars_decode($page['content'],ENT_QUOTES)),0,255,'UTF-8'));
$smarty->display('page.html');
?>