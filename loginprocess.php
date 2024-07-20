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
            echo("Logged in");
        }else{
            echo("Incorrect password");//prints "incorrect password" if the password is incorrect
        }


    }
}

else{
    print("Incorrect username");//prints if the username isn't in the table
}


$conn=null;
?>



<!DOCYTPE HTML>
<html>

<body>

<nav class="navbar navbar-default">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="checkoutbarcode.php">Barcode checkout</a></li>
            <li class="active"><a href="showtotals.php">View totals</a></li>
            <li><a href="login.php">Login</a></li>

          </ul>
        </div>
      </nav>
</body>

</html>






