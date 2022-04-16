<?php

$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "login";

// if(!$con = mysqli_connect($dbHost, $dbUser, $dbPassword, $dbName)){
//   die("Failed to connect");
// }

$string = "mysql:host=".$dbHost.";dbname=".$dbName;
if(!$con = new PDO($string, $dbUser, $dbPassword)){
  die("Failed to connect");
}
 ?>
