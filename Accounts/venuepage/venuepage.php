<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");

if (isset($_SESSION['venue'])) {
    $venueowner = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
    $venueowner = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
    $venueowner = $_SESSION['performer'];
} elseif (isset($_SESSION['admin'])) {
    $venueowner = $_SESSION['admin'];
} else {
    $venueowner = "unreg";
}

$venue = $_GET['venue'];



$venuefetch = $conn->prepare("SELECT * FROM venue INNER JOIN venuepage ON venue.id = venuepage.venueid INNER JOIN user ON venue.managerid = user.id WHERE user.id = ? ");

$venuefetch->bind_param("i", $venue);
$venuefetch->execute();

$venuefetchresult = $venuefetch->get_result();

$venuefetchresult = $venuefetchresult->fetch_assoc();


$title = $venuefetchresult['title'];
$text = $venuefetchresult['maintext'];
$image1 = $venuefetchresult['img1'];
$image2 = $venuefetchresult['img2'];
$image3 = $venuefetchresult['img3'];
$phone = $venuefetchresult['phone'];
$address = $venuefetchresult['address'];
$email = $venuefetchresult['email'];
$capacity = $venuefetchresult['capacity'];
$mainimage = $venuefetchresult['img'];
$profileimage = $venuefetchresult['profileimg'];
$managerid = $venuefetchresult['managerid'];
$username = $venuefetchresult['username'];



$promomaterialdownload = $conn -> prepare("SELECT * FROM promomaterial WHERE owner = ?");
$promomaterialdownload -> bind_param("i",$managerid);
$promomaterialdownload -> execute();
$promomaterialdownloadresult = $promomaterialdownload -> get_result();






$gallery = array($image1, $image2, $image3);


?>



<html>

    <head>
        <title> <?php echo $username; ?> </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>


        <script src="swipebox/jquery.swipebox.js"></script>
        <link rel="Stylesheet" href="swipebox/swipebox.css" >
        <script>$(document).ready(function () {
    $('.swipebox').swipebox();
});
        </script>

        <link rel="stylesheet" href ="frontendcss.css">
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">





    </head>

    <body id="cbody" style = "text-align:center;">
        <header>
            <img src="img/logo.png" class="img-fluid">
            <h2 class="datetext"> From 29.06.2020 - 05.07.2020 </h2>

        </header>

        <div class="contain-fluid">
            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto  justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                         <a href="index.php">   <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>

                        </li>
<?php
if ($venueowner == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
     <a href='login.php'>   <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
      <a href='logout.php'>  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if ($venueowner == "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
        
<a href='create.php'> <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
     <a href='secure/userspage.php'>   <img src ='img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}

if ($venueowner != "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
      <a href='inbox.php'>  <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";



    echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
     <a href='messagepage.php'> <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
}

if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
       <a href='application.php'> <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}
if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
     <a href='venueannouncement.php'>   <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
}




if (!isset($_SESSION['venue']) && $venueowner != "unreg" &&!isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
          <a class='nav-link' href='profilepage.php?user=$venueowner'>View Profile</a>
         <a href='profilepage.php?user=$venueowner'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
        </li>";
}

