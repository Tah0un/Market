<?php
function client_sanitization($input){
    $input = trim($input);
    $input = strip_tags($input);
    $input = stripcslashes($input);
    $input = htmlspecialchars($input);
    return $input;
}
?>


