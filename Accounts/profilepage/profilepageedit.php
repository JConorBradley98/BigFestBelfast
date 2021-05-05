<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");

if (isset($_SESSION['venue'])) {
    $trueprofileeditor = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
    $trueprofileeditor = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
    $trueprofileeditor = $_SESSION['performer'];
} else {
    $trueprofileeditor = 0;
}


$profileowner = $_GET['editor'];


if ($trueprofileeditor != $profileowner) {
    header("Location:index.php");
}




if ($trueprofileeditor != $profileowner) {
    header("Location:index.php");
}



$profilefetch = $conn->prepare("SELECT profilepage.userid, profilepage.title, profilepage.text, profilepage.img1, profilepage.img2, profilepage.img3,user.username,user.usertype,user.profileimg FROM profilepage INNER JOIN user ON
profilepage.userid = user.id WHERE profilepage.userid = ?");

$profilefetch->bind_param("i", $profileowner);
$profilefetch->execute();

$profilefetchresult = $profilefetch->get_result();

$profilefetchresult = $profilefetchresult->fetch_assoc();

$profileimg = $profilefetchresult['profileimg'];
$title = $profilefetchresult['title'];
$text = $profilefetchresult['text'];
$username = $profilefetchresult['username'];
$image1 = $profilefetchresult['img1'];
$image2 = $profilefetchresult['img2'];
$image3 = $profilefetchresult['img3'];
?>



<html>

    <head>
        <title> <?php echo "Edit $username's profile "; ?> </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

       
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
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                          <a href="index.php">  <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
<?php
echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
      <a href='logout.php'>  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>
      </li>";

      if ($trueprofileeditor != "unreg") {
        echo "<li class='nav-item'>
            <a class='nav-link' href='inbox.php'>Inbox</a>
           <a href='inbox.php'> <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
          </li>";
    
    
    
        echo "<li class='nav-item'>
          <a class='nav-link' href='messagepage.php'>Send Message</a>
         <a href='messagepage.php'> <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
        </li>";
    }




    if (isset($_SESSION['venue'])) {
        echo "<li class='nav-item'>
            <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
          <a href='venueannouncement.php'>  <img src ='img/announcement.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
          </li>  <li class='nav-item'>
          <a class='nav-link' href='venuepage.php?venue=$trueprofileeditor'>View Venue Page</a>
        <a href='venuepage.php?venue=$trueprofileeditor'>  <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
        </li>";
    }
    
    if ($trueprofileeditor != "unreg" && !isset($_SESSION['venue'])) {

        echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
      <a href='application.php'>  <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";
    
        echo "<li class='nav-item'>
            <a class='nav-link active' href='profilepage.php?user=$trueprofileeditor'>View Profile</a>
         <a href='profilepage.php?user=$trueprofileeditor'>   <img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
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
<a href='performerlistpage.php'>   <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
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
 <a href='publicuserpage.php'>  <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
 </li>";
?>


                    </ul>
                </div>
            </nav>

            <div class="row" style="height:724px; ">

                <div class="col-xl-4" id="central"style=" background-color: #BB0A21;">
                    <img  src='img/<?php echo $profileimg; ?>' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'> 
                    <h1 class="footertext"> Account Name </h1>
                    <h2 class="footertext">   <?php echo htmlescape($username); ?>            </h2>

                </div>

                <div id="profileright" class="col-xl-4" style=" background-color: #BB0A21;">
                    <div id="profileright">
                        <h1 class="footertext"> <?php echo htmlescape($title); ?> </h1>
                        <div class="textdiv">
                        <p class="generaltext">  <?php echo htmlescape($text); ?>             </p>
                        </div>
                        <?php
//foreach($gallery as $galleryimage){
                        echo"
    <div class ='box2 gal'>
    <div>
<a href='img/$image1' class='swipebox' title='img/$image1'><img class ='img-fluid' src='img/$image1' style='height:400px; width:550px;'  alt='image'/></a>
    </div>
    <div>
<a href='img/$image2' class='swipebox' title='img/$image2'><img hidden src='img/$image2' alt='image'/></a>
</div>
<div>
<a href='img/$image3' class='swipebox' title='img/$image3'><img hidden src='img/$image3'  alt='image'/></a>
</div>

</div>";
//}
                        ?>
                    </div>
                </div>
                


                <div class="col-xl-4" style=" background-color: #BB0A21;">
                    <form action = "savechanges.php" method="post" enctype="multipart/form-data">
                        <div class="form-group" style="padding-right:15px;">
                            <label for="title"> <h1 class="footertext"> New Title </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter Profile title" name="profiletitle" id="title">
                            <label for="text"> <h1  class="footertext"> New Text </h1> </label>
                            <input type = "text" class="form-control" placeholder="Enter some text for your profile" name="profiletext" id="text">
                            <label for="profilepicture"> <h1  class="footertext"> New Profile Image </h1> </label>
                            <input type = "file" class="form-control-file" placeholder="Enter profile image" name="img" id="profilepicture">
                            <label for="pageimages"> <h1  class="footertext"> New Profile Page Images </h1> </label>
                            <input type="file" class="form-control-file" name="images[]" placeholder="Choose Gallery Images" multiple id="pageimages">
                            <input type = "submit" class="form-control"  value="Save Changes" name="change"> 
                        </div>
                    </form>
<?php echo"
<a href = 'profilepage.php?user=$profileowner'> <button type='button' class='btn btn-danger'>Cancel</button> </a>";
?>






                </div>



            </div>
















        </div>

        <footer style ="background-color:#4B88A2;" class="navbar fixed-bottom">

            <h1 class="footertext"> BigFestBelfast </h1>

        </footer>














    </body>














</html>