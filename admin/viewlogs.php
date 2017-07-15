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
<nav class='navbar navbar-inverse bg-primary navbar-toggleable-md'> 

    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class="navbar-brand" style="color:white;" href='adminpage.php'>OJT 2017</a>
          </li>
            <li class='nav-item'>
                <a class="navbar-brand" href="recentlogs.php" style="color:white;">Recent Logs</a>
            </li>
          </ul>
            <ul class="nav navbar-nav " >
            <li class='nav-item'> 
                <a class='btn btn-sm btn-danger pull-right ' href="logout.php" > Logout</a>
            </li>
           </ul> 
    </div>
</nav>
<?php
require("../connect.php");
session_start();
echo "<div class='mt-5 mb-5 ml-3'>";
if (isset($_SESSION['username'])) {
	
	  echo"<h3 style='color:#0275d8;'>Hi! ". $_SESSION['username'];
      echo"</h3>";
	
}else{
	header("location: index.php");
}

date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d');
$time = date('h:i:a');

$sql = mysqli_query($con,"Select * from students inner join logs on students.idnumber = logs.id_number where date = '$date' order by logs.date ");
echo "<br>";
echo "<h3 style='color:#0275d8;'>The date is: ".$date;
echo "</h3>";
echo "<br>";
echo "<h3 style='color:#0275d8;'>The time is: ".$time;
echo "</h3>";
echo "</div>";
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
