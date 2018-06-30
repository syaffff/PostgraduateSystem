<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<?php
$con = mysqli_connect('localhost', 'root', '', 'postgrad');

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sql);
$rowSem = mysqli_fetch_assoc($result);

$sql = "";
$result = mysqli_query($con, $sql);

?>
<table border="1" bordercolor="#000000">
	<tr>
		<th style="text-align:center" width="20">No</th>
		<th style="text-align:center" width="80">Matric No</th>
		<th style="text-align:center" width="110">Student Name</th>
		<th style="text-align:center" width="50">Subject</th>
		<th style="text-align:center" width="50">Course</th>
		<th style="text-align:center" width="150">Project Title</th>
		<th style="text-align:center" width="100">Supervisor</th>
		<th style="text-align:center" width="100">Evaluator 1</th>
		<th style="text-align:center" width="100">Evaluator 2</th>
		<th style="text-align:center" width="80">Time</th>
		<th style="text-align:center" width="80">Room</th>
	</tr>
	<tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>

</table>

</body>
</html>