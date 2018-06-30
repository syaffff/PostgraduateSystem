<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

if (isset($_GET['courseID'])) 
{
    $courseID = $_GET['courseID'];
}

$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sql = "UPDATE course SET courseStatus='INACTIVE' WHERE courseID='$courseID'";
			if(mysqli_query($con, $sql))
			{ ?>
				 <script>
				  alert('Success delete course');
				  window.location.href='course.php';
				  </script>
				<?php
			} else
			{?>
				 <script>
				  alert('Fail to delete course');
				  window.location.href='course.php';
				  </script>
				<?php
			}
?>
</body>
</html>