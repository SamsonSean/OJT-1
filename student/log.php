<?php
require("../connect.php");
session_start();

$info = file_get_contents("php://input");
$json_decoded = json_decode($info,true);
$status = $json_decoded[0]['status'];


date_default_timezone_set("Asia/Manila");
$date = date('Y-m-d');
$time = date('h:i');


if($status == 'timein'){
$timein = mysqli_query($con,"INSERT INTO logs (time_in, date,id_number)
VALUES ( '$time', '$date', $_SESSION[idnumber])");
if($timein){
	header("location: student.php");
	
}else{
	echo"moto";
	echo $_SESSION['idnumber'];
}

}elseif($status = 'timeout'){
     
	 $timeout = mysqli_query($con,"UPDATE logs  SET time_out = '$time' where id_number =  $_SESSION[idnumber] and log_id = $_POST[timeout] ");
	 if($timeout){
	 	
	 	echo "Succesfully timed out"; 	

	 }else{
	 	echo"error";
	 }	
    
}else{
	$remarks = mysqli_query($con,"UPDATE logs SET remarks = $_POST[remarks]");
}
header("location: student.php");
// mysqli_close($con);
?>