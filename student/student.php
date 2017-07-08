<?php
require("../connect.php");
session_start();
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


<?php

if (isset($_SESSION['idnumber'])) {
	
	  echo"<h1>Hi!  $_SESSION[idnumber] </h1> ";
	
}else{
	header("location: index.php");
}

$logs = mysqli_query($con,"SELECT * from logs where id_number =  $_SESSION[idnumber]");

	
echo"<button  id='timein' value='timein' class='btn btn-sm btn-success' type='button' onclick='log_student(this)'>Time in</button>";

 if($logs->num_rows > '0'){
	echo"<table>";
		echo"<tr>";

			echo"
				<th>Log id</th>			
				<th>time in</th>
				<th>time out</th>
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
				$result = $logs->num_rows;	




								echo "<tr>	
									<td>$logid</td>			        						        		
					        		<td>$timein</td>
					        		<td>$timeout</td>
					        		<td>$remarks</td>
					        		<td>$date</td>
					        		<td>
					        		";
					        		if(isset($timeout)){
					        			echo" ";
					        		}else{

					        	
					        	echo"<form action='log.php' method='POST'>
					        		 <button  name='timeout' id='timeout' value='$logid'  onclick='log_student(this)'>Time out</button>
					        		</form>
					        		</td>
					        		";
					        			}
					        	echo"	
					        		<td>					        		
									<a href=#$logid >Remarks</a>	      
					        		</td>
					        	";
					        	echo"
					       			 <td>		
							<div id=$logid class='overlay'>
								<div class='popup'>
									<h2>Remarks</h2>
									<a class='close' href='#'>&times;</a>
									<form action='remarks.php' method='POST'>
									<textarea id='remarks' name='remarks' required></textarea>
					    			<button type='submit'  name='submit' value='$logid' id='submit' >Done</button>
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
	echo"<table>";
		echo"<tr>";

			echo"		
				<th>Log id</th>			
				<th>time in</th>
				<th>time out</th>
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