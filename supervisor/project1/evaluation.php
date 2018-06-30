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
<div id="page-title">Evaluation</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">Evaluation</a> 
</div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->

<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
<?php
$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sqlStud = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE lectID='$id' AND posID=1003 AND semester='$rowSem[details]'";
$resultStud = mysqli_query($con, $sqlStud);
$rowStud = mysqli_fetch_assoc($resultStud);
$countStud = mysqli_num_rows($resultStud);

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

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
		  echo "<th>Course</th>";
		  echo "<th></th>";
		echo "</tr>";
		
		echo "<tr>";
		  echo "<td>"; echo $rowStud['studName']; echo "</td>";
		  echo "<td>"; echo $rowStud['course']; echo "</td>";
		  
		  echo "<td>";
		  echo '<a class="link-button-dark" href="evaluationForm.php?id='.$rowStud['studID'].'"><span>Marking Form</span></a>';
		  echo "</td>";
		  
		  echo '<div class="clear"></div>';
		  
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

<script>
function click1() {
	window.location.href = "markingForm.php?studID='$rowStud[studID]'";
}
</script>

</body>
</html>