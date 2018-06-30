<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include '../basic/import.php'; ?>
<title>Untitled Document</title>
</head>

<body>
 <!-- WRAPPER -->
 <div id="wrapper">
  <!-- SIDEBAR -->
  <div id="sidebar">
   <!-- logo -->
   <a href="#"><img src="../../left/img/logo1.png" alt="" id="logo"></a>
    <!-- Navigation -->
     <?php include '../basic/nav.php'; ?>
    <!-- Navigation -->
   </div>
   <!-- ENDS SIDEBAR -->
  
   <!-- MAIN -->
   <div id="main">
    <!-- HEADER -->
    <div id="header">
     <div id="page-title">Assignment</div>
     <!-- Breadcrumb-->
     <div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
      <a href="#">Assign</a> 
     </div>
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
         <!-- ADD NEW STUDENT -->
         <a style="float:right" class="link-button netvibes" data-toggle="modal" href="#myModal"><span>Add New Student</span></a>
        </div>
       </form>
     <!-- ENDS search -->
         
<?php

    //show all unassigned students
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT DISTINCT studID, studName, course FROM student WHERE studName NOT IN (SELECT DISTINCT studName FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID)) ORDER BY studName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
    	<br />
        <h3> Unassigned Students </h3>
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th></th>
            </tr>
            
            <?php
			do {
			?>
            <tr>
            	<td><?php echo $row['studName']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><a href="assignM1.php?studID=<?php echo $row['studID']; ?>"><img src="../../left/img/mono-icons/pencilplus32.png" /></a></td>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
          </tbody>
        </table>
        

<?php
	}
    //show all assigned students
	$sql = "SELECT DISTINCT studID, studName, course, title FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) ORDER BY studName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
    	<br />
        <h3> Assigned Students </h3>
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th></th>
            </tr>
            
            <?php
			do {
			?>
            <tr>
            	<td><?php echo $row['studName']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <input id="studID" name="studID" type="hidden" value="<? echo $row['studID'] ?>" />
                <td><a href="assignM2.php?studID=<?php echo $row['studID']; ?>"><img src="../../left/img/mono-icons/linedpaperpencil32.png" /></a></td>
                <?php include '../project1/modal/viewSV.php';?>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
          </tbody>
        </table>
        
		
	<?php	
	}

if (isset($_GET["query"]))
{
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT DISTINCT studName, course, title FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studName LIKE UPPER('%$_GET[query]%') OR course LIKE UPPER('%$_GET[query]%')";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
    	<br />
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th>Title</th>
                <th></th>
            </tr>
            
            <?php
			do {
			?>
            <tr>
            	<td><?php echo $row['studName']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><?php echo $row['title']; ?></td>
                <td></td>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
          </tbody>
        </table>
		
	<?php	
	} else
	{
		echo "\n\n\n";
		echo "No results found";
	}
	
}

?>

<!-- Modal HTML -->
<?php include '../project1/modal/newStud.php';?>
        
</div>
<!-- ENDS PAGE-CONTENT -->
</div>
<!-- ENDS CONTENT -->
</div>
<!-- ENDS MAIN -->
</div>
<!-- ENDS WRAPPER -->

<!-- FOOTER -->
<?php include '../basic/footer.php'; ?>
<!-- ENDS FOOTER -->

</body>
</html>