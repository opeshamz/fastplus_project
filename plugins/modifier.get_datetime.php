<?php
function smarty_modifier_get_datetime($timestamp,$is_time) {
$date = date('Y-n-j',$timestamp);
$time = date('h:i a',$timestamp);
if ($is_time == 1) {
return $date.' '.$time;
} else {
return $date;
}
}
?>
