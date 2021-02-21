<?php
include('header.php');
$all = $mysqli->query("SELECT published,deleted FROM news WHERE published='1' AND deleted='0'");
$news = $all->num_rows;
if ($news > 0) {
?>
<div class="page-header page-heading">
<h1><i class="fa fa-sitemap"></i> Sitemaps</h1>
</div>
<table class="table">
<thead>
<tr>
<th>Sitemap</th>
</tr>
</thead>
<tbody>
<?php 
if (isset($options['general_category_sitemap']) AND $options['general_category_sitemap'] == 1) {
$categories = $mysqli->query("SELECT id FROM categories");
$categories_number = $categories->num_rows;
if ($categories_number > 0) {
$categories_sitemap_link = $options['general_siteurl'].'/categories-sitemap.xml';
$categories_sitemap = str_replace(':/','://',str_replace('//','/',($categories_sitemap_link)));
?>
<tr><td><a href="<?php echo $categories_sitemap; ?>" target="_BLANK"><?php echo $categories_sitemap; ?></a></td></tr>
<?php	
}
}
if (isset($options['general_sitemap_items'])) {
$number = $options['general_sitemap_items'];	
} else {
$number = 1000;	
}
$sitemaps = ceil($news/$number);
for($c=0;$c<$sitemaps;$c++) {
	$n = $c+1;
$sitemap_link = $options['general_siteurl'].'/sitemap-'.$n.'.xml';
$sitemap = str_replace(':/','://',str_replace('//','/',($sitemap_link)));
?>
<tr><td><a href="<?php echo $sitemap; ?>" target="_BLANK"><?php echo $sitemap; ?></a></td></tr>
<?php
}
}
?>
</tbody>
</table>
<?php
include('footer.php');
?>