<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$host = "localhost";
$username = "phpmyadmin";
$password = "password";
$dbname = "php";
$connection = mysqli_connect($host, $username, $password, $dbname);
// if($connection){
//     echo "connected";
// } 
// else{
//     die("Connection failed. Reason: " . mysqli_connect_error());
// }
if(!$connection){
    die("Connection failed. Reason: " . mysqli_connect_error());
}
?>