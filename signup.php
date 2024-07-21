<?php
session_start();//starts the session
include_once("connection.php");//allows the page to connect to the database through the connection page
?>

<!DOCTYPE html>

<head>
    <title>Sign up</title><!--sets the title of the page-->
</head>


<body>

<!--creates the form for the user to enter their details-->
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



