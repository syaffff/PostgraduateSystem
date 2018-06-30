<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
.div2 {
    width: 300px;
    height: 100px;    
    padding: 50px;
    border: 1px solid red;
}
</style>
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


$pdf->AddPage();

$pdf->Write(0, '', '', 0, 'L', true, 0, false, false, 0);

$pdf->SetFont('helvetica', '', 8);

$pdf->SetCreator(PDF_CREATOR);

$con = mysqli_connect('localhost', 'root', '', 'postgrad');

$sqlSem = "SELECT * FROM semester WHERE semID = 'currSem'";
$resultSem = mysqli_query($con, $sqlSem);
$rowSem = mysqli_fetch_assoc($resultSem);

$sql2 = "SELECT * FROM lo_element ORDER BY loID";			
$result2 = mysqli_query($con, $sql2);			
$row2 = mysqli_fetch_assoc($result2);

$tbl .='<p align="right">PROJECT 1 SUMMARY </p>

<html>
<body>
<div>

<p>
		<b>Student : </b> <br>
		<b>Supervisor : </b> <br>
		<b>Evaluator 1 : </b> <br>
		<b>Evaluator 2 : </b> <br><br>
		
		<b>Title : </b> <br><br>
		<b>Program : </b> <br><br>
		</p>

<table border="1" bordercolor="#000000">
	<tr>
		<th style="text-align:center" width="100"></th>
		<th style="text-align:center" width="80">SUPERVISOR</th>
		<th style="text-align:center" width="80">EVALUATOR 1</th>
		<th style="text-align:center" width="80">EVALUATOR 2</th>
		<th style="text-align:center" width="80">EVALUATOR (Average)</th>
		<th style="text-align:center" width="50">TOTAL</th>
		<th style="text-align:center" width="50">GRADE</th>
	</tr>';

do {
	
$tbl .= '
	<tr>
		<td style="text-align:center" rowspan="2">'. $row2['categoryName'].'</td>
		<td style="text-align:center">('. $row2['percentSV'].'%)</td>
		<td style="text-align:center">('. $row2['percentEV'].'%)</td>
		<td style="text-align:center">('. $row2['percentEV'].'%)</td>
		<td style="text-align:center">('. $row2['percentEV'].'%)</td>
		<td style="text-align:center" rowspan="5"> 0.0 </td>
		<td style="text-align:center" rowspan="5"> E </td>
	</tr>
	<tr>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
	</tr>
	';
   } while ($row2 = mysqli_fetch_assoc($result2));
   
$tbl .='
	<tr>
		<td style="text-align:center"> SUBTOTAL </td>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
		<td style="text-align:center"> 0.0 </td>
	</tr>';

$tbl .='
</table>

<br><br><br>

<p>Comments/ Remarks: </p>

<div class="div2"></div>

<p>Signature & Stamp,</p><br>

<p>Supervisor: </p><br><br><br><br>
<p>Evaluator 1: </p><br><br><br><br>
<p>Evaluator 2: </p><br><br><br><br>
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