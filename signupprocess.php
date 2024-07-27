<?php
session_start();
include_once("connection.php");//allows the page to connect to the database

if ($_POST['password']!=$_POST['confirm']){ ?> <!--checks if the password and confirm password entered were the same-->
    <body>
        <h1>Confirm password is not the same as password entered. Please try again<h1>
        <form action="signup.php"><!--sets the page to redirect back to so that the user can try again-->
        <input type="submit" value="Try again"><!--Creates a button to allow the user to return to the sign in page-->
</form>
</body>

<?php
}

?>


