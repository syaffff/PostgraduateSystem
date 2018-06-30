<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
echo '<div id="view1'.$x.'" class="modal fade">' ;

$sqlView = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$x' AND projectID='2001'";
$resultView = mysqli_query($con, $sqlView);
$rowView = mysqli_fetch_assoc($resultView);

$sqlEV1 = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$x' AND projectID='2001' AND posID=1002";
$resultEV1 = mysqli_query($con, $sqlEV1);
$rowEV1 = mysqli_fetch_assoc($resultEV1);

$sqlEV2 = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$x' AND projectID='2001' AND posID=1004";
$resultEV2 = mysqli_query($con, $sqlEV2);
$rowEV2 = mysqli_fetch_assoc($resultEV2);
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
        
        <div class="form-group">
        <label>Evaluator 1</label><br />
        <?php echo $rowEV1["lectName"]; ?>
        </div>
        
        <div class="form-group">
        <label>Evaluator 2</label><br />
        <?php echo $rowEV2["lectName"]; ?>
        </div>
      </div>
    </form>
  </div>
 </div>
</div>
</body>
</html>