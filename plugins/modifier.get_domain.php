<?php
function smarty_modifier_get_domain($link)
{
$parse = parse_url($link);
return str_replace('www.','',$parse['host']);
}
?>