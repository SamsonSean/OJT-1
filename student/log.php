<?php
require("../connect.php");
session_start();
if(isset($_SESSION['idnumber'])){


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
	unset($_SESSION['button']);
	
}else{
	echo "failed";
}

}elseif($status = 'timeout') {
    	if(isset($_POST['timeout'])){
	    $timeout = mysqli_query($con,"UPDATE logs  SET time_out = '$time' where id_number =  $_SESSION[idnumber] and log_id =  $_POST[timeout]");
    		
    	}else{
    		echo "error";
    	}
 
	 if($timeout){
	 	$_SESSION['button'] = "<button  id='timein' value='timein' class='btn btn-sm btn-success' type='button' onclick='log_student(this)'>Time in</button>";
	 	$totaltime = mysqli_query($con,"SELECT * from logs where  $_SESSION[idnumber] and log_id = $_POST[timeout]");
	 	$result = mysqli_fetch_assoc($totaltime);
	 	if($result['time_out'] < '12' && $result['time_in'] < '12'){
	 		$total = ((strtotime($result['time_out']) - strtotime($result['time_in']))/3600);
	 		$hrsrendered = mysqli_query($con,"UPDATE logs set hrs_rendered = $total  where id_number =  $_SESSION[idnumber] and log_id =  $_POST[timeout]");
	 	}else
{	 		$total = ((strtotime($result['time_out'] + 12) - strtotime($result['time_in']))/3600);
	 		$hrsrendered = mysqli_query($con,"UPDATE logs set hrs_rendered = $total  where id_number =  $_SESSION[idnumber] and log_id =  $_POST[timeout]");
	 	}
	 	 header("location: student.php");

	 }else{
	 	echo "failed to time out";
	 }

  
    
}
	


}else{
	header("location: index.php");
}
 mysqli_close($con);
?>