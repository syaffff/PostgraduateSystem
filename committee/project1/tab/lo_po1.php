<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div>
 <p class="info-add" href="#add" data-toggle="modal">Add New Category</p>
            
<!-- Modal HTML -->
<?php include 'modal/newCat.php'?>     
            
<?php
		  
$x = 1;
$xx = 0;
			
$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
$sql2 = "SELECT * FROM lo_element ORDER BY loID";			
$result2 = mysqli_query($con, $sql2);			
$row2 = mysqli_fetch_assoc($result2);
$edit = 0;	
do { ?>
            
  <table>
  
  <?php
  $sql = "SELECT * FROM lo_element JOIN lo_criteria USING (loID) WHERE loID = $x";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $x = $x + 1;
  $noRows = mysqli_num_rows($result);
  ?>
  
  <p>
  <br />
  <?php echo '<a href="#addCat'.$xx.'" data-toggle="modal">' ?> <img src="../../left/img/mono-icons/plus32.png"/></a>
  <a href="tab/delAllCrit.php?loID=<?php echo $row2['loID']; ?>"  onclick="return confirm('Delete this LO category and ALL ITS CRITERIAS?')"><img src="../../left/img/mono-icons/stop32.png"/></a> 
  <?php echo '<a href="#editCat'.$xx.'" data-toggle="modal">' ?><img src="../../left/img/mono-icons/wand32.png"/></a><br />
  <?php echo " \t Category: "; echo $row2['categoryName']; ?> <br />
  <?php echo " \t Weightage of Supervisor: "; echo $row2['percentSV']; ?> <br />
  <?php echo " \t Weightage of Evaluator: "; echo $row2['percentEV'];?>
  </p>

  <!-- Modal HTML -->   
   <?php echo '<div id="addCat'.$xx.'" class="modal fade">' ?>
 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">New Criteria For Category: <?php echo $row2["categoryName"]; ?></h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        <label>Criteria ID</label>
        <input type="textarea" name="criteriaID" class="form-control" required="required">
        </div>
        				
        <div class="form-group">
        <label>Criteria</label>
        <input type="textarea" name="criteria" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Mark Allocated</label>
        <input type="number" name="mark" class="form-control" required="required">
        </div>
        
        <input type="hidden" value="<?php echo $row2['loID']; ?>" name="test" />
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="add1" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["add1"]) && $_POST["test"]== $row2['loID'])
 {
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
	$sql = "INSERT INTO lo_criteria (loID, criteriaID, criteria, markAllocated) VALUES ('$row2[loID]', UPPER('$_POST[criteriaID]'), UPPER('$_POST[criteria]'), $_POST[mark] )";
				
	if (mysqli_query($con, $sql))
	{
            echo "<script type='text/javascript'>alert('success add criteria');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
	}
	else
		echo "<script type='text/javascript'>alert('fail add criteria');</script>";
  }
 
 ?>
</div>  

