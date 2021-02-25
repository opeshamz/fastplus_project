<?php
header("Content-Type: application/xml; charset=utf-8");
error_reporting(E_ERROR);
include('include/config.php');
include('include/connect.php');
include('include/functions.php');
include('include/setting.php');
include('include/general.class.php');
$general = new General;
$general->set_connection($mysqli);
$general_setting = $general->get_options('General');
$siteurl = $general_setting['siteurl'];
$today = date('Y-m-d');	
if (isset($general_setting['sitemap_items'])) {
$number = $general_setting['sitemap_items'];	
} else {
$number = 1000;	
}
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'categories';

$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="include/sitemap.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
                            			
$query = $mysqli->query("SELECT * FROM categories");
while($row = $query->fetch_assoc())
{
$url = $siteurl."/category/".slugit($row['category'])."?cid=".$row['id'];
$slugged = str_replace(':/','://',str_replace('//','/',($url)));
$sitemap .= "<url>";
$sitemap .= "<loc>$slugged</loc>";
$sitemap .= "<lastmod>$today</lastmod>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url>";
}
$sitemap .= "</urlset>";
echo $sitemap;
break;	
default;
if (isset($_GET['id'])) {
$id = intval(make_safe(xss_clean($_GET['id'])));
} else {
$id = 1;	
}

$sitemap .= '<?xml version="1.0" encoding="UTF-8"?>
<?xml-stylesheet type="text/xsl" href="include/sitemap.xsl"?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
	xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
	xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
			    http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">';
                            
$offset = ($id-1)*$number;			
$query = $mysqli->query("SELECT * FROM news WHERE published='1' AND deleted='0' ORDER BY id ASC LIMIT $number OFFSET $offset");
while($row = $query->fetch_assoc())
{
$url = $siteurl."/news/".slugit($row['title'])."?uid=".$row['id'];
$slugged = str_replace(':/','://',str_replace('//','/',($url)));
$sitemap .= "<url>";
$sitemap .= "<loc>$slugged</loc>";
$sitemap .= "<lastmod>$today</lastmod>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url>";
}
$sitemap .= "</urlset>";
echo $sitemap;
}
?>