<?php 
class General {

	private $mysqli;

    function set_connection($mysqli) {
        $this->db =& $mysqli;
    }
	
	function categories($order)
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
	
	function sub_categories($id,$order)
	{
	$sql = "SELECT * FROM categories WHERE main_id='$id' ORDER BY $order";
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
	
	function cities($order)
	{
	$sql = "SELECT * FROM weather WHERE published='1' ORDER BY $order";
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
	
	
	function news($order,$number)
	{
	$sql = "SELECT * FROM news WHERE published='1' AND deleted='0' ORDER BY $order LIMIT $number";
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
	
	
	function top_news($news,$video,$period,$number)
	{
	$days = time()-(60*60*24*$period);
	if (empty($number) OR $number == 0) {
		$number = 5;
	} else {
		$number = $number;
	}
	if ($news == 0 AND $video == 0) {
		$where = "";
	} elseif ($news == 1 AND $video == 0) {
		$where = "AND source_type='rss'";
	} elseif ($news == 0 AND $video == 1) {
		$where = "AND source_type='video'";
	} else {
		$where = "";
	}
	$sql = "SELECT * FROM news WHERE published='1' AND deleted='0' AND datetime > $days $where ORDER BY hits DESC LIMIT $number";
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
	
	function news_query($query,$order,$number)
	{
	$sql = "SELECT * FROM news $query ORDER BY $order LIMIT $number";
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
	
	function article($id)
	{
	$sql = "SELECT * FROM news WHERE published='1' AND deleted='0' AND id='$id' LIMIT 1";
	$query = $this->db->query($sql);
		if ($query->num_rows == 0) {
			return 0;
		} else {
			$this->db->query("UPDATE news SET hits=hits+1 WHERE id='$id'");
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
	
	function check_ip($ip)
	{
	$sql = "SELECT * FROM polls_votes WHERE ip_address='$ip' LIMIT 1";
	$query = $this->db->query($sql);
	return $query->num_rows;
	}
	
	function total_votes($poll_id)
	{
	$sql = "SELECT * FROM polls_votes WHERE poll_id='$poll_id'";
	$query = $this->db->query($sql);
	return $query->num_rows;
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
	
	function related($id,$category_id,$title,$number) 
	{
		$sql = "SELECT * FROM news WHERE published='1' AND deleted='0' AND id!='$id' AND MATCH (title) AGAINST ('$title' IN BOOLEAN MODE) ORDER BY id DESC LIMIT $number";
		$query = $this->db->query($sql);
			if ($query->num_rows == 0) {
				$sql = "SELECT * FROM news WHERE published='1' AND deleted='0' AND id!='$id' AND category_id='$category_id' ORDER BY id DESC LIMIT $number";
				$query = $this->db->query($sql);
				while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
				}
				return $rows;
			} else {
				while ($row = $query->fetch_assoc()) {
				$rows[] = $row;
				}
				return $rows;
			}
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
	
}
?>