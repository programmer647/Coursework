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

if ($valid==TRUE){//checks if the details entered are valid
    //code below inserts the details into the database
    $stmt=$conn->prepare("INSERT INTO Tblusers (UserID,Forename,Surname,Username,Password,Role) VALUES (null,:forename,:surname,:username,:password,1)");
    $stmt->bindParam(':forename', $_POST["forename"]);
    $stmt->bindParam(':surname', $_POST["surname"]);
    $stmt->bindParam(':username', $_POST["username"]);
    $hashed_password=password_hash($_POST["password"], PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashed_password);
    $stmt->execute();

    $stmt=$conn->prepare("SELECT UserID, Username, Role, Forename FROM Tblusers WHERE Username=:username");
    $stmt->bindParam(':username',$_POST["username"]);
    $stmt->execute();
    while ($row=$stmt->fetch(PDO::FETCH_ASSOC)){
        $_SESSION['name']=$row['Username'];//sets the session variable name to the user's username
        $_SESSION['role']=$row['Role'];//sets the session variable role
        $_SESSION['id']=$row['UserID'];//sets the session variable ID
        $_SESSION['firstname']=$row['Forename'];//sets the session variable firstname
    }

}

print_r($_SESSION);

?>

<script>
    alert("Sign up successful");
    window.location.href = "customerhome.php";
</script>




