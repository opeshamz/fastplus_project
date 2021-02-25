<?php
function smarty_modifier_process_content($string,$source_id)
{
global $mysqli;
if ($source_id > 0) {
$sql = "SELECT * FROM sources WHERE id='$source_id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
$content = htmlspecialchars_decode($string,ENT_QUOTES);
if ($row['strip_tags'] == 1) {
if (empty($row['allowable_tags'])) {
$content = strip_tags($content);	
} else {
$allowable_tags = htmlspecialchars_decode($row['allowable_tags'],ENT_QUOTES);
$content = strip_tags($content,"$allowable_tags");	
}	
}
if (!empty($row['banned_words'])) {
$words = explode(',',$row['banned_words']);	
if (count($words) > 0) {
foreach ($words AS $word) {
			$search[] = $word;
			$replace[] = '';
}
$content = str_ireplace($search,$replace,$content);	
}
}
} else {
$content = htmlspecialchars_decode($string,ENT_QUOTES);	
}
return nl2br($content);
}
?>