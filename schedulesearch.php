<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");


if(!isset($_SESSION['performer']) && !isset($_SESSION['venue'])){
    header("Location:index.php");
    
}





if(!empty($_POST['showname'])){
    $showname = "%".$_GET['showname']."%";
    
}

if(!empty($_POST['searchdate'])){
    $showdate = "%".$_GET['searchdate']."%";
    
}





if(isset($_SESSION['venue'])){
    $managerid = $_SESSION['venue'];
    
    $user = $_SESSION['venue'];
    $venuefind = $conn -> prepare("SELECT * FROM venue WHERE managerid = ?");
    $venuefind -> bind_param('i',$managerid);
    $venuefind -> execute();
    $venuefindresult = $venuefind -> get_result();
    $venuefindresult = $venuefindresult -> fetch_assoc();
    $venueid = $venuefindresult['id'];

    if(!isset($showdate)){
        $scheduleread = $conn -> prepare("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.venueid = ? AND showpage.title LIKE ? ");
        $scheduleread -> bind_param("is",$venueid,$showname);
        
    }
        elseif(!isset($showname)){
        $scheduleread = $conn -> prepare("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.venueid = ? AND showdb.showdate LIKE ?  ");
        $scheduleread -> bind_param("is",$venueid,$showdate);
        
}
        
        else{
        $scheduleread = $conn -> prepare("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.venueid = ? AND showpage.title LIKE ? AND showdb.showdate LIKE ? ");
        $scheduleread -> bind_param("iss", $venueid, $showname, $showdate);
        
        }
}

if(isset($_SESSION['performer'])){
    $performerid = $_SESSION['performer'];
    $user = $_SESSION['performer'];
    if(!isset($showdate)){
    $scheduleread = $conn -> prepare("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.performerid = ? AND showpage.title LIKE ?");
    $scheduleread -> bind_param("is",$performerid,$showname);
    }
    elseif(!isset($showname)){
    $scheduleread = $conn -> prepare ("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.performerid = ? AND showdb.showdate LIKE ?");
   
    $scheduleread -> bind_param("is",$performerid,$showdate);
    }
    else{
    $scheduleread = $conn -> prepare ("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid WHERE showdb.performerid = ? AND showpage.title LIKE ? AND showdb.showdate LIKE ?");
        $scheduleread -> bind_param("iss", $performerid, $showname, $showdate); 
        }
}



$scheduleread -> execute();







?>

<html>
    <head>
        <title> Your Schedule </title>
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
                         <a href="index.php">   <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
<?php
if ($user == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
    <a href='login.php'>   <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
    <a href='logout.php'>    <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if ($user == "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
       <a href='create.php'> <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
   <a href='secure/userspage.php'>     <img src ='img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if ($user != "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
   <a href='inbox.php'>     <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";


    echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    <a href='messagepage.php'>  <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
}


if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
   <a href='venueannouncement.php'>     <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>
      <li class='nav-item'>
        <a class='nav-link' href='venuepage.php?venue=$user'>View Venue Page</a>
    <a href='venuepage.php?venue=$user'>    <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";

}

if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
       <a href='application.php'> <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";

}

if ($user != "unreg" && !isset($_SESSION['venue'])) {

    echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$user'>View Profile</a>
       <a href ='profilepage.php?user=$user'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link active' href='scheduleview.php'>View Your Upcoming Shows</a>
    <a href='scheduleview.php'>  <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
    
}



echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    <a href='performerlistpage.php'>  <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
    <a href='showlistpage.php'>  <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
    <a href='venuelistpage.php'>  <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
   <a href='publicuserpage.php'>   <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
?>


                    </ul>
                </div>
            </nav>
            <div class = "container-fluid">
                <div class = "col-xl-12 searchdiv">

                    <form action = "schedulesearch.php" class ="form-group" method ="post">
                        <div class ="form-row">
                            <div class = "col-xl-2">
                                <label for ="username"><h2 class='footertext'> Search for a Show in Your Schedule </h2> </label>
                            </div>
                            <div class = "col-xl-2">
                                <input class="form-control" type = "text" name = "showname" id="username" placeholder="Show Name">
                            </div>
                            <div class = "col-xl-1">
                            <label>  <h2 class="formh"> Start Date</h2> </label>
                            </div>
                            <div class = "col-xl-2">
                                <input class="form-control" type = "date" name = "searchdate" id="username" placeholder="Show Date">
                            </div>
                            <div class ="col-xl-1">
                                <input class = "form-control" type = "submit" value = "Search">
                            </div>
                        </div>


                    </form>


                </div>
            </div>
            <div class="row">
<?php
$scheduleresult = $scheduleread -> get_result();


if($scheduleresult ->num_rows < 1){
    
    echo "<div class='col-xl-12' style='text-align:center;'> <h1 class='footertext'> No Results Found </h1> </div>";
}
while ($row = $scheduleresult->fetch_assoc()) {
    
    $name = $row['title'];
    $id = $row['showid'];
    $img = $row['img1'];
    $starttime = $row['showdate'];
    $endtime = $row['endate'];
   

    echo"
       <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
       <div  id ='uc' class='card w=33'>
       <a href = 'showpage.php?show=$id'>
            <img class='card-img-top img-fluid' src='img/$img' style = 'height:400px; width:450px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
            </a>
            <div class='card-body'>
            <h1 class ='card-title footertext'>"; echo htmlescape($name); echo" </h1>
            <h1 class ='card-title footertext'> Start Time: "; echo htmlescape($starttime); echo" </h1>
            <h1 class ='card-title footertext'> End Time: "; echo htmlescape($endtime); echo" </h1>
            </div> 
            </div>
            </div>";
}
?>




            </div>
        </div>
        <footer  class="navbar fixed-bottom">

            <h1 class='footertext'> BigFestBelfast </h1>
           

        </footer>














    </body>












</html> 