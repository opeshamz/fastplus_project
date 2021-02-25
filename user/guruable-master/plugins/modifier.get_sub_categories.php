<?php
function smarty_modifier_get_sub_categories($id)
{
global $mysqli;
$sql = "SELECT * FROM categories WHERE main_id='$id' ORDER BY category_order ASC";
$query = $mysqli->query($sql);
$number = $query->num_rows;
if ($number == 0) {
return 0;	
} else {
while ($row = $query->fetch_assoc()) {
	$rows[] = $row;
}
return $rows;
}
}

?>