<?php
session_start();
?>
<html>
<head>
  <title></title>
</head>
<body>
   <div class="modal-body">
              <form class="form" action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input class="form-control" type="text" placeholder="ID number" name="idnumber" required/>
                <p class="break"></p>
                <input class="form-control" type="password" placeholder="Password" name="password" required/>
                <p class="break"></p>
                <p><a href="forgotSP.php" >Forgot Password?</a></p>
                <p class="break"></p>
                <input type="submit" value="Login" name="loginadmin" class="btn btn-block btn-primary" />
              </form>
    </div>


</body>
</html>
<?php
require('../connect.php');
if(isset( $_SESSION['idnumber'])){
  header("location: student.php");
}else{
  header("index.php");
}

  if(isset($_POST['loginadmin'])){
     $idnumber = mysqli_real_escape_string($con,$_POST['idnumber']);
     $userpass = mysqli_real_escape_string($con,$_POST['password']);


 $checkID = mysqli_query($con,"SELECT * from students WHERE idnumber = '$idnumber' ");
 $result = $checkID->fetch_assoc();
 $password = $result['password'];

 if($checkID->num_rows < '1'){
    $_SESSION['message'] = "The account $idnumber does not exist!.";
    // header("location: error.php");
     echo"invalid ID number";

   }else if($password == $userpass){
      $_SESSION['idnumber'] = $idnumber;
       header("location: student.php");

  }else{
    $_SESSION['message'] = "Invalid password!.";
    // header("location: error.php");
    echo"invalid pass";
  } 

  }
 
mysqli_close($con);
  



?>