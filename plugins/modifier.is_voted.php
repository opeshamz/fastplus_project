<?php
function smarty_modifier_is_voted($id,$ip,$type) {
global $mysqli;
$sql = "SELECT * FROM news_votes WHERE article_id='$id' AND ip_address='$ip' AND $type='1' LIMIT 1";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return 0+$number;
}
?>
