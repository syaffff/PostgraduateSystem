<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>
<?php			
 $con = mysqli_connect('localhost', 'root', '', 'postgrad'); 
  $sql5 = "SELECT lo_mark.lo_num AS loMark, lo_po.lo_num AS loPo, lo_po.po_num AS poPo FROM lo_mark LEFT JOIN lo_po ON lo_po.lo_num = lo_mark.lo_num ORDER BY lo_mark.lo_num";
  $result5 = mysqli_query($con, $sql5);
  $row5 = mysqli_fetch_assoc($result5);
			
?>
            
 <table>
  <tr>
   <th align="center">LO No.</th>
   <th align="center">PO No.</th>
   <th></th>
  </tr>
                
<?php 
  $i = 0;
  do {?>
    <tr>
     <td><?php echo $row5['loMark']; ?></td>
     <td><?php echo $row5['poPo']; ?></td>
     <?php echo '<td><a href="#editLOPO'.$i.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>   
     
     <!-- modal -->
      <?php echo '<div id="editLOPO'.$i.'" class="modal fade">'; ?>
     <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Assign PO</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          
          <div class="modal-body">
          <?php echo "For Criteria:" .$row['criteriaID']; ?>
          <br />				
            <div class="form-group">
            <label>LO No.</label>
            <select name="lo" >
			 <?php
               $sqlLO = "SELECT * FROM lo_mark";
               $resultLO = mysqli_query($con, $sqlLO);
              while ($rowChg = mysqli_fetch_array($resultLO))
              { ?>
               <option value="<?php echo $rowChg['lo_num']?>" <?php if (!(strcmp("$row[lo_num]", "$rowChg[lo_num]"))) {echo "SELECTED";}?>><?php echo $rowChg['lo_num']?></option>
              <?php
              }
              ?>        
             </select>
            </div>
          </div>
          
          <input type="hidden" value="<?php echo $row['criteriaID']; ?>" name="test" />
          
          <div class="modal-footer">
             <input type="submit" name="assignLO" class="btn btn-primary pull-right" value="Update">
          </div>
        </form>
      </div>
     </div>
     
     <?php
     if(isset($_POST["assignLO"]) && $_POST["test"]==$row['criteriaID'])
     {
        $con = mysqli_connect('localhost', 'root', '', 'postgrad');			
        $sql = "UPDATE lo_criteria SET lo_num='$_POST[lo]' WHERE criteriaID='$row[criteriaID]'";
                    
        if (mysqli_query($con, $sql))
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('success assign LO');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
		}
        else
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('fail assign LO');</script>";
		}
      }
     
     ?>
     
    </tr>
<?php $i++;} while ($row5 = mysqli_fetch_assoc($result5)); ?>

 </table>

</div>
</body>
</html>