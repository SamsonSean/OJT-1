<?php
session_start();
require("../connect.php");
if(isset($_POST['idnumber'])){

 $idnumber = ($_POST['idnumber']);
 $lname = ($_POST['lname']);
 $fname = ($_POST['fname']);
 $course = ($_POST['course']);
 $year = ($_POST['year']);
 $time = ($_POST['time']);
 $day = ($_POST['day']);
 $password = ($_POST['password']);
 $adviser = ($_POST['adviser']);
 




 $sqlcheck = mysqli_query($con,"SELECT * from students where idnumber = '$idnumber'");

if($sqlcheck->num_rows > "0"){
	echo"student $idnumber already in the database";
}
else{
	$insert = "INSERT into `students` (idnumber, lastname, firstname, course, year, password, time_schedule, day_schedule, adviser_id) 
			VALUES ('$idnumber','$lname','$fname','$course','$year','$password','$time','$day','$adviser')";
	$query = mysqli_query($con,$insert);

if($query){
	$_SESSION['MESS'] = "SUCCESFULLY ADDED STUDENT";
	header("location: adminpage.php");
	
}else{
	$_SESSION['MESS'] = "ERROR ADDING STUDENT";
	header("location:adminpage.php");
}

}



}


mysqli_close($con);





?>