<?php
session_start();
include("../conn.php");
include("../sitescriptingfix.php");
if (!isset($_SESSION['admin'])) {
    header("Location:../index.php");
}

$id = $_GET['unrestrict'];

$adminid = $_SESSION['admin'];

$select = $conn->prepare("SELECT * FROM restrictions WHERE userid=?");
$select->bind_param("i", $id);
$select->execute();


$result = $select->get_result();
$result = $result->fetch_assoc();
$review = $result['reviews'];
$show = $result['applyforshow'];
$select->close();



$usernameselect = $conn -> prepare("SELECT * FROM user WHERE id =?");
$usernameselect -> bind_param("i",$id);
$usernameselect -> execute();
$usernameselectresult = $usernameselect -> get_result();
$usernameselectresult = $usernameselectresult -> fetch_assoc();
$username = $usernameselectresult['username'];
$usernameselect -> close();



$check = isset($_POST['check']) ? 1 : 0;


if ($check != 0) {
    $setreview = isset($_POST['r']) ? 0 : 1;
    $setapply = isset($_POST['a']) ? 0 : 1;


    if ($setreview == 1 && $setapply == 1) {
        echo"No unrestrictions selected";
        die();
    }

    $reviewandapplycheck = $conn->prepare("SELECT * FROM restrictions WHERE userid=?");
    $reviewandapplycheck->bind_param("i", $id);
    $reviewandapplycheck->execute();
    $reviewandapplycheckresult = $reviewandapplycheck->get_result();
    $reviewandapplycheckresult = $reviewandapplycheckresult->fetch_assoc();
    $reviewsoneorzero = $reviewandapplycheckresult['reviews'];
    $showoneorzero = $reviewandapplycheckresult['applyforshow'];


    if ($reviewsoneorzero == 0) {
        $setreview = 0;
    }


    if ($showoneorzero == 0) {
        $setapply = 0;
    }
    $reviewandapplycheck->close();

  







    $restrictionlift = $conn->prepare("UPDATE restrictions SET reviews = ?, applyforshow =? WHERE userid=?");
    $restrictionlift->bind_param("iii", $setreview, $setapply, $id);
    $restrictionlift->execute();
    $restrictionlift->close();

    $unrestrictcheck = $conn->prepare("SELECT * FROM restrictions WHERE userid=?");
    $unrestrictcheck->bind_param("i", $id);
    $unrestrictcheck->execute();


    $unrestrictcheckresult = $unrestrictcheck->get_result();
    $unrestrictcheckresult = $unrestrictcheckresult->fetch_assoc();
    $reviewscheck = $unrestrictcheckresult['reviews'];
    $showcheck = $unrestrictcheckresult['applyforshow'];
    $unrestrictcheck->close();



    if ($showcheck != 1 && $reviewscheck != 1) {

        $unrestrictq = $conn->prepare("UPDATE user SET restricted =0 WHERE id=?");
        $unrestrictq->bind_param("i", $id);
        $unrestrictq->execute();
        $unrestrictq->close();
    }

    header("Location:user.php?user=$id");
}
?> 


<html>
    <head>
        <title> Unrestrict Account </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" href ="../frontendcss.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">





    </head>

    <body id="cbody">
        <header>
            <img src="../img/logo.png" class="img-fluid">
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
                            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
                          <a href="../index.php">  <img src ='../img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../logout.php">Logout</a>
                           <a href="../logout.php"> <img src ='../img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link active" href="userspage.php">View Users and Take Admin Actions</a>
                          <a href="userpage.php">  <img src ='../img/adminicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>

                        <?php
                          
                            echo "<li class='nav-item'>
                                <a class='nav-link' href='../inbox.php'>Inbox</a>
                              <a href='../inbox.php'>  <img src ='../img/inboxicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                              </li>";
                        
                        
                        
                            echo "<li class='nav-item'>
                              <a class='nav-link' href='../messagepage.php'>Send Message</a>
                              <a href ='../messagepage.php'> <img src ='../img/messageicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            </li>";
                        
                        
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='../performerlistpage.php'>View Performers</a>
                             <a href='../performerlistpage.php'> <img src ='../img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            </li>";
                        
                        
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='../showlistpage.php'>View Shows</a>
                             <a href='../showlistpage.php'> <img src ='../img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            </li>";
                        
                        
                        
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='../venuelistpage.php'>View Venues</a>
                            <a href='../venuelistpage.php'>  <img src ='../img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            </li>";
                        
                        
                        
                        echo "<li class='nav-item'>
                              <a class='nav-link' href='../publicuserpage.php'>View Standard Users</a>
                            <a href='../publicuserpage.php'>  <img src ='../img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            </li>";
                   ?>




                        

                    </ul>
                </div>
            </nav>





            <div class="col-xl-12 text-center" style ="height:724px;" id="con">


                <form action="unrestrictaccount.php?unrestrict=<?php echo $id; ?>" method="post">
                    <div class="form-group-inline text-center" id="loggroup">
                        <h1 class="formh"> Select restrictions to remove from:<?php echo htmlescape($username); ?>   </h1>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block text-center">
                                <div class="form-check">

<?php if ($review == 1) {


    echo" <input class='form-check-input' type='checkbox' value='1' id='review' name='r'>
  <label class='form-check-label' for='review'>
  <h2 class='formh'>
    Unrestrict ability to make reviews.
    </h2>
  </label> ";
}
?>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block">
                                <div class="form-check">




<?php if ($show == 1) {
    echo"
  <input class='form-check-input' type='checkbox' value='1' id='apply' name='a'>
  <label class='form-check-label' for='apply'>
  <h2 class='formh'>
    Unrestrict ability to apply for shows
    </h2>
  </label>";
} ?>
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class = "logdiv center-block">
                                <input type="hidden"  name="check" value="0">
                                <input  class = "form-control"  id="logcon" type = "submit" value="Unrestrict">
                                <?php echo  "<a href = 'user.php?user=$id'> <button type='button' class='btn btn-danger'>Cancel</button> </a>"; ?>
                            </div>
                        </div>












                    </div>
                </form>
            </div>
        </div>
        <footer style="background-color:#4B88A2;" class="navbar fixed-bottom">

            <h1 class ="footertext"> BigFestBelfast </h1>
        

        </footer>














    </body>












</html>