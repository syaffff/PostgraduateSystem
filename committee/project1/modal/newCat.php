<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');	
 $sqlCat = "SELECT * FROM lo_element";
 $resultCat = mysqli_query($con, $sqlCat);
 $rowCat = mysqli_fetch_assoc($resultCat);
 $norowsCat = mysqli_num_rows($resultCat);
 $iCat = $norowsCat +1;
?>
<div id="add" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
   <form action="" method="post">
    <div class="modal-header">				
     <h4 class="modal-title">New Category</h4>
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">				
     <div class="form-group">
      <label>Category</label>
      <input type="textarea" name="catName" class="form-control" required="required">
     </div>
     <div class="form-group">
      <label>Weightage of Supervisor</label>
      <input type="number" name="catSV" class="form-control" required="required">
     </div>
     <div class="form-group">
      <label>Weightage of Evaluator</label>
      <input type="number" name="catEV" class="form-control" required="required">
     </div>
    </div>
    <div class="modal-footer">
     <input type="submit" name="submitCat" class="btn btn-primary pull-right" value="Add">
    </div>
   </form>
  </div>
 </div>
 <?php
	if(isset($_POST["submitCat"]))
	{
		$sql = "INSERT INTO lo_element (loID, categoryName, percentSV, percentEV) VALUES ('$iCat', UPPER('$_POST[catName]'), '$_POST[catSV]', '$_POST[catEV]')";
		
		if (mysqli_query($con, $sql))
			echo "<script type='text/javascript'>alert('success add new category');</script>";
		else
			echo "<script type='text/javascript'>alert('fail add new category');</script>";
	}
  ?>
</div>
</body>
</html>