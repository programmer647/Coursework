<?php
session_start();
include_once("connection.php");
?>

<!DOCTYPE html>

<head>
    <title>Sign up</title>
</head>


<body>

<form action="signupprocess.php" method= "POST">
 First name:<input type="text" name="forename"><br>
 Surname:<input type="text" name="surname"><br>
 Username:<input type="text" name="username"><br>
 Password:<input type="password" name="password"><br>
 Confirm password:<input type="password" name="confirm"><br>
  <input type="submit" value="Sign up">
</form>

</body>

</html>