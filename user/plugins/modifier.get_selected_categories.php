<?php
function smarty_modifier_get_selected_categories($ids) {
global $mysqli;
$sql = "SELECT * FROM categories WHERE id IN ($ids) ORDER BY category_order ASC";
$query = $mysqli->query($sql);
$number = $query->num_rows;
if ($number == 0) {
return 0;	
} else {
while ($row = $query->fetch_assoc()) {
$categories[] = $row;
}
return $categories;
}
}
?>
