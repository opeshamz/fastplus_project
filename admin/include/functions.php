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


function notification($type,$text) {
return '<div class="alert alert-'.$type.'">'.$text.'</div>';
}

function get_category($id) {
global $mysqli;
$sql = "SELECT category FROM categories WHERE id='$id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
return $row['category'];
}
function get_source($id) {
global $mysqli;
$sql = "SELECT title FROM sources WHERE id='$id' LIMIT 1";
$query = $mysqli->query($sql);
$row = $query->fetch_assoc();
return $row['title'];
}
function get_source_news($id) {
global $mysqli;
$sql = "SELECT source_id FROM news WHERE source_id='$id' AND source_type='rss'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_source_videos($id) {
global $mysqli;
$sql = "SELECT source_id FROM news WHERE source_id='$id' AND source_type='video'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_category_news($id) {
global $mysqli;
$sql = "SELECT category_id FROM news WHERE category_id='$id' AND source_type='rss'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_sub_category_news($id) {
global $mysqli;
$sql = "SELECT category_id FROM news WHERE sub_category_id='$id' AND source_type='rss'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_category_videos($id) {
global $mysqli;
$sql = "SELECT category_id FROM news WHERE category_id='$id' AND source_type='video'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_sub_category_videos($id) {
global $mysqli;
$sql = "SELECT category_id FROM news WHERE sub_category_id='$id' AND source_type='video'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_category_sources($id) {
global $mysqli;
$sql = "SELECT category_id FROM sources WHERE category_id='$id'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_sub_category_sources($id) {
global $mysqli;
$sql = "SELECT sub_category_id FROM sources WHERE sub_category_id='$id'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_poll_answers($id) {
global $mysqli;
$sql = "SELECT poll_id FROM polls_answers WHERE poll_id='$id'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function get_poll_votes($id) {
global $mysqli;
$sql = "SELECT poll_id FROM polls_votes WHERE poll_id='$id'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function answer_count_votes($id) {
global $mysqli;
$sql = "SELECT answer_id FROM polls_votes WHERE answer_id='$id'";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}
function slug_it($title)
{
$slugged = url_slug(
	"$title", 
	array(
		'delimiter' => '-',
		'lowercase' => true
	)
);
return $slugged;
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

function get_domain($link) {
	$parse = parse_url($link);
	return str_replace('www.','',$parse['host']);
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
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
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

function empty_templates_cache($str){
         if(is_file($str)){
             return @unlink($str);
         }
         elseif(is_dir($str)){
             $scan = glob(rtrim($str,'/').'/*.php');
             foreach($scan as $index=>$path){
			 if (str_replace($str,'',$path) === 'index.html') continue;
                 empty_templates_cache($path);
             }
         return true;
		 }
}

function generate_statics_select($year,$month) {
	$result = '';
	if ($year == date('Y')) {
	$result .= '<optgroup label="'.$year.'">';
	for($i=$month;$i<date('n')+1;$i++) {
	$result .= '<option value="?year='.$year.'&month='.$i.'">'.month_name($i).'</option>';
	}	
	$result .= '</optgroup>';
	} else {
	$result .= '<optgroup label="'.$year.'">';
	for($i=$month;$i<13;$i++) {
	$result .= '<option value="?year='.$year.'&month='.$i.'">'.month_name($i).'</option>';
	}	
	$result .= '</optgroup>';
	for($y=$year+1;$y<date('Y')+1;$y++) {
	$result .= '<optgroup label="'.$y.'">';
	for($m=1;$m<13;$m++) {
	$result .= '<option value="?year='.$y.'&month='.$m.'">'.month_name($m).'</option>';
	if ($y == date('Y') AND $m == date('n')) {
		break;
	}
	}	
	$result .= '</optgroup>';	
	}
	}
return $result;	
}

function month_name($month) {
$month_lang = array(
1 => 'January',
2 => 'February',
3 => 'March',
4 => 'April',
5 => 'May',
6 => 'June',
7 => 'July',
8 => 'August',
9 => 'September',
10 => 'October',
11 => 'November',
12 => 'December'
);
return $month_lang[$month];
}

function content_words_count($string) {
$string = trim(strip_tags($string));
$words = count(explode(" ", $string));	
return $words;	
}

function check_content($string) {
	$string = trim(strip_tags(htmlspecialchars_decode($string)));
    $words = count(explode(" ", $string)); 
	if ($words < 100) {
		return '<div class="text-muted"><b>'.$words.'</b> Words</div>';
	} elseif ($words > 100 AND $words < 400) {
		return '<div class="text-primary"><b>'.$words.'</b> Words</div>';
	} else {
		return '<div class="text-success"><b>'.$words.'</b> Words</div>';
	}
}
function check_image($thumbnail) {
	$url = '../upload/news/'.$thumbnail;
	if (empty($thumbnail) OR !file_exists($url)) {
	return '<div class="text-danger"><b>No Image</b></div>';	
	} else {
	$dim = getimagesize($url);	
	$width = $dim[0];
	$height = $dim[1];
	if ($width < 400) {
		return '<div class="text-muted"><b>'.$width.'px</b>-<b>'.$height.'px</b></div>';
	} elseif ($width > 400 AND $width < 700) {
		return '<div class="text-primary"><b>'.$width.'px</b>-<b>'.$height.'px</b></div>';
	} else {
		return '<div class="text-success"><b>'.$width.'px</b>-<b>'.$height.'px</b></div>';
	}
	} 
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

function google_fonts() {
$fonts = array(
'Aclonica' => 'Aclonica',
'Allan' => 'Allan',
'Amiri' => 'Amiri',
'Annie+Use+Your+Telescope' => 'Annie Use Your Telescope',
'Anonymous+Pro' => 'Anonymous Pro',
'Allerta+Stencil' => 'Allerta Stencil',
'Allerta' => 'Allerta',
'Amaranth' => 'Amaranth',
'Anton' => 'Anton',
'Architects+Daughter' => 'Architects Daughter',
'Arimo' => 'Arimo',
'Artifika' => 'Artifika',
'Arvo' => 'Arvo',
'Asset' => 'Asset',
'Astloch' => 'Astloch',
'Bangers' => 'Bangers',
'Bentham' => 'Bentham',
'Bevan' => 'Bevan',
'Bigshot+One' => 'Bigshot One',
'Bowlby+One' => 'Bowlby One',
'Bowlby+One+SC' => 'Bowlby One SC',
'Brawler' => 'Brawler',
'Buda' => 'Buda',
'Cabin' => 'Cabin',
'Calligraffitti' => 'Calligraffitti',
'Candal' => 'Candal',
'Cantarell' => 'Cantarell',
'Cardo' => 'Cardo',
'Carter+One' => 'Carter One',
'Caudex' => 'Caudex',
'Cedarville+Cursive' => 'Cedarville Cursive',
'Cherry+Cream+Soda' => 'Cherry Cream Soda',
'Chewy' => 'Chewy',
'Coda' => 'Coda',
'Coming+Soon' => 'Coming Soon',
'Copse' => 'Copse',
'Corben' => 'Corben',
'Cousine' => 'Cousine',
'Covered+By+Your+Grace' => 'Covered By Your Grace',
'Crafty+Girls' => 'Crafty Girls',
'Crimson+Text' => 'Crimson Text',
'Crushed' => 'Crushed',
'Cuprum' => 'Cuprum',
'Damion' => 'Damion',
'Dancing+Script' => 'Dancing Script',
'Dawning+of+a+New+Day' => 'Dawning of a New Day',
'Didact+Gothic' => 'Didact Gothic',
'Droid+Sans' => 'Droid Sans',
'Droid+Sans+Mono' => 'Droid Sans Mono',
'Droid+Serif' => 'Droid Serif',
'EB+Garamond' => 'EB Garamond',
'Expletus+Sans' => 'Expletus Sans',
'Fontdiner+Swanky' => 'Fontdiner Swanky',
'Forum' => 'Forum',
'Francois+One' => 'Francois One',
'Geo' => 'Geo',
'Give+You+Glory' => 'Give You Glory',
'Goblin+One' => 'Goblin One',
'Goudy+Bookletter+1911' => 'Goudy Bookletter 1911',
'Gravitas+One' => 'Gravitas One',
'Gruppo' => 'Gruppo',
'Hammersmith+One' => 'Hammersmith One',
'Holtwood+One+SC' => 'Holtwood One SC',
'Homemade+Apple' => 'Homemade Apple',
'Inconsolata' => 'Inconsolata',
'Indie+Flower' => 'Indie Flower',
'IM+Fell+DW+Pica' => 'IM Fell DW Pica',
'IM+Fell+DW+Pica+SC' => 'IM Fell DW Pica SC',
'IM+Fell+Double+Pica' => 'IM Fell Double Pica',
'IM+Fell+Double+Pica+SC' => 'IM Fell Double Pica SC',
'IM+Fell+English' => 'IM Fell English',
'IM+Fell+English+SC' => 'IM Fell English SC',
'IM+Fell+French+Canon' => 'IM Fell French Canon',
'IM+Fell+French+Canon+SC' => 'IM Fell French Canon SC',
'IM+Fell+Great+Primer' => 'IM Fell Great Primer',
'IM+Fell+Great+Primer+SC' => 'IM Fell Great Primer SC',
'Irish+Grover' => 'Irish Grover',
'Irish+Growler' => 'Irish Growler',
'Istok+Web' => 'Istok Web',
'Josefin+Sans' => 'Josefin Sans',
'Josefin+Slab' => 'Josefin Slab',
'Judson' => 'Judson',
'Jura' => 'Jura',
'Just+Another+Hand' => 'Just Another Hand',
'Just+Me+Again+Down+Here' => 'Just Me Again Down Here',
'Kameron' => 'Kameron',
'Kenia' => 'Kenia',
'Kranky' => 'Kranky',
'Kreon' => 'Kreon',
'Kristi' => 'Kristi',
'La+Belle+Aurore' => 'La Belle Aurore',
'Lateef' => 'Lateef',
'Lato' => 'Lato',
'League+Script' => 'League Script',
'Lekton' => 'Lekton',
'Limelight' => 'Limelight',
'Lobster' => 'Lobster',
'Lobster+Two' => 'Lobster Two',
'Lora' => 'Lora',
'Love+Ya+Like+A+Sister' => 'Love Ya Like A Sister',
'Loved+by+the+King' => 'Loved by the King',
'Luckiest+Guy' => 'Luckiest Guy',
'Maiden+Orange' => 'Maiden Orange',
'Mako' => 'Mako',
'Maven+Pro' => 'Maven Pro',
'Meddon' => 'Meddon',
'MedievalSharp' => 'MedievalSharp',
'Megrim' => 'Megrim',
'Merriweather' => 'Merriweather',
'Metrophobic' => 'Metrophobic',
'Michroma' => 'Michroma',
'Miltonian+Tattoo' => 'Miltonian Tattoo',
'Miltonian' => 'Miltonian',
'Modern+Antiqua' => 'Modern Antiqua',
'Monofett' => 'Monofett',
'Molengo' => 'Molengo',
'Mountains+of+Christmas' => 'Mountains of Christmas',
'Muli' => 'Muli',
'Neucha' => 'Neucha',
'Neuton' => 'Neuton',
'News+Cycle' => 'News Cycle',
'Nixie+One' => 'Nixie One',
'Nobile' => 'Nobile',
'Nova+Cut' => 'Nova Cut',
'Nova+Flat' => 'Nova Flat',
'Nova+Mono' => 'Nova Mono',
'Nova+Oval' => 'Nova Oval',
'Nova+Round' => 'Nova Round',
'Nova+Script' => 'Nova Script',
'Nova+Slim' => 'Nova Slim',
'Nova+Square' => 'Nova Square',
'Nunito' => 'Nunito',
'OFL+Sorts+Mill+Goudy+TT' => 'OFL Sorts Mill Goudy TT',
'Old+Standard+TT' => 'Old Standard TT',
'Open+Sans' => 'Open Sans',
'Open+Sans+Condensed' => 'Open Sans Condensed',
'Orbitron' => 'Orbitron',
'Oswald' => 'Oswald',
'Over+the+Rainbow' => 'Over the Rainbow',
'Reenie+Beanie' => 'Reenie Beanie',
'Pacifico' => 'Pacifico',
'Patrick+Hand' => 'Patrick Hand',
'Paytone+One' => 'Paytone One',
'Permanent+Marker' => 'Permanent Marker',
'Philosopher' => 'Philosopher',
'Play' => 'Play',
'Playfair+Display' => 'Playfair Display',
'Podkova' => 'Podkova',
'PT+Sans' => 'PT Sans',
'PT+Sans+Narrow' => 'PT Sans Narrow',
'PT+Serif' => 'PT Serif',
'PT+Serif+Caption' => 'PT Serif Caption',
'Puritan' => 'Puritan',
'Quattrocento' => 'Quattrocento',
'Quattrocento+Sans' => 'Quattrocento Sans',
'Radley' => 'Radley',
'Raleway' => 'Raleway',
'Redressed' => 'Redressed',
'Rock+Salt' => 'Rock Salt',
'Rokkitt' => 'Rokkitt',
'Ruslan+Display' => 'Ruslan Display',
'Scheherazade' => 'Scheherazade',
'Schoolbell' => 'Schoolbell',
'Shadows+Into+Light' => 'Shadows Into Light',
'Shanti' => 'Shanti',
'Sigmar+One' => 'Sigmar One',
'Six+Caps' => 'Six Caps',
'Slackey' => 'Slackey',
'Smythe' => 'Smythe',
'Sniglet' => 'Sniglet',
'Special+Elite' => 'Special Elite',
'Stardos+Stencil' => 'Stardos Stencil',
'Sue+Ellen+Francisco' => 'Sue Ellen Francisco',
'Sunshiney' => 'Sunshiney',
'Swanky+and+Moo+Moo' => 'Swanky and Moo Moo',
'Syncopate' => 'Syncopate',
'Tangerine' => 'Tangerine',
'Tenor+Sans' => 'Tenor Sans',
'Terminal+Dosis+Light' => 'Terminal Dosis Light',
'The+Girl+Next+Door' => 'The Girl Next Door',
'Tinos' => 'Tinos',
'Ubuntu' => 'Ubuntu',
'Ultra' => 'Ultra',
'Unkempt' => 'Unkempt',
'UnifrakturCook' => 'UnifrakturCook',
'UnifrakturMaguntia' => 'UnifrakturMaguntia',
'Varela' => 'Varela',
'Varela+Round' => 'Varela Round',
'Vibur' => 'Vibur',
'Vollkorn' => 'Vollkorn',
'VT323' => 'VT323',
'Waiting+for+the+Sunrise' => 'Waiting for the Sunrise',
'Wallpoet' => 'Wallpoet',
'Walter+Turncoat' => 'Walter Turncoat',
'Wire+One' => 'Wire One',
'Yanone+Kaffeesatz' => 'Yanone Kaffeesatz',
'Yeseva+One' => 'Yeseva One',
'Zeyada' => 'Zeyada'
);
return $fonts;
}

function video_sites() {
$sites = array(
	'youtube' => 'YouTube',
	'vimeo' => 'Vimeo',
	'dailymotion' => 'DailyMotion'
);
return $sites;
}

function ads_places() {
$places = array(
	'header' => 'Header',
	'sidebar_1' => 'Sidebar 1',
	'sidebar_2' => 'Sidebar 2',
	'content_1' => 'Content 1',
	'content_2' => 'Content 2'
);
return $places;
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

function check_channel_link($link) {
global $mysqli;	
$sql = "SELECT rss_link FROM sources WHERE rss_link='$link' LIMIT 1";
$query = $mysqli->query($sql);
$number = $query->num_rows;
return $number;
}

function get_duration($seconds)
{
    if (gmdate("H", $seconds) == '00') {
	return gmdate("i:s", $seconds);	
	} else {
	return gmdate("H:i:s", $seconds);
	}
}
?>