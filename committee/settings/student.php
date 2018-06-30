<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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

include '../basic/import.php'; 
?>

<title>Untitled Document</title>
<style>
.aa {
	background:transparent;
}
table.all {
    visibility:collapse;
}

.hidden-form {
	visibility:hidden;
}

.show-form {
	visibility:visible !important;
}
</style>
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
     <div id="page-title">Student</div>
     <!-- Breadcrumb-->
    <div id="breadcrumbs"> You are here: <a href="#">Home</a>  &raquo; <a href="#">Settings</a> &raquo; 
      <a href="#">Student</a> 
     </div>
     <!-- ENDS Breadcrumb-->
    </div>
    <!-- ENDS HEADER -->

    <!-- CONTENT -->
    <div id="content">
     <!-- PAGE CONTENT -->
     <div id="page-content">
     
     <!-- search -->
    <form  method="post" id="searchform" >
     <div>
       <input type="text" placeholder="Search" name="query"  onFocus="defaultInput(this)" onBlur="clearInput(this)"/>
       <input type="submit" name="search" class="fa" style="font-size:20px" value="&#xf002;"/>
     </div>
    </form>
    <!-- ENDS search -->
    
    <!-- ADD NEW STUDENT -->
    <a style="float:right" class="link-button netvibes" data-toggle="modal" href="#myModal"><span>Add New Student</span></a>
    <?php include '../project1/modal/newStud.php'; ?>
   
    
    <?php
		
	echo '<img src="../../left/img/mono-icons/linedpapercheck32.png"/> : Project Completed &nbsp; &nbsp;'; 
	echo '<img src="../../left/img/mono-icons/linedpaper32.png"/> : Project Not Yet Completed &nbsp; &nbsp;';
	echo '<img src="../../left/img/mono-icons/linedpaperplus32.png"/> : Project Not Yet Registered <br>';
		
    if(isset($_POST["search"]))
	{
		$query = $_POST["query"];
		
		$sql = "SELECT DISTINCT studID, studName, course FROM student WHERE studID LIKE UPPER('%$query%') OR studName LIKE UPPER('%$query%') OR course LIKE UPPER('%$query%') ORDER BY studName ASC";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if ($row)
		{
			echo "<table>";
			echo "<tr>";
			echo "<th>"; echo "Name"; echo "</th>";
			echo "<th>"; echo "Course"; echo "</th>";
			echo "<th>"; echo "Project 1"; echo "</th>";
			echo "<th>"; echo "Project 2"; echo "</th>";
			echo "</tr>";
			
			do
			{
				$x = $row["studID"];
				echo "<tr>";
				echo "<td>"; echo $row["studName"]; echo "</td>";
				echo "<td>"; echo $row["course"]; echo "</td>";
				
				$sqlCheck1 = "SELECT DISTINCT studID FROM student JOIN project_student USING (studID) WHERE studID='$row[studID]' AND projectID = '2001'";
				$sqlCheck2 = "SELECT DISTINCT studID FROM student JOIN project_student USING (studID) WHERE studID='$row[studID]' AND projectID = '2002'";
				$resultCheck1 = mysqli_query($con, $sqlCheck1);
				$resultCheck2 = mysqli_query($con, $sqlCheck2);
				$rowCheck1 = mysqli_fetch_assoc($resultCheck1);
				$rowCheck2 = mysqli_fetch_assoc($resultCheck2);
				
				if ($rowCheck1)
				{
					echo "<td>"; 
					echo '<button href="#view1'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpapercheck32.png"/> View details</button>'; 
					echo "</td>";
					include "../project1/modal/viewProj1Details.php";
				}
				else
				{
					echo "<td>"; 
					echo '<button href="#add1'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaperplus32.png"/> Add details</button>'; 
					echo "</td>";
					include "../project1/modal/addProj1Details.php";
				}
				
				if ($rowCheck2)
				{
					echo "<td>"; 
					echo '<button href="#view2'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpapercheck32.png"/> View details</button>'; 
					echo "</td>";
					include "../project1/modal/viewProj2Details.php";
				}
				
				
				else
				{
					echo "<td>"; 
					echo '<button href="#add2'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaperplus32.png"/> Add details</button>'; 
					echo "</td>";
					include "../project1/modal/addProj2Details.php";
				}				
				
				echo "</tr>";
				
			} while ($row = mysqli_fetch_assoc($result));
			
			echo "</table>";
		}
		
		else
			echo "<br><br>No results found.";
	}
	
	?>
    
    <br />
    <br />
       
     <!-- show all student -->
        <?php
		
		$sql = "SELECT DISTINCT studID, studName, course FROM student ORDER BY studName ASC";
		$result = mysqli_query($con, $sql);
		$row = mysqli_fetch_assoc($result);
		
		if(mysqli_query($con, $sql))
		{ ?>
			<div id="all" class="show-form"> 
			<table>
			
			<?php
			echo "<tr>";
			echo "<th>"; echo "Name"; echo "</th>";
			echo "<th>"; echo "Course"; echo "</th>";
			echo "<th>"; echo "Project 1"; echo "</th>";
			echo "<th>"; echo "Project 2"; echo "</th>";
			echo "</tr>";
			
			do
			{
				$x = $row["studID"];
				echo "<tr>";
				echo "<td>"; echo $row["studName"]; echo "</td>";
				echo "<td>"; echo $row["course"]; echo "</td>";
				
				$sqlCheck1 = "SELECT DISTINCT studID FROM student JOIN project_student USING (studID) WHERE studID='$row[studID]' AND projectID = '2001'";
				$sqlCheck2 = "SELECT DISTINCT studID FROM student JOIN project_student USING (studID) WHERE studID='$row[studID]' AND projectID = '2002'";
				$resultCheck1 = mysqli_query($con, $sqlCheck1);
				$resultCheck2 = mysqli_query($con, $sqlCheck2);
				$rowCheck1 = mysqli_fetch_assoc($resultCheck1);
				$rowCheck2 = mysqli_fetch_assoc($resultCheck2);
				
				if ($rowCheck1)
				{
					echo "<td>"; 
					echo '<button href="#view1'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpapercheck32.png"/> View details</button>'; 
					echo "</td>";
					include "../project1/modal/viewProj1Details.php";
				}
				else
				{
					echo "<td>"; 
					echo '<button href="#add'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaperplus32.png"/> Add details</button>'; 
					echo "</td>";
				}
				
				if ($rowCheck2)
				{
					echo "<td>"; 
					echo '<button href="#view2'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpapercheck32.png"/> View details</button>'; 
					echo "</td>";
					include "../project1/modal/viewProj2Details.php";
				}
				
				
				else
				{
					echo "<td>"; 
					echo '<button href="#add'.$x.'" class="btn aa" data-toggle="modal"><img src="../../left/img/mono-icons/linedpaperplus32.png"/> Add details</button>'; 
					echo "</td>";
				}				
				
				echo "</tr>";
				
			} while ($row = mysqli_fetch_assoc($result));
			
			
		}
		?>
        </table>
        </div>
        
       
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
 <script>
	$('.fa').click(function() {
		$(this).next().toggleClass('hide-form');
	});
	
	
	</script>