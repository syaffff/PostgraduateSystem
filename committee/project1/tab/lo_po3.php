<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>

 <p class="info-add" href="#addPO" data-toggle="modal">Add New Programme Outcome</p>
         
 <!-- Modal HTML -->
 <?php include 'modal/newPO.php'?>     
 <!-- ENDS Modal HTML -->
 
 <table>
 
 <?php
 $sqlPO = "SELECT * FROM po_mark ORDER BY po_num";
 $resultPO = mysqli_query($con, $sqlPO);
 $rowPO = mysqli_fetch_assoc($resultPO);
 $norowsPO = mysqli_num_rows($resultPO);
 ?>
 
  <tr>
   <th align="center">No.</th>
   <th align="center">Description</th>
   <th></th>
   <th></th>
  </tr>
                
<?php 
  $i = 0;
  do { ?>
    <tr>
     <td><?php echo $rowPO['po_num']; ?></td>
     <td><?php echo $rowPO['po_desc']; ?></td>
     <?php echo '<td><a href="#updatePO'.$i.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>
     
     <!-- Modal Update -->
     <?php echo '<div id="updatePO'.$i.'" class="modal fade">'; ?>
     <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Update PO Criteria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          
          <div class="modal-body">				
            <div class="form-group">
            <label>PO No.</label>
            <input type="textarea" value="<?php echo $rowPO['po_num']; ?>" name="po_num" class="form-control" required="required">
            </div>
            
            <div class="form-group">
            <label>Description</label>
            <input type="textarea" value="<?php echo $rowPO['po_desc']; ?>" name="po_desc" class="form-control" required="required">
            </div>
          </div>
          
          <input type="hidden" value="<?php echo $rowPO['po_num']; ?>" name="test" />
          
          <div class="modal-footer">
             <?php echo '<input type="submit" name="updatePO" class="btn btn-primary pull-right" value="Update">' ?>
          </div>
        </form>
      </div>
     </div>
     
     <?php
     if(isset($_POST["updatePO"])  && $_POST["test"]==$rowPO['po_num'] && $check)
     {
        $con = mysqli_connect('localhost', 'root', '', 'postgrad');			
        $sql = "UPDATE po_mark SET po_num=UPPER('$_POST[po_num]'), po_desc=UPPER('$_POST[po_desc]') WHERE po_num='$rowPO[po_num]'";
                    
        if (mysqli_query($con, $sql))
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('success update PO');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
		}
        else
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('fail update PO');</script>";
		}
      }
     
     ?>
     
     <td><a href="delPO.php?po_num=<?php echo $rowPO['po_num']; ?>" onclick="return confirm('Delete this PO criteria?')"><img src="../../left/img/mono-icons/stop32.png"/></a></td>
    </tr>
<?php $i++; } while ($rowPO = mysqli_fetch_assoc($resultPO)); ?>

 </table>
</div>
</body>
</html>