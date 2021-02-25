<?php
error_reporting(E_ERROR);
include('config.php');
include('connect.php');
include('functions.php');
include('nocsrf.php');
include('pagination.php');
include('general.class.php');
if ($tables_number == 0) {
	die('You Need to Install the Script. <a href="./install/install.php">Install</a>');
}
if (is_dir('install/')) {
die('The <b>Install</b> folder is exists. Please delete the <b>Install</b> folder or rename it.');
}
$general = new General;
$general->set_connection($mysqli);
$general_options = $general->get_options('General');
require_once('smarty/Smarty.class.php');
$smarty = new Smarty;
$smarty->compile_dir = 'cache/';
$smarty->template_dir = 'themes/'.$general_options['site_theme'].'/';
$smarty->plugins_dir = array(
                       './include/smarty/plugins',
                       './plugins/'
                       );
$smarty->force_compile = true;
$options = $general->get_all_options();
foreach ($options AS $key=>$value) {
$smarty->assign($key,$value);
}
include('languages/'.$options['general_site_language'].'/site.php');
foreach ($language AS $key=>$value) {
$smarty->assign('lang_'.$key,$value);	
}
$pubkey = $options['api_recaptcha_public'];
$smarty->assign('pubkey',$pubkey);
$google_font = get_google_fonts();
$smarty->assign('google_font',$google_font);
$categories = $general->categories('category_order ASC');
$smarty->assign('categories',$categories);
$links = $general->links('link_order ASC');
$smarty->assign('links',$links);
$pages = $general->pages('page_order ASC');
$smarty->assign('pages',$pages);
$cities = $general->cities('city_order ASC');
$smarty->assign('cities',$cities);
if ($options['theme_display_top_news_widget'] == 1) {
$top = $general->top_news($options['theme_top_news_content_type_rss'],$options['theme_top_news_content_type_video'],$options['theme_top_news_days'],$options['theme_top_news_number']);
$smarty->assign('top',$top);
}
if ($options['polls_display_poll_widget'] == 1) {
$poll = $general->question($options['polls_poll_question_id']);
foreach ($poll AS $key=>$value) {
$smarty->assign('poll_'.$key,$value);
}
$answers = $general->answers($poll['id']);
$smarty->assign('answers',$answers);
}
?>
