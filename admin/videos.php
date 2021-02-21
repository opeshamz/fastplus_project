<?php
include('header.php'); 
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'search_youtube';
if (isset($_GET['search']) AND $_GET['search'] == 1) {
if (isset($_GET['q'])) {
$q = urlencode($_GET['q']);
} else {
$q = '';	
}	
if (isset($_GET['order_by'])) {
$order_by = make_safe($_GET['order_by']);
} else {
$order_by = 'date';	
}
if (isset($_GET['page'])) {
$page = make_safe($_GET['page']);
} else {
$page = '';	
}
if (isset($_GET['max_results'])) {
$max_results = intval(make_safe($_GET['max_results']));
} else {
$max_results = 12;	
}
if (!empty($q)) {
$baseUrl = 'https://www.googleapis.com/youtube/v3/';
$apiKey = $options['api_youtube_apikey'];
if (!empty($page)) {
$url = $baseUrl .'search?' .
    'q=' .$q.
	'&maxResults='.$max_results.
	'&order='.$order_by.
    '&part=snippet' . 
	'&type=video'.	
	'&pageToken='.$page.
    '&key=' . $apiKey;	
	
} else {
$url = $baseUrl .'search?' .
    'q=' .$q.
	'&maxResults='.$max_results.
	'&order='.$order_by.
    '&part=snippet' . 
	'&type=video'.	
    '&key=' . $apiKey;		
}
$json = json_decode(file_get_contents($url), true);	
if (count($json['items']) > 0) {
$search_results = true;	
} else {
$message = notification('warning','There are no results for the Word '.$q.' in youtube.com');	
}
} else {
$message = notification('warning','Insert the Search Word Please.');	
}
}
?>
<div class="page-header page-heading">
	<h1 class="row"><div class="col-md-6"><i class="fa fa-search"></i> Search Youtube</div>
	<div class="col-md-6">
	
	</div>
	</h1>
</div>
<div class="row">
<div class="col-md-3">
<div class="big-search-form">
	<form method="GET" action="videos.php">
		  <input type="hidden" name="case" value="search_youtube" />
		  <div class="form-group">
		  <label>Search Word</label>
		  <input type="text" name="q" class="form-control" placeholder="Search in youtube.com" value="<?php if (isset($q)) {echo urldecode($q);} ?>" />
		  </div>
		  <div class="form-group">
		  <label>Order By</label>
		  <select name="order_by" class="form-control">
		  <option value="date" <?php if (isset($order_by) AND $order_by == 'date') {echo 'SELECTED';} ?>>By Date</option>
		  <option value="rating" <?php if (isset($order_by) AND $order_by == 'rating') {echo 'SELECTED';} ?>>By Rating</option>
		  <option value="relevance" <?php if (isset($order_by) AND $order_by == 'relevance') {echo 'SELECTED';} ?>>By Relevance</option>
		  <option value="title" <?php if (isset($order_by) AND $order_by == 'title') {echo 'SELECTED';} ?>>By Title</option>
		  <option value="viewCount" <?php if (isset($order_by) AND $order_by == 'viewCount') {echo 'SELECTED';} ?>>By View Count</option>
		  </select>
		  </div>
		  <div class="form-group">
		  <label>Max Results</label>
		  <select name="max_results" class="form-control">
		  <?php for($i=12;$i<49;$i=$i+6) { ?>
		  <option value="<?php echo $i; ?>" <?php if (isset($max_results) AND $max_results == $i) {echo 'SELECTED';} ?>><?php echo $i; ?></option>
		  <?php } ?>
		  </select>
		  </div>
		  <button type="submit" name="search" value="1" class="btn btn-success btn-block">Search</button>
	</form>
</div>
<div class="big-search-form">
<?php 
$categories = $general->main_categories('category_order ASC');
if ($categories == 0) {
echo notification('warning','Please add at least one category to import the videos in.');	
} else {
?>
<div class="form-group">
		<label>Category</label>
		<select name="category" id="category" class="form-control">
		<?php 
		foreach ($categories AS $category) {
		?>
		<option value="<?php echo $category['id']; ?>" style="font-weight:bold;"><?php echo $category['category']; ?></option>
		<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
			?>
			<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>"> - <?php echo $sub['category']; ?></option>
			<?php			
			}

		}
		?>
		</select>
		<p class="help">This is the category where the video will be saved when click <b><span class="text-danger"><i class="fa fa-refresh"></i> Import</span></b>.</p>
		</div>
