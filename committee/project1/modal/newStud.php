<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
$sqlCourse = "SELECT * FROM course WHERE courseStatus='ACTIVE'";
$resultCourse = mysqli_query($con, $sqlCourse);

?>
<div id="myModal" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">New Student</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">				
        <div class="form-group">
        <label>Student ID</label>
        <input type="textarea" name="studID" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Name</label>
        <input type="textarea" name="studName" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Course</label>
        <select name="course" required>
        	<option value="">Select </option>
		<?php 
        while ($rowCourse = mysqli_fetch_assoc($resultCourse))
        {
            echo "<option value=".$rowCourse['courseID'].">".$rowCourse['courseName']."</option>";
        }
        ?>        
        </select>
        </div>
        
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="addStudent" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["addStudent"]))
 {
	$email = strtoupper($_POST["studID"]) . "@student.utem.edu.my";
	
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
	$resultSem = mysqli_query($con, $sqlSem);
	$rowSem = mysqli_fetch_assoc($resultSem);
					
	$sql = "INSERT INTO student (studID, studName, course, email, semester) VALUES (UPPER('$_POST[studID]'), UPPER('$_POST[studName]'), UPPER('$_POST[course]'), '$email', '$rowSem[details]')";
					
	if (mysqli_query($con, $sql))
		echo "<script type='text/javascript'>alert('Success add student');</script>";
	else
		echo "<script type='text/javascript'>alert('Fail add student');</script>";
		
  }
 
 ?>
</div>
</body>
</html>