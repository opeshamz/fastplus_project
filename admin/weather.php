<?php
include('header.php'); 
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'setting';
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Weather');
}
$options = $general->get_options('Weather'); 
?>

                <div class="page-header page-heading">
                    <h1><i class="fa fa-cog"></i> Weather Setting
					<a href="weather.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>

					</h1>
                </div>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<input type="hidden" name="display_weather_widget" value="0" />
			<input type="checkbox" name="display_weather_widget" id="display_weather_widget" value="1" <?php if ($options['display_weather_widget'] == 1) { echo 'CHECKED'; } ?> /> <span class="checkbox-label">Display Weather Widget</span>
		  </div>
		  <div class="form-group">
			<input type="hidden" name="display_next_days" value="0" />
			<input type="checkbox" name="display_next_days" id="display_next_days" value="1" <?php if ($options['display_next_days'] == 1) { echo 'CHECKED'; } ?> /> <span class="checkbox-label">Display Next Days</span>
		  </div>
		  <div class="form-group">
			<label for="temperature_degree">Temperature Degree</label>
			<div><input type="radio" name="temperature_degree" value="c" <?php if ($options['temperature_degree'] == 'c') { echo 'CHECKED'; } ?> /> <span class="checkbox-label">C</span></div>
			<div><input type="radio" name="temperature_degree" value="f" <?php if ($options['temperature_degree'] == 'f') { echo 'CHECKED'; } ?> /> <span class="checkbox-label">F</span></div>
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
	
<?php 
break;
case 'add';
if (isset($_POST['submit'])) {
$city = make_safe(xss_clean($_POST['city']));
$yahoo_weather_id = make_safe(xss_clean($_POST['yahoo_weather_id']));
$published = intval(make_safe(xss_clean($_POST['published'])));
if (empty($city)) {
$message = notification('warning','Insert City Please.');
} elseif (empty($yahoo_weather_id)) {
$message = notification('warning','Insert WOEID Please.');
} else {
$sql = "INSERT INTO weather (city,yahoo_weather_id,published,city_order) VALUES ('$city','$yahoo_weather_id','$published','0')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','City Added Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
?>
			<div class="page-header page-heading">
				<h1>Add New City
				<a href="weather.php" class="btn btn-default  pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="city">City <span>*</span></label>
			<input type="text" class="form-control" name="city" id="city" />
		  </div>
	
		  <div class="form-group">
			<label for="yahoo_weather_id">WOEID <span>*</span></label>
			<input type="text" class="form-control" name="yahoo_weather_id" id="yahoo_weather_id" />
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="published" id="published" value="1" /> <span class="checkbox-label">Display City In Weather Menu</span>
		  </div>
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
<?php
break;
case 'edit';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['submit'])) {
$city = make_safe(xss_clean($_POST['city']));
$yahoo_weather_id = make_safe(xss_clean($_POST['yahoo_weather_id']));
$published = intval(make_safe(xss_clean($_POST['published'])));
if (empty($city)) {
$message = notification('warning','Insert City Please.');
} elseif (empty($yahoo_weather_id)) {
$message = notification('warning','Insert WOEID Please.');
} else {
$sql = "UPDATE weather SET city='$city',yahoo_weather_id='$yahoo_weather_id',published='$published' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','City Edited Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
$city = $general->city($id);
?>
			<div class="page-header page-heading">
				<h1>Edit City
				<a href="weather.php" class="btn btn-default  pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="">
		  <div class="form-group">
			<label for="city">City <span>*</span></label>
			<input type="text" class="form-control" name="city" id="city" value="<?php echo $city['city']; ?>" />
		  </div>
		<div class="form-group">
			<label for="yahoo_weather_id">WOEID <span>*</span></label>
			<input type="text" class="form-control" name="yahoo_weather_id" id="yahoo_weather_id" value="<?php echo $city['yahoo_weather_id']; ?>" />
		  </div>
		  <div class="form-group">
			<input type="checkbox" name="published" id="published" value="1" <?php if ($city['published'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Display City In Weather Menu</span>
		  </div>
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['delete'])) {
$delete = $mysqli->query("DELETE FROM weather WHERE id='$id'");
if ($delete) {
$message = notification('success','City Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$city = $general->city($id);
?>
			<div class="page-header page-heading">
				<h1>Delete City
				<a href="weather.php" class="btn btn-default  pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (empty($done)) { ?>
		  <div class="alert alert-warning">Are You Sure You Want to Delete <b><?php echo $city['city']; ?></b> ?</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="weather.php" class="btn btn-default">Back To Weather Page</a>
		  <?php } else { ?>
		  <button type="submit" name="delete" class="btn btn-danger">Delete</button>
		  <?php } ?>
		</form>
<?php
break;
default;
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-sun-o"></i> Weather
	<a href="weather.php?case=setting" class="btn btn-default btn-sm pull-right"><span class="fa fa-cog"></span></a>
	<a href="weather.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$weather = $general->cities('city_order ASC');	
if ($weather == 0) {
echo notification('warning','You didn\'t add any city. <a href="?case=add">Add New city</a>.');	
} else {
?>
<div class="categories-header">
<div class="col-xs-9 col-sm-7">City</div>
<div class="col-sm-2 hidden-xs">WOEID</div>
<div class="col-xs-3"></div>
</div>
<div id="sort_city">
<ul>
<?php
foreach ($weather AS $city) {
?>
<li id="records_<?php echo $city['id']; ?>" class="category_li" title="Drag To Re-Order">
<div class="col-xs-9 col-sm-7"><span class="fa fa-map-marker"></span> <?php echo $city['city']; ?></div>
<div class="col-sm-2 hidden-xs"><?php echo $city['yahoo_weather_id']; ?></div>
<div class="col-xs-3 text-right">
	<a href="weather.php?case=edit&id=<?php echo $city['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
	<a href="weather.php?case=delete&id=<?php echo $city['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
</div>
</li>
<?php	
}	
?>
</ul>
</div>
<?php
}
}
include('footer.php');
?>