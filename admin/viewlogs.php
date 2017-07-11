<!DOCTYPE HTML>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
</head>
<body>
<p><a href="adminpage.php" >Home</a></p>
<p><a href="recentlogs.php" >View Recent Logs</a></p>
<?php
require("../connect.php");
session_start();
if (isset($_SESSION['username'])) {
	
	  echo"Hi! ". $_SESSION['username'];
	
}else{
	header("location: index.php");
}

date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d');
$time = date('h:i:a');

$sql = mysqli_query($con,"Select * from students inner join logs on students.idnumber = logs.id_number where date = '$date' order by logs.date ");
echo "<br>";
echo "The date is ".$date;
echo "<br>";
echo "The time is ".$time;
if($sql->num_rows > "0"){
	echo"<table class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>time in</th>
				<th>time out</th>
				<th>hrs rendered</th>
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
		$hrs = $rows['hrs_rendered'];
		$row = $sql->num_rows;


		echo "<tr>
					        		<td>$idnumber</td>
					        		<td>$lastname, $firstname</td>	
					        		<td>$timein</td>
					        		<td>$timeout</td>
					        		<td>$hrs</td>
					        		<td>$remarks</td>
					        		<td>$date</td>
					        	
					        	</tr>";

	}
	echo"</table>";			
}else{


	echo"<table class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>time in</th>
				<th>time out</th>
				<th>hrs rendered</th>
				<th>remarks</th>
				<th>date</th>

				</tr>	

			";

}




mysqli_close($con);


?>


</body>
</html>
