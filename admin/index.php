<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
  <title></title>
</head>
<body>
<!--Navbar-->
<div class="container" style="width:100%;">
<nav class='navbar navbar-dark bg-primary navbar-toggleable-md'>
<a class="navbar-brand" href="#me" style="color:white;">OJT</a>
    <div class='collapse navbar-collapse'>
        <ul class='navbar-nav mr-auto'>
            <li class='nav-item'>
                <a class='nav-link' href='../student/index.php' style="color:white;">Student</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../adviser/index.php'  style="color:white;">Instructor</a>
            </li>
            <li class='nav-item'>
                <a class='nav-link' href='../admin/index.php' style="color:white;">Admin</a>
            </li>
        </ul>
    </div>
</nav>
</div>
  <div id="me" class="offset-4 mt-5" style="display:block; background-color:#e6f0bb;border-radius:50px;border:5px solid #405e01;height:55%;margin-right: 33.333333%;">
  <img src="../images/scis.png" style='width:200px;height:200px;float:left;padding:0;margin:0;'><h1 style="font-family: Sans-serif;font-size:5em;color:#405e01;">Log in</h1>
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

    
    
<section class="bg-dark">
<div class="container">
<div class="row">
	<div class="col-md-12 text-center">
		<p>
			&copy; OJT Short Term 2017 
		</p>
	</div>
</div>
</div>
</section>

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
     echo"<script>window.alert('Invalid Username')</script>";

   }else if($password == $userpass){
      $_SESSION['username'] = $username;
       header("location: adminpage.php");

  }else{
    // $_SESSION['message'] = "Invalid password!.";
    // header("location: error.php");
    echo"<script>window.alert('Invalid Password')</script>";
  } 

  }
 
mysqli_close($con);

  }
 
  



?>