<?php
function make_safe($str)
{
    return strip_tags(trim($str));
}


function notification($type,$text) {
	return '<div class="alert alert-'.$type.'">'.$text.'</div>';
}

function curPageURL() 
{
	$pageURL = 'http';
	if (isset($_SERVER["HTTPS"])) {
	$https = $_SERVER["HTTPS"]; 
	}
	if (isset($https) AND $https == "on") {$pageURL .= "s";} else {$pageURL .= "";}
	$pageURL .= "://";
	if ($_SERVER["SERVER_PORT"] != "80") {
	$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
	} else {
	$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
	}
	return $pageURL;
}