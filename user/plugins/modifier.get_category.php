<?php
function smarty_modifier_get_category($id)
{
global $mysqli;
$sql = "SELECT category FROM categories WHERE id='$id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
return $row['category'];
}

?>