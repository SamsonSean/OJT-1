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
	<script src="../js/log.js"></script>

	<title>Student</title>
</head>
<body>
<p><a href="logout.php">Logout</a></p>
<p><a href="studentrecentlogs.php">Recent Logs</a></p>


<?php

if (isset($_SESSION['idnumber'])) {
	
	  echo"<h1>Hi!  $_SESSION[idnumber] </h1> ";
	
}else{
	header("location: index.php");
}

$logs = mysqli_query($con,"SELECT * from logs where id_number =  $_SESSION[idnumber] and date = '$date'");

if(isset($_SESSION['button'])){
	echo $_SESSION['button'];
}else{
	echo "";
}	

if(isset($_SESSION['remarkmess'])){
	echo"$_SESSION[remarkmess]";
	unset($_SESSION['remarkmess']);
}else{
	echo "";
}

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
				<th> Action</th>
				<th> Remarks</th>
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
					        		if(isset($timeout)){
					        			echo" ";

					        		}else{

					        	
					        	echo"<form action='log.php' method='POST'>
					        		 <button class='btn btn-sm btn-danger'  name='timeout' id='timeout' value='$logid'  onclick='log_student(this)'>Time out</button>
					        		</form>
					        		</td>
					        		";
					        			}
					        	echo"	
					        		<td>					        		
									<a href=#$logid class='btn btn-info btn-sm role='button' >Remarks</a>	      
					        		</td>
					        	";
					        	echo"
					       			 <td>
					       		 		
							<div id=$logid class='overlay'>
								<div class='popup'>							
									<a class='close' href='#'>&times;</a>
									<form action='remarks.php' method='POST'>
									<label for='remarks'>Remarks:</label>
									<textarea class='form-control' id='remarks' name='remarks' required></textarea>
					    			<button type='submit'  name='submit' value='$logid' id='remarks' >Done</button>
									</form>
								</div>	
							</div>
							
									</td>	

						</tr>
			";	

			}
			echo"</table>";

			
}
else{
	$_SESSION['button'] = "<button  id='timein' value='timein' class='btn btn-sm btn-success' type='button' onclick='log_student(this)'>Time in</button>";
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


</body>
</html>