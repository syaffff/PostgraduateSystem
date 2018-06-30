<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>
 <p class="info-add" href="#addLO" data-toggle="modal">Add New Learning Outcome</p>
         
 <!-- Modal HTML -->
 <?php include 'modal/newLO.php'?>     
 <!-- ENDS Modal HTML -->
 
 <table>
 
 <?php
 $sqlLO = "SELECT * FROM lo_mark ORDER BY lo_num";
 $resultLO = mysqli_query($con, $sqlLO);
 $rowLO = mysqli_fetch_assoc($resultLO);
 $norowsLO = mysqli_num_rows($resultLO);
 ?>
 
  <tr>
   <th align="center">No.</th>
   <th align="center">Description</th>
   <th></th>
   <th></th>
  </tr>
                
<?php 
	$i = 0;
  do { 
    static $check = TRUE;?>
    <tr>
     <td><?php echo $rowLO['lo_num']; ?></td>
     <td><?php echo $rowLO['lo_desc']; ?></td>
      <?php echo '<td><a href="#updateLO'.$i.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>
      
      <!-- Modal Update -->
     <?php echo '<div id="updateLO'.$i.'" class="modal fade">'; ?>
     <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Update LO Criteria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          
          <div class="modal-body">				
            <div class="form-group">
            <label>LO No.</label>
            <input type="textarea" value="<?php echo $rowLO['lo_num']; ?>" name="lo_num" class="form-control" required="required">
            </div>
            
            <div class="form-group">
            <label>Description</label>
            <input type="textarea" value="<?php echo $rowLO['lo_desc']; ?>" name="lo_desc" class="form-control" required="required">
            </div>
          </div>
          
          <input type="hidden" value="<?php echo $rowLO['lo_num']; ?>" name="test" />
          
          <div class="modal-footer">
             <?php echo '<input type="submit" name="updateLO" class="btn btn-primary pull-right" value="Update">' ?>
          </div>
        </form>
      </div>
     </div>
     
     <?php
     if(isset($_POST["updateLO"])  && $_POST["test"]== $rowLO['lo_num'] && $check)
     {
        $con = mysqli_connect('localhost', 'root', '', 'postgrad');			
        $sql = "UPDATE lo_mark SET lo_num=UPPER('$_POST[lo_num]'), lo_desc=UPPER('$_POST[lo_desc]') WHERE lo_num='$rowLO[lo_num]'";
                    
        if (mysqli_query($con, $sql))
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('success update LO');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
		}
        else
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('fail update LO');</script>";
		}
      }
     
     ?>
      
     <td><a href="delLO.php?lo_num=<?php echo $rowLO['lo_num']; ?>" onclick="return confirm('Delete this LO criteria?')"><img src="../../left/img/mono-icons/stop32.png"/></a></td>
    </tr>
<?php 
	$i++; } while ($rowLO = mysqli_fetch_assoc($resultLO)); ?>

 </table>
</div>
</body>
</html>