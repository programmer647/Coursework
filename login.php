<!DOCTYPE html><!--Declares that the document is a HTML page-->
<html>
<head>
<title>Login</title><!--sets the title of the page-->

</head>

<body><!--Starts the body section of the page-->






<form action="loginprocess.php" method= "POST"><!--Creates the form and makes it redirect to the loginprocess 
page when submitted-->
 Username:<input type="text" name="Username"><br><!--Makes the input box for the username-->
 Password:<input type="password" name="Pword"><br><!--Makes the input box for the password-->
  <input type="submit" value="Login" onclick="logged()"><!--Creates the login button so that the information can be 
  submitted-->
</form><!--Closes the form-->

</body><!--Ends the body section of the page-->

</html><!--Marks the end of the document-->