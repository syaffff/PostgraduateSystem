<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<?php
    
require_once('E:\xampp\htdocs\postgrad\tcpdf\tcpdf.php');

include '../basic/import.php';

$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);


$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));


$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);


$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);


$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);


$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);


$pdf->SetFont('helvetica', 'B', 20);


$pdf->AddPage('L');

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$pdf->SetCreator(PDF_CREATOR);

$con = mysqli_connect('localhost', 'root', '', 'postgrad');

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

$sql1 = "SELECT * FROM student JOIN project_student USING (studID) JOIN present USING (titleID) JOIN project USING (projectID) ORDER BY date ASC, timeStart ASC";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$count = 0;

$tbl .='<h4>PRESENTATION SCHEDULE (MITU5213 & MITU5226) SEM '.$rowSem['details'].' </h4>

<html>
<body>
<div>

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
	</tr>';

do {
	
$count++;
$tbl .= '
	<tr>
		<td style="font-size:small; text-align:center">'. $count.'</td>
		<td style="font-size:small; text-align:center">'. $row1['studID'].'</td>
		<td style="font-size:small">'. $row1['studName'].'</td>
		<td style="font-size:small; text-align:center">'. $row1['description'].'</td>
		<td style="font-size:small; text-align:center">'. $row1['course'].'</td>
		<td style="font-size:small">'. $row1['title'].'</td>';
		
$sqlSV = "SELECT * FROM project_student JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$row1[studID]' AND posID=1003";
$resultSV = mysqli_query($con, $sqlSV);
$rowSV = mysqli_fetch_assoc($resultSV);

$sqlEV = "SELECT * FROM project_student JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$row1[studID]' AND posID=1002";
$resultEV = mysqli_query($con, $sqlEV);
$rowEV = mysqli_fetch_assoc($resultEV);

$sqlEV2 = "SELECT * FROM project_student JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studID='$row1[studID]' AND posID=1004";
$resultEV2 = mysqli_query($con, $sqlEV2);
$rowEV2 = mysqli_fetch_assoc($resultEV2);

$tbl .= '
		<td style="font-size:small">'. $rowSV['lectName'] .'</td>
		<td style="font-size:small">'. $rowEV['lectName'] .'</td>
		<td style="font-size:small">'. $rowEV2['lectName'] .'</td> ';
		
$start = $row1['timeStart'];
//$start ->setTimeZone(new DateTimeZone('UTC'));

$end = $row1['timeEnd'];
//$end ->setTimeZone(new DateTimeZone('UTC'));
	
$tbl .= '
		<td style="font-size:small">'. $start.' - '. $end.'</td>
		<td style="font-size:small">'. $row1['place'].'</td>
	</tr> ';
	 } while ($row1 = mysqli_fetch_assoc($result1));

$tbl .='
</table>

</div>
</body>
</html>
';



$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('PresentationSchedule.pdf', 'I');
?>

<body>
</body>
</html>