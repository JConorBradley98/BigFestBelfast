<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");
if (!isset($_SESSION['venue'])) {
    header("Location:venuepage.php");
}

$venuemanager = $_SESSION['venue'];

$venueowner = $_GET['editor'];





$venuefetch = $conn->prepare("SELECT * FROM venue INNER JOIN venuepage ON venue.id = venuepage.venueid INNER JOIN user ON venue.managerid = user.id WHERE user.id = ?");

$venuefetch->bind_param("i", $venueowner);
$venuefetch->execute();

$venuefetchresult = $venuefetch->get_result();

$venuefetchresult = $venuefetchresult->fetch_assoc();

$username = $venuefetchresult['username'];
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
$managerid = $venuefetchresult['managerid'];
$venueid = $venuefetchresult['id'];
$profileimg = $venuefetchresult['profileimg'];


$gallery = array($image1, $image2, $image3);
?>


<html>

    <head>
        <title> <?php echo "Edit $username's page "; ?> </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Sen&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <link rel="stylesheet" href ="frontendcss.css">
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <script src="swipebox/jquery.swipebox.js"></script>
        <link rel="Stylesheet" href="swipebox/swipebox.css" >
        <script>$(document).ready(function () {
    $('.swipebox').swipebox();
});
        </script>



    </head>

    <body id="cbody" style = "text-align:center;">
        <header>
            <img src="img/logo.png" >
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
                           <a href="index.php"> <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
<?php
echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
        <a href='logout.php'> <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";


      echo "<li class='nav-item'>
      <a class='nav-link' href='inbox.php'>Inbox</a>
     <a href='inbox.php'> <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



  echo "<li class='nav-item'>
    <a class='nav-link' href='messagepage.php'>Send Message</a>
   <a href='messagepage.php'> <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
  </li>";







echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
      <a href='venueannouncement.php'>  <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";





echo "<li class='nav-item'>
        <a class='nav-link active' href='venuepage.php?venue=$venuemanager'>View Venue Page</a>
        
  <a href='venuepage.php?venue=$venuemanager'> <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";

if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
    <a href='scheduleview.php'>  <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
    
}


echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    <a href='performerlistpage.php'>  <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
  <a href='showlistpage.php'>   <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='venuelistpage.php'>View Venues</a>
     <a href='venuelistpage.php'> <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
      
<a href='publicuserpage.php'> <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
?>


                    </ul>
                </div>
            </nav>

            <div class="row">

                <div class="col-xl-4" id="central" style=" background-color: #BB0A21;">
                <?php echo"
                <div class ='box2 gal'>
<div>
<a href='img/$mainimage'  class='swipebox' title='img/$mainimage'> <img  src='img/$mainimage' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'/></a>
</div>
<div>
<a href='img/$profileimg' class='swipebox' title='img/$profileimg'><img hidden src='img/$profileimg' alt='image'/></a>
</div>

</div>"; ?>
                    <h1 class="footertext"> Venue </h1>
                    <h2 class="footertext">   <?php echo htmlescape($username); ?>            </h2>
                    <div class="textdiv">
                    <p class="generaltext"> <?php echo htmlescape($text); ?> </p>
                    </div>
                    <h1 class="footertext"> Contact Details </h1>
                    <h1 class="footertext"> Phone Number </h1>
                    <h2 class="footertext"> <?php echo htmlescape($phone); ?> </h2>
                    <h1 class="footertext"> Email Address </h1>
                    <h2 class="footertext"> <?php echo htmlescape($email); ?> </h2>
                    <h1 class="footertext"> Address </h1>
                    <h2 class="footertext"> <?php echo htmlescape($address); ?> </h2>
                    <h1 class="footertext"> Capacity </h1>
                    <h2 class="footertext"> <?php echo htmlescape($capacity); ?> </h2>
                    

                </div>

                <div id="profileright" class="col-xl-4" style=" background-color: #BB0A21;" >
                    <div id="profileright">
                    <?php
                        echo"
<div class ='box2 gal'>
<div>
<a href='img/$image1'  class='swipebox' title='img/$image1'><img src='img/$image1' style='width:400px; height:400px;' alt='image'/></a>
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
                </div>


                <div class="col-xl-4" style=" background-color: #BB0A21;">
                    <form action = "venuepagesavechanges.php" method="post" enctype="multipart/form-data">
                        <div class="form-group" style="padding-right:15px;">
                        <label>       <h1 class="footertext"> Venue Page Title </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter Venue Page title" name="venuepagetitle">
                            <label>       <h1 class="footertext"> Venue Page Text </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter some text for your page" name="venuepagetext">
                            <label>       <h1 class="footertext"> Change Profile Image </h1> </label>
                            <input type = "file" class="form-control-file" placeholder="Enter Venue Profile Image" name="img">
                            <label>       <h1 class="footertext"> Change Venue Image </h1> </label>
                            <input type = "file" class="form-control-file" placeholder=" Enter Venue Image" name="venueimg">
                            <label>       <h1 class="footertext"> Change Phone Number </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter phone number" name="phonenumber">
                            <label>       <h1 class="footertext"> Change Email </h1> </label>
                            <input type = "email" class="form-control" placeholder="Enter Email" name="email">
                            <label>       <h1 class="footertext"> Change Address </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter address" name="address">
                            <label>       <h1 class="footertext"> Change Capacity </h1> </label>
                            <input type = "number" class="form-control" placeholder="Enter Venue Capacity" name="capacity" min ="1" max = "1000000">
                            <label>       <h1 class="footertext"> Gallery Images </h1> </label>
                            <input type="file" class="form-control-file" name="images[]" placeholder="Choose Gallery Images" multiple>
                            <input type = "submit" class="form-control"  value="Save Changes" name="change"> 
                            </form>
                            <a href = 'profilepage.php?user='> <button type="button" class="btn btn-danger">Cancel</button> </a>







                    </form>


                </div>





            </div>











        </div>
    </div>
    <footer class="navbar fixed-bottom" style="background-color:#4B88A2;">

        <h1 class="footertext"> BigFestBelfast </h1>
        <div style ="text-align:left;">
        </div>

    </footer>














</body>














</html>