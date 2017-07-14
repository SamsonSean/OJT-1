<?php
session_start();
?>
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

<nav class='navbar navbar-dark bg-primary navbar-toggleable-md'>
<a class="navbar-brand" href="#me3" style="color:white;">OJT</a>
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

    <div id='me3' class="offset-4 mt-5" style="display:block; background-color:#2c3756;border-radius:50px;border:5px solid #a6a4aa;height:55%;margin-right: 33.333333%;">
    <img src="../images/scis.png" style='width:200px;height:200px;float:left;padding:0;margin:0;'><h1 style="font-family: Sans-serif;font-size:5em;color:#a6a4aa;">Log in</h1>
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
    </div>

    
<section class="bg-dark">
<div class="container">
<div class="row">
	<div class="col-md-12 text-center">
		<footer>
			&copy; OJT Short Term 2017 
		</footer>
	</div>
</div>
</div>
</section>
    

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

     echo"<script>window.alert('The account $idnumber does not exist!.')</script>;";

   }else if($password == $userpass){
      $_SESSION['idnumber'] = $idnumber;
       header("location: student.php");

  }else{

    echo"<script>window.alert('Invalid Password')</script>";
  } 

  }
 
mysqli_close($con);
  



?>