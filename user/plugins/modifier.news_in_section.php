<?php
function smarty_modifier_news_in_section($id,$style,$rss,$video) {
global $mysqli;
if ($style == 1 OR $style == 2) {
$number = 4;	
} else {
$number = 6;	
}
	if ($rss == 0 AND $video == 1) {
		$source_type = "AND source_type='video' ";
	} elseif ($rss == 1 AND $video == 0) {
		$source_type = "AND source_type='rss' ";
	} elseif ($rss == 0 AND $video == 0) {
		$source_type = "AND source_type='rss' ";
	} else {
		$source_type = "";
	}
$sql = "SELECT * FROM news WHERE category_id='$id' AND published='1' AND deleted='0' $source_type ORDER BY id DESC LIMIT $number";
$query = $mysqli->query($sql);
$number = $query->num_rows;
if ($number == 0) {
return 0;	
} else {
while ($row = $query->fetch_assoc()) {
$news[] = $row;
}
return $news;
}
}
?>
