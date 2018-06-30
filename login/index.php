<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Login</title>
  <link rel="stylesheet" href="css/style.css">
  <?php include 'css/import.php'; ?>
</head>

<body>
<div class="container">
	<section id="content">
		<form action="" method="post">
			<h1>Login</h1>
			<div>
				<input type="text" placeholder="Staff ID" name="id" required />
			</div>
			<div>
				<input type="password" placeholder="Password" name="password" required />
			</div>
			<div>
				<input type="submit" value="Log in" name="submit" />
				<a href="#">Forgot password?</a>
			</div>
		</form><!-- form -->
	</section><!-- content -->
</div><!-- container -->

<?php 
if (isset($_POST["submit"]))
{
	$id = $_POST["id"];
	$password = $_POST["password"];
	
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT * FROM lecturer WHERE lectID='$id' AND password='$password'";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if($count)
	{
		 ?>
		<script>
        $(function() {
        $("#position").modal();//if you want you can have a timeout to hide the window after x seconds
        });
        </script>
        
         <!-- Modal -->
		<div id="position" class="modal fade">
		 <div class="modal-dialog modal-login">
		  <div class="modal-content">
			<div class="modal-header">				
			 <h4 class="modal-title">Select Role</h4>
			 <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="modal-body">
            
            <form action="../committee/settings/semester.php" method="post">				
			 <button id="committee">Committee</button>
            </form>
            
            <form action="../supervisor/project1/student.php" method="post">
			 <button id="sv">Supervisor</button>
            </form>
            
            <form action="../evaluator/project1/student.php" method="post">
			 <button id="ev">Evaluator</button>
            </form>
            
			</div>
		  </div>
		 </div>
         </div>
		 
         <?php
		 $sqlCommittee = "SELECT * FROM lecturer WHERE lectID='$id' AND committee='YES'";
		 $resultCommittee = mysqli_query($con, $sqlCommittee);
		 $countCommittee = mysqli_num_rows($resultCommittee);
		 
		 $sqlSV = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE lectID='$id' AND posID=1003";
		 $resultSV = mysqli_query($con, $sqlSV);
		 $countSV = mysqli_num_rows($resultSV);
		 
		 $sqlEV = "SELECT * FROM lecturer JOIN mark_student USING (lectID) WHERE lectID='$id' AND (posID=1002 OR posID=1004)";
		 $resultEV = mysqli_query($con, $sqlEV);
		 $countEV = mysqli_num_rows($resultEV);
		 
		 if ($countCommittee)
		 	echo "<script type='text/javascript'>document.getElementById('committee').disabled = false;</script>";
		 else
		 	echo "<script type='text/javascript'>document.getElementById('committee').disabled = true;</script>";
			
		if ($countSV)
		 	echo "<script type='text/javascript'>document.getElementById('sv').disabled = false;</script>";
		 else
		 	echo "<script type='text/javascript'>document.getElementById('sv').disabled = true;</script>";
			
		if ($countEV)
		 	echo "<script type='text/javascript'>document.getElementById('ev').disabled = false;</script>";
		 else
		 	echo "<script type='text/javascript'>document.getElementById('ev').disabled = true;</script>";
		 
		 session_start();
		 
		 $_SESSION["id"] = $id;
		 $_SESSION['login'] = true;
		 
	} else
	{
		 echo "<script type='text/javascript'>alert('fail login');</script>";
	}
	
}

?>
</body>
</html>