<?php
require("../connect.php");
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
  <script src="../js/search.js"></script>
	<title></title>
</head>
<body>
<nav class='navbar navbar-inverse bg-primary navbar-toggleable-md'> 

    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
          <li class='nav-item'>
            <a class="navbar-brand" style="color:white;" href='adminpage.php'>OJT 2017</a>
          </li>
            <li class='nav-item'>
                <a class="navbar-brand" href="viewlogs.php" style="color:white;">ViewLogs</a>
            </li>
          </ul>

          <ul class='navbar-nav mr-auto'>
<?php
          if (isset($_SESSION['username'])) {
           
             echo"<li class='h2' style='color:white;'>
              Welcome!  $_SESSION[username]
             </li> ";  
            }else{
              header("location: index.php");
            }
?>
          </ul>
            <ul class="nav navbar-nav " >
            <li class='nav-item'> 
                <a class='btn btn-sm btn-danger pull-right ' href="logout.php" > Logout</a>
            </li>
           </ul> 
    </div>

</nav>

<div class="container">
<div class="mt-5" >
<button id='addstudent' class='btn btn-block btn-primary mt-3' onclick="hidestudentform()">Add Student</button>
<div id="studentform" style="display:none;">
 <form class="form" action="addstudent.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <button id='addstudent' class='btn btn-block btn-danger mt-3' onclick="hidestudentform()">Cancel</button>
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
</div>


<button id='addinstructor' class='btn btn-block btn-primary mt-3' onclick="hideinstructorform()">Add Instructor</button>
<div id="instructorform" style="display:none;">
<form class="form" action="addInstructor.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <button id='addinstructor' class='btn btn-block btn-danger mt-3' onclick="hideinstructorform()">Cancel</button>
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
</div>
</div>
</div>


<div style='margin-top:200px;text-align:center;border-top:5px solid #0275d8;border-bottom:5px solid #0275d8;padding:20px;'>
<h2 style='color:#0275d8;'>Filter By:</h2>
<select id='value' onchange='search()' >
  <option value='1'>-SELECT-</option>
  <option value="0">ID number</option>
  <option value="1">Name</option>
  <option value="2">Course</option>
  <option value="3">Year</option>
  <option value="6">Adviser</option>
</select>
<input type="text" id="filter"  onkeyup="search()" 
placeholder="Search.." title="Type in a name" >
</div>

<?php
$sql = mysqli_query($con,"SELECT * from students ");
Echo "<h3 class='mt-5' style='color:#0275d8;'>List of Students</h3>";
echo "<a href=#delete  class='btn btn-sm btn-danger'role='button' style='float:right;margin:1% 0% 1% 85%;'>Delete All Students</a>";
            echo" <div id=delete class='overlay'>
                <div class='popup'>             
                  <a class='close' href='#'>&times;</a>
                  <form action='delete.php' method='POST'>
                  <br>
                  <p> Are you sure you want to delete all student?</p>
                  <button class='btn btn-sm btn-danger' style='align:center;' type='delete'  name='delete' value='delete' id='delete' >Ok</button>
                  </form>
                </div>  
              </div>";

if($sql->num_rows > '0'){
	echo"<table id='table' class='table table-hover '>";
		echo"<tr>";

			echo"
				<th>ID number</th>
				<th>Name</th>
				<th>Course</th>
				<th>Year</th>
        <th>Time Schedule</th>
				<th>Schedule</th>
				<th>Adviser</th>
        <th>Action</th>
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
                      <td>
                      <form action='delete.php' method='POST'>
                       <button class='btn btn-sm btn-danger'  name='delete' id='delete' value='$idnumber' >Delete</button>
                      </form>
                      </td>
					        	</tr>";

	}
	echo"</table>";			
}else{


		echo"<table class='table table-hover'>";
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
if(isset($_SESSION['delmess'])){
echo $_SESSION['delmess'];
unset($_SESSION['delmess']);  
}




mysqli_close($con);

?>
    
<script>
function hidestudentform() {

var z = document.getElementById('studentform');
var y = document.getElementById('addstudent');
if (z.style.display === 'block') {
    z.style.display = 'none';
    y.style.display = 'block';
} else {
    z.style.display = 'block';
    y.style.display = 'none';
}

}    
    
function hideinstructorform() {

var z = document.getElementById('instructorform');
var y = document.getElementById('addinstructor');
if (z.style.display === 'block') {
    z.style.display = 'none';
    y.style.display = 'block';
} else {
    z.style.display = 'block';
    y.style.display = 'none';
}

} 
</script>
</body>
</html>
