<?php
session_start();
include_once ("connection.php"); //Allows the page to connect to the database
array_map("htmlspecialchars", $_POST); //Removes the impact of special characters to ensure that the page is secure by 
//preventing SQL injection
$stmt = $conn->prepare("SELECT * FROM tblusers WHERE Username=:Username;" ); 
$stmt->bindParam(':Username', $_POST['Username']);
$stmt->execute();


if ($stmt->rowCount()>0){

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
        }


    }
}

else{
    print("Incorrect username");
}


$conn=null;
?>



