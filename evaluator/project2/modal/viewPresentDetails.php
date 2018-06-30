<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
echo '<div id="present'.$x.'" class="modal fade">' ;

$sqlPresent = "SELECT * FROM student JOIN project_student USING (studID) JOIN present USING (titleID) WHERE studID='$x' AND projectID='2001' AND semID='$rowSem[details]'";
$resultPresent = mysqli_query($con, $sqlPresent);
$rowPresent = mysqli_fetch_assoc($resultPresent);

$datePresent = date("d/m/Y", strtotime($rowPresent["date"]));
?>

 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Details of Presentation</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">
      
      	<div class="form-group">
        <label>Name</label><br />
        <?php echo $rowPresent["studName"]; ?>
        </div>
        
        <div class="form-group">
        <label>Room</label><br />
        <?php echo $datePresent; ?>
        </div>
        				
        <div class="form-group">
        <label>Time</label><br />
        <?php echo $rowPresent["timeStart"]; echo " - "; echo $rowPresent["timeEnd"];?>
        </div>
        
        <div class="form-group">
        <label>Room</label><br />
        <?php echo $rowPresent["place"]; ?>
        </div>
      </div>
    </form>
  </div>
 </div>
</div>
</body>
</html>