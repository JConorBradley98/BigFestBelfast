 <?php
 session_start();
 include("conn.php");
 if(!isset($_SESSION['admin'])){
   header("Location:index.php");
 }elseif(!isset($_SESSION['admin'])){
  header("Location:index.php");
} elseif(!isset($_SESSION['venue'])){
  header("Location:index.php");
} elseif(!isset($_SESSION['performer'])){
  header("Location:index.php");
} elseif(!isset($_SESSION['public'])){
  header("Location:index.php");
}



if(!isset($_SESSION['admin'])){
  $aid = 0;


} else {

    $aid = $_SESSION['admin'];

}

if(!isset($_SESSION['venue'])){
    $vid = 0;
  
  
  } else {
  
      $vid = $_SESSION['venue'];
  
  }



  if(!isset($_SESSION['performer'])){
    $pid = 0;
  
  
  } else {
  
      $pid = $_SESSION['performer'];
  
  }


  if(!isset($_SESSION['public'])){
    $mpid = 0;
  
  
  } else {
  
      $mpid = $_SESSION['admin'];
  
  }


$idcheck = "SELECT * FROM user WHERE id = $aid OR id = $vid OR id = $pid OR id = $mpid";
$idresult = $conn -> query($idcheck);
$idresult = $idresult -> fetch_assoc();

$question = $idresult['secques'];

$rname = $idresult['username'];










?>




<html>
   <head>
    <title> Reset Password </title>
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
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>
      
        </div>
    </ul>
  </div>
</nav>





<div class="col-xl-12 text-center" id="con">


<form action="reset.php" method="post">
<div class="form-group-inline text-center" id="loggroup">
<h1 class="formh"> <?php echo "Reset Password for $rname"; ?> </h1>
<div class="row justify-content-center">
<div class="logdiv center-block text-center">
<h1 class="formh"> Enter Email Address </h1>
<input class = "form-control" id="logcon" type ="email" name = "em" placeholder="Email"> 
</div>
</div>
<div class="row justify-content-center">
<div class="logdiv center-block">
<h1 class="formh"> <?php echo $question ; ?> </h1>
<input class = "form-control"  id="logcon" type = "password" name="ans" placeholder="Answer">
</div>
</div>
<div class="row justify-content-center">
<div class = "logdiv center-block">
<h1 class="formh"> New Password </h1>
<input  class = "form-control"  id="logcon" type = "password" name="pass" placeholder="New Password">
</div>
</div>
<div class="row justify-content-center">
<div class = "logdiv center-block">
<input  class = "form-control"  id="logcon" type = "submit" value="Reset">
</div>
</div>












</div>
</form>
</div>
</div>
<footer>

<h1> BigFestBelfast </h1>

</footer>














</body>












</html>