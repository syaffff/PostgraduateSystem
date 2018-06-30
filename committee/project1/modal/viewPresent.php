<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>
<body>
<?php
$sqlView = "SELECT * FROM student JOIN project_student USING (studID) JOIN present USING (titleID) WHERE studID='$row[studID]'";
$resultView = mysqli_query($con, $sqlView);
$rowView = mysqli_fetch_assoc($resultView);
?>

<?php echo '<div id="viewPresent'.$x.'" class="modal fade">' ?>
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
        <p><?php echo $rowView["studName"]; ?></p>
        </div>
        				
        <div class="form-group">
        <label>Title</label>
        <p><?php echo $rowView["title"]; ?></p>
        </div>
        
        <div class="form-group">
        <label>Date</label>
        <input type="date" value="<?php echo $rowView["date"]; ?>" name="date" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Time Start</label>
        <input type="time" value="<?php echo $rowView["timeStart"]; ?>" name="timeStart" class="form-control" required="required">
        </div>
        
         <div class="form-group">
        <label>Time End</label>
        <input type="time" value="<?php echo $rowView["timeEnd"]; ?>" name="timeEnd" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Place</label>
        <input type="textarea" value="<?php echo $rowView["place"]; ?>" name="place" class="form-control" required="required">
        </div>
        
        <input type="hidden" value="<?php echo $row['studID']; ?>" name="test" />
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="addView" class="btn btn-primary pull-right" value="Update">
      </div>
    </form>
    
<?php
if(isset($_POST["addView"]) && $_POST["test"]== $row['studID'])
{
	$sqlUpdate = "UPDATE present SET date='$_POST[date]', timeStart='$_POST[timeStart]', timeEnd='$_POST[timeEnd]', place=UPPER('$_POST[place]') WHERE titleID='$row[titleID]'";
	
	if (mysqli_query($con, $sqlUpdate))
	{
            echo "<script type='text/javascript'>alert('Success update presentation details');</script>";
            echo "<script type='text/javascript'> window.location.href='present.php';</script>";
	}
	else
		echo "<script type='text/javascript'>alert('Fail update presentation details');</script>";
}

?>
  </div>
  </div>

</body>
</html>