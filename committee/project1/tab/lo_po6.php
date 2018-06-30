<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div class="two-third">
    <p class="download-box" onclick="click1()">Category Form (Supervisor)</p>
    <p class="download-box" onclick="click2()">Category Form (Evaluator)</p>
    <p class="download-box" onclick="click3()">Summary</p>
    <p class="download-box" onclick="click4()">Summary LO PO</p>
    <p class="download-box" onclick="click5()">Analysis LO</p>
    <p class="download-box" onclick="click6()">Analysis PO</p>
    <p class="download-box" onclick="click7()">Analysis LO PO</p>
</div>

<script>
function click1() {
	window.location.href = "print/catSV.php";
}

function click2() {
	window.location.href = "print/catEV.php";
}

function click3() {
	window.location.href = "print/summary.php";
}

function click4() {
	window.location.href = "print/summary_lo_po.php";
}

function click5() {
	window.location.href = "print/lo.php";
}

function click6() {
	window.location.href = "print/po.php";
}

function click7() {
	window.location.href = "print/lopo.php";
}


</script>

</body>
</html>