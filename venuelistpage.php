<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");

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




$venueresults = 9;




if (isset($_POST["venues"])) {
    $venuepage = $_POST["venues"];
} else {
    $venuepage = 1;
};
$venuestart = ($venuepage - 1) * $venueresults;
$userread = "SELECT * FROM user WHERE usertype ='venue' AND venue=1 LIMIT " . "$venuestart" . " , " . "$venueresults";


$userresult = $conn->query($userread);

$venuecount = "SELECT COUNT(ID) AS total FROM user WHERE usertype = 'venue' AND venue=1";
$venueresult = $conn->query($venuecount);
$venuerow = $venueresult->fetch_assoc();
$totalrows = $venuerow['total'];




$totalvenuepages = ceil($totalrows / $venueresults);
?>

<html>
    <head>
        <title> Venues </title>
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

    <body id="cbody">
        <header>
            <img src="img/logo.png"  class="img-fluid">
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
                            <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'>
                        </li>
<?php
if ($user == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
        <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
        <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li></a>
      </li>";
}

if ($user == "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
        <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li>";
}

if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
        <img src ='img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li>";
}

if ($user != "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
        <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li>";


    echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
      <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";
}


if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
        
<img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'>

      </li>   <li class='nav-item'>
      <a class='nav-link' href='venuepage.php?venue=$user'>View Venue Page</a>
      <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";
}

if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
        <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'>

      </li>";
}


if ($user != "unreg" && !isset($_SESSION['venue']) &&!isset($_SESSION['admin'])) {

    echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$user'>View Profile</a>
        <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
      </li>";
}


if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
      
 <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";
    
}



echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
      <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
      <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link active' href='venuelistpage.php'>View Venues</a>
      <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
      <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'>
    </li>";
?>


                    </ul>
                </div>
            </nav>
            <div class = "container-fluid">
                <div class = "col-xl-12 searchdiv">

                    <form action = "searchedvenue.php" class ="form-group" method ="post">
                        <div class ="form-row">
                            <div class = "col-xl-2">
                                <label for ="username"><h2 class='footertext'> Search for a Venue </h2> </label>
                            </div>
                            <div class = "col-xl-2">
                                <input class="form-control" type = "text" name = "username" id="username" placeholder="Venue Name">
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
while ($row = $userresult->fetch_assoc()) {

    $name = $row['username'];
    $id = $row['id'];
    $img = $row['profileimg'];


    echo"
       <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
       <div  id ='uc' class='card w=33'>
       <a href = 'venuepage.php?venue=$id'>
            <img class='card-img-top img-fluid' src='img/$img' style = 'height:400px; width:450px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
            </a>
            <div class='card-body'>
            <h1 class ='card-title footertext'>"; echo htmlescape($name); echo" </h1>
            </div> 
            </div>
            </div>";
}
?>



<div class = "col-xl-12 btn-group" style="text-align:center;">
                    <div class ="row" style="padding-bottom:30px">

                <?php
                for ($i = 1; $i <= $totalvenuepages; $i++) {
                    echo "<div  style='padding-left:50px; padding=right:50px'> <a href='venuelistpage.php?venues=" . $i . "'> <button type ='button' class = 'btn btn-danger'> $i </button> </a>  </div> ";
                }
                ?>


                    </div>

                </div>

            </div>
        </div>
        <footer  class="navbar fixed-bottom">

            <h1 class='footertext'> BigFestBelfast </h1>
            
        </footer>














    </body>












</html> 