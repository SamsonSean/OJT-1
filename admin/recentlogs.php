<?php
require("../connect.php");
session_start();
if (isset($_SESSION['username'])) {
	
	  echo"Hi! ". $_SESSION['username'];
	
}else{
	header("location: index.php");
}

$date = date('Y-m-d');
$sql = mysqli_query($con,"Select * from students inner join logs on students.idnumber = logs.id_number where logs.date != '$date' ");
echo $date;


if($sql->num_rows > '0'){
	echo"<table>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>time in</th>
				<th>time out</th>
				<th>remarks</th>
				<th>date</th>

				</tr>	

			";
	while($rows = mysqli_fetch_assoc($sql)){
		$idnumber = $rows['idnumber'];
		$lastname = $rows['lastname'];
		$firstname = $rows['firstname'];
		$timein = $rows['time_in'];
		$timeout = $rows['time_out'];
		$remarks = $rows['remarks'];
		$date = $rows['date'];

		$row = $sql->num_rows;


		echo "<tr>
					        		<td>$idnumber</td>
					        		<td>$lastname, $firstname</td>	
					        		<td>$timein</td>
					        		<td>$timeout</td>
					        		<td>$remarks</td>
					        		<td>$date</td>
					        	
					        	</tr>";

	}
	echo"</table>";			
}else{


	echo"<table>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>time in</th>
				<th>time out</th>
				<th>remarks</th>
				<th>date</th>

				</tr>	

			";

}






?>

<html>
<head>
	<title></title>
</head>
<body>
<p><a href="adminpage.php" >Home</a></p>

<p><a href="viewlogs.php" >View Logs Today</a></p>
</body>
</html>
