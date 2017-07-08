<?php
require("../connect.php");
session_start();
$id = explode(",",$_SESSION['instructor']);
echo "Hi ".$id[0].",".$id[1];
echo"<br>";
if(isset($_SESSION['instructor'])){


?>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
	<title></title>
</head>
<body>
	<a href="studentlogs.php">View logs of Students this day</a>
<?php


echo "<h1> LIST OF STUDENTS</h1>";
$logs = mysqli_query($con,"SELECT * FROM `students`  where adviser_id = $id[2]");

if($logs->num_rows > '0'){
echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        		<th>Time Schedule</th>
				<th>Schedule</th>		
				</tr>	

			";
			while($rows = mysqli_fetch_assoc($logs)){
				$idnumber = $rows['idnumber'];
				$lastname = $rows['lastname'];
				$firstname = $rows['firstname'];
				$course = $rows['course'];
				$year = $rows['year'];
				$schedule = $rows['day_schedule'];
				$time = $rows['time_schedule'];

					echo "<tr>
					          <td>$idnumber</td>
					          <td>$lastname, $firstname</td>	
					          <td>$course</td>
					          <td>$year</td>
                    		  <td>$time</td>
					          <td>$schedule</td>
					          </tr>";

			}
			echo "</table>";
}else{
	echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        		<th>Time Schedule</th>
				<th>Schedule</th>		
				</tr>";	

}

}else{
	header("location:index.php");
}


?>
</body>
</html>