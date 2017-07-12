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
<nav class='navbar navbar-dark bg-primary navbar-toggleable-md'>
<a class="navbar-brand" style="color:white;">OJT 2017</a>
    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
                <a href="studentrecentlogs.php" style="color:white;">Recent Logs</a>
            </li>
            <li>
                <a class='btn btn-sm btn-danger' href="logout.php" style="color:white;position:absolute;margin-left:85%;">Logout</a>
            </li>
        </ul>
    </div>
</nav>

<?php

if (isset($_SESSION['idnumber'])) {
	  echo "<div class='mt-5' style='display:block; background-color:white;border-top:5px solid #0275d8;border-bottom:5px solid #0275d8;'>";
	  echo"<h1 style='color:#0275d8;'>Hi,  $_SESSION[idnumber] </h1> ";
      echo"<h3 style='color:#0275d8;text-align:center;margin-bottom:20px;'>Remember to always Time in first and do not forget to put in your remarks for the day!</h3> ";
      echo "</div>";
	
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
	$_SESSION['button'] = "<button  id='timein' value='timein' class='btn btn-sm btn-success' type='button' onclick='log_student(this)' style='float:none;margin:1% 0% 1% 50%;'>Time in</button>";
	echo"<table class='table' style='border-top:5px solid #0275d8;'>";
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