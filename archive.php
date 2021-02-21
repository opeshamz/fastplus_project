<?php
include('include/autoloader.php');
$slug = make_safe(xss_clean($_GET['slug']));
$smarty->assign('is_archive',1);
$ur = explode('?',curPageURL());
if (count($ur) != 0) {
parse_str($ur[1],$params);	
}
$day = intval(make_safe(xss_clean($params['d'])));
$month = intval(make_safe(xss_clean($params['m'])));
$year = intval(make_safe(xss_clean($params['y'])));
$smarty->assign('day',$day);
$smarty->assign('month',$month);
$smarty->assign('year',$year);
$smarty->assign('seo_title','News Archive for '.$day.'-'.$month.'-'.$year);
$smarty->assign('seo_keywords',$options['general_seo_keywords']);
$smarty->assign('seo_description',$options['general_seo_description']);
$smarty->display('archive.html');
?>