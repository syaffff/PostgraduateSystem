<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
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
?>
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
<div id="page-title">Supervisor</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="index.html">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">Supervisor</a> </div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->
<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
	<!-- search -->
    <form  method="post" id="searchform" >
     <div>
       <input type="text" placeholder="Search" name="query"  onFocus="defaultInput(this)" onBlur="clearInput(this)"/>
       <input type="submit" name="search" class="fa" style="font-size:20px" value="&#xf002;"/>
     </div>
    </form>
    <!-- ENDS search -->
<?php

$con = mysqli_connect('localhost', 'root', '', 'postgrad');

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

//sql all unassigned students
$sqlUn = "SELECT DISTINCT studID, studName, course FROM student WHERE semID='$rowSem[details]' AND projectID='2001' AND studName NOT IN (SELECT DISTINCT studName FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID)) ORDER BY studName ASC";
$resultUn = mysqli_query($con, $sqlUn);
$rowUn = mysqli_fetch_assoc($resultUn);
$countUn = mysqli_num_rows($resultUn);

//sql all assigned students
$sql = "SELECT DISTINCT studID, studName, course, title FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID)  WHERE semID='$rowSem[details]' AND projectID='2001' ORDER BY studName ASC";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);
$count = mysqli_num_rows($result);


if ($count)
	{
		echo '
    	<br />
        <h3> Unassigned Students </h3>
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th></th>
            </tr>';
            
			do {
			
			echo '	
            <tr>
            	<td>'.$rowUn["studName"].'</td>
                <td>'.$rowUn["course"].'</td>
                <td><a href="assignM1.php?studID='.$rowUn["studID"].'"><img src="../../left/img/mono-icons/pencilplus32.png" /></a></td>
            </tr> ';
			
			} while ($rowUn = mysqli_fetch_assoc($resultUn));
			
			echo '
          </tbody>
        </table> ';
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