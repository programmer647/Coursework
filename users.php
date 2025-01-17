<?php
session_start();
?>

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



