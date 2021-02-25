<?php
function smarty_modifier_poll_answer_votes_percent($votes,$total) {
if ($votes == 0) {
return 0;	
} else {
$percent = ($votes*100)/$total;
return round($percent);
}
}
?>
