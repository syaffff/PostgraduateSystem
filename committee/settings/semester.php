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
<link rel="stylesheet" href="http://code.jquery.com/ui/1.9.1/themes/base/jquery-ui.css" />
<script src="http://code.jquery.com/ui/1.9.1/jquery-ui.js"></script>
<title>Untitled Document</title>
</head>

<body>
 <!-- WRAPPER -->
 <div id="wrapper">
  <!-- SIDEBAR -->
  <div id="sidebar">
   <!-- logo -->
   <a href="index.html"><img src="../../left/img/logo1.png" alt="" id="logo"></a>
    <!-- Navigation -->
     <?php include '../basic/nav.php'; ?>
    <!-- Navigation -->
   </div>
   <!-- ENDS SIDEBAR -->
  
   <!-- MAIN -->
   <div id="main">
    <!-- HEADER -->
    <div id="header">
     <div id="page-title">Semester</div>
     <!-- Breadcrumb-->
     <div id="breadcrumbs"> You are here: <a href="#">Home</a>  &raquo; <a href="#">Settings</a> &raquo; 
      <a href="#">Semester</a> 
     </div>
     <!-- ENDS Breadcrumb-->
    </div>
    <!-- ENDS HEADER -->

    <!-- CONTENT -->
    <div id="content">
     <!-- PAGE CONTENT -->
     <div id="page-content">
     <!-- set semester -->
        <?php
		
		$con = mysqli_connect('localhost', 'root', '', 'postgrad');
		$sql = "SELECT * FROM semester WHERE semID = 'currSem'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		
		$minYear = date("Y")-1;
		?>
        <h4>Current Semester: <?php echo $row["details"];  ?></h4>
        <br />
        <br />
        <form id="contactForm" action="" method="post">
          <fieldset>
            <div>
            <p>
              <label>Semester: </label>
              <select name="sem"  class="form-control" style="width: 150px;" required>
              	<option value="">Select</option>
              	<option value="1" >1</option>
                <option value="2" >2</option>
                <option value="KHAS" >KHAS</option>
              </select>
              
              <label>Year</label>
              <?php include 'yearPicker.php'; ?>
              
              
              <br />
              
               <input type="submit" value="SET" name="submit" id="submit" />
            </p>
            </div>
          </fieldset>
        </form>
        <!-- ENDS set semester -->
      
        <?php
			if(isset($_POST["submit"]))
			{
				$semesterNew = "";
				$semesterNew .= $_POST["sem"];
				$semesterNew .= "-";
				$semesterNew .= $_POST["year1"];
				$semesterNew .= "/";
				$semesterNew .= $_POST["year2"];
				
				echo $semesterNew;
				
				
				$sqlUpdate = "UPDATE semester SET details = '$semesterNew' WHERE semID='currSem'";
				
				if(mysqli_query($con, $sqlUpdate))
				{
					echo "<script type='text/javascript'>alert('Success edit semester.');</script>";
					echo "<script type='text/javascript'>window.location.href='semester.php';</script>";
				}
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
<script type="text/javascript">
      $('.date-own').datepicker({
         minViewMode: 2,
         format: 'yyyy'
       });
	   
	   $(function() { 
    $("#datepicker1").datepicker({ dateFormat: 'yy' });
});
  </script>
</html>