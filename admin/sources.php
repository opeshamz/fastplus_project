<?php
include('header.php');
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'add';
if (isset($_POST['submit'])) {
$title = make_safe(xss_clean($_POST['title']));
$category_id = make_safe(xss_clean($_POST['category_id']));
$cc = explode(',',$category_id);
$main_category = $cc[0];
$sub_category = $cc[1];
$is_referal = intval(make_safe(xss_clean($_POST['is_referal'])));
$published = intval(make_safe(xss_clean($_POST['published'])));
$referal_suffix = make_safe(xss_clean($_POST['referal_suffix']));
$strip_tags = intval(make_safe(xss_clean($_POST['strip_tags'])));
$allowable_tags = htmlspecialchars($_POST['allowable_tags'],ENT_QUOTES);
$rss_link = make_safe(xss_clean($_POST['rss_link']));
$tt = parse_url($rss_link);
$bb = str_replace('www.','',$tt['host']);
$nn = explode('.',$bb);
$source_domain = $nn[0];
$banned_words = make_safe(xss_clean($_POST['banned_words']));
$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
if (empty($title)) {
$message = notification('warning','Insert Resource Name Please.');
} elseif (empty($rss_link)) {
$message = notification('warning','Insert Source Url Please.');
} elseif (empty($category_id)) {
$message = notification('warning','Choose a Category Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/sources/');
$thumbnail = $up->upload($_FILES['thumbnail']);
} else {
$thumbnail = '';
}
$datetime = time();
$sql = "INSERT INTO sources (source_type,source_domain,title,rss_link,category_id,sub_category_id,thumbnail,news_number,banned_words,is_referal,referal_suffix,strip_tags,allowable_tags,auto_update,auto_update_period,add_time,latest_activity,published) VALUES 
							('rss','$source_domain','$title','$rss_link','$main_category','$sub_category','$thumbnail','$news_number','$banned_words','$is_referal','$referal_suffix','$strip_tags','$allowable_tags','$auto_update','$auto_update_period','$datetime','$datetime','$published')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Source Added Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Add New Source
				<a href="sources.php" class="btn btn-default btn-sm"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data" style="margin: 25px;">
		
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Setting</a></li>
    <li role="presentation"><a href="#filter" aria-controls="filter" role="tab" data-toggle="tab">Filters Setting</a></li>
	<li role="presentation"><a href="#cron" aria-controls="cron" role="tab" data-toggle="tab">Cron Setting</a></li>
	<li role="presentation"><a href="#ref" aria-controls="ref" role="tab" data-toggle="tab">Referral Setting</a></li>
  </ul>

  <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="basic">
		  <div class="form-group">
			<label for="title">Source Name <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" />
		  </div>
		  <div class="form-group">
			<label for="rss_link">Source Url <span>*</span></label>
			<input type="text" class="form-control" name="rss_link" id="rss_link" />
		  </div>
		  <div class="form-group">
			<label for="category_id">Category <span>*</span></label>
			<select class="form-control" name="category_id" id="category_id">
			<?php 
			$categories = $general->main_categories('category_order ASC');
			foreach ($categories AS $category) {
			?>
			<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;"><?php echo $category['category']; ?></option>
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
		  </div>
		  <div class="form-group">
			<label for="news_number">Items Number Per Grab <span>*</span></label>
			<select class="form-control" name="news_number" id="news_number">
			<?php 
			for($i=1;$i<51;$i++) {
			?>
			<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
			<?php			
			}
			?>
			</select>
		  </div>
		  <div class="form-group">
		  <label for="news_number">News State <span>*</span></label>
		   <div><input type="radio" name="published" value="1" CHECKED /><span class="checkbox-label"> Published</span></div>
		   <div><input type="radio" name="published" value="0" /><span class="checkbox-label"> Draft (Review Before Publishing)</span></div>
		  </div>
		 <div class="form-group no-bottom-border">
			<label for="category_id">Thumbnail</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="ref">
		<div class="form-group">
			<input type="checkbox" name="is_referal" id="is_referal" value="1" /> <span class="checkbox-label">Has a Referal Suffix ?</span>
		  </div>
		  <div class="form-group" id="referal_suffix_div">
			<label for="referal_suffix">Referal Suffix</label>
			<input type="text" class="form-control" name="referal_suffix" id="referal_suffix" />
		  </div>
		</div>
		
		<div role="tabpanel" class="tab-pane" id="cron">
		<div class="form-group">
			<input type="checkbox" name="auto_update" id="auto_update" value="1" /> <span class="checkbox-label">Auto Update Source ?</span>
		  </div>
		  <div class="form-group" id="auto_update_period_div">
			<label for="auto_update_period">Auto Update Period</label>
			<select class="form-control" name="auto_update_period" id="auto_update_period">
			<option value="1800">30 Minutes</option>
			<option value="2700">45 Minutes</option>
			<option value="3600">1 Hour</option>
			<?php 
			for($t=7200;$t<86400;$t=$t+3600) {
			?>
			<option value="<?php echo $t; ?>"><?php echo ($t/3600); ?> Hours</option>
			<?php			
			}
			?>
			<option value="86400">1 Day</option>
			<option value="172800">2 Days</option>
			<option value="259200">3 Days</option>
			</select>
		  </div>
		</div>
		<div role="tabpanel" class="tab-pane" id="filter">
		  <div class="form-group">
			<label for="banned_words">Banned Words</label>
			<textarea class="form-control" name="banned_words" id="banned_words" rows="3"></textarea>
		  </div>
		  
		  <div class="form-group">
			<input type="checkbox" name="strip_tags" id="strip_tags" value="1" /> <span class="checkbox-label">Strip HTML Tags ?</span>
		  </div>
		  <div class="form-group" id="strip_tags_div">
			<label for="allowable_tags">Allowable HTML Tags</label>
			<input type="text" class="form-control" name="allowable_tags" id="allowable_tags" />
		  </div>
		  
		</div>
		</div>
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
</div>
</div>
</div>
</div>
</div>
</div>


<?php
break;
case 'edit';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['submit'])) {
$title = make_safe(xss_clean($_POST['title']));
$category_id = make_safe(xss_clean($_POST['category_id']));
$cc = explode(',',$category_id);
$main_category = $cc[0];
$sub_category = $cc[1];
$is_referal = intval(make_safe(xss_clean($_POST['is_referal'])));
$published = intval(make_safe(xss_clean($_POST['published'])));
$referal_suffix = make_safe(xss_clean($_POST['referal_suffix']));
$strip_tags = intval(make_safe(xss_clean($_POST['strip_tags'])));
$allowable_tags = htmlspecialchars($_POST['allowable_tags'],ENT_QUOTES);
$rss_link = make_safe(xss_clean($_POST['rss_link']));
$tt = parse_url($rss_link);
$bb = str_replace('www.','',$tt['host']);
$nn = explode('.',$bb);
$source_domain = $nn[0];
$banned_words = make_safe(xss_clean($_POST['banned_words']));
$auto_update = intval(make_safe(xss_clean($_POST['auto_update'])));
$auto_update_period = intval(make_safe(xss_clean($_POST['auto_update_period'])));
$news_number = intval(make_safe(xss_clean($_POST['news_number'])));
if (empty($title)) {
$message = notification('warning','Insert Resource Name Please.');
} elseif (empty($rss_link)) {
$message = notification('warning','Insert Source Url Please.');
} elseif (empty($category_id)) {
$message = notification('warning','Choose a Category Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/sources/');
$thumbnail = $up->upload($_FILES['thumbnail']);
$up->delete("$_POST[old_thumbnail]");
} else {
$thumbnail = $_POST['old_thumbnail'];
}
$sql = "UPDATE sources SET source_domain='$source_domain',title='$title',rss_link='$rss_link',category_id='$main_category',sub_category_id='$sub_category',thumbnail='$thumbnail',news_number='$news_number',banned_words='$banned_words',is_referal='$is_referal',referal_suffix='$referal_suffix',strip_tags='$strip_tags',allowable_tags='$allowable_tags',auto_update='$auto_update',auto_update_period='$auto_update_period',published='$published' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$mysqli->query("UPDATE news SET category_id='$main_category',sub_category_id='$sub_category' WHERE source_id='$id'");
$message = notification('success','Source Added Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
$source = $general->source($id);
?>
			<div class="page-header page-heading ">
				<h1>Edit Source
				<a href="sources.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
						<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#basic" aria-controls="basic" role="tab" data-toggle="tab">Basic Setting</a></li>
    <li role="presentation"><a href="#filter" aria-controls="filter" role="tab" data-toggle="tab">Filters Setting</a></li>
	<li role="presentation"><a href="#cron" aria-controls="cron" role="tab" data-toggle="tab">Cron Setting</a></li>
	<li role="presentation"><a href="#ref" aria-controls="ref" role="tab" data-toggle="tab">Referral Setting</a></li>
   </ul>

  <div class="tab-content">
  <div role="tabpanel" class="tab-pane active" id="basic">
		  
		  <div class="form-group">
			<label for="title">Source Name <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $source['title']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="rss_link">Source Url <span>*</span></label>
			<input type="text" class="form-control" name="rss_link" id="rss_link" value="<?php echo $source['rss_link']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="category_id">Category <span>*</span></label>
			<select class="form-control" name="category_id" id="category_id">
			<?php 
			$categories = $general->main_categories('category_order ASC');
			foreach ($categories AS $category) {
			?>
			<option value="<?php echo $category['id']; ?>,0" style="font-weight:bold;" <?php if ($source['category_id'] == $category['id'] AND $source['sub_category_id'] == 0) { ?>SELECTED<?php } ?>><?php echo $category['category']; ?></option>
			<?php
			$subs = $general->sub_categories($category['id'],'category_order ASC');
			foreach ($subs AS $sub) {
			?>
			<option value="<?php echo $category['id']; ?>,<?php echo $sub['id']; ?>" <?php if ($source['category_id'] == $category['id'] AND $source['sub_category_id'] == $sub['id']) { ?>SELECTED<?php } ?>> - <?php echo $sub['category']; ?></option>
			<?php			
			}			
			}
			?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="news_number">Items Number Per Grab <span>*</span></label>
			<select class="form-control" name="news_number" id="news_number">
			<?php 
			for($i=1;$i<51;$i++) {
			?>
			<option value="<?php echo $i; ?>" <?php if ($source['news_number'] == $i) { ?>SELECTED<?php } ?>><?php echo $i; ?></option>
			<?php			
			}
			?>
			</select>
		  </div>
		  <div class="form-group">
		  <label for="news_number">News State <span>*</span></label>
		   <div><input type="radio" name="published" value="1" <?php if ($source['published'] == 1) {echo 'CHECKED';} ?> /><span class="checkbox-label"> Published</span></div>
		   <div><input type="radio" name="published" value="0" <?php if ($source['published'] == 0) {echo 'CHECKED';} ?> /><span class="checkbox-label"> Draft (Review Before Publishing)</span></div>
		  </div>
		 <div class="form-group no-bottom-border">
			<label for="thumbnail">Thumbnail</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
			<?php if (!empty($source['thumbnail'])) { ?>
			<p><a href="javascript:void();" class="delete-source-image" id="<?php echo $source['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/sources/<?php echo $source['thumbnail']; ?>' class='img-responsive' />"><?php echo $source['thumbnail']; ?></a></p>
			<?php } ?>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane" id="ref">
		  <div class="form-group">
			<input type="checkbox" name="is_referal" id="is_referal" value="1" <?php if ($source['is_referal'] == 1) { ?>CHECKED<?php } ?> /> <span class="checkbox-label">Has a Referal Suffix ?</span>
		  </div>
		  <div class="form-group" id="referal_suffix_div">
			<label for="referal_suffix">Referal Suffix</label>
			<input type="text" class="form-control" name="referal_suffix" id="referal_suffix" value="<?php echo $source['referal_suffix']; ?>" />
		  </div>
		</div>
		<div role="tabpanel" class="tab-pane" id="cron">
		  <div class="form-group">
			<input type="checkbox" name="auto_update" id="auto_update" value="1" <?php if ($source['auto_update'] == 1) { ?>CHECKED<?php } ?> /> <span class="checkbox-label">Auto Update Source ?</span>
		  </div>
		  <div class="form-group" id="auto_update_period_div">
			<label for="auto_update_period">Auto Update Period</label>
			<select class="form-control" name="auto_update_period" id="auto_update_period">
			<option value="1800" <?php if ($source['auto_update_period'] == 1800) { ?>SELECTED<?php } ?>>30 Minutes</option>
			<option value="2700" <?php if ($source['auto_update_period'] == 2700) { ?>SELECTED<?php } ?>>45 Minutes</option>
			<option value="3600" <?php if ($source['auto_update_period'] == 3600) { ?>SELECTED<?php } ?>>1 Hour</option>
			<?php 
			for($t=7200;$t<86400;$t=$t+3600) {
			?>
			<option value="<?php echo $t; ?>" <?php if ($source['auto_update_period'] == $t) { ?>SELECTED<?php } ?>><?php echo ($t/3600); ?> Hours</option>
			<?php			
			}
			?>
			<option value="86400"  <?php if ($source['auto_update_period'] == 86400) { ?>SELECTED<?php } ?>>1 Day</option>
			<option value="172800" <?php if ($source['auto_update_period'] == 172800) { ?>SELECTED<?php } ?>>2 Days</option>
			<option value="259200" <?php if ($source['auto_update_period'] == 259200) { ?>SELECTED<?php } ?>>3 Days</option>
			</select>
		  </div>
		</div>
		<div role="tabpanel" class="tab-pane" id="filter">
		  <div class="form-group">
			<label for="banned_words">Banned Words</label>
			<textarea class="form-control" name="banned_words" id="banned_words" rows="3"><?php echo $source['banned_words']; ?></textarea>
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="strip_tags" id="strip_tags" value="1" <?php if ($source['strip_tags'] == 1) { ?>CHECKED<?php } ?> /> <span class="checkbox-label">Strip HTML Tags ?</span>
		  </div>
		  <div class="form-group" id="strip_tags_div">
			<label for="allowable_tags">Allowable HTML Tags</label>
			<input type="text" class="form-control" name="allowable_tags" id="allowable_tags" value="<?php echo $source['allowable_tags']; ?>" />
		  </div>
		</div>
		</div>
		  <input type="hidden" name="old_thumbnail" value="<?php echo $source['thumbnail']; ?>" />
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['delete'])) {
$sql = "SELECT * FROM news WHERE source_id='$id'";
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
while ($row = $query->fetch_assoc()) {	
if (!empty($row['thumbnail']) AND file_exists('../upload/news/'.$row['thumbnail'])) {
@unlink('../upload/news/'.$row['thumbnail']);	
}
$mysqli->query("DELETE FROM news WHERE id='$row[id]'");
}
}
$delete = $mysqli->query("DELETE FROM sources WHERE id='$id'");
if ($delete) {
$message = notification('success','Source and All related News Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$source = $general->source($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Delete Source
				<a href="sources.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<div class="container">
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done) AND get_source_news($id) > 0) { ?>
			<div class="alert alert-warning">The Source <b><?php echo $source['title']; ?></b> Contains <b><?php echo get_source_news($id); ?></b> Article(s). Do You Want To Delete this Source and all Related Articles ?</div>
		  <?php } else { ?>
		  <div class="alert alert-warning">The Source <b><?php echo $source['title']; ?></b> is Empty. Process to Delete ?</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="sources.php" class="btn btn-default">Back To Sources</a>
		  <?php } else { ?>
		  <a href="sources.php" class="btn btn-default">Cancel</a>
		  <button type="submit" name="delete" class="btn btn-danger">Delete</button>
		  <?php } ?>
		</form>
		</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
