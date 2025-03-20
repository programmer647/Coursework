<!DOCTYPE html><!--Declares that the document is a HTML page-->
<html>
<head>
<title>Sign up</title><!--sets the title of the page-->

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
  <h3>Sign up</h3>
<!--creates the form for the user to enter their details-->
<form action="signupprocess.php" method= "POST">
 First name:<input type="text" name="forename" required><br>
 Surname:<input type="text" name="surname" required><br>
 Username:<input type="text" name="username" required><br>
 Password:<input type="password" name="password" required><br>
 Confirm password:<input type="password" name="confirm" required><br>
  <input type="submit" value="Sign up">
</form>
<h4>Already have an account? Sign in now</h4>
<form action="login.php">
  <input type="submit" value="Login">
</form>
</div>
</div>


</body><!--Ends the body section of the page-->

</html><!--Marks the end of the document-->



