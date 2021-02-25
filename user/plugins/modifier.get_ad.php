<?php
function smarty_modifier_get_ad($place,$widget = false,$sticky = false)
{
global $mysqli;
$sql = "SELECT * FROM advertisements WHERE place='$place' ORDER BY RAND() LIMIT 1";
$query = $mysqli->query($sql);
if ($query->num_rows != 0) {
$row = $query->fetch_assoc();
if ($sticky == 1) {
	$id = "id='sticky'";
} else {
	$id = "";
}
if ($row['ad_type'] == 'banner') {
	if ($widget == 1) {
	return '<div class="widget ad" '.$id.'>
				<a href="'.$row['link'].'" rel="nofollow" target="_BLANK">
					<img src="upload/ads/'.$row['image'].'" class="img-responsive" />
				</a>
			</div>';		
	} else {
	return '<a href="'.$row['link'].'" rel="nofollow" target="_BLANK">
				<img src="upload/ads/'.$row['image'].'" class="img-responsive" />
			</a>';	
	}
	
} else {
	if ($widget == 1) {
		return '<div class="widget ad" '.$id.'>
		<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="'.$row['data_ad_client'].'"
			 data-ad-slot="'.$row['data_ad_slot'].'"
			 data-ad-format="auto"
			 data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>
		</div>';	
	} else {
		return '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<ins class="adsbygoogle"
			 style="display:block"
			 data-ad-client="'.$row['data_ad_client'].'"
			 data-ad-slot="'.$row['data_ad_slot'].'"
			 data-ad-format="auto"
			 data-full-width-responsive="true"></ins>
		<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
		</script>';	
	}
}
}
}
?>