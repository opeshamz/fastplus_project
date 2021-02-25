<?php 
class General {

	var $mysqli;

    function set_connection($mysqli) {
        $this->db =& $mysqli;
    }
	
	function main_categories($order)
	{
	$sql = "SELECT * FROM categories WHERE main_id='0' ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function categories_query($where,$order)
	{
	$sql = "SELECT * FROM categories $where ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function sub_categories($main_id,$order)
	{
	$sql = "SELECT * FROM categories WHERE main_id='$main_id' ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function sources()
	{
	$sql = "SELECT id,title FROM sources ORDER BY id ASC";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function links($order)
	{
	$sql = "SELECT * FROM links ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function link($id)
	{
	$sql = "SELECT * FROM links WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	
	}
	
	function ads($order)
	{
	$sql = "SELECT * FROM advertisements ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function ad($id)
	{
	$sql = "SELECT * FROM advertisements WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	
	}
	
	
	function cities($order)
	{
	$sql = "SELECT * FROM weather ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function polls($order)
	{
	$sql = "SELECT * FROM polls ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function question($id)
	{
	$sql = "SELECT * FROM polls WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
	
	function answers($id)
	{
	$sql = "SELECT * FROM polls_answers WHERE poll_id='$id' ORDER BY id ASC";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	
	}
	
	function category($id)
	{
	$sql = "SELECT * FROM categories WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
	
	function city($id)
	{
	$sql = "SELECT * FROM weather WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
	
	function news($id)
	{
	$sql = "SELECT * FROM news WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
	
	function source($id)
	{
	$sql = "SELECT * FROM sources WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
	
	
	function start_period() {
	$sql = "SELECT month,year FROM news ORDER BY id ASC LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}	
	}
	
	function statistics_news($day,$month,$year) {
	$sql = "SELECT source_type,day,month,year FROM news WHERE source_type='rss' AND day='$day' AND month='$month' AND year='$year'";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function statistics_videos($day,$month,$year) {
	$sql = "SELECT source_type,day,month,year FROM news WHERE source_type='video' AND day='$day' AND month='$month' AND year='$year'";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function count_sources($type) {
	$sql = "SELECT source_type FROM sources WHERE source_type='$type'";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function count_news($type) {
	$sql = "SELECT source_type FROM news WHERE published='1' AND deleted='0'";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	
	function count_categories() {
	$sql = "SELECT id FROM categories";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function count_draft_news($type) {
	$sql = "SELECT source_type,published,deleted FROM news WHERE source_type='$type' AND published='0' AND deleted='0'";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function set_options($data,$set) {
	unset($data['save']);
	foreach ($data AS $key=>$value) {
		if (is_array($value)) {
			$value = implode(',',$value);
		}
	$check = $this->db->query("SELECT option_name FROM options WHERE option_name='$key'");
	$value = $this->db->real_escape_string(htmlspecialchars($value,ENT_QUOTES));	
	if ($check->num_rows == 0) {
	$excute = $this->db->query("INSERT INTO options (option_name,option_value,option_default,option_set) VALUES ('$key','$value','$value','$set')");	
	} else {
	$excute = $this->db->query("UPDATE options SET option_value='$value' WHERE option_name='$key'");		
	}
	if ($excute) {
	$message = notification('success','All Changes Saved.');
	} else {
	$message = notification('danger','Error Happened.');
	}
	}
	return $message;
	}
	
	function get_options($set) {
	$options = array();
	$query = $this->db->query("SELECT * FROM options WHERE option_set='$set' ORDER BY id ASC");
	while ($row = $query->fetch_assoc()) {
		$options[$row["option_name"]] = $row["option_value"];
	}  
	return $options;
	}
	
	function get_all_options() {
	$options = array();
	$query = $this->db->query("SELECT * FROM options ORDER BY id ASC");
	while ($row = $query->fetch_assoc()) {
		$options[strtolower($row["option_set"]).'_'.$row["option_name"]] = $row["option_value"];
	}  
	return $options;
	}
	
	function pages($order)
	{
	$sql = "SELECT * FROM pages ORDER BY $order";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
			}
			return $rows;
		}
	}
	
	function page($id)
	{
	$sql = "SELECT * FROM pages WHERE id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$row = $query->fetch_assoc();
			return $row;
		}
	}
}
?>