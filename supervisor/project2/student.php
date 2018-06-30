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
<div id="page-title">Student</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Project 2</a> &raquo; 
<a href="#">Student</a> 
</div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->

<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
<?php
$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sqlStud = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE lectID='$id' AND posID=1003 AND semester='$rowSem[details]'";
$resultStud = mysqli_query($con, $sqlStud);
$rowStud = mysqli_fetch_assoc($resultStud);
$countStud = mysqli_num_rows($resultStud);

if ($countStud)
{
	echo '<table>';
	do
	{
		$sqlLoop = "SELECT * FROM student JOIN project_student USING (studID) WHERE projectID=2001 AND studID='$rowStud[studID]'";
		$resultLoop = mysqli_query($con, $sqlLoop);
		$rowLoop = mysqli_fetch_assoc($resultLoop);
		
		$x = $rowStud["studID"];
		
		echo "<tr>";
		  echo "<th>Name</th>";
		  echo "<th style='text-align:center' width='30'>Project</th>";
		  echo "<th style='text-align:center' width='30'>Presentation</th>";
		  echo "<th style='text-align:center' width='30'>Mark</th>";
		echo "</tr>";
		
		echo "<tr>";
		  echo "<td>"; echo $rowStud['studName']; echo "</td>";
		  
		  echo "<td>";
		  echo '<button href="#view1'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaper32.png"/> View details</button>';
		  include "../project1/modal/viewStudentDetails.php";
		  echo "</td>";
		  
		  echo "<td>";
		  echo '<button href="#present'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaper32.png"/> View details</button>';
		  include "../project1/modal/viewPresentDetails.php";
		  echo "</td>";
		  
		  echo "<td>";
		  echo '<button href="#mark'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaper32.png"/> View details</button>';
		  include "../project1/modal/viewMarkDetails.php";
		  echo "</td>";
		  
		echo "</tr>'";
		
	} while ($rowStud = mysqli_fetch_assoc($resultStud));
	
	echo '</table>';
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