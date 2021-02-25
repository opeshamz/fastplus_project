<?php
function smarty_modifier_article_thumbnail($thumbnail,$source_id)
{
    global $mysqli;
	if (!empty($thumbnail) AND file_exists('upload/news/'.$thumbnail)) {
	$thumb = 'upload/news/'.$thumbnail;
	}  else {
	if ($source_id == 0) {
	$thumb = 'upload/noimage.jpg';
	} else {	
	$sql = "SELECT thumbnail FROM sources WHERE id='$source_id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (!empty($row['thumbnail'])) {
	$thumb .= 'upload/sources/'.$row['thumbnail'];
	} else {
	$thumb .= 'upload/noimage.jpg';
	} 
	}
	}
 
return $thumb; 
}

?>
