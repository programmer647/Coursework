<?php
include_once("connection.php");//connects the page to the database
session_start();

$valid=TRUE;//sets the valid variable to true so that it starts by assuming the details entered are valid

if ($_POST['passwd']!=$_POST['passwd2']){ //checks if the password and confirm password entered were the same
    $valid=FALSE;//if they are not the same then it sets the valid variable to false
    ?>
    <body>
        <h1>Confirm password is not the same as password entered. Please try again<h1><!--displays a message so that the user knows why they weren't able to add a user-->
        <form action="users.php"><!--sets the page to redirect back to so that the user can try again-->
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
            $valid=FALSE;//if the username is already in use it sets the valid variable to false
            ?>
            <h1>Username already in use. Try another one.</h1><!--displays a message so that the user knows why they weren't able to add a user-->
            <form action="users.php"><!--sets the page to redirect back so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the sign in page-->
</form>
<?php
        }
    }

if (($_POST['forename'])=="" or ($_POST['surname'])=="" or ($_POST['username'])=="" or ($_POST['passwd'])=="") {//checks if any of the fields were left blank
    $valid=False;//sets the valid variable to false because some of the details are missing
    ?>
    <h1>Please enter all details</h1><!--tells the user to enter all of the details-->
    <form action="users.php"><!--sets the page to redirect back so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the add user page-->
</form>
<?php
}

if ($valid==TRUE){//checks if the details entered are valid
    //code below inserts the details into the database
    $stmt=$conn->prepare("INSERT INTO Tblusers (UserID,Forename,Surname,Username,Password,Role) VALUES (null,:forename,:surname,:username,:password,:role)");
    $stmt->bindParam(':forename', $_POST["forename"]);
    $stmt->bindParam(':surname', $_POST["surname"]);
    $stmt->bindParam(':username', $_POST["username"]);
    $stmt->bindParam(':role', $_POST["role"]);
    $hashed_password=password_hash($_POST["passwd"], PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();
    echo("User added correctly");//prints a message telling the user that the new user has been added
    echo("<form action='users.php'>");//provides a way for the user to get back to the previous page
    echo("<input type='Submit' value='Add another user'");
    echo("</form>");
}
?>



