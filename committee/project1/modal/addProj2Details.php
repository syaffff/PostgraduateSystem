<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
echo '<div id="add2'.$x.'" class="modal fade">';

$sqlAdd = "SELECT * FROM student WHERE studID='$x'";
$resultAdd = mysqli_query($con, $sqlAdd);
$rowAdd = mysqli_fetch_assoc($resultAdd);
?>

 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Details of Project 1</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">        
        <div class="form-group">
        <label>Name</label><br />
        <?php echo $rowAdd["studName"]; ?>
        </div>
        
        <div class="form-group">
        <label>Title</label><br />
        <input type="textarea" name="title" class="form-control" required="required">
        </div>
      </div>
       <div class="modal-footer">
        <input type="submit" name="addProj1" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["addProj1"]))
 {
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
	$resultSem = mysqli_query($con, $sqlSem);
	$rowSem = mysqli_fetch_assoc($resultSem);
					
	$sqlAdd1 = "INSERT INTO project_student (studID, projectID, semID, title) VALUES ('$x', '2002', '$rowSem[details]', UPPER('$_POST[title]'))";
			
	if (mysqli_query($con, $sqlAdd1))
		echo "<script type='text/javascript'>alert('Success add project details');</script>";
	else
		echo "<script type='text/javascript'>alert('Fail add project details');</script>";
		
  }
 
 ?>
</div>
</body>
</html>