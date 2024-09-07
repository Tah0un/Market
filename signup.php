<?php
require 'connection.php';
require 'signup_I.php';
require 'client_sanitize.php';


function validateAndSanitize($field) {
    if (isset($field)) 
        return client_sanitization($field);
    return null;
}

function validatePhoneNumber($field) {
    if (isset($field) && strlen(trim($field)) == 11)
        return client_sanitization($field);
    return null;
}

function validatePassword($field) {
    if (isset($field) && strlen($field) >= 8) {
        $password = client_sanitization($field);
        return md5($password);
    }
    return null;
}

function validateGender($field) {
    if (isset($field) && in_array($field, ["male", "female"]))
        return client_sanitization($field);
    return null;
}

if (isset($_POST["submit"])){
    $firstName = validateAndSanitize($_POST["first-name"]);
    $lastName = validateAndSanitize($_POST["last-name"]);
    $password = validatePassword($_POST["password"]);
    $email = validateAndSanitize($_POST["email"]);
    $number = validatePhoneNumber($_POST["number"]);
    $gender = validateGender($_POST["gender"]);

    if (isset($firstName, $lastName, $password, $email, $number, $gender)) {
        $insert_query = "INSERT INTO users VALUES (NULL,'$firstName','$lastName','$password','$email','$number','$gender');";
        if(mysqli_query($connection, $insert_query)) 
            header("location:login.php");
        else 
            echo "Error: " . mysqli_error($connection);
    }
    else{
        echo "Error: Not all form fields are set.";  
    }
} 
mysqli_close($connection);
?>