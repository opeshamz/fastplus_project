<?php
// convert seconds number to human readable format
function smarty_modifier_get_duration($seconds)
{
    if (gmdate("H", $seconds) == '00') {
	return gmdate("i:s", $seconds);	
	} else {
	return gmdate("H:i:s", $seconds);
	}
}

?>