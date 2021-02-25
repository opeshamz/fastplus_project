<?php
function smarty_modifier_get_meta_datetime($timestamp) {
$date = date('Y-n-j',$timestamp);
$time = date('h:i:s',$timestamp);
return $date.'T'.$time.'+03:00';
}
?>
