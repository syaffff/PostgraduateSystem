<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php echo '<div id="addPresent'.$x.'" class="modal fade">' ?>
 <div class="modal-dialog modal-login">
  <div class="modal-content">
   <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Presentation Details</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        <label>Student Name</label>
        <p><?php echo $row["studName"]; ?></p>
        </div>
        				
        <div class="form-group">
        <label>Title</label>
        <p><?php echo $row["title"]; ?></p>
        </div>
        
        <div class="form-group">
        <label>Date</label>
        <input type="date" name="date" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Time Start</label>
        <input type="time" name="timeStart" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Time End</label>
        <input type="time" name="timeEnd" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Place</label>
        <input type="textarea" name="place" class="form-control" required="required">
        </div>
        
        <input type="hidden" value="<?php echo $row['studID']; ?>" name="test" />
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="addAdd" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
    
<?php
if(isset($_POST["addAdd"]) && $_POST["test"]== $row['studID'])
{
	$sqlAdd = "INSERT INTO present VALUE ('$row[titleID]','$_POST[date]', '$_POST[timeStart]', '$_POST[timeEnd]', UPPER('$_POST[place]'))";
	
	if (mysqli_query($con, $sqlAdd))
	{
            echo "<script type='text/javascript'>alert('Success add presentation details');</script>";
            echo "<script type='text/javascript'> window.location.href='present.php';</script>";
	}
	else
		echo "<script type='text/javascript'>alert('Fail add presentation details');</script>";
}

?>
  </div>
  </div>

</body>
</html>