<?php
session_start();
//print_r($_POST);
include_once ("connection.php");
array_map("htmlspecialchars", $_POST);
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username=:Username;" );
$stmt->bindParam(':Username', $_POST['Username']);
$stmt->execute();
while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
{ 
    $hashed = $row['Password'];
    $attempt= $_POST['Pword'];
    if(password_verify($attempt, $hashed)){
        $_SESSION['name']=$row['Username'];
        $_SESSION['role']=$row['Role'];
        $_SESSION['id']=$row['UserID'];
        echo("Logged in");
    }else{
        echo("Incorrect password");
        //header('Location: login.php');
    }
}
$conn=null;
?>
