<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>
<?php
 $x = 1;
			
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');			
 $sql2 = "SELECT * FROM lo_element ORDER BY loID";			
 $result2 = mysqli_query($con, $sql2);			
 $row2 = mysqli_fetch_assoc($result2);
			
?>
<?php 

  $i = 0;
  do { ?>
            
 <table>
 <?php
  $sql = "SELECT * FROM lo_element JOIN lo_criteria USING (loID) WHERE loID = $x";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $x = $x + 1;
 ?>
  
  <p><br /><?php echo $row2['categoryName']; ?></p>
                               
  <tr>
   <th align="center">No.</th>
   <th align="center">Criteria</th>
   <th align="center">MARKS</th>
   <th align="center">LO No.</th>
  </tr>
                
<?php 
  do { ?>
    <tr>
     <td align="center"><?php echo $row['criteriaID']; ?></td>
     <td><?php echo $row['criteria']; ?></td>
     <td><?php echo $row['markAllocated']; ?></td>
     <td><?php 
	 		if ($row['lo_num'] == "NULL")
				echo "-";				
			else 
				echo $row['lo_num'];
			?></td>
     <?php echo '<td><a href="#assignLO'.$i.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>
     
      <?php echo '<div id="assignLO'.$i.'" class="modal fade">'; ?>
     <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Assign LO Criteria</h4>
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
<?php $i++;} while ($row = mysqli_fetch_assoc($result)); ?>

 </table>
<?php } while ($row2 = mysqli_fetch_assoc($result2)); ?>

</div>
</body>
</html>