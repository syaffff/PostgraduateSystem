<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

if (isset($_GET['loID'])) 
{
    $loID = $_GET['loID'];
}

$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sql1 = "DELETE FROM lo_criteria WHERE loID='$loID'";
$sql2 = "DELETE FROM lo_element WHERE loID='$loID'";
			if(mysqli_query($con, $sql1) && mysqli_query($con, $sql2))
			{ ?>
				 <script>
				  alert('Success delete criteria');
				  window.location.href='../lo_po.php';
				  </script>
				<?php
			} else
			{?>
				 <script>
				  alert('Fail to delete criteria');
				  window.location.href='../lo_po.php';
				  </script>
				<?php
			}
?>
</body>
</html>