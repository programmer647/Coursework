<?php
session_start();
include_once("connection.php");

if ($_POST['password']!=$_POST['confirm']){
    echo("<script>
    alert('Confirm password not the same as password entered. Please try again.');
    window.location.href='signup.php';
    </script>";)
}

$stmt=$conn->prepare("SELECT username from Tblusers");//selects all the usernames from the users table
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        if (($row['username'])==($_POST['username'])){//checks if the username entered is the same as one in the table
            echo("<script>
            alert('Username is already in use. Please try another one.');
            window.location.href='signup.php';
            </script>";)     
        }
    }
            

?>

