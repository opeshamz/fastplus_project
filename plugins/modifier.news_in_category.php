<?php
function smarty_modifier_news_in_category($id,$number) {
global $mysqli;
$sql = "SELECT * FROM news WHERE category_id='$id' AND published='1' AND deleted='0' ORDER BY id DESC LIMIT $number";
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
