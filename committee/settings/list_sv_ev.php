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
<div id="page-title">List of Supervisors and Evaluators</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Settings</a> &raquo; 
<a href="#">Lecturer</a> </div>
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
	
	?>

	 <!-- search -->
    <form  method="post" id="searchform" >
     <div>
       <input type="text" placeholder="Search" name="query"  onFocus="defaultInput(this)" onBlur="clearInput(this)"/>
       <input type="submit" name="search" class="fa" style="font-size:20px" value="&#xf002;"/>
     </div>
    </form>
    
    <?php	
    if(isset($_POST["search"]))
	{
		$query = $_POST["query"];
		
		$sqlSearch = "SELECT * FROM lecturer WHERE lectID LIKE UPPER('%$query%') OR lectName LIKE UPPER('%$query%') ORDER BY status ASC, lectName ASC";
		$resultSearch = mysqli_query($con, $sqlSearch);
		$rowSearch = mysqli_fetch_assoc($resultSearch);
		
		if($rowSearch)
		{
			echo '<table>';
			echo '
				  <tr>
					  <th style="text-align:center" rowspan="2">Name</th>
					  <th style="text-align:center" colspan="2">Project 1</th>
					  <th style="text-align:center" colspan="2">Project 2</th>
					  <th style="text-align:center" rowspan="2"></th>
				  </tr>
				  <tr>
					  <th style="text-align:center">Supervisor</th>
					  <th style="text-align:center">Evaluator</th>
					  <th style="text-align:center">Supervisor</th>
					  <th style="text-align:center">Evaluator</th>
				  </tr>
			  ';
			
			do
			{
				if ($rowSearch["status"]=="ACTIVE")
				{
					$sql1 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowSearch[lectID]' AND posID='1003' AND projectID='2001' AND semID='$rowSem[details]'";
					$sql2 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowSearch[lectID]' AND (posID='1002' OR posID='1004') AND projectID='2001' AND semID='$rowSem[details]'";
					$sql3 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowSearch[lectID]' AND posID='1003' AND projectID='2002' AND semID='$rowSem[details]'";
					$sql4 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowSearch[lectID]' AND (posID='1002' OR posID='1004') AND projectID='2002' AND semID='$rowSem[details]'";
					
					$result1 = mysqli_query($con, $sql1);
					$result2 = mysqli_query($con, $sql2);
					$result3 = mysqli_query($con, $sql3);
					$result4 = mysqli_query($con, $sql4);
					
					$count1 = mysqli_num_rows($result1);
					$count2 = mysqli_num_rows($result2);
					$count3 = mysqli_num_rows($result3);
					$count4 = mysqli_num_rows($result4);
						
					echo '
					<tr>
						<td>'.$rowSearch['lectName'].'</td>';
						
						if ($count1) echo '<td style="text-align:center; color:black">'.$count1.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';
						if ($count2) echo '<td style="text-align:center; color:black">'.$count2.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';
						if ($count3) echo '<td style="text-align:center; color:black">'.$count3.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';
						if ($count4) echo '<td style="text-align:center; color:black">'.$count4.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>'; 
						
					echo '<td style="text-align:center"><a href="delList.php?lectID='.$rowSearch['lectID'].'" onclick="return confirm("Inactivate this lecturer?")"><img src="../../left/img/knobs-icons/Knob Remove Red.png"/></a></td> 
					
					</tr>';
					
					
				} else if ($rowSearch["status"]=="INACTIVE")
				{
					echo '
					<tr>
						<td>'.$rowSearch['lectName'].'</td>
						<td style="text-align:center">-</td>
						<td style="text-align:center">-</td>
						<td style="text-align:center">-</td>
						<td style="text-align:center">-</td>
						
						<td style="text-align:center"><a href="chgList.php?lectID='.$rowSearch['lectID'].'" onclick="return confirm("Activate this lecturer?")"><img src="../../left/img/knobs-icons/Knob Add.png"/></a></td>
					</tr>
					';
				}
			} while ($rowSearch = mysqli_fetch_assoc($resultSearch));
			
			echo '</table>';
		} else
			echo "No results found.";
	}
		
		
	?>
    <!-- ENDS search -->
    
    
   <!-- ADD NEW LECTURER -->
     <a style="float:right" class="link-button netvibes" data-toggle="modal" href="#myModal"><span>Add New Lecturer</span></a>
     <?php include '../project1/modal/newLect.php'; ?>
   <!-- ENDS add new lecturer -->
    
