<?php
function make_safe($str)
{
    return strip_tags(trim($str));
}
function get_first_image($html){
    if (!empty($html)) {
	require_once('simple_html_dom.php');
    $post_dom = str_get_html($html);
    $first_img = $post_dom->find('img', 0);
    if($first_img !== null) {
	$image = $first_img->src;
	if (strtok($image, '?') != '') {
	$image = strtok($image, '?');
	} else {
	$image = $image;
	}
        return $image;
    }

    return null;
	} else {
	return null;	
    }
}
function send_simple_mail($from,$to,$title,$body) {
$header = "From:$from \r\n";
$header .= "MIME-Version: 1.0\r\n";
$header .= "Content-type: text/html\r\n";
         
$send = mail ($to,$title,$body,$header);	
if ($send) {
	return true;
} else {
	return false;
}	
}

function send_smtp_mail($host,$port,$username,$password,$from,$to,$title,$body) {
	require 'include/mailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	$mail->isSMTP();                               // Set mailer to use SMTP
	$mail->Host = "$host";  					   // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                        // Enable SMTP authentication
	$mail->Username = "$username";                 // SMTP username
	$mail->Password = "$password";                 // SMTP password
	$mail->SMTPSecure = 'tls';                     // Enable TLS encryption, `ssl` also accepted
	$mail->Port = $port;             			   // TCP port to connect to
	$mail->From = "$from";
	$mail->FromName = "Site";
	$mail->addAddress("$to", "Site Admin");      // Add a recipient 
	$mail->isHTML(true);                           // Set email format to HTML                            
	$mail->Subject = "$title";
	$mail->Body    = "$body";
	$mail->AltBody = "".strip_tags($body)."";
	if ($mail->send()) {
		return true;
	} else {
		return false;
	}	
}

function is_image($path)
{
    $a = getimagesize($path);
    $image_type = $a[0];
     
    if($image_type > 40)
    {
        return true;
    }
    return false;
}

function check_item_url($permalink) {
	global $mysqli;
	$sql = "SELECT permalink FROM news WHERE permalink='$permalink' LIMIT 1";
	$query = $mysqli->query($sql);
	return $query->num_rows;
}
function get_domain($link) {
	$parse = parse_url($link);
	return str_replace('www.','',$parse['host']);
}
function title_to_keywords($title) {
	$searchs = array();
	$tags = explode('-',slugit($title));
		foreach ($tags AS $tag) {
			if (mb_strlen($tag,'UTF-8') > 4) {
			$searchs[] .= trim($tag);
			}
		}
	if (count($searchs) > 0) {
	return implode(',',$searchs);
	} else {
	return false;	
	}
}
function notification($type,$text) {
return '<div class="alert alert-'.$type.'" style="margin:400px;">'.$text.'</div>';
}

function verify_recaptcha($secret,$response) {
	$response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret."&response=".$response."&remoteip=".$_SERVER['REMOTE_ADDR']);
	$obj = json_decode($response, true);
	if(isset($obj["success"]) AND $obj["success"] == true)
	{
		return 1;
	}
	else
	{
		return 0;
	}
}

function getExtension($str)
{
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
}



function getRealIpAddr()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    {
      $ip=$_SERVER['HTTP_CLIENT_IP'];
    }
    elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    {
      $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
    }
    else
    {
      $ip=$_SERVER['REMOTE_ADDR'];
    }
    return $ip;
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
function slugit($title)
{
$slugged = url_slug(
	"$title", 
	array(
		'delimiter' => '-',
		'lowercase' => true
	)
);
$string = str_replace('quot-','',$slugged);
$string = str_replace('-quot','',$string);
$string = str_replace('-amp','',$string);
$string = str_replace('amp-','',$string);
return $string;
}

