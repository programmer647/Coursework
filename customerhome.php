<!DOCTYPE html>
<html>
        
<head>
    
    <title>Home Page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"><!--links to the bootstrap -->
    <link rel="stylesheet" href="style.css"><!--links to the external style sheet-->

</head>
<body>

<!--creating the navbar-->
<nav class="navbar navbar-fixed-top"><!--fixes the navbar to the top of the page-->
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li class="active"><a href="loggedouthome.php">Home</a></li><!--sets the home page to the active link so that it appears a different 
            colour so that the user knows which page they are currently on-->
            <!--the code below provides the links to the different pages-->
            <li><a href="about.php">About Us</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="news.php">News</a></li>
            <li><a href="faqs.php">FAQs</a></li>
            <li><a href="uniformlists.php">Uniform Lists</a></li>
            <li><a href="account.php">My Account</a></li>

          </ul>
        </div>
      </nav>

<div id="carousel" class="carousel slide" data-ride="carousel"

<ol class="carousel-indicators">
    <li data-target="#carousel" data-slide-to="0" class="active"></li>
    <li data-target="#carousel" data-slide-to="1"></li>
    <li data-target="#carousel" data-slide-to="2"></li>
  </ol>

  <!-- Wrapper for slides -->
  <div class="carousel-inner">
    <div class="item active">
      <img src="images/Shop1.jpg" alt="shop1">
      <div class="carousel-caption">
          <h1>Welcome to the FOLSS pre-loved uniform shop!</h1>
        </div>
    </div>

    <div class="item">
      <img src="images/shop2.jpg" alt="shop2">
      <div class="carousel-caption">
          <h1>Welcome to the FOLSS pre-loved uniform shop!</h1>
        </div>
    </div>

    <div class="item">
      <img src="images/shop3.jpg" alt="shop3">
      <div class="carousel-caption">
          <h1>Welcome to the FOLSS pre-loved uniform shop!</h1>
        </div>
    </div>
  </div>

  <a class="left carousel-control" href="#carousel" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>

<div class="container-fluid">
<div class="row">
  <div class="col-sm-7 box">
    <h3>Contact Us</h3>
    <p>Email: folssoundle@gmail.com</p>
    <h4>Privacy and Returns Policies</h4>
    <p><a href="privacy.pdf">Privacy Policy</a></br>
    <a href="returns.pdf">Returns Policy></a></p>


  </div>
  

  <div class="col-sm-5 box">
    <h3>Upcoming Sales</h3>
    <p>Example: xx/xx/xx</br>
    Example: xx/xx/xx </p>
  </div>
  
</div>
</div>


</body>
</html>