break;
default;
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<div class="page-header page-heading">
	
	<a href="sources.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM sources WHERE source_type='rss' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo '<div class="pcoded-content">
<div class="pcoded-inner-content">
	<!-- Main-body start -->
	<div class="main-body">
		<div class="page-wrapper">
<div class="page-header card">
<div class="row align-items-end">
	<div class="col-lg-8">
		<div class="page-header-title">
			<i class="icofont icofont-table bg-c-blue"></i>
			<div class="d-inline">
				<h4>You didn\'t add any Source</h4>
				<button type="button" class="btn btn-primary"><a href="?case=add" class="alert-link">Add new Source</a></button>
				
			</div>
		</div>
	</div>
	<div class="col-lg-4">
		
</div>
</div>
</div>
</div>
</div>
</div>
</div>';

} else {
$pagination = new Pagination();
$pagination->setLink("?page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM sources WHERE source_type='rss' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>

<div class="table-responsive" >
<div class="card-block table-border-style">

<table class="table">
    <thead>
        <tr>
			<th>Source</th>
			<th class="hidden-xs">News</th>
			<th class="hidden-xs">Add / Latest Update</th>
            <th></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td class="col-xs-6">
			<div class="the-source">
			<div class="article-title">
				<a href="news.php?case=source&id=<?php echo $row['id']; ?>"><b><?php echo $row['title']; ?></b></a> 
			</div>
			<div class="article-meta">
			<span><i class="fa fa-folder"></i> <?php echo get_category($row['category_id']); if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
			<?php if (get_source_news($row['id']) > 0) { ?>
			<span class="empty-source"><a href="javascript:void();" rel="<?php echo $row['id']; ?>" class="empty-source-link text-danger">Empty</a></span>
			<?php } ?>
			</div>
			</div>
			</td>
			<td class="hidden-xs"><?php echo get_source_news($row['id']); ?></td>
			<td class="hidden-xs">
			<div class="text-muted"><?php echo date('Y-n-j h:i a',$row['add_time']); ?></div>
			<div class="text-success"><b><?php if ($row['latest_activity'] == 0) {echo 'Not Updated Yet';} else {echo date('Y-n-j h:i a',$row['latest_activity']);} ?></b></div>
			</td>
			<td align="right">
				<a class="news_grab btn btn-primary btn-xs" href="javascript:void();" id="<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Grab"><span class="fa fa-refresh"></span></a>
				<a class="btn btn-default btn-xs" href="sources.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="sources.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
echo $pagination->create_links();
}
} 
//include('footer.php');
?>