// function to prepare the slugging
function url_slug($str, $options = array()) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => '-',
		'limit' => null,
		'lowercase' => true,
		'replacements' => array(),
		'transliterate' => true,
	);
	
	// Merge options
	$options = array_merge($defaults, $options);
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',

		// Latin symbols
		'©' => '(c)',

		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',

		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 

		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',

		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',

		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 

		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',

		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z',
		
		// vietnamese 
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ì' => 'I',
		'Í' => 'I', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Ă' => 'A',
		'Đ' => 'D', 'Ĩ' => 'I', 'Ũ' => 'U', 'Ơ' => 'O', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a',
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ì' => 'i', 'í' => 'i', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o',
		'õ' => 'o', 'ù' => 'u', 'ú' => 'u', 'ă' => 'a', 'đ' => 'd', 'ĩ' => 'i', 'ũ' => 'u', 'ơ' => 'o',
		'Ư' => 'U', 'Ă' => 'A', 'Ạ' => 'A', 'Ả' => 'A', 'Ấ' => 'A', 'Ầ' => 'A', 'Ẩ' => 'A', 'Ẫ' => 'A',
		'Ậ' => 'A', 'Ắ' => 'A', 'Ằ' => 'A', 'Ẳ' => 'A', 'Ẵ' => 'A', 'Ặ' => 'A', 'Ẹ' => 'E', 'Ẻ' => 'E',
		'Ẽ' => 'E', 'Ề' => 'E', 'Ề' => 'E', 'Ể' => 'E', 'ư' => 'u', 'ă' => 'a', 'ạ' => 'a', 'ả' => 'a',
		'ấ' => 'a', 'ầ' => 'a', 'ẩ' => 'a', 'ẫ' => 'a', 'ậ' => 'a', 'ắ' => 'a', 'ằ' => 'a', 'ẳ' => 'a',
		'ẵ' => 'a', 'ặ' => 'a', 'ẹ' => 'e', 'ẻ' => 'e', 'ẽ' => 'e', 'ề' => 'e', 'ề' => 'e', 'ể' => 'e',
		'Ễ' => 'E', 'Ệ' => 'E', 'Ỉ' => 'I', 'Ị' => 'I', 'Ọ' => 'O', 'Ỏ' => 'O', 'Ố' => 'O', 'Ồ' => 'O',
		'Ổ' => 'O', 'Ỗ' => 'O', 'Ộ' => 'O', 'Ớ' => 'O', 'Ờ' => 'O', 'Ở' => 'O', 'Ỡ' => 'O', 'Ợ' => 'O',
		'Ụ' => 'U', 'Ủ' => 'U', 'Ứ' => 'U', 'Ừ' => 'U', 'ễ' => 'e', 'ệ' => 'e', 'ỉ' => 'i', 'ị' => 'i',
		'ọ' => 'o', 'ỏ' => 'o', 'ố' => 'o', 'ồ' => 'o', 'ổ' => 'o', 'ỗ' => 'o', 'ộ' => 'o', 'ớ' => 'o',
		'ờ' => 'o', 'ở' => 'o', 'ỡ' => 'o', 'ợ' => 'o', 'ụ' => 'u', 'ủ' => 'u', 'ứ' => 'u', 'ừ' => 'u',
		'Ử' => 'u', 'Ữ' => 'U', 'Ự' => 'U', 'Ỳ' => 'Y', 'Ỵ' => 'Y', 'Ý' => 'Y', 'Ỷ' => 'Y', 'Ỹ' => 'Y',
		'ử' => 'u', 'ữ' => 'u', 'ự' => 'u', 'ỳ' => 'y', 'ỵ' => 'y', 'ỷ' => 'y', 'ỹ' => 'y', 'ế' => 'e'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
}


function genRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}

function genRandomNumber($length) {
    $characters = '0123456789';
    $string = '';    

    for ($p = 0; $p < $length; $p++) {
        $string .= $characters[mt_rand(0, strlen($characters))];
    }

    return $string;
}

function xss_clean($data)
{
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');

        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);

        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);

        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);

        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);

        do
        {
                // Remove really unwanted tags
                $old_data = $data;
                $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);

        // we are done...
        return $data;
}

function get_google_fonts() {
	global $options;
	if (isset($options['theme_heading_font'])) {
		$style = '<link href="http://fonts.googleapis.com/css?family='.$options['theme_heading_font'].'|'.$options['theme_paragraph_font'].'" rel="stylesheet" type="text/css">
		<style>
		.heading-font {
			font-family: '.str_replace('+',' ',$options['theme_heading_font']).', Arial !important;
			font-size:'.$options['theme_heading_font_size'].'px !important;
			font-weight:'.$options['theme_heading_font_weight'].' !important;
		}
		
		.paragraph-font {
			font-family: '.str_replace('+',' ',$options['theme_paragraph_font']).', Tahoma !important;
			font-size:'.$options['theme_paragraph_font_size'].'px !important;
			font-weight:'.$options['theme_paragraph_font_weight'].' !important;
		}
		</style>';
	return $style;
	} else {
	return '';	
	}
}

function date_news_number($day,$month,$year) {
	global $mysqli;
	$query = $mysqli->query("SELECT day,month,year,published,deleted FROM news WHERE day='$day' AND month='$month' AND year='$year' AND published='1' AND deleted='0'");
	return $query->num_rows;
}

