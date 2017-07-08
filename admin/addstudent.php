<?php
session_start();
require("../connect.php");
if(isset($_POST['addstudent'])){

 $idnumber = mysqli_real_escape_string($con,$_POST['idnumber']);
 $lname = mysqli_real_escape_string($con,$_POST['lname']);
 $fname = mysqli_real_escape_string($con,$_POST['fname']);
 $course = mysqli_real_escape_string($con,$_POST['course']);
 $year = mysqli_real_escape_string($con,$_POST['year']);
 $time = mysqli_real_escape_string($con,$_POST['time']);
 $day = mysqli_real_escape_string($con,$_POST['day']);
 $password = mysqli_real_escape_string($con,$_POST['password']);
 $adviser = mysqli_real_escape_string($con,$_POST['adviser']);
 




 $sqlcheck = mysqli_query($con,"SELECT * from students where idnumber = '$idnumber'");

if($sqlcheck->num_rows > "0"){
	$_SESSION['MESS'] = "student $idnumber already in the database";
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



}else{
	header("location: adminpage.php");
}


mysqli_close($con);





?>