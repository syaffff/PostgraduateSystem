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

$sql1 = "SELECT DISTINCT studID, studName, course FROM student JOIN project_student USING (studID) JOIN project USING (projectID) JOIN lo_mark_student USING (studID) WHERE projectID=2001 AND semID='$rowSem[details]'";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);

$count = 0;

$tbl .='<h4 style="text-align:center"> PO </h4>

<html>
<body>
<div>

<table border="1" bordercolor="#000000" style="font-size:small">
	<tr>
		<th style="text-align:center; border:none" width="670" colspan="13"></th>
		<th style="text-align:center" width="100" colspan="2">PO1</th>
		<th style="text-align:center" width="100" colspan="2">PO2</th>
		<th style="text-align:center" width="100" colspan="2">PO5</th>
	</tr>
	<tr>
		<th style="text-align:center" width="20">No</th>
		<th style="text-align:center" width="50">Matric No</th>
		<th style="text-align:center" width="100">Name</th>
		<th style="text-align:center" width="50">Course</th>
		<th style="text-align:center" width="50">LO1 (Supervisor)</th>
		<th style="text-align:center" width="50">LO2 (Supervisor)</th>
		<th style="text-align:center" width="50">LO3 (Supervisor)</th>
		<th style="text-align:center" width="50">LO1 (Evaluator 1)</th>
		<th style="text-align:center" width="50">LO2 (Evaluator 1)</th>
		<th style="text-align:center" width="50">LO3 (Evaluator 1)</th>
		<th style="text-align:center" width="50">LO1 (Evaluator 2)</th>
		<th style="text-align:center" width="50">LO2 (Evaluator 2)</th>
		<th style="text-align:center" width="50">LO3 (Evaluator 2)</th>
		<th style="text-align:center" width="50">LO1</th>
		<th style="text-align:center" width="50">%</th>
		<th style="text-align:center" width="50">LO2</th>
		<th style="text-align:center" width="50">%</th>
		<th style="text-align:center" width="50">LO3</th>
		<th style="text-align:center" width="50">%</th>
	</tr>';

do {

	$lo1 = 0;
	$lo2 = 0;
	$lo3 = 0;
	$count = $count + 1;
	
	$tbl .='
		<tr>
			<td>'.$count.'</td>
			<td>'.$row1['studID'].'</td>
			<td>'.$row1['studName'].'</td>
			<td>'.$row1['course'].'</td>';
	
	$sqlSV = "SELECT * FROM student JOIN lo_mark_student USING (studID) WHERE studID='$row1[studID]' AND posID=1003 ORDER BY lo_num";
	$resultSV = mysqli_query($con, $sqlSV);
	$rowSV = mysqli_fetch_assoc($resultSV);
	
	$sqlEV1 = "SELECT * FROM student JOIN lo_mark_student USING (studID) WHERE studID='$row1[studID]' AND posID=1002 ORDER BY lo_num";
	$resultEV1 = mysqli_query($con, $sqlEV1);
	$rowEV1 = mysqli_fetch_assoc($resultEV1);
	
	$sqlEV2 = "SELECT * FROM student JOIN lo_mark_student USING (studID) WHERE studID='$row1[studID]' AND posID=1004 ORDER BY lo_num";
	$resultEV2 = mysqli_query($con, $sqlEV2);
	$rowEV2 = mysqli_fetch_assoc($resultEV2);
	
	$sqlMark = "SELECT * FROM student JOIN lo_mark_student_total USING (studID) WHERE studID='$row1[studID]' ORDER BY lo_num";
	$resultMark = mysqli_query($con, $sqlMark);
	$rowMark = mysqli_fetch_assoc($resultMark);
	
	do {
	
	$mark = number_format($rowSV['lo_mark'], 1);	
	$tbl .='
			<td>'.$mark.'</td>';
			
		} while ($rowSV = mysqli_fetch_assoc($resultSV));
			
	do {
		
	$mark = number_format($rowEV1['lo_mark'], 1);	
	$tbl .='
			<td>'.$mark.'</td>';
			
		} while ($rowEV1 = mysqli_fetch_assoc($resultEV1));
			
	do {
	
	$mark = number_format($rowEV2['lo_mark'], 1);	
	$tbl .='
			<td>'.$mark.'</td>';
			
		} while ($rowEV2 = mysqli_fetch_assoc($resultEV2));
	
	do {
	
	$total = number_format($rowMark['totalMark'], 1);
	$percent = number_format($rowMark['percentage'], 1);
	$tbl .='
			<td>'.$total.'</td>
			<td>'.$percent.'</td>';
			
			
		} while ($rowMark = mysqli_fetch_assoc($resultMark));
				
	$tbl .='
		</tr>';
	
} while ($row1 = mysqli_fetch_assoc($result1));


$tbl .='
</table>

<p>
Number of students achieve PO	  : <br>
Percentage of students achieve PO : 
</p>

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