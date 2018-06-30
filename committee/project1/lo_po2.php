<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
<!-- SIDEBAR -->
<div id="sidebar">
<!-- logo -->
<a href="index.html"><img src="../left/img/logo1.png" alt="" id="logo"></a>
<!-- Navigation -->
<?php include 'basic/nav.php'; ?>
<!-- Navigation -->
</div>
<!-- ENDS SIDEBAR -->

<!-- MAIN -->
<div id="main">
<!-- HEADER -->
<div id="header">
<div id="page-title">Marking Scheme</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="index.html">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">Marking</a> </div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->
<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
<!-- TABS -->
<!-- the tabs -->
 <ul class="tabs">
   <li><a href="#">Evaluation Criteria</a></li>
   <li><a href="#">Learning Outcomes</a></li>
   <li><a href="#">Programme Outcomes</a></li>
   <li><a href="#">LO-PO Settings</a></li>
 </ul>
<!-- tab "panes" -->
<div class="panes">
<!-- tab 1 content  -->
<div>
 <p class="info-add" href="#add" data-toggle="modal">Add New Category</p>
            
<!-- Modal HTML -->
<?php include 'modal/newCat.php'?>     
            
<?php
		  
$x = 1;
			
$con = mysqli_connect('localhost', 'root', '', 'postgrad');			
$sql2 = "SELECT * FROM lo_element ORDER BY loID";			
$result2 = mysqli_query($con, $sql2);			
$row2 = mysqli_fetch_assoc($result2);
			
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
  <div class="social"> <a href="#myModal" class="netvibes" data-toggle="modal"></a><?php echo " \t Category: "; echo $row2['categoryName'];?></div>
  </p>

  <!-- Modal HTML -->
   <?php include 'modal/newCriteria.php';?>    

   <?php  if ($noRows)
   { ?>
   <tr>
   	<th>No.</th>
    <th>Criteria</th>
    <th>MARKS</th>
    <th>Percent SV </th>
    <th>Percent EV </th>
    <th></th>
   <tr>
          
   <?php 
					
	$i = 0;	
					
	do { ?>
                
    <tr>
     <td align="center"><?php echo $row['criteriaID']; ?></td>
     <td><?php echo $row['criteria']; ?></td>
     <td align="center"><?php echo $row['markAllocated']; ?></td>
     <?php 
	 $i = $i + 1;
					
	 if ($noRows == $i)
	 {
	 ?>
     <td align="center" style="vertical-align : middle;text-align:center;" rowspan="$noRows">
     <?php echo $row2['percentSV'];?>
     </td>
     <td align="center" style="vertical-align : middle;text-align:center;" rowspan="$noRows">
     <?php echo $row2['percentEV']; ?>
     </td>
     <?php } ?>
    </tr>
<?php } while ($row = mysqli_fetch_assoc($result)); 
   } else 
   		echo "No criteria yet";?>
  </table>
<?php } while ($row2 = mysqli_fetch_assoc($result2)); ?>
        
</div>
<!-- ENDS tab 1 content -->
<!-- tab 2 content  -->
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
  </tr>
                
<?php 
  do { ?>
    <tr>
     <td><?php echo $rowLO['lo_num']; ?></td>
     <td><?php echo $rowLO['lo_desc']; ?></td>
    </tr>
<?php } while ($rowLO = mysqli_fetch_assoc($resultLO)); ?>

 </table>
</div>
<!-- ENDS tab 2 content -->
<!-- tab 3 content  -->
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
  </tr>
                
<?php 
  do { ?>
    <tr>
     <td><?php echo $rowPO['po_num']; ?></td>
     <td><p id="container"><span><?php echo $rowPO['po_desc']; ?></span></p></td>
    </tr>
<?php } while ($rowPO = mysqli_fetch_assoc($resultPO)); ?>

 </table>
</div>
<!-- ENDS tab 3 content -->
          
<!-- tab 4 content  -->
<div>
<?php
 $x = 1;
			
 $con = mysqli_connect('localhost', 'root', '', 'postgrad');			
 $sql2 = "SELECT * FROM lo_element ORDER BY loID";			
 $result2 = mysqli_query($con, $sql2);			
 $row2 = mysqli_fetch_assoc($result2);
			
?>
<?php do { ?>
            
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
     <td align="center"><?php echo $row['markAllocated']; ?></td>
     <td><select name="sv" >
		 <?php
		   $sqlLO = "SELECT * FROM lo_mark";
 		   $resultLO = mysqli_query($con, $sqlLO);
          while ($rowChg = mysqli_fetch_array($resultLO))
          { ?>
           <option value="<?php echo $rowChg['lo_num']?>"><?php echo $rowChg['lo_num']?></option>
          <?php
          }
          ?>        
         </select>
     </td>
    </tr>
<?php } while ($row = mysqli_fetch_assoc($result)); ?>

 </table>
<?php } while ($row2 = mysqli_fetch_assoc($result2)); ?>

</div>
<!-- ENDS tab 4 content -->          
</div>
<!-- ENDS TABS -->
</div>
<!-- ENDS PAGE-CONTENT -->
</div>
<!-- ENDS CONTENT -->
</div>
<!-- ENDS MAIN -->
</div>
<!-- ENDS WRAPPER -->

<!-- FOOTER -->
<?php include 'basic/footer.php'; ?>
<!-- ENDS FOOTER -->

</body>
<script>
    window.onload = function() {
    document.getElementById('container').onclick = function(event) {
        var span, input, text;

        // Get the event (handle MS difference)
        event = event || window.event;

        // Get the root element of the event (handle MS difference)
        span = event.target || event.srcElement;

        // If it's a span...
        if (span && span.tagName.toUpperCase() === "SPAN") {
            // Hide it
            span.style.display = "none";

            // Get its text
            text = span.innerHTML;

            // Create an input
            input = document.createElement("input");
            input.type = "text";
            input.value = text;
            input.size = Math.max(text.length * 3, 4);
            span.parentNode.insertBefore(input, span);

            // Focus it, hook blur to undo
            input.focus();
            input.onblur = function() {
                // Remove the input
                span.parentNode.removeChild(input);

                // Update the span
                span.innerHTML = input.value == "" ? "&nbsp;" : input.value;

                // Show the span again
                span.style.display = "";
			};
        }
    };
};
				</script>
</html>