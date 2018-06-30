<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<form action="" method="post">
	<input type="text" name="id" placeholder="Staff ID" />
    <input type="password" name="password" placeholder="password" />
    
    <input type="submit" value="Login" name="submit"/>
</form>

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
	
	echo $count;
	if($count)
	{
		 session_start();
		 $_SESSION["id"] = $id;
		 echo "<script type='text/javascript'>alert('success login');</script>";
		 echo "<script type='text/javascript'> window.location.href='project1/student.php';</script>";
		 
	} else
	{
		 echo "<script type='text/javascript'>alert('fail login');</script>";
	}
	
}

?>
</body>
</html>