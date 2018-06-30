<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<?php 
echo '<div id="mark'.$x.'" class="modal fade">' ;

$sqlMark = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$x' AND projectID='2001'";
$resultMark = mysqli_query($con, $sqlMark);
$rowMark = mysqli_fetch_assoc($resultMark);
?>

 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Details of Mark Obtained</h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        <label>Name</label><br />
        <?php echo $rowMark["studName"]; ?>
        </div>
        
        <div class="form-group">
        <label>Supervisor</label><br />
        <?php echo "Total LO: "; //$rowMark["course"]; ?>
        </div>
        
        <div class="form-group">
        <label>Evaluator 1</label><br />
        <?php echo "Total LO: "; //$rowMark["course"]; ?>
        </div>
        
        <div class="form-group">
        <label>Evaluator 2</label><br />
        <?php echo "Total LO: "; //$rowMark["course"]; ?>
        </div>
        
        <div class="form-group">
        <label>Total</label><br />
        <?php //echo $rowMark["course"]; ?>
        </div>
        
        <div class="form-group">
        <label>Grade</label><br />
        <?php //echo $rowMark["course"]; ?>
        </div>
      </div>
    </form>
  </div>
 </div>
</div>
</body>
</html>