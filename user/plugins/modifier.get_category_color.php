<?php
function smarty_modifier_get_category_color($id)
{
global $mysqli;
$sql = "SELECT color FROM categories WHERE id='$id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
return $row['color'];
}

?>