<?php 
}
?>
</div>
</div>
<div class="col-md-9">
<?php 
if (isset($message)) {
echo $message;	
}
if (isset($search_results)) {
?>
<div class="row">
<div class="col-xs-12">
<div class="alert alert-warning">There are (<b><?php echo $json['pageInfo']['totalResults']; ?></b>) Result(s) for <b><?php echo urldecode($q); ?></b> Query.</div>	
</div>
<?php
foreach ($json['items'] AS $item) {
?>
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="video">
<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']['videoId']; ?>&site=youtube"><img src="<?php echo $item['snippet']['thumbnails']['medium']['url']; ?>" class="img-responsive" /></a></div>
<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']['videoId']; ?>&site=youtube"><?php echo mb_substr($item['snippet']['title'],0,60,'UTF-8'); ?></a></div>
<div class="video-tools">
<div class="col-xs-6 first-action-div">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']['videoId']; ?>&site=youtube" class="text-info"><i class="fa fa-reorder"></i> Details</a>
</div>
<div class="col-xs-6 action-div" id="d<?php echo $item['id']['videoId']; ?>">
<?php if (check_video_id($item['id']['videoId'],'youtube') == 0) { ?>
<a href="javascript:void();" class="import-single-video text-danger" id="<?php echo $item['id']['videoId']; ?>"><i class="fa fa-refresh"></i> Import</a>
<?php } else { ?>	
<span class="text-success"><i class="fa fa-check"></i> Imported</span>
<?php	
}
?>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
<div class="col-xs-12 pages-line">
<div class="row">
<div class="col-xs-6">
<?php
if (isset($json['prevPageToken'])) {
echo '<a class="btn btn-default" href="videos.php?case=search_youtube&q='.$q.'&order_by='.$order_by.'&max_results='.$max_results.'&search=1&page='.$json['prevPageToken'].'">Previews</a>';	
} 
?>
</div>
<div class="col-xs-6 text-right">
<?php
if (isset($json['nextPageToken'])) {
echo '<a class="btn btn-default"  href="videos.php?case=search_youtube&q='.$q.'&order_by='.$order_by.'&max_results='.$max_results.'&search=1&page='.$json['nextPageToken'].'">Next</a>';	
} 
?>
</div>
</div>
</div>
<?php } ?>
</div>
</div>
<?php
break;	



case 'search_dailymotion';
if (isset($_GET['search']) AND $_GET['search'] == 1) {
if (isset($_GET['q'])) {
$q = str_replace(' ','+',$_GET['q']);
} else {
$q = '';	
}	
if (isset($_GET['order_by'])) {
$order_by = make_safe($_GET['order_by']);
} else {
$order_by = 'recent';	
}
if (isset($_GET['page'])) {
$page = make_safe($_GET['page']);
} else {
$page = 1;	
}
if (isset($_GET['max_results'])) {
$max_results = intval(make_safe($_GET['max_results']));
} else {
$max_results = 12;	
}
if (!empty($q)) {
$url = 'https://api.dailymotion.com/videos?fields=id,thumbnail_180_url,title&search='.$q.'&sort='.$order_by.'&limit='.$max_results.'&page='.$page;
$json = json_decode(file_get_contents($url), true);	
if ($json['total'] > 0) {
$search_results = true;	
} else {
$message = notification('warning','There are no results for the Word '.$q.' in dailymotion.com');	
}
} else {
$message = notification('warning','Insert the Search Word Please.');	
}
}
?>
<div class="page-header page-heading">
	<h1 class="row"><div class="col-md-6"><i class="fa fa-search"></i> Search DailyMotion</div>
	<div class="col-md-6">
	
	</div>
	</h1>
</div>
<div class="row">
<div class="col-md-3">
<div class="big-search-form">
	<form method="GET" action="videos.php">
		  <input type="hidden" name="case" value="search_dailymotion" />
		  <div class="form-group">
		  <label>Search Word</label>
		  <input type="text" name="q" class="form-control" placeholder="Search in dailymotion.com" value="<?php if (isset($q)) {echo str_replace('+',' ',$q);} ?>" />
		  </div>
		  <div class="form-group">
		  <label>Order By</label>
		  <select name="order_by" class="form-control">
		  <option value="recent" <?php if (isset($order_by) AND $order_by == 'recent') {echo 'SELECTED';} ?>>By Date</option>
		  <option value="rated" <?php if (isset($order_by) AND $order_by == 'rated') {echo 'SELECTED';} ?>>By Rating</option>
		  <option value="relevance" <?php if (isset($order_by) AND $order_by == 'relevance') {echo 'SELECTED';} ?>>By Relevance</option>
		  <option value="trending" <?php if (isset($order_by) AND $order_by == 'trending') {echo 'SELECTED';} ?>>By Trending</option>
		  <option value="visited" <?php if (isset($order_by) AND $order_by == 'viewCount') {echo 'SELECTED';} ?>>By View Count</option>
		  </select>
		  </div>
		  <div class="form-group">
		  <label>Max Results</label>
		  <select name="max_results" class="form-control">
		  <?php for($i=12;$i<49;$i=$i+6) { ?>
		  <option value="<?php echo $i; ?>" <?php if (isset($max_results) AND $max_results == $i) {echo 'SELECTED';} ?>><?php echo $i; ?></option>
		  <?php } ?>
		  </select>
		  </div>
		  <button type="submit" name="search" value="1" class="btn btn-success btn-block">Search</button>
	</form>
</div>
<div class="big-search-form">
<?php 
$categories = $general->main_categories('category_order ASC');
if ($categories == 0) {
echo notification('warning','Please add at least one category to import the videos in.');	
} else {
?>
<div class="form-group">
		<label>Category</label>
		<select name="category" id="category" class="form-control">
		<?php 
		foreach ($categories AS $category) {
		?>
		<option value="<?php echo $category['id']; ?>" style="font-weight:bold;"><?php echo $category['category']; ?></option>
		<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
			?>
			<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>"> - <?php echo $sub['category']; ?></option>
			<?php			
			}

		}
		?>
		</select>
		<p class="help">This is the category where the video will be saved when click <b><span class="text-danger"><i class="fa fa-refresh"></i> Import</span></b>.</p>
		</div>
<?php 
}
?>
</div>
</div>
<div class="col-md-9">
<?php 
if (isset($message)) {
echo $message;	
}
if (isset($search_results)) {
?>
<div class="row">
<div class="col-xs-12">
<div class="alert alert-warning">There are (<b><?php echo $json['total']; ?></b>) Result(s) for <b><?php echo urldecode($q); ?></b> Query.</div>	
</div>
<?php
foreach ($json['list'] AS $item) {
?>
<div class="col-md-4 col-sm-6 col-xs-12">
<div class="video">
<div class="video-thumbnail"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']; ?>&site=dailymotion"><img src="<?php echo $item['thumbnail_180_url']; ?>" class="img-responsive" /></a></div>
<div class="video-title"><a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']; ?>&site=dailymotion"><?php echo mb_substr($item['title'],0,60,'UTF-8'); ?></a></div>
<div class="video-tools">
<div class="col-xs-6 first-action-div">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $item['id']; ?>&site=dailymotion" class="text-info"><i class="fa fa-reorder"></i> Details</a>
</div>
<div class="col-xs-6 action-div" id="dm<?php echo $item['id']; ?>">
<?php if (check_video_id($item['id'],'dailymotion') == 0) { ?>
<a href="javascript:void();" class="import-dm-single-video text-danger" id="<?php echo $item['id']; ?>"><i class="fa fa-refresh"></i> Import</a>
<?php } else { ?>	
<span class="text-success"><i class="fa fa-check"></i> Imported</span>
<?php	
}
?>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>
<div class="col-xs-12">
<?php
$urlt = "videos.php?case=search_dailymotion&q=$q&order_by=$order_by&max_results=$max_results&search=1";
$size = $max_results;
$paginations = new Pagination();
$paginations->setLink("$urlt&page=%s");
$paginations->setPage($page);
$paginations->setSize($size);
$paginations->setTotalRecords($json['total']);
echo $paginations->create_links();
?>
</div>
<?php } ?>
</div>
</div>
<?php
break;	
case 'edit';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['submit'])) {
$title = make_safe(xss_clean(htmlspecialchars($_POST['title'],ENT_QUOTES)));
$details = htmlspecialchars($_POST['details'],ENT_QUOTES);
$category_id = make_safe(xss_clean($_POST['category_id']));
$cc = explode(',',$category_id);
$main_category = $cc[0];
$sub_category = $cc[1];
$tags = htmlspecialchars($_POST['tags'],ENT_QUOTES);
$published = make_safe(xss_clean(intval($_POST['published'])));	
if (empty($title)) {
$message = notification('warning','Insert The Title Please.');	
} elseif (empty($details)) {
$message = notification('warning','Write Some Details Please.');	
} elseif (empty($category_id)) {
$message = notification('warning','Choose a Category Please.');	
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/news/');
$thumbnail = $up->upload($_FILES['thumbnail']);
$up->delete("$_POST[old_thumbnail]");
} else {
$thumbnail = $_POST['old_thumbnail'];
}
$sql = "UPDATE news SET title='$title',details='$details',category_id='$main_category',sub_category_id='$sub_category',thumbnail='$thumbnail',tags='$tags',published='$published' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Article Edited Successfully.');	
} else {
$message = notification('danger','Error Happened.');	
}
}
}
$news = $general->news($id);
?>
			<div class="page-header page-heading">
				<h1>Edit Video
				<a href="videos.php" class="btn btn-default pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		<div class="row">
		<div class="col-md-9">
		  <div class="form-group">
			<label for="category">Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $news['title']; ?>" />
		  </div>
		  
		  <div class="form-group">
			<label for="details">Details</label>
			<textarea class="wysiwyg form-control" name="details" id="details" rows="20"><?php echo htmlspecialchars_decode($news['details'],ENT_QUOTES); ?></textarea>
		  </div>
		</div>
		<div class="col-md-3">
		  <div class="form-group">
			<label for="category_id">Category <span>*</span></label>
			<select class="form-control" name="category_id" id="category_id">
			<?php 
			$categories = $general->main_categories('category_order ASC');
			foreach ($categories AS $category) {
			?>
			<option value="<?php echo $category['id']; ?>,0" <?php if ($news['category_id'] == $category['id'] AND $news['sub_category_id'] == 0) {echo 'SELECTED';} ?> style="font-weight:bold;"><?php echo $category['category']; ?></option>
			<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
			?>
			<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>" <?php if ($news['category_id'] == $category['id'] AND $news['sub_category_id'] == $sub['id']) {echo 'SELECTED';} ?>> - <?php echo $sub['category']; ?></option>
			<?php			
			}			
			}
			?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="category_id">Featured Image</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
			<?php if (!empty($news['thumbnail'])) { ?>
			<p>Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/news/<?php echo $news['thumbnail']; ?>' class='img-responsive' />"><?php echo $news['thumbnail']; ?></a></p>
			<?php } ?>
			</div>
		<div class="form-group">
			<label for="tags">Tags <span>*</span></label>
			<input type="text" class="form-control tags" name="tags" id="tags" value="<?php if (isset($news['tags'])) { echo $news['tags']; } ?>" />
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="published" id="published" value="1" <?php if ($news['published'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Publish news ?</span>
		  </div>
		  
		  <input type="hidden" name="old_thumbnail" value="<?php echo $news['thumbnail']; ?>" />
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		  </div>
		  </div>
		</form>
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['unpublish'])) {
$delete = $mysqli->query("UPDATE news SET deleted='1',published='0' WHERE id='$id'");
if ($delete) {
$message = notification('success','Video Has Been Unpublished Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
if (isset($_POST['delete'])) {
$sql = "SELECT * FROM news WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
$row = $query->fetch_assoc();
if (!empty($row['thumbnail']) AND file_exists('../upload/news/'.$row['thumbnail'])) {
@unlink('../upload/news/'.$row['thumbnail']);	
}
}
$delete = $mysqli->query("DELETE FROM news WHERE id='$id'");
if ($delete) {
$message = notification('success','Video Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$news = $general->news($id);
?>
			<div class="page-header page-heading">
				<h1>Delete Video
				<a href="videos.php" class="btn btn-default  pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done)) { ?>
			<div class="alert alert-warning">You Can Either <b>Unpublish</b> or <b>Delete</b> the Video : <b><?php echo htmlspecialchars_decode($news['title'],ENT_QUOTES); ?></b>. If you Choose to Delete you Can't Undo this Action Later.</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="videos.php" class="btn btn-default">Back To Videos</a>
		  <?php } else { ?>
		  <button type="submit" name="unpublish" class="btn btn-warning">Temporary Delete</button>
		  <button type="submit" name="delete" class="btn btn-danger">Permanent Delete</button>
		  <?php } ?>
		</form>
<?php
break;
case 'search';
$q = make_safe(xss_clean($_GET['q']));
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET deleted='1',published='0' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected Videos Was Deleted Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
?>
<div class="page-header page-heading">
	<h1 class="row"><div class="col-md-6"><i class="fa fa-search"></i> Search For <?php echo $q; ?> In Published Videos</div>
	<div class="col-md-6">
	<div class="pull-right search-form">
	<form method="GET" action="videos.php">
		<div class="input-group">
		  <input type="hidden" name="case" value="search" />
		  <input type="text" name="q" class="form-control" placeholder="Search" value="<?php echo $q; ?>" />
		  <span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div>
	<a href="videos.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted Videos"><span class="fa fa-trash"></span></a>
	<a href="videos.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published Videos"><span class="fa fa-youtube-play"></span></a>
	</div>
	</h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='video' AND title LIKE '%$q%' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Results.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=search&page=%s&q=$q");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='video' AND title LIKE '%$q%' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th colspan="2">Video</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
<tr>
<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
<td width="75">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<img src="../upload/news/<?php echo $row['thumbnail']; ?>" width="75" height="42" />
</a>
</td>
<td>
<div class="article-title">
<a style="display:block;" href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<?php echo $row['title']; ?>
</a>
</div>
<div class="article-meta">
<span><?php echo $row['source_domain']; ?></span>
<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
<span><i class="fa fa-clock-o"></i> <?php echo get_duration($row['duration']); ?></span>
<?php if ($row['source_id'] != 0) { ?>
<span><i class="fa fa-th-large"></i> <?php echo get_source($row['source_id']); ?></span>
<?php } ?>
</div>
</td>
<td align="right">
<a href="videos.php?case=edit&id=<?php echo $row['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
<a href="videos.php?case=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
</td>
</tr>
<?php
}
?>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
<?php
}		
break;
case 'channel';
$id = intval(make_safe(xss_clean($_GET['id'])));
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET deleted='1',published='0' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected Videos Was Deleted Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
$source = $general->source($id);
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-th-large"></i> <?php if ($id == 0) { echo 'Single Videos'; } else { echo 'Imported Videos From '.$source['title']; } ?></h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_id='$id' AND source_type='video' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Published Videos From '.$source['title'].'.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=channel&id=$id&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_id='$id' AND source_type='video' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th colspan="2">Video</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
<tr>
<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
<td width="75">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<img src="../upload/news/<?php echo $row['thumbnail']; ?>" width="75" height="42" />
</a>
</td>
<td>
<div class="article-title">
<a style="display:block;" href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<?php echo $row['title']; ?>
</a>
</div>
<div class="article-meta">
<span><?php echo $row['source_domain']; ?></span>
<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
<span><i class="fa fa-clock-o"></i> <?php echo get_duration($row['duration']); ?></span>
<?php if ($row['source_id'] != 0) { ?>
<span><i class="fa fa-th-large"></i> <?php echo get_source($row['source_id']); ?></span>
<?php } ?>
</div>
</td>
<td align="right">
<a href="videos.php?case=edit&id=<?php echo $row['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
<a href="videos.php?case=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
</td>
</tr>
<?php
}
?>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
<?php
}	
break;
case 'deleted';
if (isset($_POST['restore']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET deleted='0',published='1' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected Video Was Restored Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "SELECT * FROM news WHERE id='$del_id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
	if (!empty($row['thumbnail']) AND file_exists('../upload/news/'.$row['thumbnail'])) {
		@unlink('../upload/news/'.$row['thumbnail']);	
	}
	$delete = $mysqli->query("DELETE FROM news WHERE id='$row[id]'");
	}	
if ($delete) {
$message = notification('success','Video Deleted Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-reorder"></i> Deleted Videos</h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='video' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Deleted Videos.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=deleted&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='video' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th colspan="2">Video</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
<tr>
<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
<td width="75">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<img src="../upload/news/<?php echo $row['thumbnail']; ?>" width="75" height="42" />
</a>
</td>
<td>
<div class="article-title">
<a style="display:block;" href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<?php echo $row['title']; ?>
</a>
</div>
<div class="article-meta">
<span><?php echo $row['source_domain']; ?></span>
<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
<span><i class="fa fa-clock-o"></i> <?php echo get_duration($row['duration']); ?></span>
<?php if ($row['source_id'] != 0) { ?>
<span><i class="fa fa-th-large"></i> <?php echo get_source($row['source_id']); ?></span>
<?php } ?>
</div>
</td>
<td align="right">
<a href="videos.php?case=edit&id=<?php echo $row['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
<a href="videos.php?case=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
</td>
</tr>
<?php
}
?>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="restore" class="btn btn-success"><span class="fa fa-check"></span> Restore</button>
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Permanent Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
<?php
}	
break;
case 'review';
if (isset($_POST['publish']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET deleted='0',published='1' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected Videos Was Published Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$delete = $mysqli->query("UPDATE news SET published='0',deleted='1' WHERE id='$del_id'");
	}	
if ($delete) {
$message = notification('success','Videos Deleted Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-edit"></i> Need Review Videos</h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='video' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Videos Need Review.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=review&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='video' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th colspan="2">Video</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
<tr>
<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
<td width="75">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<img src="../upload/news/<?php echo $row['thumbnail']; ?>" width="75" height="42" />
</a>
</td>
<td>
<div class="article-title">
<a style="display:block;" href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<?php echo $row['title']; ?>
</a>
</div>
<div class="article-meta">
<span><?php echo $row['source_domain']; ?></span>
<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
<span><i class="fa fa-clock-o"></i> <?php echo get_duration($row['duration']); ?></span>
<?php if ($row['source_id'] != 0) { ?>
<span><i class="fa fa-th-large"></i> <?php echo get_source($row['source_id']); ?></span>
<?php } ?>
</div>
</td>
<td align="right">
<a href="videos.php?case=edit&id=<?php echo $row['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
<a href="videos.php?case=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
</td>
</tr>
<?php
}
?>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="publish" class="btn btn-success"><span class="fa fa-check"></span> Publish</button>
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
<?php
}	
break;
default;
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$delete = $mysqli->query("UPDATE news SET published='0',deleted='1' WHERE id='$del_id'");
	if ($delete) {
	$message = notification('success','The Selected Videos Were Assigned as Deleted.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
?>
<div class="page-header page-heading">
	<h1 class="row"><div class="col-md-6"><i class="fa fa-youtube-play"></i> Published Videos</div>
	<div class="col-md-6">
	<div class="pull-right search-form">
	<form method="GET" action="videos.php">
		<div class="input-group">
		  <input type="hidden" name="case" value="search" />
		  <input type="text" name="q" class="form-control" placeholder="Search">
		  <span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div>
	<a href="videos.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted Videos"><span class="fa fa-trash"></span></a>
	<a href="videos.php?case=review" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Need Review Videos"><span class="fa fa-edit"></span></a>
	<a href="videos.php?case=search_youtube" class="btn btn-primary pull-right" data-toggle="tooltip" data-placement="top" title="Search in YouTube"><span class="fa fa-youtube"></span></a>
	<a href="videos.php?case=search_dailymotion" class="btn btn-primary pull-right" data-toggle="tooltip" data-placement="top" title="Search in DailyMotion"><span class="fa fa-toggle-on"></span></a>
	</div>
	</h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='video' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Published Videos.');
} else {
$pagination = new Pagination();
$pagination->setLink("?page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='video' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th colspan="2">Video</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
<tr>
<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
<td width="75">
<a href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<img src="../upload/news/<?php echo $row['thumbnail']; ?>" width="75" height="42" />
</a>
</td>
<td>
<div class="article-title">
<a style="display:block;" href="javascript:void();" data-toggle="ajax-modal" data-url="ajax.php?case=video_details&id=<?php echo $row['video_id']; ?>&site=<?php echo $row['source_domain']; ?>">
<?php echo $row['title']; ?>
</a>
</div>
<div class="article-meta">
<span><?php echo $row['source_domain']; ?></span>
<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
<span><i class="fa fa-clock-o"></i> <?php echo get_duration($row['duration']); ?></span>
<?php if ($row['source_id'] != 0) { ?>
<span><i class="fa fa-th-large"></i> <?php echo get_source($row['source_id']); ?></span>
<?php } ?>
</div>
</td>
<td align="right">
<a href="videos.php?case=edit&id=<?php echo $row['id']; ?>" class="btn btn-default btn-xs" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
<a href="videos.php?case=delete&id=<?php echo $row['id']; ?>" class="btn btn-danger btn-xs" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-trash"></span></a>
</td>
</tr>
<?php
}
?>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-2 col-md-3"><button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button></div>
<div class="col-sm-10 col-md-9"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
<?php
} 
} 
include('footer.php');
?>