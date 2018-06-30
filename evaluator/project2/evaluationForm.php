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

if (isset($_GET['id'])) 
{
    $studID = $_GET['id'];
}
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
<div id="page-title">Evaluation Form</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Project 2</a> &raquo; 
<a href="#">Evaluation</a>  &raquo; <a href="#">Evaluation Form</a> 
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
$sqlStud = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE lectID='$id' AND (posID=1002 OR posID=1004) AND semester='$rowSem[details]' AND studID='$studID'";
$resultStud = mysqli_query($con, $sqlStud);
$rowStud = mysqli_fetch_assoc($resultStud);
$countStud = mysqli_num_rows($resultStud);

$sqlSV = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$studID' AND semester='$rowSem[details]' AND posID=1003";
$resultSV = mysqli_query($con, $sqlSV);
$rowSV = mysqli_fetch_assoc($resultSV);

$sqlEV1 = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$studID' AND semester='$rowSem[details]' AND posID=1002";
$resultEV1 = mysqli_query($con, $sqlEV1);
$rowEV1 = mysqli_fetch_assoc($resultEV1);

$sqlEV2 = "SELECT * FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$studID' AND semester='$rowSem[details]' AND posID=1004";
$resultEV2 = mysqli_query($con, $sqlEV2);
$rowEV2 = mysqli_fetch_assoc($resultEV2);

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

echo '<p>';
echo '<b>Name: </b>'.$rowStud['studName'].'<br>';
echo '<b>Supervisor: </b>'.$rowSV['lectName'].'<br>';
echo '<b>Evaluator 1: </b>'.$rowEV1['lectName'].'<br>';
echo '<b>Evaluator 2: </b>'.$rowEV2['lectName'].'<br>';
echo '<br>';

echo '<b>Title: </b>'.$rowStud['title'].'<br>';
echo '<b>Course: </b>'.$rowStud['course'].'<br>';
echo '</p>';
echo '<br>';

$x = 1;
$xx = 0;
				
$sql2 = "SELECT * FROM lo_element ORDER BY loID";			
$result2 = mysqli_query($con, $sql2);			
$row2 = mysqli_fetch_assoc($result2);
$edit = 0;

echo '<form>';	
do { 
            
  echo '<table>';
  
  $sql = "SELECT * FROM lo_element JOIN lo_criteria USING (loID) WHERE loID = $x";
  $result = mysqli_query($con, $sql);
  $row = mysqli_fetch_assoc($result);
  $x = $x + 1;
  $noRows = mysqli_num_rows($result);
  
  if ($noRows)
  {
   echo '<tr>';
    echo '<th width="900">'.$row2['categoryName'].'</th>';
    echo '<th width="30">MARKS</th>';
    echo '<th width="50" style="text-align:center">'.$row2['percentEV'].'% </th>';
   echo '</tr>';
    			
	$i = 0;	
					
	do {    
    echo '<tr>';
     echo '<td>'.++$edit.'.  '.$row['criteria'].'<b> ('.$row['markAllocated'].'M)</b></td>';
     echo '<td><input type=number style="width: 50px" required /></td>';
	 echo '<td rowspan="'.$noRows.'"></td>';
    echo '</tr>';

	 } while ($row = mysqli_fetch_assoc($result)); 
	 
	 $edit = 0;
   } else 
   		echo "No criteria yet";
  echo '</table>';
  
  $xx++;} while ($row2 = mysqli_fetch_assoc($result2));
  
  echo '<input style="float:right" type="button" value="Submit"';

echo '</form>';

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
	window.location.href = "student.php";
}
</script>

</body>
</html>