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
$category = make_safe(xss_clean($_POST['category']));
$color = make_safe(xss_clean($_POST['color']));
$main_id = intval(make_safe(xss_clean($_POST['main_id'])));
$seo_keywords = make_safe(xss_clean($_POST['seo_keywords']));
$seo_description = make_safe(xss_clean($_POST['seo_description']));
if (empty($category)) {
$message = notification('warning','Insert Category Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/categories/');
$thumbnail = $up->upload($_FILES['thumbnail']);
} else {
$thumbnail = '';
}
$sql = "INSERT INTO categories (category,main_id,image,seo_keywords,seo_description,color,category_order) VALUES ('$category','$main_id','$thumbnail','$seo_keywords','$seo_description','$color','0')";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Category Added Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
?>
<div class="jumbotron" style="margin" >
			<div class="page-header page-heading" style="margin-top: -750px;" >
				<h1>Add New Category
				<a href="categories.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="category">Category <span>*</span></label>
			<input type="text" class="form-control" name="category" id="category" />
		  </div>
		  <div class="form-group">
			<label for="main_id">Main Category <span>*</span></label>
			<select name="main_id" id="main_id" class="form-control">
				<option value="0">Main Category</option>
				<?php 
				$mains = $general->main_categories('category_order ASC');
				foreach ($mains AS $main) {
				?>
				<option value="<?php echo $main['id']; ?>"><?php echo $main['category']; ?></option>
				<?php		
				}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="color">Color</label>
			<input type="text" class="form-control color" name="color" id="color" />
		  </div>
		  <div class="form-group">
			<label for="category_id">Thumbnail</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
		  <div class="form-group">
			<label for="seo_keywords">SEO Keywords</label>
			<input type="text" class="form-control tags" name="seo_keywords" id="seo_keywords" />
		  </div>
		  <div class="form-group">
			<label for="seo_description">SEO Description</label>
			<textarea class="form-control" name="seo_description" id="seo_description" rows="3" ></textarea>
		  </div>
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
<?php
break;
case 'edit';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['submit'])) {
$category = make_safe(xss_clean($_POST['category']));
$color = make_safe(xss_clean($_POST['color']));
$main_id = intval(make_safe(xss_clean($_POST['main_id'])));
$seo_keywords = make_safe(xss_clean($_POST['seo_keywords']));
$seo_description = make_safe(xss_clean($_POST['seo_description']));
if (empty($category)) {
$message = notification('warning','Insert Category Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/categories/');
$thumbnail = $up->upload($_FILES['thumbnail']);
$up->delete("$_POST[old_thumbnail]");
} else {
$thumbnail = $_POST['old_thumbnail'];
}
$sql = "UPDATE categories SET category='$category',main_id='$main_id',image='$thumbnail',seo_keywords='$seo_keywords',seo_description='$seo_description',color='$color' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$message = notification('success','Category Edited Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
$category = $general->category($id);
?>
			<div class="page-header page-heading">
				<h1>Edit Category
				<a href="categories.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data">
		  <div class="form-group">
			<label for="category">Category <span>*</span></label>
			<input type="text" class="form-control" name="category" id="category" value="<?php echo $category['category']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="main_id">Main Category <span>*</span></label>
			<select name="main_id" id="main_id" class="form-control">
				<option value="0">Main Category</option>
				<?php 
				$mains = $general->categories_query("WHERE id!='$id' AND main_id='0'",'category_order ASC');
				foreach ($mains AS $main) {
				?>
				<option value="<?php echo $main['id']; ?>" <?php if ($category['main_id'] == $main['id']) {echo 'SELECTED';} ?>><?php echo $main['category']; ?></option>
				<?php		
				}
				?>
			</select>
		  </div>
		  <div class="form-group">
			<label for="color">Color</label>
			<input type="text" class="form-control color" name="color" id="color" value="<?php echo $category['color']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="thumbnail">Thumbnail</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
			<?php if (!empty($category['image'])) { ?>
			<p><a href="javascript:void();" class="delete-category-image" id="<?php echo $category['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/categories/<?php echo $category['image']; ?>' class='img-responsive' />"><?php echo $category['image']; ?></a></p>
			<?php } ?>
		</div>
		  <div class="form-group">
			<label for="seo_keywords">SEO Keywords</label>
			<input type="text" class="form-control tags" name="seo_keywords" id="seo_keywords" value="<?php echo $category['seo_keywords']; ?>" />
		  </div>
		  <div class="form-group">
			<label for="seo_description">SEO Description</label>
			<textarea class="form-control" name="seo_description" id="seo_description" rows="3" ><?php echo $category['seo_description']; ?></textarea>
		  </div>
		  <input type="hidden" name="old_thumbnail" value="<?php echo $category['image']; ?>" />
		  <button type="submit" name="submit" class="btn btn-primary">Save</button>
		</form>
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
$type = make_safe(xss_clean($_GET['type']));
if (isset($_POST['move'])) {
$new_category = make_safe(xss_clean($_POST['category_id']));
if (empty($new_category)) {
$message = notification('warning','Please Select a Category that you want to move the Sources to.');	
} else {
$cc = explode(',',$new_category);
$main = $cc[0];
$sub = $cc[1];
if ($type == 'main') {
$sql = "SELECT * FROM sources WHERE category_id='$id'";
} else {
$sql = "SELECT * FROM sources WHERE sub_category_id='$id'";	
}
$query = $mysqli->query($sql);
if ($query->num_rows > 0) {
while ($row = $query->fetch_assoc()) {
$mysqli->query("UPDATE news SET category_id='$main',sub_category_id='$sub' WHERE source_id='$row[id]'");
$mysqli->query("UPDATE sources SET category_id='$main',sub_category_id='$sub' WHERE id='$row[id]'");
}	
}
$delete = $mysqli->query("DELETE FROM categories WHERE id='$id'");
if ($delete) {
$message = notification('success','Sources Moved and Category Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
}
if (isset($_POST['delete'])) {
$mysqli->query("DELETE FROM news WHERE category_id='$id'");
$mysqli->query("DELETE FROM sources WHERE category_id='$id'");
if ($type == 'main') {
$mysqli->query("DELETE FROM categories WHERE main_id='$id'");	
}
$delete = $mysqli->query("DELETE FROM categories WHERE id='$id'");
if ($delete) {
$message = notification('success','Category and All related Sources and News Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$tcategory = $general->category($id);
?>
			<div class="page-header page-heading">
				<h1>Delete Category
				<a href="categories.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="">
		  <?php if (get_category_sources($id) > 0) { ?>
			<div class="alert alert-warning">The Category <b><?php echo $tcategory['category']; ?></b> Contains <b><?php echo get_category_sources($id); ?></b> Source(s). Do You Want To Move Them to Another Category ?</div>
		<div class="form-group">
			<label for="seo_keywords">Choose a Category to Move The Source(s) To.</label>
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
		  <?php } else { ?>
			<div class="alert alert-warning">Are you Sure that you want to delete The Category <b><?php echo $tcategory['category']; ?></b> ?</div>  
			  
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="categories.php" class="btn btn-default">Back To Categories</a>
		  <?php } else { ?>
		  <?php if (get_category_sources($id) > 0) { ?>
		  <button type="submit" name="move" class="btn btn-warning">Move Then Delete</button>
		  <?php } ?>
		  <button type="submit" name="delete" class="btn btn-danger">Just Delete</button>
		  <?php } ?>
		</form>
<?php
break;
default;
?>
<div class="page-header page-heading">
	<h1><i class="fa fa-folder"></i> Categories
	<a href="categories.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$categories = $general->main_categories('category_order ASC');	
if ($categories == 0) {
echo notification('warning','You didn\'t add any category. <a href="?case=add">Add new category</a>.');	
} else {
?>
<div class="categories-header">
<div class="col-xs-9 col-sm-3">Category</div>
<div class="col-sm-2 hidden-xs">Sources</div>
<div class="col-sm-2 hidden-xs">News</div>
<div class="col-sm-2 hidden-xs">Videos</div>
<div class="col-xs-3"></div>
</div>
<div id="sort_category">
<ul>
<?php
foreach ($categories AS $category) {
?>
<li id="records_<?php echo $category['id']; ?>" class="category_li" title="Drag To Re-Order">
<div class="col-xs-9 col-sm-3"><span class="fa fa-folder-open"></span> <a style="color:<?php echo $category['color']; ?>" href="news.php?case=category&id=<?php echo $category['id']; ?>&sub_id=0"><b><?php echo $category['category']; ?></b></a></div>
<div class="col-sm-2 hidden-xs"><b><?php echo get_category_sources($category['id']); ?></b></div>
<div class="col-sm-2 hidden-xs"><b><?php echo get_category_news($category['id']); ?></b></div>
<div class="col-sm-2 hidden-xs"><b><?php echo get_category_videos($category['id']); ?></b></div>
<div class="col-xs-3 text-right">
	<a href="categories.php?case=edit&id=<?php echo $category['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
	<a href="categories.php?case=delete&id=<?php echo $category['id']; ?>&type=main" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
</div>
</li>
<?php
$subs = $general->sub_categories($category['id'],'category_order ASC');	
if ($subs != 0) {
foreach ($subs AS $sub) {
?>
<li id="records_<?php echo $sub['id']; ?>" class="category_li" title="Drag To Re-Order">
<div class="col-xs-9 col-sm-3"><a style="padding-left:30px; color:<?php echo $sub['color']; ?>;" href="news.php?case=category&id=<?php echo $sub['id']; ?>&sub_id=<?php echo $category['id']; ?>"><?php echo $sub['category']; ?></a></div>
<div class="col-sm-2 hidden-xs"><?php echo get_sub_category_sources($sub['id']); ?></div>
<div class="col-sm-2 hidden-xs"><?php echo get_sub_category_news($sub['id']); ?></div>
<div class="col-sm-2 hidden-xs"><?php echo get_sub_category_videos($sub['id']); ?></div>
<div class="col-xs-3 text-right">
	<a href="categories.php?case=edit&id=<?php echo $sub['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
	<a href="categories.php?case=delete&id=<?php echo $sub['id']; ?>&type=sub" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
</div>
</li>
<?php
}
}	
}	
?>
</ul>
</div>
</div>
<?php
}
}
include('footer.php');
?>