<?php
	
	//$sql = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) WHERE posID = '1002' OR posID = '1003' ORDER BY lectName ASC";
	
	//show all list 
	$sql = "SELECT * FROM lecturer ORDER BY status ASC, lectName ASC";
	$sqlActive = "SELECT * FROM lecturer WHERE status='ACTIVE' ORDER BY status ASC, lectName ASC";
	$sqlInactive = "SELECT * FROM lecturer WHERE status='INACTIVE' ORDER BY status ASC, lectName ASC";
	
	$result = mysqli_query($con, $sql);
	$resultActive = mysqli_query($con, $sqlActive);
	$resultInactive = mysqli_query($con, $sqlInactive);
	
	$row = mysqli_fetch_assoc($result);
	$rowActive = mysqli_fetch_assoc($resultActive);
	$rowInactive = mysqli_fetch_assoc($resultInactive);
	
	$count = mysqli_num_rows($result);
	$countActive = mysqli_num_rows($resultActive);
	$countInactive = mysqli_num_rows($resultInactive);	
		
	if ($countActive)
	{ ?>
    	<br />
        <h4>Status: Active</h4>
        <p>Total: <?php echo $countActive; ?></p>
		<table>
        	<tr>
            	<th style="text-align:center" rowspan="2">Name</th>
                <th style="text-align:center" colspan="2">Project 1</th>
                <th style="text-align:center" colspan="2">Project 2</th>
                <th style="text-align:center" rowspan="2"></th>
            </tr>
            <tr>
            	<th style="text-align:center">Supervisor</th>
                <th style="text-align:center">Evaluator</th>
                <th style="text-align:center">Supervisor</th>
                <th style="text-align:center">Evaluator</th>
            </tr>
            
            <?php
			do {
						
			$sql1 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowActive[lectID]' AND posID='1003' AND projectID='2001' AND semID='$rowSem[details]'";
			$sql2 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowActive[lectID]' AND (posID='1002' OR posID='1004') AND projectID='2001' AND semID='$rowSem[details]'";
			$sql3 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowActive[lectID]' AND posID='1003' AND projectID='2002' AND semID='$rowSem[details]'";
			$sql4 = "SELECT DISTINCT lectName FROM lecturer JOIN mark_student USING (lectID) JOIN project_student USING (titleID) WHERE lectID='$rowActive[lectID]' AND (posID='1002' OR posID='1004') AND projectID='2002' AND semID='$rowSem[details]'";
			
			$result1 = mysqli_query($con, $sql1);
			$result2 = mysqli_query($con, $sql2);
			$result3 = mysqli_query($con, $sql3);
			$result4 = mysqli_query($con, $sql4);
			
			$count1 = mysqli_num_rows($result1);
			$count2 = mysqli_num_rows($result2);
			$count3 = mysqli_num_rows($result3);
			$count4 = mysqli_num_rows($result4);
			
			?>
            <tr>
               	<td><?php echo $rowActive['lectName']; ?></td>
                
                <?php if ($count1) echo '<td style="text-align:center; color:black">'.$count1.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';?>
                <?php if ($count2) echo '<td style="text-align:center; color:black">'.$count2.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';?>
                <?php if ($count3) echo '<td style="text-align:center; color:black">'.$count3.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';?>
                <?php if ($count4) echo '<td style="text-align:center; color:black">'.$count4.'</td>'; else echo '<td style="text-align:center; color:black">				0</td>';?> 
                <td style="text-align:center"><a href="delList.php?lectID=<?php echo $rowActive['lectID']; ?>" onclick="return confirm('Inactivate this lecturer?')"><img src="../../left/img/knobs-icons/Knob Remove Red.png"/></a></td>      
            <?php
			
			} while ($rowActive = mysqli_fetch_assoc($resultActive))
			?>
        </table>
	<?php	
	}
	
	if ($countInactive)
	{ ?>
    	<br />
        <h4>Status: Inactive</h4>
        <p>Total: <?php echo $countInactive; ?></p>
		<table>
        	<tr>
            	<th style="text-align:center">Name</th>
                <th></th>
            </tr>
                       
            <?php
			do {			
			?>
            <tr>
               	<td><?php echo $rowInactive['lectName']; ?></td>
                <td style="text-align:center"><a href="chgList.php?lectID=<?php echo $rowInactive['lectID']; ?>" onclick="return confirm('Activate this lecturer?')"><img src="../../left/img/knobs-icons/Knob Add.png"/></a></td>      
            <?php
			
			} while ($rowInactive = mysqli_fetch_assoc($resultInactive))
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
<?php include '../basic/footer.php'; ?>
<!-- ENDS FOOTER -->

</body>
</html>