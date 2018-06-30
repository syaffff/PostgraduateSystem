<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php

if (isset($_GET['po_num'])) 
{
    $po_num = $_GET['po_num'];
}

$con = mysqli_connect('localhost', 'root', '', 'postgrad');
$sql = "DELETE FROM po_mark WHERE po_num='$po_num'";
			if(mysqli_query($con, $sql))
			{ ?>
				 <script>
				  alert('Success delete PO');
				  window.location.href='lo_po.php';
				  </script>
				<?php
			} else
			{?>
				 <script>
				  alert('Fail to delete PO');
				  window.location.href='lo_po.php';
				  </script>
				<?php
			}
?>
</body>
</html>