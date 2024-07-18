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
            <li><a href="login.php">Login/Sign up</a></li>

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
      <img src="images/shop1.jpg" alt="Los Angeles">
    </div>

    <div class="item">
      <img src="images/shop2.jpg" alt="Chicago">
    </div>

    <div class="item">
      <img src="images/shop3.jpg" alt="New York">
    </div>
  </div>


</body>
</html>
