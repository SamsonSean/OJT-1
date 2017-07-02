<?php
session_start();
require("../connect.php");

if(isset($_POST['addInstructor'])){
	$insID =  mysqli_real_escape_string($con,$_POST['insID']);
	$lname = mysqli_real_escape_string($con,$_POST['lname']);
	$fname = mysqli_real_escape_string($con,$_POST['fname']);
	$password = mysqli_real_escape_string($con,$_POST['password']);


	$checkID = mysqli_query($con,"SELECT * from adviser where adviser_id = '$insID'");

	if($checkID->num_rows > "0"){
		$_SESSION['insMess'] = "Instructor $insID is already in the database";

	}else{
		$insertInstructor = mysqli_query($con,"INSERT INTO `adviser` (adviser_id, lastname, firstname, password)
											VALUES ('$insID','$lname','$fname','$password')");
		

		if($insertInstructor){
			header("location: adminpage.php");
			$_SESSION['insMess'] = "Successfully added instructor $insID";
			
		}else{
			header("location: adminpage.php");
			$_SESSION['insMess'] = "Error adding instructor $insID".mysqli_error($insertInstructor);
			

		}
	}



}else{
	header("location: adminpage.php");
}

mysqli_close($con);




?>