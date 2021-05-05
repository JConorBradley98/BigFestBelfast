<?php
session_start();
session_destroy();
include("conn.php");
if (isset($_SESSION['admin'])) {
    header("Location:index.php");
} elseif (isset($_SESSION['admin'])) {
    header("Location:index.php");
} elseif (isset($_SESSION['venue'])) {
    header("Location:index.php");
} elseif (isset($_SESSION['performer'])) {
    header("Location:index.php");
} elseif (isset($_SESSION['public'])) {
    header("Location:index.php");
}
?>




<html>
    <head>
        <title> Reset Password Step 1 </title>
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

    <body id="cbody" style="overflow:hidden;" scroll="no">
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
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                           <a href="index.php"> <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="login.php">Login</a>
                          <a href="login.php">  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="create.php">Create Account</a>
                             
                          <a href="create.php">  <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
                        <li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    <a href ="performerlistpage.php">  <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
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
      <a href="publicuserpage.php" ><img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>


                    </ul>
                </div>
            </nav>





            <div class="col-xl-12 text-center" id="con" style="height:724px;">


                <form action="securityquestion.php" method="post">
                    <div class="form-group-inline text-center" id="loggroup">
                        <h1 class="formh"> Reset Password Step 1:  </h1>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block text-center">
                                <h1 class="formh"> Enter Email Address </h1>
                                <input class = "form-control" id="logcon" type ="email" name = "em" placeholder="Email" required> 
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class = "logdiv center-block">
                            <input  class = "form-control"  id="logcon" type = "submit" value="Step 2">
                        </div>
                    </div>












            </div>
        </form>
    </div>

    <footer class="navbar fixed-bottom" style="background-color:#4B88A2">

        <h1 class ="footertext"> BigFestBelfast </h1>
      

    </footer>














</body>












</html>