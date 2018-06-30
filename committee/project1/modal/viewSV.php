<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div id="viewModal" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Assigned Supervisor and Evaluators</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
 <?php
	//$studID = $_GET['studID'];
	$data =  $_COOKIE['studID'];
	echo $data;
	echo "heloooo";
	
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');	
			
	$sqlSV = "SELECT DISTINCT lectName FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID = '$data' AND posID = '1003'";
	$sqlEV = "SELECT DISTINCT lectName FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID = '$data' AND posID = '1002'";
	
	$resultSV = mysqli_query($con, $sqlSV);
	$resultEV = mysqli_query($con, $sqlEV);
	
	$rowSV = mysqli_fetch_assoc($resultSV);
	$rowEV = mysqli_fetch_assoc($resultEV);
?>
      
      <div class="modal-body">				
        <div class="form-group">
        <label>Supervisor</label>
        <?php echo $rowSV['lectName']; ?>
        <input type="textarea" name="criteria" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Evaluator 1</label>
        <?php echo $rowEV['lectName']; ?>
        <input type="textarea" name="criteria" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Evaluator 2</label>
        <?php //echo $row_rs_student['Student_ID']; ?>
        <input type="textarea" name="criteria" class="form-control" required="required">
        </div>
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="add1" class="btn btn-primary pull-right" value="Edit">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["add1"]))
 {
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
	$sql = "INSERT INTO lo_criteria (loID, criteriaID, criteria, markAllocated) VALUES ('$x', 'XX', '$_POST[criteria]', $_POST[mark] )";
				
	if (mysqli_query($con, $sql))
		echo "<script type='text/javascript'>alert('success');</script>";
	else
		echo "<script type='text/javascript'>alert('fail');</script>";
  }
 
 ?>
</div>
</body>

<script>
$(document).ready(function () 
{
	var studID = $(this).attr("id");
	document.cookie = "studID=$(this).attr('id')";
});
</script>
</html>