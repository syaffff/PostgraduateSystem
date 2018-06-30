<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <?php include '../basic/import.php'; ?>
    <title>Untitled Document</title>
</head>

<body>
<?php
if (isset($_GET['studID'])) 
{
    $studID = $_GET['studID'];
}
?>
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
     
     <?php
    //show all unassigned students
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT * FROM lecturer WHERE status = 1 ORDER BY lectName ASC";	
	$sql2 = "SELECT * FROM student JOIN project_student USING (studID) WHERE studID = '$studID'";
	$result2 = mysqli_query($con, $sql2);
	$row2 = mysqli_fetch_assoc($result2);
	?>
    
     <!-- form -->
        <h3>ASSIGN SUPERVISOR AND EVALUATORS</h3>
        <p>Student's Name: <span><?php echo $row2["studName"]; ?></span></p>
        <form id="contactForm" action="" method="post">
          <fieldset>
            <div>
              <label>Supervisor</label>
                <select name="sv" >
				<?php
				$result = mysqli_query($con, $sql); 
                while ($row = mysqli_fetch_array($result))
                { ?>
                    <option value="<?php echo $row['lectID']?>"><?php echo $row['lectName']?></option>
                <?php
                }
                ?>        
                </select>
            </div>
            <div>
              <label>Evaluator 1</label>
              <select name="ev1" >
				<?php 
				$result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))
                { ?>
                    <option value="<?php echo $row['lectID']?>"><?php echo $row['lectName']?></option>
                <?php
                }
                ?>        
                </select>
            </div>
            <div>
              <label>Evaluator 2</label>
              <select name="ev2" >
				<?php 
				$result = mysqli_query($con, $sql);
                while ($row = mysqli_fetch_array($result))
                { ?>
                    <option value="<?php echo $row['lectID']?>"><?php echo $row['lectName']?></option>
                <?php
                }
                ?>        
                </select>
            </div>
            <p>
              <input type="button" value="ADD" name="submit" id="submit">
            </p>
          </fieldset>
        </form>
        <!-- ENDS form -->
        
        <?php
		
		if(isset($_POST["submit"]))
		{
			$con = mysqli_connect('localhost', 'root', '', 'postgrad');
			
			$sqlsv = "INSERT INTO mark_student (titleID, lectID, postID) VALUES ('$row2[titleID]', '$_POST[sv]', '1003')";
			$sqlev1 = "INSERT INTO mark_student (titleID, lectID, postID) VALUES ('$row2[titleID]', '$_POST[ev1]', '1002')";
			$sqlev2 = "INSERT INTO mark_student (titleID, lectID, postID) VALUES ('$row2[titleID]', '$_POST[ev2]', '1002')";
			
			if(mysqli_query($con, $sqlsv) && mysqli_query($con, $sqlev1) && mysqli_query($con, $sqlev2))
			{
				echo "<script type='text/javascript'>alert('successfully assigned');</script>";
				
			} else
			{
				echo "<script type='text/javascript'>alert('fail to assign');</script>";
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
</html>
