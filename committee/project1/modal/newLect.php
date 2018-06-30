<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<div id="myModal" class="modal fade">
 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">New Lecturer</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">				
        <div class="form-group">
        <label>Lecturer ID</label>
        <input type="textarea" name="lectID" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Name</label>
        <input type="textarea" name="lectName" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Email</label>
        <input type="email" name="email" class="form-control" required="required">
        </div>
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="add" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["add"]))
 {
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
	$sql = "INSERT INTO lecturer (lectID, lectName, password, email, status) VALUES (UPPER('$_POST[lectID]'), UPPER('$_POST[lectName]'), 'abc123', '$_POST[email]', 'ACTIVE')";
				
	if (mysqli_query($con, $sql))
		echo "<script type='text/javascript'>alert('success');</script>";
	else
		echo "<script type='text/javascript'>alert('fail');</script>";
  }
 
 ?>
</div>
</body>
</html>