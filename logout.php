<?php
session_start();

?>

<!DOCTYPE html><!--Declares that the document is a HTML page-->
<html>
<head>
<title>Login</title><!--sets the title of the page-->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
<link rel="stylesheet" href="style.css"><!--links to the external style sheet-->

<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li><a href="customerhome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="about.php">About Us</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="faqs.php">FAQs</a></li>
            <li><a href="uniformlists.php">Uniform Lists</a></li>
            <li class="active"><a href="login.php">Login/sign up</a></li>

          </ul>
        </div>
      </nav>


</head>

<body><!--Starts the body section of the page-->

<div class="container-fluid">
  <img src="images/shop1.jpg" style="width:100%;">
  <div class="centered box white">
  <?php

if(isset($_SESSION['name']))//checks if there is a user logged in
{
    unset($_SESSION['name']);//unsets the session variable name which stores the user's username
    unset($_SESSION['role']);//unsets the session variable which stores the user's role
    echo("<h3>Logged out successfully</h3>");//displays a heading to let the user know they have been logged out
}
else{
    echo("<h3>No user logged in</h3>");//displays a heading with the message that nobody was logged in in the first place
}


?>

  

</div>
</div>

</body><!--Ends the body section of the page-->

</html><!--Marks the end of the document-->



