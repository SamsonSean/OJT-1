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
<nav class='navbar navbar-inverse bg-primary navbar-toggleable-md'> 

    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class="navbar-brand" style="color:white;" href='adviserpage.php'>OJT 2017</a>
          </li>
            <li class='nav-item'>
                <a class="navbar-brand" href="recentlogs.php" style="color:white;">Recent Logs</a>
            </li>
            <li class='nav-item'>
                <a class="navbar-brand" href="adviserpage.php" style="color:white;">Home</a>
            </li>
          </ul>       
          <ul class='navbar-nav mr-auto'>
          </ul>
            <ul class="nav navbar-nav " >
            <li class='nav-item'> 
                <a class='btn btn-sm btn-danger pull-right ' href="logout.php" > Logout</a>
            </li>
           </ul> 
    </div>
</nav>
<?php
echo "<div class='mb-5 mt-5 ml-3'>";
$sql = mysqli_query($con,"Select * from students inner join logs on students.idnumber = logs.id_number where date = '$date' order by logs.date ");
echo "<br>";
echo "<h3 style='color:#0275d8;'>The date is: ".$date;
echo "</h3>";
echo "<br>";
echo "<h3 style='color:#0275d8;'>The time is: ".$time;
echo "</h3>";
echo "</div>";
$logs = mysqli_query($con,"SELECT * FROM `students` inner join logs on students.idnumber = logs.id_number
							 where adviser_id = $id[2] and date = '$date' order by logs.date ");

if($logs->num_rows > '0'){
	echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Time in</th>
				<th>Time out</th>
				<th>hrs rendered</th>
        		<th>Remarks </th>
				<th>Date</th>
				<th>Action</th>		
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
				$hrs = $result['hrs_rendered'];
				$logid = $result['log_id'];

					echo "<tr>
					          <td>$idnumber</td>
					          <td>$lastname, $firstname</td>	
					          <td>$timein</td>
					          <td>$timeout</td>
					          <td>$hrs</td>
                    		  <td>$remarks</td>
					          <td>$date</td>
					          <td>
					          <form action='deletelogs.php' method='POST'>
					           <button class='btn btn-sm btn-danger'  name='logs' id='logs' value='$logid'  >Delete</button>
					          </form>
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


if(isset($_SESSION['dellog'])){
	echo $_SESSION['dellog'];
	unset($_SESSION['dellog']);
}else{
	echo "";
}


?>
</body>
</html>