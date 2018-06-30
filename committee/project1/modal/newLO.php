<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');	
 $sqlLO = "SELECT * FROM lo_mark";
 $resultLO = mysqli_query($con, $sqlLO);
 $rowLO = mysqli_fetch_assoc($resultLO);
 $norowsLO = mysqli_num_rows($resultLO);
 $i = $norowsLO +1;
 $id = "LO" .$i;
?>
<div id="addLO" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
   <form action="" method="post">
    <div class="modal-header">				
     <h4 class="modal-title">New Learning Outcome</h4>
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">				
     <div class="form-group">
      <label>No.</label>
      <?php echo $id;?>
     </div>
      <div class="form-group">
      <label>Description</label>
      <input type="textarea" name="desc" class="form-control" required="required">
     </div>
     <div class="form-group">
      <label>Weightage of Supervisor</label>
      <input type="number" class="form-control">
     </div>
     <div class="form-group">
      <label>Weightage of Evaluator</label>
      <input type="number" class="form-control">
     </div>
    </div>
    <div class="modal-footer">
     <input type="submit" name="submitLO" class="btn btn-primary pull-right" value="Add">
    </div>
   </form>
  </div>
 </div>
 <?php 
	if(isset($_POST["submitLO"]))
	{
		$sql = "INSERT INTO lo_mark (lo_num, lo_desc) VALUES ('$id', UPPER('$_POST[desc]'))";
		
		if (mysqli_query($con, $sql))
		{
			echo "<script type='text/javascript'>alert('success add LO');</script>";
			echo "<script type='text/javascript'>window.location.href='../committee/lo_po.php';</script>";
		}
		else
		{
			echo "<script type='text/javascript'>alert('fail add LO');</script>";
			echo "<script type='text/javascript'>window.location.href='../committee/lo_po.php';</script>";
		}
	}
  ?>
</div>
</body>
</html>