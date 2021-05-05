<?php
session_start();
include("conn.php");
include("sitescriptingfix.php");
if (!isset($_SESSION['performer'])) {
    header("Location:index.php");
}

$manageridget = $_GET['venue'];

$applicantid = $_SESSION['performer'];

$restrictioncheck = $conn->prepare("SELECT * FROM restrictions WHERE userid = ?");
$restrictioncheck->bind_param("i", $applicantid);
$restrictioncheck->execute();
$restrictioncheckresult = $restrictioncheck->get_result();
$restrictioncheckrow = $restrictioncheckresult->fetch_assoc();
$applicationrestriction = $restrictioncheckrow['applyforshow'];


$venueuserjoin = $conn->prepare("SELECT venue.id, venue.managerid, user.username FROM venue INNER JOIN user ON venue.managerid = user.id WHERE venue.managerid = ?");
$venueuserjoin->bind_param("i", $manageridget);
$venueuserjoin->execute();
$venueuserjoinresult = $venueuserjoin->get_result();
$venueuserjoinrow = $venueuserjoinresult->fetch_assoc();

$venueid = $venueuserjoinrow['id'];
$venuename = $venueuserjoinrow['username'];

if ($applicationrestriction == 1) {
    header("Location:index.php");
}








$check = isset($_POST['check']) ? 1 : 0;
$confirmationechocheck = isset($_POST['check']) ? 1 : 0;


if ($check == 1) {



    if (empty($_POST['date'])) {
        echo "No Date Selected";
        $confirmationechocheck = 0;
        die();
    }

    if (empty($_POST['title'])) {
        echo "No Title Entered";
        $confirmationechocheck = 0;
        die();
    }

    if (empty($_POST['text'])) {
        echo "No description entered";
        $confirmationechocheck = 0;
        die();
    }
    
    if (empty($_POST['end'])) {
        echo "No end date Selected";
        $confirmationechocheck = 0;
        die();
    }


    
    $lengthcheck = strlen($_POST['text']);

    if($lengthcheck > 600){
        echo "Description is too long";
        die();
    }

    $startdatecheck = $conn ->prepare("SELECT IF(? < '20-06-29 00:00:00', 1, 0) AS 'check'");
    $startdatecheck -> bind_param("s",$_POST['date']);
    $startdatecheck -> execute();
    
    $startdatecheckresults = $startdatecheck -> get_result();
    $startdatecheckrow = $startdatecheckresults -> fetch_assoc();
    $startdatecheckflag = $startdatecheckrow['check'];
    
    if($startdatecheckflag == 1){
        echo "Start Date is Before Festival Start Time";
        $confirmationechocheck = 0;
        die();
    }
    $startdatecheck -> close();


    $enddatecheck = $conn ->prepare("SELECT IF(? < '20-06-29 00:00:00', 1, 0) AS 'check'");
    $enddatecheck -> bind_param("s",$_POST['end']);
    $enddatecheck -> execute();
    
    $enddatecheckresults = $enddatecheck -> get_result();
    $enddatecheckrow = $enddatecheckresults -> fetch_assoc();
    $enddatecheckflag = $enddatecheckrow['check'];
    
    if($enddatecheckflag == 1){
        echo "End Date is Before Festival Start Time";
        $confirmationechocheck = 0;
        die();
    }
    $enddatecheck -> close();

    $poststartdatecheck = $conn ->prepare("SELECT IF( ? >'2020-07-05 24:00:00' , 1, 0) AS 'check'");
    $poststartdatecheck -> bind_param("s",$_POST['date']);
    $poststartdatecheck -> execute();
    
    $poststartdatecheckresults = $poststartdatecheck -> get_result();
    $poststartdatecheckrow = $poststartdatecheckresults -> fetch_assoc();
    $poststartdatecheckflag = $poststartdatecheckrow['check'];
    
    if($poststartdatecheckflag == 1){
        echo "Start Date is After Festival Ends";
        $confirmationechocheck = 0;
        die();
    }
    $poststartdatecheck -> close();

    $postenddatecheck = $conn ->prepare("SELECT IF( ? >'2020-07-05 24:00:00' , 1, 0) AS 'check'");
    $postenddatecheck -> bind_param("s",$_POST['end']);
    $postenddatecheck -> execute();
    
    $postenddatecheckresults = $postenddatecheck -> get_result();
    $postenddatecheckrow = $postenddatecheckresults -> fetch_assoc();
    $postenddatecheckflag = $postenddatecheckrow['check'];
    
    if($postenddatecheckflag == 1){
        echo "End Date is After Festival Ends";
        $confirmationechocheck = 0;
        die();
    }
    $postenddatecheck -> close();

    $paradoxdatecheck = $conn ->prepare("SELECT IF(? > ?, 1, 0) AS 'check'");
    $paradoxdatecheck -> bind_param("ss",$_POST['date'],$_POST['end']);
    $paradoxdatecheck -> execute();
    
    $paradoxdatecheckresults = $paradoxdatecheck -> get_result();
    $paradoxdatecheckrow = $paradoxdatecheckresults -> fetch_assoc();
    $paradoxdatecheckflag = $paradoxdatecheckrow['check'];
    
    if($paradoxdatecheckflag == 1){
        echo "End Date is Before Start Time";
        $confirmationechocheck = 0;
        die();
    }
    $paradoxdatecheck -> close();








    $venuevalidationquery = $conn->prepare("SELECT * FROM venue INNER JOIN user ON venue.managerid = user.id WHERE venue.managerid=?");
    $venuevalidationquery->bind_param("i", $manageridget);
    $venuevalidationquery->execute();
    $venuevalidationqueryresult = $venuevalidationquery->get_result();
    
    if ($venuevalidationqueryresult->num_rows > 0) {

        $venueselectionquery = $conn->prepare("SELECT * FROM venue WHERE managerid =?");
        $venueselectionquery->bind_param("i", $manageridget);
        $venueselectionquery->execute();
        $venueselectionqueryresult = $venueselectionquery->get_result();
        $venueselectionqueryresult = $venueselectionqueryresult->fetch_assoc();
        $venueid = $venueselectionqueryresult['id'];


        

        $timeslotcheckquery = $conn -> prepare("SELECT * FROM application WHERE date >=? AND enddatetime <= ? AND venueid = ? AND confirmed =1");
        
        $timeslotcheckquery -> bind_param("ssi",$_POST['date'], $_POST['end'], $venueid);
        $timeslotcheckquery -> execute();
        $timeslotcheckqueryresults = $timeslotcheckquery -> get_result();

        if($timeslotcheckqueryresults->num_rows  > 0){
            echo "Show taking place at this time in the selected venue please select a later time";
            $confirmationechocheck = 0;
            die();
        }

        $doublebookingcheck = $conn -> prepare("SELECT * FROM application WHERE date >=? AND enddatetime <= ? AND performerid = ? AND confirmed = 1");
        $doublebookingcheck -> bind_param("ssi",$_POST['date'],$_POST['end'],$applicantid);
        $doublebookingcheck -> execute();
        $doublebookingcheckreults = $doublebookingcheck -> get_result();

        if($doublebookingcheckreults->num_rows > 0){
        echo "You all ready have a booking at this time";
        $confirmationechocheck = 0;
        die();
        }
      


        $applicationquery = $conn->prepare("INSERT INTO application (id,performerid,venueid,date,enddatetime,confirmed,title,message) VALUES(NULL,?,?,?,?,NULL,?,?)");
        $applicationquery->bind_param('iissss', $applicantid, $venueid, $_POST['date'], $_POST['end'], $_POST['title'], $_POST['text']);
        $applicationquery->execute();

        $applicationquery->close();
        $venueuserjoin->close();
        $venuevalidationquery->close();
        $doublebookingcheck->close();

    } else {
        echo"Venue not found";
        $confirmationechocheck = 0;
        $venuevalidationquery->close();
        die();
    }
}
?>