function showMonth($month = null, $year = null, $language)
{
	global $mysqli;
	global $language;
	$calendar = '';
	if($month == null || $year == null) {
		$month = date('m');
		$year = date('Y');
	}
	$date = mktime(12, 0, 0, $month, 1, $year);
	$daysInMonth = date("t", $date);
	$offset = date("w", $date);
	$rows = 1;
	$prev_month = $month - 1;
	$prev_year = $year;
	if ($month == 1) {
		$prev_month = 12;
		$prev_year = $year-1;
	}
	
	$next_month = $month + 1;
	$next_year = $year;
	if ($month == 12) {
		$next_month = 1;
		$next_year = $year + 1;
	}
	$calendar .= "<script>
	$(function(){
	$('[data-toggle=tooltip]').tooltip({html:true});
	});
	</script>
<div class='panel-heading text-center'>
	<div class='row'>
	<div class='col-md-3 col-xs-4 text-left'>
	<a class='ajax-navigation btn btn-default btn-sm' href='ajax.php?case=calendar&month=".$prev_month."&year=".$prev_year."'>
	<span class='fa fa-chevron-left'></span>
	</a>
	</div>
	<div class='col-md-6 col-xs-4 month-name'>" . $language[strtolower(date("F", $date))] .' <strong>'. date("Y", $date) . "</strong></div>";
	$calendar .= "<div class='col-md-3 col-xs-4 text-right'>
	<a class='ajax-navigation btn btn-default btn-sm' href='ajax.php?case=calendar&month=".$next_month."&year=".$next_year."'>
	<span class='fa fa-chevron-right'></span>
	</a>
	</div>
	</div>
	</div>"; 
	$calendar .= "<table class='table table-bordered'>";
	$calendar .= "<tr><th>".$language['sunday']."</th><th>".$language['monday']."</th><th>".$language['tuesday']."</th><th>".$language['wednesday']."</th><th>".$language['thursday']."</th><th>".$language['friday']."</th><th>".$language['saturday']."</th></tr>";
	$calendar .= "<tr>";
	for($i = 1; $i <= $offset; $i++) {
		$calendar .= "<td></td>";
	}
	for($day = 1; $day <= $daysInMonth; $day++) {
		if( ($day + $offset - 1) % 7 == 0 && $day != 1) {
			$calendar .= "</tr><tr>";
			$rows++;
		}
		$news_number = date_news_number($day,$month,$year);
		if ($news_number == 0) {
		if ($day == date('j') AND $month == date('n') AND $year == date('Y')) {
		$calendar .= "<td class='text-center bg-info'><b>" . $day . "</b></td>";		
		} else {
		$calendar .= "<td class='text-center'>" . $day . "</td>";	
		}
		} else {
 		if ($day == date('j') AND $month == date('n') AND $year == date('Y')) {
		$calendar .= "<td class='text-center bg-info'><a href='./archive?d=".$day."&m=".$month."&y=".$year."' data-toggle='tooltip' data-placement='top' title='".$news_number." ".$language['items']."'><b>" . $day . "</b></a></td>";
		} else {
		$calendar .= "<td class='text-center'><a href='./archive?d=".$day."&m=".$month."&y=".$year."' data-toggle='tooltip' data-placement='top' title='".$news_number." ".$language['items']."'>" . $day . "</a></td>";
		}
		}
	}
	while( ($day + $offset) <= $rows * 7)
	{
		$calendar .= "<td></td>";
		$day++;
	}
	$calendar .= "</tr>";
	$calendar .= "</table>";
	return $calendar;
}


// Curl helper function
function curl_get($url) {
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($curl, CURLOPT_TIMEOUT, 360);
	curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
	$return = curl_exec($curl);
	curl_close($curl);
	return $return;
}

// check if the video imported befor
function check_video_id($video_id,$site) {
	global $mysqli;
	$sql = "SELECT * FROM news WHERE video_id='$video_id' AND source_domain='$site' LIMIT 1";
	$query = $mysqli->query($sql);
	return $query->num_rows;
}

// convert object result to array
function object_to_array($d) {
		if (is_object($d)) {
			// Gets the properties of the given object
			// with get_object_vars function
			$d = get_object_vars($d);
		}
 
		if (is_array($d)) {
			/*
			* Return array converted to object
			* Using __FUNCTION__ (Magic constant)
			* for recursive call
			*/
			return array_map(__FUNCTION__, $d);
		}
		else {
			// Return array
			return $d;
		}
}

function youtube_date_to_unix($datetime) {
	$pub = explode('T',$datetime);
	$aa = explode('-',$pub[0]);
	$year = $aa[0];
	$month = $aa[1];
	$day = $aa[2];
	$bb = explode(':',$pub[1]);
	$hours = $bb[0];
	$minutes = $bb[1];
	$seconds = 0;
	$unix = mktime($hours, $minutes, $seconds, $month, $day, $year);	
	return $unix;
}

function vimeo_date_to_unix($datetime) {
	$pub = explode(' ',$datetime);
	$aa = explode('-',$pub[0]);
	$year = $aa[0];
	$month = $aa[1];
	$day = $aa[2];
	$bb = explode(':',$pub[1]);
	$hours = $bb[0];
	$minutes = $bb[1];
	$seconds = $bb[2];
	$unix = mktime($hours, $minutes, $seconds, $month, $day, $year);	
	return $unix;
}

function youtube_duration($video_duration) {
if (strpos($video_duration,'H') !== false) {
	$hh = explode('H',$video_duration);
	$h = str_replace('PT','',$hh[0]);
	$mm = explode('M',$hh[1]);
	$m = $mm[0];
	$s = str_replace('S','',$mm[1]);
} else {
	if (strpos($video_duration,'M') !== false) {
	$mm = explode('M',$video_duration);
	$h = 0;
	$m = str_replace('PT','',$mm[0]);
	$s = str_replace('S','',$mm[1]);
	} else {
	$h = 0;
	$m = 0;
	$ss = str_replace('PT','',$video_duration);
	$s = str_replace('S','',$ss);
	}
}
$duration = ($h*3600)+($m*60)+$s;
return $duration;	
}
?>