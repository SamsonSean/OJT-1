<?php
session_start();
?>

<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
  <script src="search.js"></script>
	<title></title>
</head>
<body>
  <div class="pull-left"><a href="logout.php" >Logout</a></div>

<p><a href="viewlogs.php" >ViewLogs</a></p>



 <form class="form" action="addstudent.php" method="POST" enctype="multipart/form-data" autocomplete="off">
 				  <label>ID number: </label>
                <input class="form-control" type="text" placeholder="idnumber" name="idnumber" required/>
                <p class="break"></p>
                  <label>Lastname: </label>
                <input class="form-control" type="text" placeholder="lastname" name="lname" required/>
                <p class="break"></p>   
                  <label>Firstname: </label>                    
                <input class="form-control" type="text" placeholder="firstname" name="fname" required/>
                <p class="break"></p>
                  <label>Course: </label>
                <input class="form-control" type="text" placeholder="course" name="course" required/>
                <p class="break"></p>
                  <label>Year: </label>
                <input class="form-control" type="text" placeholder="year" name="year" required/>
                <p class="break"></p>
                  <label>Schedule (time): </label>
                <input class="form-control" type="text" placeholder="time_schedule" name="time" required/>
                <p class="break"></p>
                  <label>Schedule (days): </label>
                <input class="form-control" type="text" placeholder="day_schedule" name="day" required/>
                <p class="break"></p>
                  <label>Password: </label>
                <input class="form-control" type="password" placeholder="Password" name="password" required/>
                <p class="break"></p>
                  <div class="form-group">
                  <label>Select Adviser: </label>
               	<select name="adviser"  class="form-control">
               		<option>--SELECT--</option>
               		<?php
               		require("../connect.php");
               		$list = mysqli_query($con,"SELECT * from adviser");
               			while($row_list =mysqli_fetch_assoc($list)){
               		?>

               		<option value="<?php echo $row_list['adviser_id'];?>"><?php echo $row_list['adviser_id'];echo" "; echo $row_list['lastname'];?></option>
               		<?php
               			}
               		?>
               	</select>
               </div>
                <p class="break"></p>
                <input type="submit" value="Add Student" name="addstudent" class="btn btn-block btn-primary" />
               
               <?php
               	if(isset($_SESSION['MESS'])){
               		echo "<br>";
               		ECHO $_SESSION['MESS'];
               	}
              
               ?>
              

</form>

<h2>Add Instructor </h2>
<form class="form" action="addInstructor.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input class="form-control" type="text" placeholder="Instructor ID" name="insID" required/>
                <p class="break"></p>
                <input class="form-control" type="text" placeholder="lastname" name="lname" required/>
                <p class="break"></p>                       
                <input class="form-control" type="text" placeholder="firstname" name="fname" required/>
      			<p class="break"></p>
                <input class="form-control" type="password" placeholder="Password" name="password" required/>       
                 <p class="break"></p>
                <input type="submit" value="Add Instructor" name="addInstructor" class="btn btn-block btn-primary" />
                 <?php
               	if(isset($_SESSION['insMess'])){
               		echo "<br>";
               		ECHO $_SESSION['insMess'];
               	}
              
               ?>
</form>

<?php
require("../connect.php");

if (isset($_SESSION['username'])) {
	
	  echo"<h1>Hi!  $_SESSION[username] </h1> ";
	
}else{
	header("location: index.php");
}
?>
Filter By:
<select id='value' onchange='search()'>
  <option value=''>-SELECT-</option>
  <option value="0">ID number</option>
  <option value="1">Name</option>
  <option value="2">Course</option>
  <option value="3">Year</option>
  <option value="6">Adviser</option>
</select>
<input type="text" id="filter" onkeyup="search()" 
placeholder="Search for names.." title="Type in a name">
<?php
$sql = mysqli_query($con,"SELECT * from students ");
echo"<br>";
Echo "<h3>List of Students</h3>";
if($sql->num_rows > '0'){
	echo"<table id='table' class='table table-hover'>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        <th>Time Schedule</th>
				<th>Schedule</th>
				<th>Adviser</th>

				</tr>	

			";
	while($rows = mysqli_fetch_assoc($sql)){
		$idnumber = $rows['idnumber'];
		$lastname = $rows['lastname'];
		$firstname = $rows['firstname'];
		$course = $rows['course'];
		$year = $rows['year'];
		$schedule = $rows['day_schedule'];
		$time = $rows['time_schedule'];
		$adviserid = $rows['adviser_id'];

		$adviserquery = mysqli_query($con,"SELECT * from adviser where adviser_id = '$adviserid'");
		$result = mysqli_fetch_assoc($adviserquery);
		$adviserlname = $result['lastname'];
		$adviserfname = $result['firstname'];



		$row = $sql->num_rows;


		echo "<tr>
					        		<td>$idnumber</td>
					        		<td>$lastname, $firstname</td>	
					        		<td>$course</td>
					        		<td>$year</td>
                      <td>$time</td>
					        		<td> $schedule</td>
					        		<td> $adviserlname, $adviserfname</td>
					        	</tr>";

	}
	echo"</table>";			
}else{


		echo"<table>";
		echo"<tr>";

			echo"
		  	<th>ID number</th>
        <th>Name</th>
        <th>Course</th>
        <th>Year</th>
        <th>Time Schedule</th>
        <th>Schedule</th>
        <th>Adviser</th>

				</tr>	

			";

}




mysqli_close($con);

?>
</body>
</html>