<html>
    <head>
        <title> Make Application </title>
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
        <a href='logout.php'> <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";






echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
        
<a href='inbox.php'> <img src ='img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";



echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    <a href='messagepage.php'>  <img src ='img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";

echo "<li class='nav-item'>
        <a class='nav-link  active' href='application.php'>Apply to run a Show</a>
        
  <a href ='application.php'> <img src ='img/application.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>

      </li>";





echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$applicantid'>View Profile</a>
        <a href='profilepage.php?user=$applicantid'><img src ='img/profileicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
      </li>";

      if(isset($_SESSION['performer']) || isset($_SESSION['venue'])){
        echo "<li class='nav-item'>
      <a class='nav-link' href='scheduleview.php'>View Your Upcoming Shows</a>
     <a href='scheduleview.php'> <img src ='img/calendar.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";
    
}


      echo "<li class='nav-item'>
      <a class='nav-link' href='performerlistpage.php'>View Performers</a>
    <a href='performerlistpage.php'>  <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
    </li>";


echo "<li class='nav-item'>
      <a class='nav-link' href='showlistpage.php'>View Shows</a>
     <a href='showlistpage.php'> <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>

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





            <div class="col-xl-12 text-center" id="con" >


                <form action="directshowapplication.php?venue=<?php echo $manageridget ?>" method="post">
                    <div class="form-group-inline text-center" id="loggroup">
                        <h1 class="formh"> Send Application to <?php echo htmlescape($venuename); ?></h1>
                        <?php
                        if ($confirmationechocheck == 1) {

                            echo "<h1 class='formh'> Application Sent </h1>";
                        }
                        ?>

                        <div class="row justify-content-center">
                            <div class="logdiv center-block text-center">
                            <label>   <h1 class="footertext"> Title   </h1> </label>
                                <input class = "form-control" id="logcon" type ="text" name = "title" placeholder="Title" required> 
                                <input type="hidden" id="check" name="check" value="1">
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block">
                            <label>   <h1 class="footertext"> Description   </h1> </label>
                                <textarea class = "form-control" maxlength="600"  id="logcon" type = "text" name="text" placeholder="Text" rows="10" required></textarea>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block">
                            <label>   <h1 class="footertext"> Start Time  </h1> </label>
                                <input class = "form-control"  id="logcon" type = "datetime-local" min="2020-06-29T00:00" max ="2020-07-05T23:59" name="date" placeholder="Date" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block">
                            <label>   <h1 class="footertext"> End Time   </h1> </label>
                                <input class = "form-control"  id="logcon" type = "datetime-local" min="2020-06-29T00:00" max ="2020-07-05T23:59" name="end" placeholder="End Date" required>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class = "logdiv center-block">
                                <input  class = "form-control"  id="logcon" type = "submit" value="Send Application" required>
                            </div>
                        </div>
                        <div>
                     <?php echo"  <a type='button' class='btn btn-danger' href='venuepage.php?venue=$manageridget'>  Cancel  </a>"; ?> 

                        </div>












                    </div>
                </form>
            </div>
        </div>
        <footer style="background-color:#4B88A2;"  class="navbar fixed-bottom">

            <h1 class="footertext"> BigFestBelfast </h1>
      

        </footer>














    </body>












</html> 