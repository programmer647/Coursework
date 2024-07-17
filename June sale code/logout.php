<?php
session_start();
if(isset($_SESSION['name']))//checks if there is a user logged in
{
    unset($_SESSION['name']);//unsets the session variable name which stores the user's username
    echo("Logged out successfully");
}
else{
    echo("No user logged in");
}


?>

