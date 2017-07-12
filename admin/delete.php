<?php
require("../connect.php");
session_start();


if(isset($_POST['delete'])){
	if($_POST['delete'] == 'delete'){
		$delete = mysqli_query($con,"DELETE from students where 1");
		if($delete){
			header("location: adminpage.php");
			$_SESSION['delmess'] =  "<script>alert('Successfully deleted all student');</script>";

		}else{
			$_SESSION['delmess'] = "<script>alert('Error deleting all student');</script>";
		}
	}else{
	$id = mysqli_real_escape_string($con,$_POST['delete']);
	$delete = mysqli_query($con,"DELETE from students where idnumber = '$id'");
	
	if($delete){
		header("location: adminpage.php");
		$_SESSION['delmess'] =  "<script>alert('Successfully deleted student');</script>";
	}else{
		header("location: adminpage.php");
		$_SESSION['delmess'] = "<script>alert('Error deleting student');</script>";
	
}

}

	}else{ 
		echo "You need to delete student";
	}


?>