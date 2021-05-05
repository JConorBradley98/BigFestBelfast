<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header("Location:../index.php");
}
include("../conn.php");
include("../sitescriptingfix.php");

$id = $_GET['user'];


$adminid = $_SESSION['admin'];

$userq = $conn->prepare("SELECT * FROM user WHERE user.id = ?");
$userq->bind_param("i", $id);
$userq->execute();
$res = $userq->get_result();
$res = $res->fetch_assoc();
$displayid = $id;
$username = $res['username'];
$email = $res['email'];
$phone = $res['phonenumber'];
$proimg = $res['profileimg'];
$dob = $res['dob'];
$type = $res['usertype'];
$confirm = $res['venue'];
$restrict = $res['restricted'];
$apply = 0;
$reviews = 0;


if ($restrict == 1) {

    $restriction = $conn->prepare("SELECT * FROM restrictions WHERE userid =?");
    $restriction->bind_param("i", $id);
    $restriction->execute();

    $rest = $restriction->get_result();
    $rest = $rest->fetch_assoc();
    $reviews = $rest['reviews'];
    $apply = $rest['applyforshow'];
}
?>


<html>

    <head>
        <title> Users </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Inter&display=swap" rel="stylesheet">
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
            <img src="../img/logo.png" class="img-fluid" >
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

            <div class="row">

                <div class="col-xl-9" id="central" style="text-align:center;">
                    <div class="highleveldetails"> 
                    <img id="highleveluserimg"  src='../img/<?php echo $proimg ?>' style = 'height:350px; width:350px; margin-left:auto; margin-right:auto; padding-top:10px'> 
                    <h1 class="footertext"> Account Name </h1>
                    <h2 class="generaltext userdetail">   <?php echo htmlescape($username); ?>            </h2>
                    <h1 class="footertext"> Email Address </h1>
                    <h2 class="generaltext userdetail">   <?php echo htmlescape($email); ?>            </h2>
                    <h1 class="footertext"> Phone Number </h1>
                    <h2 class="generaltext userdetail">   <?php echo htmlescape($phone); ?>            </h2>
                    <h1 class = "footertext"> DOB </h1>
                    <h2 class="generaltext userdetail">   <?php echo htmlescape($dob); ?>            </h2>
                    <h1 class="footertext "> Account Type </h1>
                    <h2 class="generaltext userdetail">   <?php echo $type; ?>            </h2>
                    <h1 class="footertext"> Venue Validated </h1>
                    <h2 class="generaltext userdetail">   <?php echo $confirm; ?>            </h2>
                    <h1 class="footertext"> Account Restricted </h1>
                    <h2 class="generaltext userdetail">   <?php echo $restrict; ?>            </h2>
                    <h2 class="generaltext userdetail"> <?php
if ($reviews == 1) {
    echo "Review Restrictions";
} else {
    $reviews = 0;
}
?> </h2>
                    <h2 class="generaltext userdetail"> <?php
if ($apply == 1) {
    echo "Application Restrictions";
} else {
    $apply = 0;
}
?> </h2>


                 </div>
                </div>



                <div id="right" class="col-xl-3" style="text-align:center;" >
                    <div class="dropdown show" style="text-align:center;">
                        <a class="btn btn-block btn-danger btn-large dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin Actions
                        </a>

                        <div class="dropdown-menu" style="width:100%; text-align:center;" aria-labelledby="dropdownMenuLink">
<?php
if ($type == "venue" && $confirm != 1) {


    echo "<a class='dropdown-item' href='approveaccount.php?venue=$displayid'>Approve Venue</a>";
}
?>
                            <a class="dropdown-item" onclick="reswarning()">Reset Password</a>
                            <?php
                            if ($restrict == 1) {
                                echo"<a class='dropdown-item' href='unrestrictaccount.php?unrestrict=$displayid'>Unrestrict Account</a>";
                            }
                            if ($apply == 0 || $reviews == 0) {
                                echo"<a class='dropdown-item' href='restrictaccount.php?restrict=$displayid'>Restrict Account</a>";
                            }
                            ?>


                            <a class="dropdown-item" onclick ="delwarning()">Delete Account</a>
                            <script>
                                function delwarning() {
                                    var a = confirm("Are you sure you want to delete this account? This cannot be undone");

                                    if (a == true) {
                                        window.location.href = "deleteaccount.php?delete=<?php echo $displayid; ?>"

                                    }


                                }


                                function reswarning() {
                                    var b = confirm("Are you sure you want to reset the password on this account?");

                                    if (b == true) {
                                        window.location.href = "adminreset.php?reset=<?php echo $displayid; ?>"

                                    }


                                }








                            </script>
                        </div>
                    </div>






                </div>











            </div>
        </div>
        <footer  class="navbar fixed-bottom" style="text-align:center;">

            <h1 class="footertext"> BigFestBelfast </h1>
       

        </footer>














    </body>














</html>