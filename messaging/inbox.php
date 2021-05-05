<?php
session_start();


include("conn.php");
include("sitescriptingfix.php");

if (isset($_SESSION['admin'])) {
    $inboxowner = $_SESSION['admin'];
} elseif (isset($_SESSION['venue'])) {
    $inboxowner = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
    $inboxowner = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
    $inboxowner = $_SESSION['performer'];
} else {
    $inboxowner = "unreg";
}

if ($inboxowner == "unreg") {
    header("Location:index.php");
}



$inboxquery = $conn->prepare("SELECT user.username, message.id, message.senderid, message.title, message.text, message.date FROM user INNER JOIN message ON user.id = message.`senderid` WHERE message.` recipientid` = ? ORDER BY date DESC");
$inboxquery->bind_param("i", $inboxowner);
$inboxquery->execute();

$inboxecho = $inboxquery->get_result();

$inboxquery->close();
?>

<html>
    <head>
        <title> Inbox </title>
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

    <body id="cbody" style="background-color:#BB0A21;">
        <header>
            <img src="img/logo.png" class="img-fluid">
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
                        <a href="index.php">    <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
<?php
if ($inboxowner == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
     <a href='logout.php'>  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>

      </li>
      ";
}

if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
      <a href='secure/userspage.php'>  <img src ='img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if ($inboxowner != "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link  active' href='inbox.php'>Inbox</a>
      <a href='inbox.php'>  <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

    echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    <a href='messagepage.php'>  <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
       <a href='application.php'> <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>  ";
}

if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
      <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
   <a href='venueannouncement.php'>   <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>   <li class='nav-item'>
    <a class='nav-link' href='venuepage.php?venue=$inboxowner'>View Venue Page</a>
    <a href = 'venuepage.php?venue=$inboxowner'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
  </li>";
}



if ($inboxowner != "unreg" && !isset($_SESSION['venue']) &&!isset($_SESSION['admin'])) {

    echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$inboxowner'>View Profile</a>
        <a href='profilepage.php?user=$inboxowner'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}


if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
      <a href='scheduleview.php'> <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
    
}


echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    <a href ='performerlistpage.php'>  <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
    <a href='showlistpage.php'>  <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
   <a href='venuelistpage.php'>   <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
      
