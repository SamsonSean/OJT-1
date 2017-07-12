<?php
require("../connect.php");
session_start();
date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d');
$time = date('h:i:a');
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
	<script src="log.js"></script>

	<title>Student</title>
</head>
<body>
<p><a href="logout.php">Logout</a></p>
<p><a href="student.php">Logs today</a></p>


<?php

if (isset($_SESSION['idnumber'])) {
	
	  echo"<h1>Hi!  $_SESSION[idnumber] </h1> ";
	
}else{
	header("location: index.php");
}

$logs = mysqli_query($con,"SELECT * from logs where id_number =  $_SESSION[idnumber] and date != '$date'");

	
// echo"<button  id='timein' value='timein' class='btn btn-sm btn-success' type='button' onclick='log_student(this)'>Time in</button>";

 if($logs->num_rows > '0'){
	echo"<table class='table'>";
		echo"<tr>";

			echo"
				<th>Log id</th>			
				<th>time in</th>
				<th>time out</th>
				<th>hrs rendered</th>
				<th>remarks</th>
				<th>date</th>
				
				</tr>	

			";
			while($result = mysqli_fetch_assoc($logs)){
				$logid = $result['log_id'];
				$timein = $result['time_in'];
				$timeout = $result['time_out'];
				$remarks = $result['remarks'];
				$date = $result['date'];
				$hrs = $result['hrs_rendered'];
				$result = $logs->num_rows;	




								echo "<tr>	
									<td>$logid</td>			  	        		
					        		<td>$timein</td>
					        		<td>$timeout</td>
					        		<td>$hrs</td>
					        		<td>$remarks</td>
					        		<td>$date</td>
					        		<td>
					        		";
					        		

			}
echo"</table>";

			
}
else{
	echo"<table class='table'>";
		echo"<tr>";

			echo"		
				<th>Log id</th>			
				<th>time in</th>
				<th>time out</th>
				<th>hrs rendered</th>
				<th>remarks</th>
				<th>date</th>
				<th>Action</th>
				<th>Remarks</th>
				</tr>	
				";
}
?>

</div>
</body>
</html>