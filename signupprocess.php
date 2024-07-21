<?php
session_start();
include_once("connection.php");

print_r($_POST);

if ($_POST['password']!=$_POST['confirm']){
    echo "<script>alert('Confirm password not the same as password entered. Please try again.');</script>";
    header("location:signup.php");
}

?>