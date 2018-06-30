<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');	
 $sqlPO = "SELECT * FROM po_mark";
 $resultPO = mysqli_query($con, $sqlPO);
 $rowPO = mysqli_fetch_assoc($resultPO);
 $norowsPO = mysqli_num_rows($resultPO);
 $iPO = $norowsPO +1;
 $idPO = "PO" .$iPO;
?>
<div id="addPO" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
   <form action="" method="post">
    <div class="modal-header">				
     <h4 class="modal-title">New Programme Outcome</h4>
     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    </div>
    <div class="modal-body">				
     <div class="form-group">
      <label>No.</label>
      <?php echo $idPO;?>
     </div>
      <div class="form-group">
      <label>Description</label>
      <input type="textarea" name="descPO" class="form-control" required="required">
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
     <input type="submit" name="submitPO" class="btn btn-primary pull-right" value="Add">
    </div>
   </form>
  </div>
 </div>
 <?php
	if(isset($_POST["submitPO"]))
	{
		$sql = "INSERT INTO po_mark (po_num, po_desc) VALUES ('$idPO', UPPER('$_POST[descPO]'))";
		
		if (mysqli_query($con, $sql))
			echo "<script type='text/javascript'>alert('success add PO');</script>";
		else
			echo "<script type='text/javascript'>alert('fail add PO');</script>";
	}
  ?>
</div>
</body>
</html>