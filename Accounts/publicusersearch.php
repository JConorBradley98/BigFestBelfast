<?php
 session_start();
include("../conn.php");


$username = '%'.$_POST['username'].'%';
$usertype = $_POST['usertype'];

    
if(empty($username)){
  $userread = $conn -> prepare("SELECT * FROM user WHERE usertype =?");
  $userread -> bind_param("s",$usertype);
}
elseif($usertype == "Filter by User Type"){





    $userread = $conn -> prepare("SELECT * FROM user WHERE username LIKE ? "); 
$userread -> bind_param("s",$username);
} else{
  $userread = $conn -> prepare("SELECT * FROM user WHERE username LIKE ? AND usertype=?");
  $userread -> bind_param("ss",$username,$usertype);
}


$userread -> execute();
$userresult = $userread -> get_result();








?>

<html>
   <head>
    <title> Results </title>
    <!--Bootsrap link-->
    <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="stylesheet" href ="../frontendcss.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<!--Responsive-->
<meta name="viewport" content="width=device-width, initial-scale=1.0">





    </head>

    <body id="cbody">
<header>
<img src="../img/logo.png" class="img-fluid">

</header>

<div class="contain-fluid">

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="../logout.php">Logout</a>
      </li>

     
      
        
    </ul>
  </div>
</nav>
<div class = "container-fluid">
<div class = "col-xl-12">

   <form action = "searchedusers.php" class ="form-group" method ="post">
   <div class ="form-row">
   <div class = "col-xl-2">
   <label for ="username"><h2> Search for a User </h2> </label>
   </div>
   <div class = "col-xl-2">
   <input class="form-control" type = "text" name = "username" id="username">
   </div>
   <div class ="col-xl-2">
   <select class="custom-select custom-select-md mb-3" type = "dropdown" name = "usertype">
     <option selected> Filter by User Type</option>
     <option value ="public"> Public User </option>
     <option value ="performer"> Performer </option>
     <option value ="venue"> Venue </option>
    </select>
    </div>
     <div class ="col-xl-2">
   <input class = "form-control" type = "submit" value = "Search">
   </div>
   </div>
   

   </form>


</div>
</div>

<div class="row">
<?php


if($userresult -> num_rows < 0){
  echo"<h1> No Users Found </h1>";
} else{

while($row = $userresult ->fetch_assoc()) {
      
       $name = $row['username'];
       $id = $row['id'];
       $img = $row['profileimg'];

   
       echo"
       <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
       <div  id ='uc' class='card w=33'>
       <a href = 'user.php?user=$id'>
            <img class='card-img-top' src='../img/$img' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
            </a>
            <div class='card-body'>
            <h1 class ='card-title'> $name </h1>
            <h1 class ='card-title'> $id </h1>
            </div> 
            </div>
            </div>";









}


}








?>

</div>
</div>
<footer>

<h1> BigFestBelfast </h1>

</footer>














</body>












</html> 

<?php

$userread -> close();
?>