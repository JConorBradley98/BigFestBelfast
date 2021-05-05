<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");
$messageid = $_GET['messno'];
if (isset($_SESSION['admin'])) {
    $checkuserid = $_SESSION['admin'];
} elseif (isset($_SESSION['venue'])) {
    $checkuserid = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
    $checkuserid = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
    $checkuserid = $_SESSION['performer'];
} else {
    header("Location:index.php");
}




$viewmessagequery = $conn->prepare("SELECT * FROM message WHERE id = ? AND ` recipientid` = ? ");
$viewmessagequery->bind_param("ii", $messageid, $checkuserid);
$viewmessagequery->execute();
$viewmessageresult = $viewmessagequery->get_result();
$viewmessageresult = $viewmessageresult->fetch_assoc();

$title = $viewmessageresult['title'];
$text = $viewmessageresult['text'];
$sender = $viewmessageresult['senderid'];
$date = $viewmessageresult['date'];


$senderquery = $conn->prepare("SELECT * FROM user WHERE id = ?");
$senderquery->bind_param("i", $sender);
$senderquery->execute();
$senderqueryresult = $senderquery->get_result();
$senderqueryresult = $senderqueryresult->fetch_assoc();
$sendername = $senderqueryresult['username'];
$senderimg = $senderqueryresult['profileimg'];
?>



<html>
    <head>
        <title> <?php echo $title; ?> </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href ="frontendcss.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        




    </head>

    <body id="cbody" style="background-color: #BB0A21; overflow-x:hidden " >
        <header>
            <img src="img/logo.png" class="img-fluid" >
            <h2 class="datetext"> From 29.06.2020 - 05.07.2020 </h2>

        </header>

        

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
<?php
echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
        <a href='logout.php'> <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";



if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
     <a href='secure/userspage.php'>   <img src ='img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

echo "<li class='nav-item'>
        <a class='nav-link  active' href='inbox.php'>Inbox</a>
    <a href='inbox.php'>    <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
     <a href='messagepage.php'> <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
      <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
    <a href='venueannouncement.php'>  <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>
    <li class='nav-item'>
    <a class='nav-link' href='venuepage.php?venue=$checkuserid'>View Venue Page</a>
   <a href='venuepage.php?venue=$checkuserid'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
  </li>";
}






if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
        <a href ='application.php'> <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> 
      </li>";
}

if(!isset($_SESSION['venue']) &&!isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
            <a class='nav-link' href='profilepage.php?user=$checkuserid'>View Profile</a>
         <a href='profilepage.php?user=$checkuserid'>   <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
          </li>";
    }

if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
    <a href='scheduleview.php'>  <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
    
}

?>
<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
   <a href="performerlistpage.php">   <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      
    </li>


    <li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
      <a href='showlistpage.php' > <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>



    <li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
     <a href='venuelistpage.php'> <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>



    <li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
     <a href='publicuserpage.php'> <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>

                    </ul>
                </div>
            </nav>
            <div class="container-fluid">
            <div class="row" >


                <div class="col-xl-3 text-center" id="con"  style="height:650px">

                    <h1 class="footertext"> <?php echo htmlescape($sendername); ?> </h1>
                    <img src = "img/<?php echo $senderimg ?>" style="height:400px; width:400px;"> 









                </div>
                <div class="col-xl-9 text-center" id="con" style="height:650px; overflow-x:hidden;">

                    <h1 class="footertext"> <?php echo htmlescape($title); ?> </h1>

                    <div>
                        <div class="textdiv">
                        <div class="form-group" style="text-align:center">
                        <h2 class="generaltext">
                        <textarea readonly class="form-group" style="height:500px;">
                     <?php echo htmlescape($text); ?> 
                        </textarea>
                        </h2>
                        </input>
                        </div>
                        </div>
                        



                    <a type='button' class='btn btn-danger' href='inbox.php'> Return to Inbox  </a>
                    </div>

                </div>
            </div>
        </div>
        <footer  class="navbar fixed-bottom" style="background-color:#4B88A2; overflow-x:hidden; padding-left:5px; margin:0px">

            <h1 class="footertext"> BigFestBelfast </h1>
         

        </footer>














    </body>












</html> 