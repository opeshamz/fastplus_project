<?php
function smarty_modifier_poll_answer_votes($id) {
global $mysqli;
$sql = "SELECT answer_id FROM polls_votes WHERE answer_id='$id'";
$query = $mysqli->query($sql);
return $query->num_rows;
}
?>
