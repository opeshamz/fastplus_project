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
$link = make_safe(xss_clean($_POST['link']));
$published = intval(make_safe(xss_clean($_POST['published'])));
$target = make_safe(xss_clean($_POST['target']));
$place = make_safe(xss_clean(intval($_POST['place'])));
$nofollow = intval(make_safe(xss_clean($_POST['nofollow'])));
if (empty($title)) {
$message = notification('warning','Insert Title Please.');
} elseif (empty($link)) {
$message = notification('warning','Insert Link Please.');
} else {
$sql = "INSERT INTO links (title,link,published,target,nofollow,place,link_order) VALUES ('$title','$link','$published','$target','$nofollow','$place','0')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Link Added Successfully.');
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
				<h1>Add New Link
				<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" style="margin: 25px;">
		  <div class="form-group">
			<label for="title">Link Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" />
		  </div>
		  <div class="form-group">
			<label for="title">Link URL <span>*</span></label>
			<input type="text" class="form-control" name="link" id="link" />
		  </div>
		  <div class="form-group">
			<label for="place">Place <span>*</span></label>
			<select name="place" id="place" class="form-control">
				<option value="0">Header Top Menu</option>
				<option value="1">Footer Menu</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="target">Link Target</label>
			<select name="target" id="target" class="form-control">
			<option value="_NEW">New Page</option>
			<option value="_SELF">Self Page</option>
			</select>
		  </div>
		  <div class="form-group">
			<input type="hidden" name="nofollow" value="0" />
			<input type="checkbox" name="nofollow" id="nofollow" value="1" /> <span class="checkbox-label">Add nofollow=nofollow to this Link ?</span>
		  </div>
		  <div class="form-group">
			<input type="hidden" name="published" value="0" />
			<input type="checkbox" name="published" id="published" value="1" /> <span class="checkbox-label">Publish This Link ?</span>
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
$link = make_safe(xss_clean($_POST['link']));
$place = make_safe(xss_clean(intval($_POST['place'])));
$published = intval(make_safe(xss_clean($_POST['published'])));
$target = make_safe(xss_clean($_POST['target']));
$nofollow = intval(make_safe(xss_clean($_POST['nofollow'])));
if (empty($title)) {
$message = notification('warning','Insert Title Please.');
} elseif (empty($link)) {
$message = notification('warning','Insert Link Please.');
} else {
$sql = "UPDATE links SET title='$title',link='$link',published='$published',target='$target',nofollow='$nofollow',place='$place' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Link Edited Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
$link = $general->link($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Edit Link
				<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
				<form role="form" method="POST" action="" style="margin: 25px;">
		  <div class="form-group">
			<label for="title">Link Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $link['title']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="title">Link URL <span>*</span></label>
			<input type="text" class="form-control" name="link" id="link" value="<?php echo $link['link']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="place">Place <span>*</span></label>
			<select name="place" id="place" class="form-control">
				<option value="0" <?php if ($link['place'] == 0) {echo 'SELECTED';} ?>>Header Top Menu</option>
				<option value="1" <?php if ($link['place'] == 1) {echo 'SELECTED';} ?>>Footer Menu</option>
			</select>
		  </div>
		  <div class="form-group">
			<label for="target">Link Target</label>
			<select name="target" id="target" class="form-control">
			<option value="_NEW" <?php if ($link['target'] == '_NEW') {echo 'SELECTED';} ?>>New Page</option>
			<option value="_SELF" <?php if ($link['target'] == '_SELF') {echo 'SELECTED';} ?>>Self Page</option>
			</select>
		  </div>
		  <div class="form-group">
			<input type="hidden" name="nofollow" value="0" />
			<input type="checkbox" name="nofollow" id="nofollow" value="1" <?php if ($link['nofollow'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Add nofollow=nofollow to this Link ?</span>
		  </div>
		  <div class="form-group">
			<input type="hidden" name="published" value="0" />
			<input type="checkbox" name="published" id="published" value="1" <?php if ($link['published'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Publish This Link ?</span>
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
case 'delete';
$id = intval($_GET['id']);
if (isset($_POST['delete'])) {
$delete = $mysqli->query("DELETE FROM links WHERE id='$id'");
if ($delete) {
$message = notification('success','Link Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$link = $general->link($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Delete Link
				<a href="links.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="" style="margin: 25px;">
		  <?php if (empty($done)) { ?>
			<div class="alert alert-warning">Are you Sure that you want to delete the Link : <b><?php echo $link['title']; ?></b> ?</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="links.php" class="btn btn-default">Back To links</a>
		  <?php } else { ?>
		  <button type="submit" name="delete" class="btn btn-danger">Delete</button>
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
default;
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
<div class="page-header page-heading">
	<h1><i class="fa fa-link"></i> Links
	<a href="links.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$links = $general->links('link_order ASC');	
if ($links == 0) {
echo notification('warning','You didn\'t add any Link. <a href="?case=add">Add new Link</a>.');	
} else {
?>
<div class="categories-header">
<div class="col-xs-9 col-sm-5">Title</div>
<div class="col-sm-2 hidden-xs">Target</div>
<div class="col-sm-2 hidden-xs">nofollow</div>
<div class="col-xs-3"></div>
</div>
<div id="sort_links">
<ul>
<?php
foreach ($links AS $link) {
?>
<li id="records_<?php echo $link['id']; ?>" class="category_li" title="Drag To Re-Order">
<div class="col-xs-9 col-sm-5"><span class="fa fa-link"></span> <?php echo $link['title']; ?></div>
<div class="col-sm-2 hidden-xs"><?php echo strtolower(str_replace('_','',$link['target'])).' page'; ?></div>
<div class="col-sm-2 hidden-xs"><?php if ($link['nofollow'] == 0) {echo '<i class="fa fa-close text-danger"></i>';} else {echo '<i class="fa fa-check text-success"></i>';} ?></div>
<div class="col-xs-3 text-right">
	<a href="links.php?case=edit&id=<?php echo $link['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
	<a href="links.php?case=delete&id=<?php echo $link['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
</div>
</li>
<?php	
}	
?>
</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
}
include('footer.php');
?>