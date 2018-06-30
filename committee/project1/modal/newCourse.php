<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');
?>
<div id="addCourse" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
   <form action="" method="post">
    <div class="modal-header">				
     <h4 class="modal-title">New Course</h4>
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">				
     <div class="form-group">
      <label>Course ID</label>
      <input type="textarea" name="courseID" class="form-control" required="required">
     </div>
     <div class="form-group">
      <label>Course Name</label>
      <input type="textarea" name="courseName" class="form-control" required="required">
     </div>
    </div>
    <div class="modal-footer">
     <input type="submit" name="addCourse" class="btn btn-primary pull-right" value="Add">
    </div>
   </form>
  </div>
 </div>
 <?php 
	if(isset($_POST["addCourse"]))
	{
		$sqlAdd = "INSERT INTO course (courseID, courseName, courseStatus) VALUES (UPPER('$_POST[courseID]'), UPPER('$_POST[courseName]'), 'ACTIVE')";
		
		if (mysqli_query($con, $sqlAdd))
		{
			echo "<script type='text/javascript'>alert('Success add course');</script>";
			echo "<script type='text/javascript'>window.location.href='../settings/course.php';</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('Fail to add course');</script>";
			echo "<script type='text/javascript'>window.location.href='../settings/course.php';</script>";
		}
	}
  ?>
</div>
</body>
</html>