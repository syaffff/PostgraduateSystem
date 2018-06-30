<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
echo '<div id="view2'.$x.'" class="modal fade">' ;

$sqlView = "SELECT * FROM student JOIN project_student USING (studID) WHERE studID='$x' AND projectID='2002'";
$resultView = mysqli_query($con, $sqlView);
$rowView = mysqli_fetch_assoc($resultView);
?>

 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Details of Project 2</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">				
        <div class="form-group">
        <label>Student ID</label><br />
        <?php echo $rowView["studID"];?>
        </div>
        
        <div class="form-group">
        <label>Name</label><br />
        <?php echo $rowView["studName"]; ?>
        </div>
        
        <div class="form-group">
        <label>Course</label><br />
        <?php echo $rowView["course"]; ?>
        </div>
        
        <div class="form-group">
        <label>Title</label><br />
        <?php echo $rowView["title"]; ?>
        </div>
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["add1"]))
 {
	$email = strtoupper($_POST["studID"]) . "@student.utem.edu.my";
	
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
	$resultSem = mysqli_query($con, $sqlSem);
	$rowSem = mysqli_fetch_assoc($resultSem);
					
	$sql = "INSERT INTO student (studID, studName, course, email, semester) VALUES (UPPER('$_POST[studID]'), UPPER('$_POST[studName]'), UPPER('$_POST[course]'), '$email', '$rowSem[details]')";
	
	$sql2 = "INSERT INTO project_student (studID, projectID, semID, title) VALUES (UPPER('$_POST[studID]'), '2001', '$rowSem[details]', UPPER('$_POST[title]'))";
				
	if (mysqli_query($con, $sql) && mysqli_query($con, $sql2))
		echo "<script type='text/javascript'>alert('success add');</script>";
	else
		echo "<script type='text/javascript'>alert('fail add');</script>";
		
  }
 
 ?>
</div>
</body>
</html>