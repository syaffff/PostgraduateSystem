<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>

@import url(https://fonts.googleapis.com/css?family=Open+Sans);

body{
  background: #f2f2f2;
  font-family: 'Open Sans', sans-serif;
}

.search {
  width: 100%;
  position: relative
}

.searchTerm {
  float: left;
  width: 100%;
  border: 3px solid #00B4CC;
  padding: 5px;
  height: 20px;
  border-radius: 5px;
  outline: none;
  color: #9DBFAF;
}

.searchTerm:focus{
  color: #00B4CC;
}

.searchButton {
  position: absolute;  
  right: -50px;
  width: 40px;
  height: 36px;
  border: 1px solid #00B4CC;
  background: #00B4CC;
  text-align: center;
  color: #fff;
  border-radius: 5px;
  cursor: pointer;
  font-size: 20px;
}

/*Resize the wrap to see the search bar change!*/
.wrap{
  width: 30%;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

</style>
</head>

<body>

<div class="wrap">
   <div class="search">
   	  <form id = "search" method="get">
      <input type="text" class="searchTerm" name="query" placeholder="What are you looking for?">
      <button type="submit" class="searchButton" name="search">
        <i class="fa fa-search"></i>
     </button>
     </form>
   </div>
</div>

<?php

if (isset($_GET["query"]))
{
	$con = mysqli_connect('localhost', 'root', '', 'postgrad');
	$sql = "SELECT DISTINCT studName, course, title FROM student JOIN project_student USING (studID) JOIN mark_student USING (titleID) JOIN lecturer USING (lectID) WHERE studName LIKE UPPER('%$_GET[query]%') OR course LIKE UPPER('%$_GET[query]%')";
	$result = mysqli_query($con, $sql);
	$row = mysqli_fetch_assoc($result);
	$count = mysqli_num_rows($result);
	
	if ($count)
	{ ?>
		<table>
        	<tr>
            	<th>Name</th>
                <th>Course</th>
                <th>Title</th>
                <th></th>
            </tr>
            
            <?php
			do {
			?>
            <tr>
            	<th><?php echo $row['studName']; ?></th>
                <th><?php echo $row['course']; ?></th>
                <th><?php echo $row['title']; ?></th>
                <th></th>
            </tr>            
            <?php
			
			} while ($row = mysqli_fetch_assoc($result))
			?>
        </table>
		
	<?php	
	} else
	{
		echo "No results found";
	}
	
}

?>
</body>
</html>