<?php 
require 'connection.php';
require 'login_I.php';
require 'client_sanitize.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = client_sanitization($_POST["email"]);
    $password = md5(client_sanitization($_POST["password"]));
    
    $select_query = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($connection, $select_query); 

    if ($result){
        $row = mysqli_fetch_assoc($result);
        if($row){
            if($row['password'] === $password){
                $_SESSION["username"] = $row['firstname']." ".$row["lastname"];
                $_SESSION["email"] = $email;
                $_SESSION["logged_in"] = true;
                header("location:shop.php");
            }
            else echo "<script> alert('Invalid Data');</script>";
        }
        else echo "No user found with this email";
    }
    else echo "Error: " . mysqli_errno($connection);
    
    mysqli_close($connection);
}

?>
