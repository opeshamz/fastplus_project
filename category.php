<?php
include('include/autoloader.php');
$slug = make_safe(xss_clean($_GET['slug']));
$smarty->assign('is_category',1);
$ur = explode('?',curPageURL());
if (count($ur) != 0) {
parse_str($ur[1],$params);	
}
$id = intval(make_safe(xss_clean($params['cid'])));
$category = $general->category($id);
foreach ($category AS $key=>$value) {
$smarty->assign('category_'.$key,$value);
}
if ($category['main_id'] > 0) {
$main = $general->category($category['main_id']);
foreach ($main AS $key=>$value) {
$smarty->assign('main_category_'.$key,$value);
}
$smarty->assign('seo_title',$main['category'].' - '.$category['category']);
} else {
$smarty->assign('seo_title',$category['category']);	
} 


$smarty->assign('seo_keywords',$category['seo_keywords']);
$smarty->assign('seo_description',$category['seo_description']);
$smarty->display('category.html');
?>