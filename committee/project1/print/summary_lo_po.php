<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>


<?php
    
require_once('E:\xampp\htdocs\postgrad\tcpdf\tcpdf.php');

include '../../basic/import.php';

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


$pdf->AddPage();

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$pdf->SetCreator(PDF_CREATOR);

$con = mysqli_connect('localhost', 'root', '', 'postgrad');

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

$sqlLO = "SELECT * FROM lo_mark ORDER BY lo_num";
$resultLO = mysqli_query($con, $sqlLO);
$rowLO = mysqli_fetch_assoc($resultLO);
$norowsLO = mysqli_num_rows($resultLO);

$tbl .='<p align="center">SUMMARY LO PO </p>

<html>
<body>
<div>

<b>
		<p>Student : </p>
		<p>Supervisor : </p>
		<p>Evaluator 1 : </p>
		<p>Evaluator 2 : </p>
		
		<p>Title : </p>
		<p>Program : </p>
</b>

<table border="1" bordercolor="#000000">
	<tr>
		<th style="text-align:center" width="100">LEARNING OUTCOME</th>
		<th style="text-align:center" width="80">ITEM</th>
		<th style="text-align:center" width="80">SUPERVISOR</th>
		<th style="text-align:center" width="80">EVALUATOR 1</th>
		<th style="text-align:center" width="80">EVALUATOR 2</th>
		<th style="text-align:center" width="80">TOTAL/LO</th>
		<th style="text-align:center" width="50">TOTAL</th>
		<th style="text-align:center" width="50">GRADE</th>
	</tr>';

do {
	
$tbl .= '
	<tr>
		<td style="text-align:center" rowspan="2">'. $rowLO['lo_num'].'</td>
		<td style="text-align:center" rowspan="2"> xxx </td>
		<td style="text-align:center">(xx%)</td>
		<td style="text-align:center">(xx%)</td>
		<td style="text-align:center">(xx%)</td>
		<td style="text-align:center" rowspan="2"> 0.0 </td>
		<td style="text-align:center" rowspan="6"> E </td>
		<td style="text-align:center" rowspan="6"> E </td>
	</tr>
	<tr>
		<td style="text-align:center">xx</td>
		<td style="text-align:center">xx</td>
		<td style="text-align:center">xx</td>
	</tr>
	';
   } while ($rowLO = mysqli_fetch_assoc($resultLO));

$tbl .='
</table>
</div>
</body>
</html>
';



$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('summary.pdf', 'I');
?>

<body>
</body>
</html>