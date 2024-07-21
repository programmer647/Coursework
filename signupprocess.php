<?php
session_start();
include_once("connection.php");//allows the page to connect to the database

if ($_POST['password']!=$_POST['confirm']){//checks if the password and confirm password entered were the same
    echo "<script>alert('Confirm password not the same as password entered. Please try again.');</script>";//alerts the user to say that 
    //the passwords weren't the same
}

?>


