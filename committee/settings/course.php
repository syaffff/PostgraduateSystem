<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php 
if (!isset($_SESSION)) 
{
	session_start();
}

if(!$_SESSION['login']){
   header("location:../../login/index.php");
   die;
}

$id = $_SESSION["id"];

include '../basic/import.php'; 
?>

<!-- YEAR PICKER -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
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
     <div id="page-title">Main</div>
     <!-- Breadcrumb-->
    <div id="breadcrumbs"> You are here: <a href="#">Home</a>  &raquo; <a href="#">Settings</a> &raquo; 
      <a href="#">Course</a> 
     </div>
     <!-- ENDS Breadcrumb-->
    </div>
    <!-- ENDS HEADER -->

    <!-- CONTENT -->
    <div id="content">
     <!-- PAGE CONTENT -->
     <div id="page-content">
      
         <p class="info-add" href="#addCourse" data-toggle="modal">Add New Course</p>
                 
         <!-- Modal HTML -->
         <?php include '../project1/modal/newCourse.php'?>     
         <!-- ENDS Modal HTML -->
         
    	<!-- list of courses -->
        <br />
        <h3>Active Course</h3>
        <?php
		
		$con = mysqli_connect('localhost', 'root', '', 'postgrad');
		$sql = "SELECT * FROM course WHERE courseStatus='ACTIVE'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if(mysqli_query($con, $sql))
		{
			echo "<table>";
			echo "<tr>";
			echo "<th>"; echo "Course ID"; echo "</th>";
			echo "<th>"; echo "Course Name"; echo "</th>";
			echo "<th>"; echo "</th>";
			echo "<th>"; echo "</th>";
			echo "</tr>";
			
			$i = 0;
			do
			{
				echo "<tr>";
				echo "<td>"; echo $row["courseID"]; echo "</td>";
				echo "<td>"; echo $row["courseName"]; echo "</td>";
				echo '<td><a href="#editCourse'.$i.'" data-toggle="modal"><img src="../../left/img/mono-icons/wand32.png" /></a></td>'; ?>
				
				 <!-- Modal Update -->
				 <?php echo '<div id="editCourse'.$i.'" class="modal fade">'; ?>
                 <div class="modal-dialog modal-login">
                  <div class="modal-content">
                    <form action="" method="post">
                      <div class="modal-header">				
                        <h4 class="modal-title">Update Course</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                      </div>
                      
                      <div class="modal-body">				
                        <div class="form-group">
                        <label>Course ID</label>
                        <input type="textarea" value="<?php echo $row['courseID']; ?>" name="courseID" class="form-control" required="required">
                        </div>
                        
                        <div class="form-group">
                        <label>Course Name</label>
                        <input type="textarea" value="<?php echo $row['courseName']; ?>" name="courseName" class="form-control" required="required">
                        </div>
                      </div>
                      
                      <input type="hidden" value="<?php echo $row['courseID']; ?>" name="test" />
                      
                      <div class="modal-footer">
                         <?php echo '<input type="submit" name="editCourse" class="btn btn-primary pull-right" value="Update">' ?>
                      </div>
                    </form>
                  </div>
                 </div>
                 
                 <?php
                 if(isset($_POST["editCourse"])  && $_POST["test"]==$row['courseID'])
                 {		
                    $sqlEdit = "UPDATE course SET courseID=UPPER('$_POST[courseID]'), courseName=UPPER('$_POST[courseName]') WHERE courseID='$row[courseID]'";
                                
                    if (mysqli_query($con, $sqlEdit))
                    {
                        echo "<script type='text/javascript'>alert('success edit course');</script>";
                        echo "<script type='text/javascript'> window.location.href='course.php';</script>";
                    }
                    else
                    {
                        echo "<script type='text/javascript'>alert('fail edit course');</script>";
                    }
                  } ?>                 
				
				<td><a href="delCourse.php?courseID=<?php echo $row["courseID"]; ?>" onclick="return confirm('Delete this course from list?')"><img src="../../left/img/mono-icons/stop32.png"/></a></td>
                <?php
				echo "</tr>";
				$i++;				
			} while($row = mysqli_fetch_assoc($result));
			
			echo "</table>";
		}
		?>
        
        <br />
        <h3>Inactive Course</h3>
        <?php
		
		$sql2 = "SELECT * FROM course WHERE courseStatus='INACTIVE'";
		$result2 = mysqli_query($con, $sql2);
		$row2 = mysqli_fetch_assoc($result2);
		
		if(mysqli_query($con, $sql2) && $row2)
		{
			echo "<table>";
			echo "<tr>";
			echo "<th>"; echo "Course ID"; echo "</th>";
			echo "<th>"; echo "Course Name"; echo "</th>";
			echo "<th>"; echo "</th>";
			echo "</tr>";
			
			do
			{
				echo "<tr>";
				echo "<td>"; echo $row2["courseID"]; echo "</td>";
				echo "<td>"; echo $row2["courseName"]; echo "</td>";
			?>
				<td><a href="readdCourse.php?courseID=<?php echo $row2["courseID"]; ?>" onclick="return confirm('Add this course to list?')"><img src="../../left/img/mono-icons/plus32.png"/></a></td>
                <?php
				echo "</tr>";
			} while($row2 = mysqli_fetch_assoc($result2));
			
			echo "</table>";
		} else
		{ ?>
        	<h4>No inactive course</h4>
          <?php
		}
		?>
     
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