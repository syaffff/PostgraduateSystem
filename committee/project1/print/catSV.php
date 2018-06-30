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

$sql2 = "SELECT * FROM lo_element ORDER BY loID";			
$result2 = mysqli_query($con, $sql2);			
$row2 = mysqli_fetch_assoc($result2);
$edit = 0;
$x = 1;
$xx = 0;
$loop1 ='';
$loop2 ='';
$loop3 ='';

$tbl .='<p align="right">MITU 5213: PROJECT 1 (SUPERVISOR) </p>

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
		';

do {
	$loop1 .='<table>'; 
	
	$x = $x + 1;
	
	$sql = "SELECT * FROM lo_element JOIN lo_criteria USING (loID) WHERE loID = $x";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$noRows = mysqli_num_rows($result);
	
	if ($noRows)
		$loop1 .='<tr>
				<th>'.$row2['categoryName'].'</th>
				<th>MARKS</th>
				<th>'.$row2['percentSV'].'</th>
				<th></th>
			    </tr>';
	
	
	do {
	
		$loop2 .= '<tr>
					<td>'.$row['criteria'].'</td>
					<td>'.$row['markAllocated'].'</td>
					<td></td>
				 </tr>';
		$edit++;
		
		} while ($row = mysqli_fetch_assoc($result));
		
	$loop3 .='</table>';
	$xx++;
	
	} while ($row2 = mysqli_fetch_assoc($result2));

$tbl .= $loop1;
$tbl .= $loop2;
$tbl .= $loop2;

$tbl .= '

</div>
</body>
</html> ';

$pdf->writeHTML($tbl, true, false, false, false, '');
ob_end_clean();
$pdf->Output('categorySupervisor.pdf', 'I');
?>

<body>
</body>
</html>