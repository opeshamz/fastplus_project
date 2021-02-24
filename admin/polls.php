<?php
include('header.php'); 
if (!empty($_GET['case'])) {
$case = make_safe($_GET['case']);	
} else {
$case = '';	
}
switch ($case) {
case 'setting';
$polls = $general->polls('id DESC');
if (isset($_POST['save'])) {
$message = $general->set_options($_POST,'Polls');
}
$options = $general->get_options('Polls'); 
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">

                <div class="page-header page-heading">
                    <h1><i class="fa fa-cog"></i> Poll Setting
					<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>

					</h1>
                </div>
				<?php 
				if ($polls == 0) {
					echo notification('warning','You haven\'t created any poll. <a href="?case=add" class="alert-link">Create New Poll</a>');
				} else {
				?>
	<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" style="margin: 25px;">
		  <div class="form-group">
			<input type="hidden" name="display_poll_widget" value="0" />
			<input type="checkbox" name="display_poll_widget" id="display_poll_widget" value="1" <?php if (isset($options['display_poll_widget']) AND $options['display_poll_widget'] == 1) {echo 'CHECKED';} ?> /> <span class="checkbox-label">Display Poll Widget ?</span>
		  </div>
		   <div id="poll-widget-div">
		  <div class="form-group">
			<label for="poll_question_id">Select Poll Question</label>
			<select name="poll_question_id" id="poll_question_id" class="form-control">
			<?php 
			
			foreach ($polls AS $question) {
			?>
			<option value="<?php echo $question['id']; ?>" <?php if ($options['poll_question_id'] == $question['id']) {echo 'SELECTED';} ?>><?php echo $question['question']; ?></option>	
			<?php
			}
			?>
			</select>
		  </div>
		  </div>
		  <button type="submit" name="save" class="btn btn-primary">Save</button>
		</form>
</div>
</div>
</div>
</div>
</div>
</div>

		<?php } ?>
	
<?php 
break;
case 'add';
if (isset($_POST['submit'])) {
$question = make_safe(xss_clean($_POST['question']));
if (empty($question)) {
$message = notification('warning','Insert Poll Question Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/polls/');
$thumbnail = $up->upload($_FILES['thumbnail']);
} else {
$thumbnail = '';
}
$sql = "INSERT INTO polls (question,image) VALUES ('$question','$thumbnail')";
$query = $mysqli->query($sql);
if ($query) {
$poll_id = $mysqli->insert_id;
$answers = $_POST['answer'];
if (count($answers) > 0) {
	for($i=0;$i<count($answers);$i++) {
		$answer = $answers[$i];
		$mysqli->query("INSERT INTO polls_answers (poll_id,answer) VALUES ('$poll_id','$answer')");
	}
}
$message = notification('success','Poll Added Successfully.');
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
				<h1>Add New Poll
				<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data" style="margin: 25px;">
		  <div class="form-group">
			<label for="question">Poll Question <span>*</span></label>
			<input type="text" class="form-control" name="question" id="question" />
		  </div>
		  <div class="form-group no-bottom-border">
			<label for="category_id">Image</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
		</div>
		  <div class="form-group">
			<label for="answer">Poll Answers <span>*</span></label>
			<div class="old_answers">
			<input type="text" class="form-control" name="answer[]" />
			</div>
			<div class="another_answer">
			
			</div>
			<p><a href="javascript:void();" onclick="javascript:AddMoreInputs();">Add More Answers</a></p>
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
$question = make_safe(xss_clean($_POST['question']));
if (empty($question)) {
$message = notification('warning','Insert Poll Question Please.');
} else {
if (!empty($_FILES['thumbnail']['name'])) {
$up = new fileDir('../upload/polls/');
$thumbnail = $up->upload($_FILES['thumbnail']);
$up->delete("$_POST[old_thumbnail]");
} else {
$thumbnail = $_POST['old_thumbnail'];
}
$sql = "UPDATE polls SET question='$question',image='$thumbnail' WHERE id='$id'";
$query = $mysqli->query($sql);
if ($query) {
$answers = $_POST['answer'];
if (count($answers) > 0) {
	for($i=0;$i<count($answers);$i++) {
		$answer = $answers[$i];
		$mysqli->query("INSERT INTO polls_answers (poll_id,answer) VALUES ('$id','$answer')");
	}
}
$old_answers = $_POST['old_answer'];
$old_answers_id = $_POST['old_answer_id'];
if (count($old_answers_id) > 0) {
	for($b=0;$b<count($old_answers_id);$b++) {
		$old_answer = $old_answers[$b];
		$old_answer_id = $old_answers_id[$b];
		if (empty($old_answer)) {
		$mysqli->query("DELETE FROM polls_answers WHERE id='$old_answer_id'");	
		} else {
		$mysqli->query("UPDATE polls_answers SET answer='$old_answer' WHERE id='$old_answer_id'");	
		}
	}
}
$message = notification('success','Poll Edited Successfully.');
} else {
$message = notification('danger','Error Happened.');
}
}
}
$question = $general->question($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Edit Poll
				<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		<form role="form" method="POST" action="" enctype="multipart/form-data" style="margin: 25px;">
		  <div class="form-group">
			<label for="question">Poll Question <span>*</span></label>
			<input type="text" class="form-control" name="question" id="question" value="<?php echo $question['question']; ?>" />
		  </div>
		  <div class="form-group no-bottom-border">
			<label for="thumbnail">Thumbnail</label>
			<div class="fileinput fileinput-new input-group" data-provides="fileinput">
			  <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
			  <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="thumbnail"></span>
			  <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
			</div>
			<?php if (!empty($question['image'])) { ?>
			<p><a href="javascript:void();" class="delete-poll-image" id="<?php echo $question['id']; ?>" data-toggle="tooltip" data-placement="top" title="Delete Image"><span class="fa fa-close"></span></a> Current Image : <a href="javascript:void();" data-toggle="popover" data-placement="top" title="Current Image" data-content="<img src='../upload/polls/<?php echo $question['image']; ?>' class='img-responsive' />"><?php echo $question['image']; ?></a></p>
			<?php } ?>
		</div>
		  <div class="form-group">
			<label for="answer">Poll Answers <span>*</span></label>
			<div class="old_answers">
			<?php 
			$query = $mysqli->query("SELECT * FROM polls_answers WHERE poll_id='$id'");
			if ($query->num_rows > 0) {
			while ($row = $query->fetch_assoc()) {
			?>
			<input type="text" class="form-control" name="old_answer[]" value="<?php echo $row['answer']; ?>" />
			<input type="hidden" name="old_answer_id[]" value="<?php echo $row['id']; ?>" />
			<?php 
			} 
			}
			?>
			</div>
			<div class="another_answer">
			
			</div>
			<p><a href="javascript:void();" onclick="javascript:AddMoreInputs();">Add More Answers</a></p>
		  </div>
		  <input type="hidden" name="old_thumbnail" value="<?php echo $question['image']; ?>" />
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
case 'result';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
$question = $general->question($id);
$answers = $general->answers($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1><i class="fa fa-pie-chart"></i> <?php echo $question['question']; ?>
				<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				<a href="polls.php?case=edit&id=<?php echo $id; ?>" class="btn btn-warning btn-sm pull-right"><span class="fa fa-edit"></span></a>
				<a href="polls.php?case=delete&id=<?php echo $id; ?>" class="btn btn-danger btn-sm pull-right"><span class="fa fa-trash"></span></a>
				</h1>
			</div>
			<?php if ($answers == 0) {
			echo notification('warning','You Didn\'t Add any Answers For this Question.');	
			} else { ?>
			<div class="row">
			<div class="col-md-8">
			<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
				<thead>
					<tr>
						<th>Answer</th>
						<th>Votes</th>
						<th>Percent</th>
					</tr>
				</thead>
				<tbody>
			<?php 
			foreach ($answers AS $ans) {
			?>
			 <tr>
				<td><?php echo $ans['answer']; ?></td>
				<td><?php echo answer_count_votes($ans['id']); ?></td>
				<td><?php echo number_format((answer_count_votes($ans['id'])*100)/get_poll_votes($id), 2, '.', ''); ?>%</td>
			 </tr>
			<?php	
			}
			?>
			</table>
			</div>
			<div class="col-md-6">
			<script>
			$(function() {
				Morris.Donut({
				  element: 'pollresult',
					data: [
					<?php 
					foreach ($answers AS $answer) {
					?>
					{value: <?php echo answer_count_votes($answer['id']); ?>, label: '<?php echo $answer['answer']; ?>', formatted: '<?php echo number_format((answer_count_votes($answer['id'])*100)/get_poll_votes($id), 2, '.', ''); ?>%'},
					<?php } ?>
				  ],
				  resize: true,
				  backgroundColor: '#fff',
				  labelColor: '#aaa',
				  colors: [
					'#0BA462',
					'#39B580',
					'#67C69D',
					'#95D7BB'
				  ],
				  formatter: function (x, data) { return data.formatted; }
				});
			});
			</script>
	
			<div id="pollresult"></div>		
			</div>
			</div>
</div>
</div>
</div>
</div>
</div>
</div>

			<?php } ?>
			
<?php
break;
case 'delete';
$id = abs(intval(make_safe(xss_clean($_GET['id']))));
if (isset($_POST['delete'])) {
$mysqli->query("DELETE FROM poll_answers WHERE poll_id='$id'");
$mysqli->query("DELETE FROM poll_votes WHERE poll_id='$id'");
$delete = $mysqli->query("DELETE FROM polls WHERE id='$id'");
if ($delete) {
$message = notification('success','Poll and Related Answers and Votes Deleted Successfully.');
$done = true;
} else {
$message = notification('danger','Error Happened.');
}
}
$poll = $general->question($id);
?>
<div class="pcoded-content">
<div class="pcoded-inner-content">
<div class="main-body">
<div class="page-wrapper">
<div class="page-body">
<div class="card">
			<div class="page-header page-heading">
				<h1>Delete Poll
				<a href="polls.php" class="btn btn-default btn-sm pull-right"><span class="fa fa-arrow-right"></span></a>
				</h1>
			</div>
			<?php if (isset($message)) {echo $message;} ?>
		  <form role="form" method="POST" action="" style="margin: 25px;">
		  <?php if (empty($done)) { ?>
			<div class="alert alert-warning">Are You Sure that you want to Delete the Poll : <?php echo $poll['question']; ?> With all Related Answers and Votes ?</div>
		  <?php } ?>
		  <?php if ($done) { ?>
		  <a href="polls.php" class="btn btn-default">Back To Polls</a>
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
	<h1><i class="fa fa-pie-chart"></i> Polls
	<a href="polls.php?case=setting" class="btn btn-default btn-sm pull-right"><span class="fa fa-cog"></span></a>
	<a href="polls.php?case=add" class="btn btn-success btn-sm pull-right"><span class="fa fa-plus"></span></a>
	</h1>
</div>
<?php
$polls = $general->polls('id DESC');	
if ($polls == 0) {
echo notification('warning','You didn\'t add any Poll. <a href="?case=add">Add new Poll</a>.');	
} else {
?>
<table width="100%" cellpadding="5" cellspacing="0" class="table table-striped">
    <thead>
        <tr>
			<th>Question</th>
			<th class="hidden-xs">Answers</th>
			<th class="hidden-xs">Votes</th>
            <th></th>
        </tr>
    </thead>
	<tbody>
<?php
foreach ($polls AS $question) {
?>
		<tr>
			<td><i class="fa fa-question-circle has-image"></i> <?php echo $question['question']; ?></td>
			<td class="hidden-xs"><?php echo get_poll_answers($question['id']); ?></td>
			<td class="hidden-xs"><?php echo get_poll_votes($question['id']); ?></td>
			<td align="right">
				<a href="polls.php?case=result&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-warning"><span class="fa fa-pie-chart"></span></a>
				<a href="polls.php?case=edit&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-default"><span class="fa fa-edit"></span></a>
				<a href="polls.php?case=delete&id=<?php echo $question['id']; ?>" class="btn btn-xs btn-danger"><span class="fa fa-close"></span></a>
			</td>
		</tr>
<?php	
}	
?>
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