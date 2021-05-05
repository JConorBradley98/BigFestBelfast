<?php
session_start();
session_destroy();








?>

<!DOCTYPE html>
<html>
   <head>
    <title> Login </title>
    <!--Bootsrap link-->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
    <link rel="stylesheet" href ="frontendcss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--Responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">





    </head>

    <body id="cbody" scroll="no" style="overflow:hidden;">
<header>
<img src="img/logo.png" class="img-fluid" >
<h2 class="datetext"> From 29.06.2020 - 05.07.2020 </h2>

</header>

<div class="contain-fluid">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
        <a href="index.php"> <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link active" href="login.php">Login</a>
      <a href="login.php">  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="create.php">Create Account</a>
       <a href="create.php"> <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>
      <li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
      
  <a href="performerlistpage.php"> <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>


    <li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
     <a href="showlistpage.php"> <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>



    <li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
    <a href="venuelistpage.php">  <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>



    <li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
     <a href="publicuserpage.php"> <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>
        
    </ul>
  </div>
</nav>


<div id="logrow" class="row">


<div class="col-xl-12 text-center" id="lcon">


<form action="logtest.php" method="post">
<div class="form-group-inline text-center" id="loggroup">
<h1 class="formh"> Login </h1>
<div class="row justify-content-center">
<div class="logdiv center-block text-center">
<h1 class="formh"> Username </h1>
<input class = "form-control" id="logcon" type ="text" name = "u" placeholder="username"> 
</div>
</div>
<div class="row justify-content-center">
<div class="logdiv center-block">
<h1 class="formh"> Password </h1>
<input class = "form-control"  id="logcon" type = "password" name="p" placeholder="password">
</div>
</div>
<div class="row justify-content-center">
<div class = "logdiv center-block">
<input  class = "form-control"  id="logcon" type = "submit" value="Login">
</div>
</div>












</div>
</form>
<h3 class="formh">  <a href="loggedoutpassreset.php" style="color:white;"> Forgot Password? </a> </h3>
</div>

    <footer id="logfooter" class="navbar fixed-bottom">

<h1 class="footertext"> BigFestBelfast </h1>

</footer>
</div>
</div>











        


        
</body>












</html>