if (isset($_SESSION['venue'])) {

    echo "<li class='nav-item'>
        <a class='nav-link active' href='venuepage.php?user=$venueowner'>View Venue Page</a>
     <a href='venuepage.php?user=$venueowner'>   <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
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
      <a href='performerlistpage.php'> <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
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
      
<a href ='publicuserpage.php'> <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
?>


                    </ul>
                </div>
            </nav>


            <div class="row profilepagerow">

                <div class="col-xl-5" id="central" style=" background-color: #BB0A21;">
                <?php echo"
                <div class ='box2 gal'>
<div>
<a href='img/$mainimage'  class='swipebox' title='img/$mainimage'> <img  src='img/$mainimage' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'/></a>
</div>
<div>
<a href='img/$profileimage' class='swipebox' title='img/$profileimage'><img hidden src='img/$profileimage' alt='image'/></a>
</div>

</div>"; ?>
                    
                    <h1 class="footertext"> Venue </h1>
                    <h2 class="footertext">   <?php echo htmlescape($username); ?> </h2>
                    <h1 class="footertext"> Contact Details </h1>
                    <h1 class="footertext"> Phone Number </h1>
                    <h2 class="footertext"> <?php echo htmlescape($phone); ?> </h2>
                    <h1 class="footertext"> Email Address </h1>
                    <h2 class="footertext"> <?php echo htmlescape($email); ?> </h2>
                    <h1 class="footertext"> Address </h1>
                    <h2 class="footertext"> <?php echo htmlescape($address); ?> </h2>
                    <h1 class="footertext"> Capacity </h1>
                    <h2 class="footertext"> <?php echo htmlescape($capacity); ?> </h2>
                    <h1 class="footertext"> Promotional Material </h1>
                    <div class="textdiv">
                    <?php
                     while($promorow = $promomaterialdownloadresult -> fetch_assoc()){
                            $materialaddress = $promorow['promomaterial'];
                                //replace hosting address with own here
                            echo "<a href= 'http://lrobinson46.hosting.eeecs.qub.ac.uk/Bigfest/promomaterial/$materialaddress' download> $materialaddress </a>";


                     }






                    ?>
                    </div>  



 
            










                </div>
                <div class="col-xl-5" style=" background-color: #BB0A21;">
                <h1 class="footertext"> <?php echo htmlescape($title); ?> </h1>
                <div class="textdiv">
                    <p class="generaltext"> <?php echo htmlescape($text); ?> </p>
                    </div>
                <?php
                        echo"
<div class ='box2 gal'>
<div>
<a href='img/$image1'  class='swipebox' title='img/$image1'><img src='img/$image1' style='width:500px; height:500px;' alt='image'/></a>
</div>
<div>
<a href='img/$image2' class='swipebox' title='img/$image2'><img hidden src='img/$image2' alt='image'/></a>
</div>
<div>
<a href='img/$image3' class='swipebox' title='img/$image3'><img hidden src='img/$image3'  alt='image'/></a>
</div>

</div>"
                        ?>


                </div>

                <div class="col-xl-2" style=" background-color: #BB0A21;">
                    <?php
                    if ($venueowner == $managerid) {
                        echo"<h1 class='footertext'> Edit "; echo htmlescape($username); echo" page       <h1>
  <a href='venuepageedit.php?editor=$venueowner'  <button type='button' class='btn btn-success'>Edit</button> </a>";
                        echo"<h1 class='footertext'> Upload Promotional Material       </h1>
                            
                            <form action = 'materialupload.php' method='post' enctype='multipart/form-data'>
                            <div class='form-group'>   
                            <input type='file' class='form-control-file' name='material[]' placeholder='Upload Promotional Material' multiple>
                            <input type = 'submit' class=''  value='Upload' name='upload'> 




                            </form>
                            </div>";
                            
                    }


                    if (isset($_SESSION['performer'])) {
                        echo "<h1 class='footertext'> Apply for a show </h1>
  <a href='directshowapplication.php?venue=$venue'  <button type='button' class='btn btn-success'>Apply</button> </a>";
                    }

                    if ($venueowner != "unreg" && $venue != $venueowner) {
                        echo"<h1 class='footertext'> Send Message to "; echo  htmlescape($username); echo" </h1>
  <a href='messagethroughprofile.php?recipient=$managerid'  <button type='button' class='btn btn-success'>Message</button> </a>";
                    }
                    ?>


                </div>





            </div>

            <div class="row" style="text-algin:Center">
            <div class = "col-xl-12 profileshowbackground" style="text-align:center;">
            <h1 class='formh'> Upcoming Shows </h1>
            
            <?php
$showselectionquery = $conn->prepare("SELECT * FROM showdb INNER JOIN showpage ON showdb.id = showpage.showid INNER JOIN venue ON showdb.venueid = venue.id WHERE venue.managerid = ? AND showdate > CURDATE() ORDER BY showdate ASC LIMIT 3");
$showselectionquery->bind_param("i", $venue);
$showselectionquery->execute();



$showselectionqueryresult = $showselectionquery->get_result();

if ($showselectionqueryresult->num_rows < 1) {
    echo"<h1 class='formh'> No Upcoming Shows </h1>";
} else{
    echo"<div class='card-deck'>";


while ($row = $showselectionqueryresult->fetch_assoc()) {

    $showtitle = $row['title'];
    $showimg = $row['img1'];
    $startdate = $row['showdate'];



    echo"
    <div id='cardcol' class='col-xl-4' style='padding:20px; text-align:center;'>
  <div  id ='uc' class='card w=33'>
  <a href = 'showpage.php?showno=#'>
       <img class='card-img-top img-fluid' src='img/$showimg' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'> </img>
       </a>
       <div class='card-body'>
       <h1 class ='card-title footertext'>"; echo htmlescape($showtitle); echo" </h1>
       <h1 class ='card-title footertext'> Starts at: "; echo htmlescape($startdate); echo" </h1>
       <h1 class ='card-title'> </h1>
       </div> 
       </div>
       </div>";
}
echo "</div>";

}

$showselectionquery->close();
?>


        </div>



        </div>

        </div>
        </div>

        <footer style="background-color:#4B88A2;"class="navbar fixed-bottom">

            <h1 class="footertext"> BigFestBelfast </h1>
        </footer>














    </body>














</html>