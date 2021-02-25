<?php
function smarty_modifier_get_referral($id)
{
if ($id == 0) {
return '';	
} else {
global $mysqli;
$sql = "SELECT id,is_referal,referal_suffix FROM sources WHERE id='$id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
if ($row['is_referal'] == 0) {
return '';	
} else {
return $row['referal_suffix'];		
}
}
}
?>