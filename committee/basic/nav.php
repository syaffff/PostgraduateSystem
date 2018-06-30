<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?php include 'import.php'; ?>
</head>

<body>

    <?php
		$con = mysqli_connect('localhost', 'root', '', 'postgrad');
		$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
		$resultSem = mysqli_query($con, $sqlSem);
		$rowSem = mysqli_fetch_assoc($resultSem);
		
		$sql = "SELECT * FROM lecturer WHERE lectID='$id'";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		
		 $sqlSV = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE lectID='$id' AND posID=1003";
		 $resultSV = mysqli_query($con, $sqlSV);
		 $countSV = mysqli_num_rows($resultSV);
		 
		 $sqlEV = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE lectID='$id' AND (posID=1002 OR posID=1004)";
		 $resultEV = mysqli_query($con, $sqlEV);
		 $countEV = mysqli_num_rows($resultEV);	
	?>
    <b><h5 align="center"><?php echo $row["lectName"]; ?></h5></b>
    <b><h5 align="center">Committee
    
      <div class="dropdown">
      <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">
      <span class="caret"></span></button>
      <ul class="dropdown-menu" style="color:#630" >
      	<?php if($countSV)
        		echo '<li><a href="../../supervisor/project1/student.php">Supervisor</a></li>';
			  if($countEV)
        		echo '<li><a href="../../evaluator/project1/student.php">Evaluator</a></li>';
		?>
      </ul>
    </div>
    </h5>
    </b>
    
    <br />
    
    <h5 align="center">Current Semester: </h5>
	<p align="center"><?php echo $rowSem["details"]; ?></p>
    
 <ul id="nav" class="sf-menu sf-vertical">
      <li><a href="#">Settings</a>
      	<ul>
            <li><a href="../settings/semester.php">Semester</a></li>
            <li><a href="../settings/course.php">Course</a></li>
            <li><a href="../settings/list_sv_ev.php">Lecturer</a></li>
            <li><a href="../settings/student.php">Student</a></li>
        </ul>
      </li>
      <li><a href="#">Project 1</a>
      	<ul>
            <li><a href="../project1/lo_po.php">Marking</a></li>
            <li><a href="../project1/present.php">Presentation</a></li>
            <li><a href="../project1/supervisor.php">Supervisor</a></li>
            <li><a href="../project1/evaluator.php">Evaluator</a></li>
            <li><a href="../project1/report.php">Report</a></li>
        </ul>
      </li>
      <li><a href="#">Project 2</a>
        <ul>
            <li><a href="#">Marking</a></li>
            <li><a href="#">Presentation</a></li>
            <li><a href="#">Supervisor</a></li>
            <li><a href="#">Evaluator</a></li>
            <li><a href="#">Report</a></li>
        </ul>
      </li>
      <li><a href="#">Proposal Defense</a>
        <ul>
            <li><a href="#">Master</a></li>
            <li><a href="#">PHD</a></li>
            <li><a href="#">Report</a></li>
        </ul>
      </li>
      <li>
      	<a href="../../logout.php" onclick="return confirm('Are you sure to logout?');">Logout  <i class="fa fa-sign-out"></i></a>
      </li>      
    </ul> 
    
    <br />
    <br />
    <br />
    
</body>
</html>