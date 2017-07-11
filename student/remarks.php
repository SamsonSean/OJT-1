<?php
require("../connect.php");
session_start();
if(!isset($_SESSION['idnumber'])){
	header("location: index.php");
}else{
	

$remarks = mysqli_real_escape_string($con,$_POST['remarks']);
$id = $_POST['submit'];

$query = mysqli_query($con,"SELECT * from logs where id_number = $_SESSION[idnumber] and log_id = $id");

$result = mysqli_fetch_assoc($query);


if(is_null($result['time_out'])){

 $_SESSION['remarkmess'] = "<script>alert('You need to log out first');</script>";
header("location: student.php");
}else{
	$remarks = mysqli_query($con,"UPDATE logs SET remarks = '$remarks' where id_number =  $_SESSION[idnumber] and log_id = $id");

	if($remarks){
		unset($_SESSION['remarkmess']);
		header("location: student.php");
	}else{
		echo 'failed';
	}
}

}


?>