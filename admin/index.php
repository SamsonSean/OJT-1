<html>
<head>
  <title></title>
</head>
<body>
   <div class="modal-body">
              <form class="form" action="index.php" method="POST" enctype="multipart/form-data" autocomplete="off">
                <input class="form-control" type="text" placeholder="Username" name="username" required/>
                <p class="break"></p>
                <input class="form-control" type="password" placeholder="Password" name="password" required/>
                <p class="break"></p>
                <p><a href="forgotSP.php" >Forgot Password?</a></p>
                <p class="break"></p>
                <input type="submit" value="Login" name="loginadmin" class="btn btn-block btn-primary" />
              </form>



</body>
</html>
<?php
require('../connect.php');
session_start();
  if(isset($_POST['username'])){
     $username = $_POST['username'];
     $userpass = $_POST['password'];


 $checkUsername = mysqli_query($con,"Select * from admin WHERE username = '$username'");
 $result = $checkUsername->fetch_assoc();
 $password = $result['password'];

 if($checkUsername->num_rows < '1'){
    $_SESSION['message'] = "The account $username does not exist!.";
    // header("location: error.php");
     echo"invalid username";

   }else if($password == $userpass){
      $_SESSION['username'] = $username;
       header("location: adminpage.php");

  }else{
    $_SESSION['message'] = "Invalid password!.";
    // header("location: error.php");
    echo"invalid pass";
  } 

  }
 
mysqli_close($con);
  



?>