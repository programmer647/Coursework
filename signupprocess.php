<?php
session_start();
include_once("connection.php");//allows the page to connect to the database

$valid=TRUE;

if ($_POST['password']!=$_POST['confirm']){ //checks if the password and confirm password entered were the same
    $valid=FALSE;
    ?>
    <body>
        <h1>Confirm password is not the same as password entered. Please try again<h1>
        <form action="signup.php"><!--sets the page to redirect back to so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the sign in page-->
</form>
</body>

<?php
}

$stmt=$conn->prepare("SELECT username from Tblusers");//selects all the usernames from the users table
$stmt->execute();
while ($row=$stmt->fetch(PDO::FETCH_ASSOC))
    {
        if (($row['username'])==($_POST['username'])){//checks if the username entered is the same as one in the table
            $valid=FALSE;
            ?>
            <h1>Username already in use. Try another one.</h1>
            <form action="signup.php"><!--sets the page to redirect back to so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the sign in page-->
</form>
<?php
        }
    }


if (($_POST['forename'])=="" or ($_POST['surname'])=="" or ($_POST['username'])=="" or ($_POST['password'])=="") {
    ?>
    <h1>Please enter all details</h1>
    <form action="signup.php"><!--sets the page to redirect back to so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the sign in page-->
</form>
<?php
}


if ($valid==TRUE){
    $stmt=$conn->prepare("INSERT INTO Tblusers (UserID,Forename,Surname,Username,Password,Role) VALUES (null,:forename,:surname,:username,:password,:role") 
}


?>


