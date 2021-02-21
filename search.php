<?php
include('include/autoloader.php');
$smarty->assign('is_search',1);
$ur = explode('?',curPageURL());
if (count($ur) != 0) {
parse_str($ur[1],$params);	
}
$q = htmlspecialchars(make_safe(xss_clean(str_replace('-',' ',$params['q']))),ENT_QUOTES);
$smarty->assign('q',$q);
$smarty->assign('seo_title','Search For '.$q.' - '.$options['general_seo_title']);
$smarty->assign('seo_keywords',$options['general_seo_keywords']);
$smarty->assign('seo_description',$options['general_seo_description']);
$smarty->display('search.html');
?>