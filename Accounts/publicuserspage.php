<?php
 session_start();
include("conn.php");

if(isset($_SESSION['admin'])){
  $user = $_SESSION['admin'];
  $type = "admin";
}elseif(isset($_SESSION['venue'])){
  $type = "venue";
  $user = $_SESSION['venue'];
}elseif(isset($_SESSION['public'])){
  $type = "public";
  $user = $_SESSION['public'];
}elseif(isset($_SESSION['performer'])){
  $user = $_SESSION['performer'];
  $type = "performer";
}else{
  $user = "unreg";
}


$acts = "SELECT * FROM user WHERE usertype='performer'";
$actsresult = $conn -> query($acts);

$venue = "SELECT * FROM user WHERE usertype='venue' AND venue=1";
$venueresult = $conn -> query($venue);


$userread = "SELECT * FROM user WHERE usertype != 'admin'";
$userresult = $conn ->query($userread);








?>

<html>
   <head>
    <title> Users </title>
    <!--Bootsrap link-->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href ="frontendcss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--Responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">





    </head>

    <body id="cbody">
<header>
<img src="img/logo.png" >

</header>

<div class="contain-fluid">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
     <?php if($user == "unreg" ){

     
     echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";} else{
        echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
      </li></a>
      </li>"; 
      }

      if($user == "unreg"){
     echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
      </li>";

      } 
      
      if(isset($_SESSION['admin'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
      </li>";
      }
      
      if($user != "unreg"){
        echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
      </li>";


      echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    </li>";

    
      }


      if(isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
      </li>";
        }

      if(isset($_SESSION['performer'])){
        echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
      </li>";



      if($user != "unreg"){

        echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$user'>View Profile</a>
      </li>";


      }
      }
      
      
      
      
      
      
      ?>
      
        
    </ul>
  </div>
</nav>

<div class="row">
<?php

while($row = $userresult ->fetch_assoc()) {
      
       $name = $row['username'];
       $id = $row['id'];
       $img = $row['profileimg'];

   
       echo"
       <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
       <div  id ='uc' class='card w=33'>
       <a href = 'profilepage.php?user=$id'>
            <img class='card-img-top' src='img/$img' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
            </a>
            <div class='card-body'>
            <h1 class ='card-title'> $name </h1>
            <h1 class ='card-title'> $id </h1>
            </div> 
            </div>
            </div>";









}











?>

</div>
</div>
<footer>

<h1> BigFestBelfast </h1>

</footer>














</body>












</html> 