<?php
	session_start();
   
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="../style/bootstrap.css">
  <link rel="stylesheet" type="text/css" href="../style/bootsrap-grid.css">
  <link rel="stylesheet" type="text/css" href="../style/botstrap.min.css">
  <link rel="stylesheet" type="text/css" href="../style/popup.css">
  <meta charset="UTF-8">
  <title>Logout</title>

</head>

<body>

   <div class="offset-2 mt-5" style="margin-right: 16.666667%">
       <div style="display:block; background-color:#e6f0bb;border-radius:50px;border:5px solid #405e01;padding-bottom:50px;">
        <h1 style="font-family: Sans-serif;font-size:5em;color:#405e01;">Thank You!</h1>    
        <h2 style="font-family: Sans-serif;font-size:2em;color:#405e01;text-align:center;">You have successfully logged out</h2>
        <a href="index.php"><button class="btn btn-primary" style="float:none;margin-left:45%;">HOME</button></a>
       </div>
   </div>



    <?php
		session_unset();
		session_destroy(); 
    
    ?>

</body>
</html>