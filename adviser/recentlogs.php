<?php
require("../connect.php");
session_start();
$id = explode(",",$_SESSION['instructor']);
date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d');
$time = date('h:i:a');
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
	<a href="adviserpage.php">Home</a>
	<br>
	<a href='studentlogs.php'>Log today</a>
<?php
$logs = mysqli_query($con,"SELECT * FROM `students` inner join logs on students.idnumber = logs.id_number
							 where adviser_id = $id[2] and date != '$date' order by logs.date ");

if($logs->num_rows > '0'){
	echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Time in</th>
				<th>Time out</th>
        		<th>Remarks </th>
				<th>Date</th>		
				</tr>	

			";

		while($result = mysqli_fetch_assoc($logs)){
				$idnumber = $result['idnumber'];
				$lastname = $result['lastname'];
				$firstname = $result['firstname'];
				$timein = $result['time_in'];
				$timeout = $result['time_out'];
				$remarks = $result['remarks'];
				$date = $result['date'];

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
			echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Time in</th>
				<th>Time out</th>
        		<th>Remarks</th>
				<th>Date</th>		
				</tr>	

			</table>";

		}	


?>
</body>
</html>