<?php
require("../connect.php");
session_start();
$id = explode(",",$_SESSION['instructor']);

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
                <a class="navbar-brand" href="studentlogs.php" style="color:white;">View Logs</a>
            </li>
          </ul>

          <ul class='navbar-nav mr-auto'>
<?php
        echo "<li><h2 style='color:white;'>Welcome ".$id[0].",".$id[1];
        echo "</h2>";
        echo "</li>";
        echo"<br>";
        if(isset($_SESSION['instructor'])){


?>
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


echo "<h3 class='mt-5 mb-5' style='color:#0275d8;'>List of Students</h2>";
$logs = mysqli_query($con,"SELECT * FROM `students`  where adviser_id = $id[2]");

if($logs->num_rows > '0'){
echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        		<th>Time Schedule</th>
				<th>Schedule</th>		
				</tr>	

			";
			while($rows = mysqli_fetch_assoc($logs)){
				$idnumber = $rows['idnumber'];
				$lastname = $rows['lastname'];
				$firstname = $rows['firstname'];
				$course = $rows['course'];
				$year = $rows['year'];
				$schedule = $rows['day_schedule'];
				$time = $rows['time_schedule'];

					echo "<tr>
					          <td>$idnumber</td>
					          <td>$lastname, $firstname</td>	
					          <td>$course</td>
					          <td>$year</td>
                    		  <td>$time</td>
					          <td>$schedule</td>
					          </tr>";

			}
			echo "</table>";
}else{
	echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        		<th>Time Schedule</th>
				<th>Schedule</th>		
				</tr>";	

}

}else{
	header("location:index.php");
}


?>
</body>
</html>