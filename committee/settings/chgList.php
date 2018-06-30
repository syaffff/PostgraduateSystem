<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

if (isset($_GET['lectID'])) 
{
    $lectID = $_GET['lectID'];
}

$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sql = "UPDATE lecturer SET status='ACTIVE' WHERE lectID=$lectID";
			if(mysqli_query($con, $sql))
			{ ?>
				 <script>
				  alert('Success activate lecturer');
				  window.location.href='list_sv_ev.php';
				  </script>
				<?php
			} else
			{?>
				 <script>
				  alert('Fail to activate lecturer');
				  window.location.href='list_sv_ev.php';
				  </script>
				<?php
			}
?>
</body>
</html>