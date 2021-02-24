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
$ad_type = make_safe(xss_clean(htmlspecialchars($_POST['ad_type'],ENT_QUOTES)));
$place = make_safe(xss_clean(htmlspecialchars($_POST['place'],ENT_QUOTES)));
if ($ad_type == 'code') {
$data_ad_client = make_safe(xss_clean($_POST['data_ad_client']));
$data_ad_slot = make_safe(xss_clean($_POST['data_ad_slot']));
} else {
$link = make_safe(xss_clean($_POST['link']));	
}
if (empty($title)) {
$message = notification('warning','Insert The Title Please.');	
} elseif ($ad_type == 'code' AND empty($data_ad_client)) {
$message = notification('warning','Insert Ad Client Please.');	
} elseif ($ad_type == 'banner' AND empty($link)) {
$message = notification('warning','Insert Ad Link Please.');	
} else {
if (!empty($_FILES['image']['name'])) {
$up = new fileDir('../upload/ads/');
$thumbnail = $up->upload($_FILES['image']);
} else {
$thumbnail = '';
}	
$sql = "INSERT INTO advertisements (title,ad_type,link,image,place,data_ad_client,data_ad_slot,active) VALUES ('$title','$ad_type','$link','$thumbnail','$place','$data_ad_client','$data_ad_slot','1')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Advertisement Added Successfully.');	
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
				<h1>Add Advertisement
				<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="title">Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" />
		  </div>
		  <div class="form-group">
			<label for="place">Place <span>*</span></label>
			<select name="place" class="form-control" id="place">
				<?php 
				$places = ads_places();
				foreach ($places AS $key=>$value) {
				?>
				<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
				<?php
				}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="ad_type">Ad Type <span>*</span></label>
			<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_link');" value="banner" CHECKED /> Banner</div>
			<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_code');" value="code" /> Code</div>
		  </div>
		  <div id="ad_code">
		  <div class="form-group">
			<label for="data_ad_client">Adsense AD Client <span>*</span></label>
			<input type="text" class="form-control" name="data_ad_client" id="data_ad_client" />
		  </div>
		  <div class="form-group">
			<label for="data_ad_slot">Adsense AD Slot <span>*</span></label>
			<input type="text" class="form-control" name="data_ad_slot" id="data_ad_slot" />
		  </div>
		  </div>
		  <div id="ad_link">
		  <div class="form-group">
			<label for="link">Link <span>*</span></label>
			<input type="text" class="form-control" name="link" id="link" />
		  </div>
		  <div class="form-group">
			<label for="image">Image <span>*</span></label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
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
$title = make_safe(xss_clean(htmlspecialchars($_POST['title'],ENT_QUOTES)));
$ad_type = make_safe(xss_clean(htmlspecialchars($_POST['ad_type'],ENT_QUOTES)));
$place = make_safe(xss_clean(htmlspecialchars($_POST['place'],ENT_QUOTES)));
if ($ad_type == 'code') {
$data_ad_client = make_safe(xss_clean($_POST['data_ad_client']));
$data_ad_slot = make_safe(xss_clean($_POST['data_ad_slot']));
} else {
$link = make_safe(xss_clean($_POST['link']));	
}
if (empty($title)) {
$message = notification('warning','Insert The Title Please.');	
} elseif ($ad_type == 'code' AND empty($data_ad_client)) {
$message = notification('warning','Insert Ad Client Please.');	
} elseif ($ad_type == 'banner' AND empty($link)) {
$message = notification('warning','Insert Ad Link Please.');	
} else {
if (!empty($_FILES['image']['name'])) {
$up = new fileDir('../upload/ads/');
$thumbnail = $up->upload($_FILES['image']);
$up->delete("$_POST[old_image]");
} else {
$thumbnail = $_POST['old_image'];
}
$sql = "UPDATE advertisements SET title='$title',data_ad_client='$data_ad_client',data_ad_slot='$data_ad_slot',ad_type='$ad_type',place='$place',link='$link',image='$thumbnail' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Advertisement Edited Successfully.');	
} else {
$message = notification('danger','Error Happened.');	
}
}
}
$ad = $general->ad($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Edit Advertisement
				<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="title">Title <span>*</span></label>
			<input type="text" class="form-control" name="title" id="title" value="<?php echo $ad['title']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="place">Place <span>*</span></label>
			<select name="place" class="form-control" id="place">
				<?php 
				$places = ads_places();
				foreach ($places AS $key=>$value) {
				?>
				<option value="<?php echo $key; ?>" <?php if($ad['place'] == $key) {echo 'SELECTED';} ?>><?php echo $value; ?></option>
				<?php
				}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="ad_type">Ad Type <span>*</span></label>
			<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_link');" value="banner" <?php if ($ad['ad_type'] == 'banner') {echo 'CHECKED';} ?> /> Banner</div>
			<div><input type="radio" name="ad_type" onclick="javascript:ShowAdDiv('ad_code');" value="code" <?php if ($ad['ad_type'] == 'code') {echo 'CHECKED';} ?> /> Code</div>
		  </div>
		  <div id="ad_code">
		  <div class="form-group">
			<label for="data_ad_client">Adsense AD Client <span>*</span></label>
			<input type="text" class="form-control" name="data_ad_client" id="data_ad_client" value="<?php echo $ad['data_ad_client']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="data_ad_slot">Adsense AD Slot <span>*</span></label>
			<input type="text" class="form-control" name="data_ad_slot" id="data_ad_slot" value="<?php echo $ad['data_ad_slot']; ?>" />
		  </div>
		  </div>
		  <div id="ad_link">
		  <div class="form-group">
			<label for="link">Link <span>*</span></label>
			<input type="text" class="form-control" name="link" id="link" value="<?php echo $ad['link']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="image">Image <span>*</span></label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new"><i class="fa fa-folder-open"></i></span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
			<?php if (!empty($ad['image'])) { ?>
			<p>Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/ads/<?php echo $ad['image']; ?>' class='img-responsive' />"><?php echo $ad['image']; ?></a></p>
			<?php } ?>
		</div>
		</div>
		<input type="hidden" name="old_image" value="<?php echo $ad['image']; ?>" />
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
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['delete'])) {
$delete = $mysqli->query("DELETE FROM advertisements WHERE id='$id'");
if ($delete) {
$message = notification('success','Advertisement Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$ad = $general->ad($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Delete Advertisement
				<a href="advertisements.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done)) { ?>
			<div class="alert alert-warning">Are you sure to Delete the Advertisement : <b><?php echo htmlspecialchars_decode($ad['title'],ENT_QUOTES); ?></b> ?</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="advertisements.php" class="btn btn-default">Back To Advertisement</a>
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
	<h1><i class="fa fa-picture-o"></i> Advertisements
	<a href="advertisements.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$ads = $general->ads('id DESC');	
if ($ads == 0) {
echo notification('warning','You didn\'t add any Ad. <a href="?case=add" class="alert-link">Add new Ad</a>.');	
} else {
?>
<table class="table">
<thead>
<tr>
<th>Title</th>
<th>Type</th>
<th>Place</th>
<th>Smarty Code</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
foreach ($ads AS $ad) {
?>
<tr>
<td><?php echo $ad['title']; ?></td>
<td><?php echo $ad['ad_type']; ?></td>
<td><?php echo $ad['place']; ?></td>
<td><?php echo "{'".$ad['place']."'|get_ad}"; ?></td>
<td class="text-right">
	<a href="advertisements.php?case=edit&id=<?php echo $ad['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
	<a href="advertisements.php?case=delete&id=<?php echo $ad['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
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

<?php
}
} 
include('footer.php');
?>