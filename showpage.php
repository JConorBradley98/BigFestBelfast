 
<?php
session_start();
if (isset($_SESSION['admin'])) {
    $user = $_SESSION['admin'];
    $type = "admin";
} elseif (isset($_SESSION['venue'])) {
    $type = "venue";
    $user = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
    $type = "public";
    $user = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
    $user = $_SESSION['performer'];
    $type = "performer";
} else {
    $user = "unreg";
}

include("conn.php");
$acts = "SELECT * FROM user WHERE usertype='performer' ORDER BY RAND() LIMIT 3";
$actsresult = $conn->query($acts);

$venue = "SELECT * FROM user WHERE usertype='venue' AND venue=1 ORDER BY RAND() LIMIT 3";
$venueresult = $conn->query($venue);

$show = "SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid ORDER BY RAND() LIMIT 3";
$showresult = $conn->query($show);
?>





















<html>
    <head>
        <title> Bigfest </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href ="frontendcss.css">





    </head>

    <body id="cbody">
        <header>
            <div>
                <img src="img/logo.png" class="img-fluid" >
                <h2 class="datetext"> From 29.06.2020 - 05.07.2020 </h2>
            </div>

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
<?php
if ($user == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
      </li></a>
      </li>";
}

if ($user == "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
      </li>";
}

if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
      </li>";
}

if ($user != "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
      </li>";


    echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    </li>";
}


if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
      </li>";
}

if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
      </li>";
}

if ($user != "unreg") {

    echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$user'>View Profile</a>
      </li>";
}

if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
    </li>";
    
}


echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
    </li>";
?>


                    </ul>
                </div>
            </nav>

            <div class="row">
                <div class="col-xl-4 homecol"style="text-align:center; background-color:  #FFF9FB;">
                    <h1 style="font-family: 'Bebas Neue', cursive;"> Acts  </h1>
                        <?php
                        while ($actsrow = $actsresult->fetch_assoc()) {

                            $actsname = $actsrow['username'];
                            $actsid = $actsrow['id'];
                            $actsimg = $actsrow['profileimg'];


                            echo"
    <div id='cardcol' class='col-xl-12' style='padding:20px; text-align:center;'>
    <div  id ='uc' class='card w=33'>
    <a href = 'profilepage.php?user=$actsid'>
         <img class='card-img-top' src='img/$actsimg' style = 'height:320px; width:250px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
         </a>
         <div class='card-body'>
         <h1 class ='card-title footertext'> $actsname </h1>
         </div> 
         </div>
         </div>";
                        }
                        ?>


                </div>


                <div class="col-xl-4 homecol" style="text-align:center; background-color:  #FFF9FB;">


                    <h1 style="font-family: 'Bebas Neue', cursive;"> Shows </h1>
                    <?php
                    while ($showrow = $showresult->fetch_assoc()) {

                        $showname = $showrow['title'];
                        $showid = $showrow['showid'];
                        $showimg = $showrow['img1'];


                        echo"
    <div id='cardcol' class='col-xl-12' style='padding:20px; text-align:center;'>
    <div  id ='uc' class='card w=33'>
    <a href = 'showpage.php?show=$showid'>
         <img class='card-img-top' src='img/$showimg' style = 'height:320px; width:250px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
         </a>
         <div class='card-body'>
         <h1 class ='card-title footertext'> $showname </h1>
         </div> 
         </div>
         </div>";
                    }
                    ?>



                </div>




                <div class="col-xl-4 homecol" style="text-align:center; background-color: #FFF9FB;">

                    <h1 style="font-family: 'Bebas Neue', cursive;"> Venues </h1>
                    <?php
                    while ($row = $venueresult->fetch_assoc()) {

                        $venuename = $row['username'];
                        $venueid = $row['id'];
                        $venueimg = $row['profileimg'];


                        echo"
    <div id='cardcol' class='col-xl-12 ' style='padding:20px; text-align:center;'>
    <div  id ='uc' class='card w=33'>
    <a href = 'venuepage.php?venue=$venueid'>
         <img class='card-img-top' src='img/$venueimg' style = 'height:320px; width:250px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
         </a>
         <div class='card-body'>
         <h1 class ='card-title footertext'> $venuename </h1>
         </div> 
         </div>
         </div>";
                    }
                    ?>



                </div>

            </div>
        </div>
        <footer class="navbar fixed-bottom">

            <h1 style="font-family: 'Bebas Neue', cursive;"> BigFestBelfast </h1>

        </footer>














    </body>












</html>