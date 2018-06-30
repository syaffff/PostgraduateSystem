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

$sql1 = "SELECT * FROM student JOIN project_student USING (studID) JOIN present USING (titleID) JOIN project USING (projectID)";
$result1 = mysqli_query($con, $sql1);
$row1 = mysqli_fetch_assoc($result1);
$count = 0;

$tbl .='<h4 style="text-align:center"> LO PO </h4>

<b>
<p>Learning Outcomes (LO) and Programme Outcomes (PO) Assessment</p>
<p>Subject MITU5226 (PROJECT 1)</p>
<p>'.$rowSem['details'].'</p>

</b>

<html>
<body>
<div>

<table border="1" bordercolor="#000000" style="font-size:small">
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
		<th style="text-align:center" width="50">LO2</th>
		<th style="text-align:center" width="50">LO3</th>
		<th style="text-align:center" width="50">%</th>
		<th style="text-align:center" width="50">%</th>
		<th style="text-align:center" width="50">%</th>
	</tr>';

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