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
<a href="#"><img src="../../left/img/logo1.png" alt="" id="logo"></a>
<!-- Navigation -->
<?php include '../basic/nav.php'; ?>
<!-- Navigation -->
</div>
<!-- ENDS SIDEBAR -->
  
<!-- MAIN -->
<div id="main">
<!-- HEADER -->
<div id="header">
<div id="page-title">Report</div>
<!-- Breadcrumb-->
<div id="breadcrumbs"> You are here: <a href="index.html">Home</a> &raquo; <a href="#">Project 1</a> &raquo; 
<a href="#">Report</a> </div>
<!-- ENDS Breadcrumb-->
</div>
<!-- ENDS HEADER -->
<!-- CONTENT -->
<div id="content">
<!-- PAGE CONTENT -->
<div id="page-content">
<!-- search -->
<form  method="get" id="searchform" >
 <div>
   <input type="text" value="Search..." name="query"  onFocus="defaultInput(this)" onBlur="clearInput(this)">
   <input type="submit" name="search" value=" ">
 </div>
</form>
<!-- ENDS search -->
         
<?php
/*
if (isset($_GET["query"]))
{
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT DISTINCT studName, course, title FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studName LIKE UPPER('%$_GET[query]%') OR course LIKE UPPER('%$_GET[query]%')";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
    	<p>Search result for: <?php echo $_GET["query"];?> </p>
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th>Details</th>
            </tr>
            
            <?php
			do
			{
				$x = 0;
				$sqlCheck = "SELECT DISTINCT studID FROM student JOIN project_student USING (studID) WHERE studID='$row[studID]' AND projectID = '2001'";
				$resultCheck = mysqli_query($con, $sqlCheck);
				$rowCheck = mysqli_fetch_assoc($resultCheck);
				?>
            <tr>
            	<td><?php echo $row['studName']; ?></td>
                <td><?php echo $row['course']; ?></td>
                <td><a href="delList.php?studID=<?php echo $row['studID']; ?>"><img src="../../left/img/mono-icons/wand32.png"/></a></td>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
          </tbody>
        </table>
		
	<?php	
	} else
	{
		echo "No results found";
	}	
} */
/*
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT DISTINCT studID, studName, course, title, titleID FROM student JOIN project_student USING (studID) WHERE projectID = '2001' ORDER BY studName ASC";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
    	<br />
        <form action="print/printPresent.php" method="post" name="printForm">
        	 <input type="submit"  name="submitpdf" value="Print" class="btn btn-default">
        </form>
        <br />
		<table>
          <tbody>
        	<tr style="text-align:center">
            	<th>Name</th>
                <th>Course</th>
                <th></th>
            </tr>
            
            <?php				
			$x = 0;
			do 
			{
				$sqlCheck = "SELECT DISTINCT studID, studName, course, title FROM student JOIN project_student USING (studID) JOIN present USING (titleID) WHERE studID='$row[studID]' AND projectID = '2001'";
				$resultCheck = mysqli_query($con, $sqlCheck);
				$rowCheck = mysqli_fetch_assoc($resultCheck);
				
			echo "<tr>";
            	echo "<td>"; echo $row['studName']; echo "</td>";
                echo "<td>"; echo $row['course']; echo "</td>";
				
				if($rowCheck)
				{
					echo "<td>";
					echo '<button href="#viewPresent'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/check32.png"/> View details</button>'; 
					echo "</td>";
					include "modal/viewPresent.php";
				}
				else
				{
					echo "<td>"; 
					echo '<button href="#addPresent'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaperplus32.png"/> Add details</button>'; 
					echo "</td>"; 
					
					include "modal/addPresent.php";
					?>
                    
					
					
			<?php	}
				
            echo "<tr>";
			
			$x++;
			} while ($row = mysqli_fetch_assoc($result))
			?>
          </tbody>
        </table>
		<?php
	}
*/
?>
        
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