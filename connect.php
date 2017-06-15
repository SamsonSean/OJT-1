<?php
$DB_host = "localhost";
$DB_username = "root";
$DB_pass = "";
$DB_schema = "OJT";

$con = mysqli_connect($DB_host,$DB_username,$DB_pass,$DB_schema);
if (mysqli_connect_errno())
  {
  echo "Failed to to connect MySQL: " . mysqli_connect_error();
  }


?>