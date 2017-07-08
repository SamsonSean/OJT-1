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

   <div class="body-content">
 	  <div class="body-content-module">
  		<div class="logout_module">
          <h1>Thank You!</h1>
              
          <p>You have successfully logged out</p>
        
          <a href="index.php"><button class="btn btn-primary">HOME</button></a>
        
       		 </div>
   	  </div>
   </div>



    <?php
		session_unset();
		session_destroy(); 
    
    ?>

</body>
</html>