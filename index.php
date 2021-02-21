<?php
include('include/autoloader.php');
$smarty->assign('is_home',1);
$f = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' ORDER BY rand() LIMIT 4");
while ($ff = $f->fetch_assoc()) {
	$row[] = $ff;
}
$smarty->assign('featured',$row);
$smarty->assign('seo_title',$options['general_seo_title']);
$smarty->assign('seo_keywords',$options['general_seo_keywords']);
$smarty->assign('seo_description',$options['general_seo_description']);
$smarty->display('index.html'); 
?>