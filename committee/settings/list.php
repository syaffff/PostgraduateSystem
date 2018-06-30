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
<div id="page-title">List of Supervisors and Evaluators</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="index.html">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">List</a> </div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->
<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
	<!-- search -->
       <form  method="get" id="searchform" >
        <div>
         <input type="text" value="Search..." name="query"  onFocus="defaultInput(this)" onBlur="clearInput(this)">
         <input type="submit" name="searchsubmit" value=" ">
        </div>
       </form>
       <!-- ADD NEW LECTURER -->
         <a style="float:right" class="link-button netvibes" data-toggle="modal" href="#myModal"><span>Add New Lecturer</span></a>
         <?php include 'modal/newLect.php'; ?>
     <!-- ENDS search -->
     <h4>Supervisors and Evaluators</h4>
<?php

	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE posID = '1003' ORDER BY lectName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
?>
	<p><?php// echo "No of Supervisors: "; echo $count; ?></p>
<?php
	
	$sql = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE posID = '1002' ORDER BY lectName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
?>
	<p><?php// echo "No of Evaluators: "; echo $count; ?></p>
    
<?php
	
	//$sql = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) WHERE posID = '1002' OR posID = '1003' ORDER BY lectName ASC";
	$sql = "SELECT * FROM lecturer ORDER BY status ASC, lectName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
        
		<table>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Status</th>
                <th></th>
            </tr>
            
            <?php
			do {
			?>
            <tr>
            	<td><?php echo $row['lectName']; ?></td>
                <td><?php echo $row['status']; ?></td>
                <?php if ($row['status'] == "ACTIVE")
				{ ?>
                <td><a href="delList.php?lectID=<?php echo $row['lectID']; ?>" onclick="return confirm('Deactivate this lecturer's status?')"><img src="../left/img/mono-icons/stop32.png"/></a></td>
                <?php
				}
                else if($row['status'] == "INACTIVE")
				{ ?>
                <td><a href="chgList.php?lectID=<?php echo $row['lectID']; ?>" onclick="return confirm('Activate this lecturer's status?')"><img src="../left/img/mono-icons/wand32.png" /></a></td>
                <?php } ?>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
        </table>
	<?php	
	}
?>

<p></p>
         
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
</html>