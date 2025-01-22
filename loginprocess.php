<?php
session_start();
include_once ("connection.php"); //Allows the page to connect to the database
array_map("htmlspecialchars", $_POST); //Removes the impact of special characters to ensure that the page is secure by 
//preventing SQL injection
$stmt = $conn->prepare("SELECT * FROM Tblusers WHERE Username=:Username;" ); //selects the rows where the username is equal to the 
//username inputted by the user
$stmt->bindParam(':Username', $_POST['Username']);
$stmt->execute();

//This if statement checks if the SQL statement returned anything
if ($stmt->rowCount()>0){

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))//if the SQL statement returns a username it checks it against the password entered 
    //by the user. If it matches with the password stored in the table then the user is logged in 
    { 
        $hashed = $row['Password'];
        $attempt= $_POST['Pword'];
        if(password_verify($attempt, $hashed)){
            $_SESSION['name']=$row['Username'];//sets the session variable name to the user's username
            $_SESSION['role']=$row['Role'];//sets the session variable role
            $_SESSION['id']=$row['UserID'];//sets the session variable ID
            $_SESSION['firstname']=$row['Forename'];//sets the session variable firstname
            echo ("<script>alert('Sign in successful')</script>");//alerts the user that they have signed in successfully
            echo("<script>window.location.href='customerhome.php'</script>");//redirects the user back to the home page
        }else{
            echo ("<script>alert('Details incorrect')</script>");//alerts the user that the details they entered aren't correct
            echo("<script>window.location.href='login.php'</script>");//redirects the user back to the login page
        }
    }
}

else{
    echo("<script>alert('Details incorrect')</script>");//alerts the user that the details they entered aren't valid
    echo("<script>window.location.href='login.php'</script>");//redirects the user back to the login page
}

$conn=null;
?>









