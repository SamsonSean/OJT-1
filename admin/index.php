<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
  <title></title>
</head>
<body class="offset-4 mt-5" style="margin-right: 33.333333%">
  <div style="display:block; background-color:#e6f0bb;border-radius:50px;border:5px solid #405e01;">
  <h1 style="font-family: Sans-serif;font-size:5em;color:#405e01;">Log in</h1>
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
   </div>
 </div>

</body>
</html>
<?php
require('../connect.php');
session_start();

  if(isset($_SESSION['username'])){
    header("location: adminpage.php");
  }else{
     if(isset($_POST['username'])){
     $username = mysqli_real_escape_string($con,$_POST['username']);
     $userpass = mysqli_real_escape_string($con,$_POST['password']);


 $checkUsername = mysqli_query($con,"SELECT * from admin WHERE username = '$username' ");
 $result = $checkUsername->fetch_assoc();
 $password = $result['password'];

 if($checkUsername->num_rows < '1'){
    // $_SESSION['message'] = "The account $username does not exist!.";
    // header("location: error.php");
     echo"invalid username";

   }else if($password == $userpass){
      $_SESSION['username'] = $username;
       header("location: adminpage.php");

  }else{
    // $_SESSION['message'] = "Invalid password!.";
    // header("location: error.php");
    echo"invalid pass";
  } 

  }
 
mysqli_close($con);

  }
 
  



?>