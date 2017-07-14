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
<nav class='navbar navbar-dark bg-primary navbar-toggleable-md'>
<a class="navbar-brand" style="color:white;" href="student.php">OJT 2017</a>
    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto navbar-header'>
            <li class='nav-item'>
                <a href="student.php" style="color:white;">Logs today</a>        
            </li>
          </ul>
          <ul class="nav navbar-nav ">  
            <li class='nav-item' >
                <a class='btn btn-sm btn-danger pull-right' href="logout.php">Logout</a>
            </li>
        </ul>
    </div>
</nav>


<?php

if (isset($_SESSION['idnumber'])) {
		$name = mysqli_query($con,"Select * from students where idnumber = $_SESSION[idnumber]");
		$row = mysqli_fetch_assoc($name);	
	  echo "<div class='mt-5' style='display:block; background-color:white;border-top:5px solid #0275d8;border-bottom:5px solid #0275d8;'>";
	  echo"<h1 style='color:#0275d8;'>Hi!  $row[lastname], $row[firstname] </h1> ";
      echo"<h3 style='color:#0275d8;text-align:center;margin-bottom:20px;'>Here you can view your latest time in logs.</h3> ";
      echo "</div>";
	
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