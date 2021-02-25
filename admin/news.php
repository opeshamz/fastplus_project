
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
} else {
$thumbnail = '';
}
$datetime = time();
$day = date('j');
$month = date('n');
$year = date('Y');	
$domain = get_domain($options['general_siteurl']);
$sql = "INSERT INTO news (source_type,source_domain,title,details,category_id,sub_category_id,tags,thumbnail,datetime,published,day,month,year,hits,video_id,duration,source_id,deleted,featured,votes_up,votes_down,permalink) VALUES 
						 ('rss','$domain','$title','$details','$main_category','$sub_category','$tags','$thumbnail','$datetime','$published','$day','$month','$year','0','0','0','0','0','0','0','0','')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Article Added Successfully.');	
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
				<h1>Add Article
				<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
<form role="form" method="POST" action="" enctype="multipart/form-data" style="margin: 25px;">
		<div class="row">
		<div class="col-md-9">
		  <div class="form-group">
			<label for="title">Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" />
		  </div>
		  
		  <div class="form-group">
			<label for="details">Details</label>
			<textarea class="wysiwyg form-control" name="details" id="details" rows="15"></textarea>
		  </div>
		</div>
		<div class="col-md-9">
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
			<label for="category_id">Featured Image</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
		<div class="form-group">
			<label for="tags">Tags <span>*</span></label>
			<input type="text" class="form-control tags" name="tags" id="tags" />
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="published" id="published" value="1" /> <span class="checkbox-label">Publish Article ?</span>
		  </div>
		  
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		  </div>
		  </div>
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
?><div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Edit Article
				<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data" style="margin: 25px;">
		<div class="row">
		<div class="col-md-9">
		  <div class="form-group">
			<label for="title">Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $news['title']; ?>" />
		  </div>
		  
		  <div class="form-group">
			<label for="details">Details <span>*</span></label>
			<textarea class="wysiwyg form-control" name="details" id="details" rows="15" ><?php echo htmlspecialchars_decode($news['details'],ENT_QUOTES); ?></textarea>
		  </div>
		</div>
		<div class="col-md-9">
		  <div class="form-group">
			<input type="checkbox" name="published" id="published" value="1" <?php if ($news['published'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Publish Article ?</span>
		  </div>
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
			<label for="tags">Tags</label>
			<input type="text" class="form-control tags" name="tags" id="tags" value="<?php if (!empty($news['tags'])) { echo $news['tags']; } else {echo title_to_keywords($news['title']); } ?>" />
		  </div>
		  <div class="form-group">
			<label for="category_id">Featured Image</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists"><i class="fa fa-folder-open"></i></span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput"><i class="fa fa-remove"></i></a>
			</div>
			<?php if (!empty($news['thumbnail'])) { ?>
			<p><a href="javascript:void();" class="delete-image" id="<?php echo $news['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/news/<?php echo $news['thumbnail']; ?>' class='img-responsive' />"><?php echo $news['thumbnail']; ?></a></p>
			<?php } ?>
			</div>
		
		  
		  
		  <input type="hidden" name="old_thumbnail" value="<?php echo $news['thumbnail']; ?>" />
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		  </div>
		  
		  </div>
		</form>
</div>
</div>
</div>
</div>
</div>
  </div>
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['unpublish'])) {
$delete = $mysqli->query("UPDATE news SET published='0',deleted='1' WHERE id='$id'");
if ($delete) {
$message = notification('success','Article Have Been Unpublished Successfully.');
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
$message = notification('success','Article Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$news = $general->news($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Delete Article
				<a href="news.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done)) { ?>
			<div class="alert alert-warning">You Can Either <b>Unpublish</b> or <b>Delete</b> the Article : <b><?php echo htmlspecialchars_decode($news['title'],ENT_QUOTES); ?></b>. If you Choose to Delete you Can't Undo this Action Later.</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="news.php" class="btn btn-default">Back To News</a>
		  <?php } else { ?>
		  <div style="margin: 10px;">
		  <button type="submit" name="unpublish" class="btn btn-warning">Unpublish</button>
		  <button type="submit" name="delete" class="btn btn-danger">Permanent Delete</button>
		  </div>
		  <?php } ?>
		</form>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
break;
case 'search';
$q = make_safe(xss_clean($_GET['q']));
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<div class="page-header page-heading">
	<h1 class="row"><div class=""><i class="fa fa-search"></i> Search For <?php echo $q; ?> In News</div>
	<div class="col-md-6">
	<div class="pull-right search-form">
	<form method="GET" action="news.php">
		<div class="input-group">
		  <input type="hidden" name="case" value="search" />
		  <input type="text" name="q" class="form-control" placeholder="Search" value="<?php echo $q; ?>" />
		  <span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div>
	<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
	<a href="news.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted News"><span class="fa fa-trash"></span></a>
	<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
	</div>
	</h1>
</div>



<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND title LIKE '%$q%' ORDER BY id DESC";
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
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND title LIKE '%$q%' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<div class="table-responsive" >
<div class="card-block table-border-style">
<table width=""  class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
</div>
</div>
<div class="news-actions">
<div class="row">
<div class="col-xs-12"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
}		
break;
case 'category';
$id = intval(make_safe(xss_clean($_GET['id'])));
$sub_id = intval(make_safe(xss_clean($_GET['sub_id'])));
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected News Was Deleted Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
if ($sub_id == 0) {
$category = $general->category($id);
} else {
$category = $general->category($sub_id);	
}
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-reorder"></i> News About <?php echo $category['category']; ?></h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND category_id='$id' AND sub_category_id='$sub_id' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Published News About '.$category['category'].'.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=category&id=$id&sub_id=$sub_id&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND category_id='$id' AND sub_category_id='$sub_id' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
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
</div>
</div>
</div>
</div>
</div>
<?php
}	
break;
case 'source';
$id = intval(make_safe(xss_clean($_GET['id'])));
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected News Was Deleted Successfully.');
	} else {
	$message = notification('error','Error Happened');
	}
	}
}
$source = $general->source($id);
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-rss"></i> <?php if ($id == 0) { echo 'Private News'; } else { echo 'News From '.$source['title']; } ?></h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND source_id='$id' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Published News From '.$source['title'].'.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=source&id=$id&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' AND source_id='$id' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
}	
break;
case 'deleted';
if (isset($_POST['restore']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET published='1',deleted='0' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected News Was Restored Successfully.');
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
	$sql = "SELECT id,thumbnail FROM news WHERE id='$del_id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
		if (file_exists('../upload/news/'.$row['thumbnail'])) {
			@unlink('../upload/news/'.$row['thumbnail']);
		}
	$delete = $mysqli->query("DELETE FROM news WHERE id='$del_id'");
	if ($delete) {
	$message = notification('success','The Selected News Was Deleted Permanently.');
	} else {
	$message = notification('error','Error Happened');
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
	<h1 class="row"><div class="col-md-6"><i class="fa fa-trash"></i> Deleted News</div>
	<div class="col-md-6">
	<div class="pull-right search-form">
	<form method="GET" action="news.php">
		<div class="input-group">
		  <input type="hidden" name="case" value="search" />
		  <input type="text" name="q" class="form-control" placeholder="Search">
		  <span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div>
	<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
	<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
	</div>
	</h1>
</div>

<div style="margin: 25px;">
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='rss' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Deleted News.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=deleted&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='0' AND deleted='1' AND source_type='rss' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="restore" class="btn btn-success"><span class="fa fa-refresh"></span> Restore</button>
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Permanent Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
}		
break;
case 'review';
if (isset($_POST['publish']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET published='1',deleted='0' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected News Was Published Successfully.');
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
	$sql = "SELECT id,thumbnail FROM news WHERE id='$del_id'";
	$query = $mysqli->query($sql);
	$row = $query->fetch_assoc();
		if (file_exists('../upload/news/'.$row['thumbnail'])) {
			@unlink('../upload/news/'.$row['thumbnail']);
		}
	$delete = $mysqli->query("DELETE FROM news WHERE id='$del_id'");
	if ($delete) {
	$message = notification('success','The Selected News Was Deleted Permanently.');
	} else {
	$message = notification('error','Error Happened');
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
	<h1 class="row"><div class="col-md-6"><i class="fa fa-edit"></i> Need Review News</div>
	<div class="col-md-6">
	<a href="news.php" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Published News"><span class="fa fa-newspaper-o"></span></a>
	</div>
	</h1>
</div>
<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='rss' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No News to Review.');
} else {
$pagination = new Pagination();
$pagination->setLink("?case=review&page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='0' AND deleted='0' AND source_type='rss' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>
<form role="form" method="POST" action="">
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i><a href="news.php?case=category&id=<?php echo $row['category_id']; ?>"><?php echo get_category($row['category_id']); ?></a></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<div class="news-actions">
<div class="row">
<div class="col-sm-3 col-md-4">
<button type="submit" name="publish" class="btn btn-success"><span class="fa fa-refresh"></span> Publish</button>
<button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Permanent Delete</button>
</div>
<div class="col-sm-9 col-md-8"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}		
break;
default;
if (isset($_POST['delete']) AND isset($_POST['id'])) {
	$ids = $_POST['id'];
	$count= count($ids);
	for($i=0;$i<$count;$i++){
	$del_id = $ids[$i];
	$sql = "UPDATE news SET published='0',deleted='1' WHERE id='$del_id'";
	$res = $mysqli->query($sql);
	if ($res) {
	$message = notification('success','The Selected News Was Deleted Successfully.');
	} else {
	$message = notification('error','Error Happened');
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
	<h1 class="row"><div class="col-md-6"><i class="fa fa-newspaper-o"></i> Published News</div>
	<div class="col-md-6">
	<div class="pull-right search-form">
	<form method="GET" action="news.php">
		<div class="input-group">
		  <input type="hidden" name="case" value="search" />
		  <input type="text" name="q" class="form-control" placeholder="Search">
		  <span class="input-group-addon"><button class="btn-link"><span class="fa fa-search"></span></button></span>
		</div>
	</form>
	</div>
	<a href="news.php?case=add" class="btn btn-success pull-right" data-toggle="tooltip" data-placement="top" title="Add New Article"><span class="fa fa-plus"></span></a>
	<a href="news.php?case=deleted" class="btn btn-danger pull-right" data-toggle="tooltip" data-placement="top" title="Deleted News"><span class="fa fa-trash"></span></a>
	<a href="news.php?case=review" class="btn btn-default pull-right" data-toggle="tooltip" data-placement="top" title="Need Review News"><span class="fa fa-edit"></span></a>
	</div>
	</h1>
</div>



<?php
if (isset($message)) {echo $message;}
$page = 1;
$size = 20;
if (isset($_GET['page'])){ $page = (int) $_GET['page']; }
$sqls = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' ORDER BY id DESC";
$query = $mysqli->query($sqls);
$total_records = $query->num_rows;
if ($total_records == 0) {
echo notification('warning','There Are No Published News.');
} else {
$pagination = new Pagination();
$pagination->setLink("?page=%s");
$pagination->setPage($page);
$pagination->setSize($size);
$pagination->setTotalRecords($total_records);
$get = "SELECT * FROM news WHERE published='1' AND deleted='0' AND source_type='rss' ORDER BY id DESC ".$pagination->getLimitSql();
$q = $mysqli->query($get);
?>


<form role="form" method="POST" action="">

<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th width="15"><input type="checkbox" class="parentCheckBox" /></th>
			<th>Details</th>
			<th class="hidden-xs">Image</th>
			<th class="hidden-xs">Content</th>
            <th width="80"></th>
        </tr>
    </thead>
	<tbody>
<?php 
while ($row = $q->fetch_assoc()) {
?>
		<tr>
			<td><input type="checkbox" name="id[]" class="childCheckBox" value="<?php echo $row['id']; ?>" /></td>
			<td>
			<div class="article-title"><a href="news.php?case=details&id=<?php echo $row['id']; ?>"><?php echo htmlspecialchars_decode($row['title'],ENT_QUOTES); ?></a></div>
			<div class="article-meta">
			<span><i class="fa fa-reorder"></i> <?php echo get_category($row['category_id']); ?><?php if ($row['sub_category_id'] != 0) {echo ' &rarr; '.get_category($row['sub_category_id']);} ?></span>
			<?php if ($row['source_id'] != 0) { ?><span><i class="fa fa-rss"></i><a href="news.php?case=source&id=<?php echo $row['source_id']; ?>"><?php echo get_source($row['source_id']); ?></a></span><?php } ?>
			<span><i class="fa fa-calendar"></i><?php echo date('Y-n-j h:i a',$row['datetime']); ?></span>
			<span><i class="fa fa-bar-chart"></i><?php echo $row['hits']; ?></span>
			</div>
			</td>
			<td class="hidden-xs" width="150"><?php echo check_image($row['thumbnail']); ?></td>
			<td class="hidden-xs" width="150"><?php echo check_content($row['details']); ?></td>
			<td align="right">
				<a class="btn btn-default btn-xs" href="news.php?case=edit&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Edit"><span class="fa fa-edit"></span></a>
				<a class="btn btn-danger btn-xs" href="news.php?case=delete&id=<?php echo $row['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php
}
?>
	</tbody>
</table>
<div class="news-actions" style="margin: 10px;">
<div class="row">
<div class="col-sm-2 col-md-3"><button type="submit" name="delete" class="btn btn-danger"><span class="fa fa-trash"></span> Delete</button></div>
<div class="col-sm-10 col-md-9"><?php echo $pagination->create_links(); ?></div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>

<?php
} 
} 
//include('footer.php');
?>