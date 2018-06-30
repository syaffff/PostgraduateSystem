<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php
if (!isset($_SESSION)) 
{
	session_start();
}

if(!$_SESSION['login']){
   header("location:../../login/index.php");
   die;
}

$id = $_SESSION["id"];
?>
</head>

<body>
<!-- WRAPPER -->
<div id="wrapper">
<!-- SIDEBAR -->
<div id="sidebar">
<!-- logo -->
<a href="index.html"><img src="../../left/img/logo1.png" alt="" id="logo"></a>
<!-- Navigation -->
<?php include '../basic/nav.php'; ?>
<!-- Navigation -->
</div>
<!-- ENDS SIDEBAR -->

<!-- MAIN -->
<div id="main">
<!-- HEADER -->
<div id="header">
<div id="page-title">Marking Scheme</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="#">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">Marking</a> </div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->
<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
<!-- TABS -->
<!-- the tabs -->
 <ul class="tabs">
   <li><a href="#">Category-Criteria</a></li>
   <li><a href="#">Learning Outcomes</a></li>
   <li><a href="#">Programme Outcomes</a></li>
   <li><a href="#">LO-Criteria Settings</a></li>
   <li><a href="#">PO-LO Settings</a></li>
   <li><a href="#">Form Preview</a></li>
 </ul>
<!-- tab "panes" -->
<div class="panes">

<!-- tab 1 content  -->
	<?php include 'tab/lo_po1.php'; ?>
<!-- ENDS tab 1 content -->

<!-- tab 2 content  -->
	<?php include 'tab/lo_po2.php'; ?>
<!-- ENDS tab 2 content -->

<!-- tab 3 content  -->
	<?php include 'tab/lo_po3.php'; ?>
<!-- ENDS tab 3 content -->
          
<!-- tab 4 content  -->
	<?php include 'tab/lo_po4.php'; ?>
<!-- ENDS tab 4 content --> 

<!-- tab 5 content  -->
	<?php include 'tab/lo_po5.php'; ?>
<!-- ENDS tab 5 content --> 

<!-- tab 6 content  -->
	<?php  include 'tab/lo_po6.php'; ?>
<!-- ENDS tab 6 content --> 

</div>
<!-- ENDS TABS -->
</div>
<!-- ENDS PAGE-CONTENT -->
</div>
<!-- ENDS CONTENT -->
</div>
<!-- ENDS MAIN -->
</div>
<!-- ENDS WRAPPER -->

<!-- FOOTER -->
<?php include '../basic/footer.php'; ?>
<!-- ENDS FOOTER -->

</body>
</html>