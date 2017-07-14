<?php
require("../connect.php");
session_start();



if(isset($_POST['logs'])){
	
		$logs = mysqli_query($con,"Delete from logs where log_id = $_POST[logs]");
		if($logs){
			header("location: studentlogs.php");
			$_SESSION['dellog'] =  "<script>alert('Successfully deleted log');</script>";

		}else{
			$_SESSION['dellog'] = "<script>alert('Error deleting log');</script>";
		}
	}else{ 
		echo " ";
	}


?>