<!-- Modal HTML -->   
   <?php echo '<div id="editCat'.$xx.'" class="modal fade">' ?>
 <div class="modal-dialog modal-login">
  <div class="modal-content">
    <form action="" method="post">
      <div class="modal-header">				
      	<h4 class="modal-title">Edit Category: <?php echo $row2["categoryName"]; ?></h4>
      	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
      </div>
      
      <div class="modal-body">
        <div class="form-group">
        <label>Category Name</label>
        <input type="textarea" name="catName" value="<?php echo $row2["categoryName"]; ?>" class="form-control" required="required">
        </div>
        				
        <div class="form-group">
        <label>Weightage of Supervisor</label>
        <input type="number" name="wSV" value="<?php echo $row2["percentSV"]; ?>" class="form-control" required="required">
        </div>
        
        <div class="form-group">
        <label>Weightage of Supervisor</label>
        <input type="number" name="wEV" value="<?php echo $row2["percentEV"]; ?>"  class="form-control" required="required">
        </div>
        
        <input type="hidden" value="<?php echo $row2['loID']; ?>" name="test" />
      </div>
      
      <div class="modal-footer">
        <input type="submit" name="edit1" class="btn btn-primary pull-right" value="Add">
      </div>
    </form>
  </div>
 </div>
 <?php
 if(isset($_POST["edit1"]) && $_POST["test"]== $row2['loID'])
 {
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
	$sql = "UPDATE lo_element SET categoryName=UPPER('$_POST[catName]'), percentSV='$_POST[wSV]', percentEV='$_POST[wEV]' WHERE loID='$row2[loID]'";
				
	if (mysqli_query($con, $sql))
	{
            echo "<script type='text/javascript'>alert('success update category');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
	}
	else
		echo "<script type='text/javascript'>alert('fail update category');</script>";
  }
 
 ?> 

   <?php  if ($noRows)
   { ?>
   <tr>
   	<th>No.</th>
    <th>Criteria</th>
    <th>MARKS</th>
    <th></th>
    <th></th>
   </tr>
          
   <?php 
					
	$i = 0;	
					
	do { ?>
                
    <tr>
     <td align="center"><?php echo $row['criteriaID']; ?></td>
     <td><?php echo $row['criteria']; ?></td>
     <td><?php echo $row['markAllocated']; ?></td>
     <?php echo '<td><a href="#editCriteria'.$edit.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>
     
     <!-- Modal Update -->
     <?php echo '<div id="editCriteria'.$edit.'" class="modal fade">'; ?>
     <div class="modal-dialog modal-login">
      <div class="modal-content">
        <form action="" method="post">
          <div class="modal-header">				
            <h4 class="modal-title">Update Criteria</h4>
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          </div>
          
          <div class="modal-body">				
            <div class="form-group">
            <label>Criteria ID</label>
            <input type="textarea" value="<?php echo $row['criteriaID']; ?>" name="criteriaID" class="form-control" required="required">
            </div>
            
            <div class="form-group">
            <label>Criteria</label>
            <input type="textarea" value="<?php echo $row['criteria']; ?>" name="criteria" class="form-control" required="required">
            </div>
            
            <div class="form-group">
            <label>Mark Allocated</label>
            <input type="number" value="<?php echo $row['markAllocated']; ?>" name="markAllocated" class="form-control" required="required">
            </div>
          </div>
          
          <input type="hidden" value="<?php echo $row['criteriaID']; ?>" name="test" />
          
          <div class="modal-footer">
             <input type="submit" name="editCriteria" class="btn btn-primary pull-right" value="Update">
          </div>
        </form>
      </div>
     </div>
     
     <?php
     if(isset($_POST["editCriteria"])  && $_POST["test"]== $row['criteriaID'])
     {		
        $sqlModal = "UPDATE lo_criteria SET criteriaID=UPPER('$_POST[criteriaID]'), criteria=UPPER('$_POST[criteria]'), markAllocated='$_POST[markAllocated]' WHERE criteriaID='$row[criteriaID]'";
                    
        if (mysqli_query($con, $sqlModal))
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('success update criteria');</script>";
            echo "<script type='text/javascript'> window.location.href='lo_po.php';</script>";
		}
        else
		{
			$check = FALSE;
            echo "<script type='text/javascript'>alert('fail update criteria');</script>";
		}
      }
     
     ?>
     <td><a href="../tab/delCrit.php?criteriaID=<?php echo $row['criteriaID']; ?>" onclick="return confirm('Delete this criteria?')"><img src="../../left/img/mono-icons/stop32.png"/></a></td>
    </tr>
<?php $edit++; } while ($row = mysqli_fetch_assoc($result)); 
   } else 
   		echo "No criteria yet";?>
  </table>
<?php $xx++;} while ($row2 = mysqli_fetch_assoc($result2)); ?>
        
</div>
</body>
</html>