<a href ='publicuserpage.php'> <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
?>


                    </ul>
                </div>
            </nav>



            <div class="contain-fluid">
            <div class="col-xl-12 text-center" id="con">
            <h1 class='formh'> Messages </h1>
                <div class="row">

                        <?php
                        if ($inboxecho->num_rows < 1) {
                            echo "<h1 class='formh'> No Messages </h1>";
                        } else {
                            while ($row = $inboxecho->fetch_assoc()) {

                                $sender = $row['username'];
                                $messagetitle = $row['title'];
                                $messagetext = $row['text'];
                                $messageid = $row['id'];
                                $sendtime = $row['date'];


                                echo"
    <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
    <div  id ='uc' class='card w=33'>
         </a>
         <div class='card-body'>
         <h1 class ='card-title footertext'> Sender: "; echo htmlescape($sender); echo"  </h1>
         <h1 class ='card-title footertext'> <a href = 'viewmessage.php?messno=$messageid'> Title: "; echo htmlescape($messagetitle); echo "</a> </h1>
         <h1 class ='card-title footertext'> Sent at: "; echo htmlescape($sendtime); echo"  </h1>
         </div> 
         </div>
         </div>";
                            }
                        }

                        

                        if (isset($_SESSION['venue'])) {

                            $application = $conn->prepare("SELECT  user.username, venue.id, venue.managerid, application.id, application.venueid, application.title, application.message, application.date, application.enddatetime,application.confirmed FROM application INNER JOIN venue ON application.venueid = venue.id INNER JOIN user on application.performerid = user.id WHERE venue.managerid=? AND application.date > CURDATE() ORDER by application.date DESC");
                            $application->bind_param("i", $inboxowner);
                            $application->execute();
                            $applicationresult = $application->get_result();
                            echo "<div class='row'>";
                            echo "<div class='col-xl-12'>";
                         
                            echo"<div> <h1 class='footertext'> Applications </h1> </div>";


                            if ($applicationresult->num_rows < 1) {
                                echo " <div> <h1 class='footertext'> No Applications </h1> </div>";
                            } else {

                                echo "<div class ='card-deck'>";
                                while ($applicationrow = $applicationresult->fetch_assoc()) {

                                    $applicationtitle = $applicationrow['title'];
                                    $applicationid = $applicationrow['id'];
                                    $applicationdescription = $applicationrow['message'];
                                    $applicationdate = $applicationrow['date'];
                                    $enddate = $applicationrow['enddatetime'];
                                    $applicationaccepted = $applicationrow['confirmed'];
                                    $applicantname = $applicationrow['username'];

                                    echo" 
         <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
         <div  id ='uc' class='card w=33'>
              </a>
              <div class='card-body'>
              <h1 class ='card-title footertext'> Sender: "; echo htmlescape($applicantname); echo" </h1>
              <h1 class ='card-title footertext'>  Title: "; echo htmlescape($applicationtitle); echo" </a> </h1>
              <h1 class ='card-title footertext'>  Start Time: ";echo htmlescape ($applicationdate); echo" </a> </h1>
              <h1 class ='card-title footertext'>  End Time: ";echo htmlescape ($enddate); echo" </a> </h1>
              <p class='card-text generaltext'>"; echo  htmlescape($applicationdescription); echo"</p>";
                                    if (is_null($applicationaccepted)) {
                                        echo"
              
              
                  <script>   function acceptwarning$applicationid() {
                   var accept$applicationid = confirm('Are you sure you want to accept this application?');
                            
                   if (accept$applicationid == true) {
                      window.location.href = 'accept.php?acceptedapplication=$applicationid';
                            
                    }
                            
                            
                    }
                    </script>     
              
              
                <a type='button' class='btn btn-success' onclick='acceptwarning$applicationid()'>Accept Application</a>


              <script>   function denywarning$applicationid() {
                var deny$applicationid = confirm('Are you sure you want to deny this application? This cannot be undone');

                if (deny$applicationid == true) {
                    window.location.href = 'deny.php?denyapplication=$applicationid';

                }


            }
        </script>     
              <a type='button' class='btn btn-danger' onclick='denywarning$applicationid()'>Deny Application</a>";
                                    }
                                    if ($applicationaccepted == 1) {
                                        echo"<h1 class='footertext'> Application Confirmed </h1>";
                                    }
                                    if (!is_null($applicationaccepted) && $applicationaccepted == 0) {
                                        echo"<h1 class='footertext'> Application denied </h1>";
                                    }
                                    echo "</div> 
              </div>
              </div>
              
              ";
                                }
                            }
                        }
                        ?>
                </div>
                
                
                <div class = "row">
                 <div class = "col-xl-12">
                    <?php
                    if (isset($_SESSION['performer'])) {

                        $performerannouncement = $conn->prepare("SELECT * FROM `message` INNER JOIN `user` ON message.`senderid` = user.`id` WHERE message.` recipientid` = ? AND message.announcement = 1 ORDER BY message.date DESC");
                        $performerannouncement->bind_param("i", $inboxowner);
                        $performerannouncement->execute();
                        $performerannouncementresult = $performerannouncement->get_result();
                        echo"<div style='text-align:center;'> <h1 class='footertext'> Announcements </h1> </div>";
                        if ($performerannouncementresult->num_rows < 1) {
                            echo" <div style='text-align:center;'> <h1 class='footertext'> No Announcements </h1> </div>";
                        } else {
                            echo"<div class = 'card-deck'>";

                            while ($performerannouncementrow = $performerannouncementresult->fetch_assoc()) {

                                $announcementtitle = $performerannouncementrow['title'];
                                $announcementid = $performerannouncementrow['id'];
                                $performerannouncementtext = $performerannouncementrow['text'];
                                $performerannouncementdate = $performerannouncementrow['date'];
                                $venueusername = $performerannouncementrow['username'];

                                echo" 
        <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
        <div  id ='uc' class='card w=33'>
             </a>
             <div class='card-body'>
             <h1 class ='card-title footertext'> Sender: "; echo htmlescape($venueusername); echo" </h1>
             <h1 class ='card-title footertext'>  Title: "; echo htmlescape($announcementtitle); echo" </a> </h1>
             <h1 class ='card-title footertext'>  Date and Time Sent: "; echo htmlescape($performerannouncementdate); echo " </a> </h1>
             <p class='card-text generaltext'>"; echo htmlescape($performerannouncementtext); echo"</p>
             </div> 
             </div>
             </div>";
                            }
                        }
                    }
                    ?>
                </div>


            </div>
            </div>
        </div>
        <footer style="background-color:#4B88A2;"  class="navbar fixed-bottom">

            <h1 class="footertext"> BigFestBelfast </h1>
            

        </footer>














    </body>












</html> 