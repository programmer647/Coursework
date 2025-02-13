<?php
session_start();//allows the page to access the session variables

if ($_SESSION['role']!=3)//checks if the user is a committee member
{   
    header("Location:customerhome.php");//if the user is a customer not a committee member they are redirected to the home page
}

?>

<!--creates the input fields for the details the user needs to enter about the new user-->
<form action="addusers.php" method="post">
    First name:<input type="text" name="forename"><br>
    Last name:<input type="text" name="surname"><br>
    Username:<input type="text" name="username"><br>
    Password:<input type="password" name="passwd"><br>
    Confirm password:<input type="password" name="passwd2"><br>
    <input type="radio" name="role" value="2">Volunteer</br>
    <input type="radio" name="role" value="3">Admin</br>
    <input type="submit" value="Add User">
</form>



