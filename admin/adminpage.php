<?php
require("../connect.php");
session_start();
if (isset($_SESSION['username'])) {
	
	  echo"Hi! ". $_SESSION['username'];
	
}else{
	header("location: index.php");
}

$sql = mysqli_query($con,"Select * from students");

if($sql->num_rows > '0'){
	echo"<table>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
				<th>Schedule</th>
				<th>Status</th>

				</tr>	

			";
	while($rows = mysqli_fetch_assoc($sql)){
		$idnumber = $rows['id_number'];
		$lastname = $rows['last_name'];
		$firstname = $rows['first_name'];
		$course = $rows['course'];
		$year = $rows['year'];
		$schedule = $rows['schedule'];
		$status = $rows['status'];

		$row = $sql->num_rows;


		echo "<tr>
					        		<td>$idnumber</td>
					        		<td>$lastname, $firstname</td>	
					        		<td>$course</td>
					        		<td>$year</td>
					        		<td>$schedule</td>
					        		<td>$status</td>
					        	</tr>";

	}
	echo"</table>";			
}else{


		echo"<table>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
				<th>Schedule</th>
				<th>Status</th>

				</tr>	

			";

}






?>

<html>
<head>
	<title></title>
</head>
<body>
<p><a href="logout.php" >Logout</a></p>
<p><a href="viewlogs.php" >ViewLogs</a></p>
</body>
</html>
