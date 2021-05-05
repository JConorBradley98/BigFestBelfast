<?php
session_start();
include("../conn.php");
include("../sitescriptingfix.php");
if (!isset($_SESSION['admin'])) {
    header("Location:../index.php");
}
$id = $_GET['restrict'];

$check = isset($_POST['check']) ? 1 : 0;
$review = isset($_POST['r']) ? 1 : 0;
$apply = isset($_POST['a']) ? 1 : 0;


$adminid = $_SESSION['admin'];

$usernamequery = $conn -> prepare("SELECT * FROM user WHERE id =?");
$usernamequery -> bind_param("i",$id);
$usernamequery -> execute();
$usernamequeryresult = $usernamequery -> get_result();
$usernamequeryresult = $usernamequeryresult -> fetch_assoc();
$username = $usernamequeryresult['username'];






if ($check != 0) {

    $updateorinsertcheck = $conn->prepare("SELECT * FROM restrictions WHERE userid = ?");
    $updateorinsertcheck->bind_param("i", $id);
    $updateorinsertcheck->execute();

    $updateorinsertcheckresult = $updateorinsertcheck->get_result();

    while ($row = $updateorinsertcheckresult->fetch_assoc()) {
        $reviewresult = $row['reviews'];
        $applyresult = $row['applyforshow'];
    }

    if ($reviewresult == 1) {
        $review = 1;
    }

    if ($applyresult == 1) {

        $apply = 1;
    }



    if ($review == 0 && $apply == 0) {
        echo"No restrictions selected";
        die();
    }










    if ($updateorinsertcheckresult->num_rows < 1) {


        $set = $conn->prepare("INSERT INTO restrictions (id,userid,reviews,applyforshow) VALUES(NULL,?,NULL,NULL)");
        $set->bind_param("i", $id);
        $set->execute();
        $set->close();
        $updateorinsertcheck->close();



        $restrictq = $conn->prepare("UPDATE  restrictions SET restrictions.reviews=?, restrictions.applyforshow =? WHERE restrictions.userid=?");
        $restrictq->bind_param("iii", $review, $apply, $id);
        $restrictq->execute();
        $restrictq->close();

        $setuserflag = $conn -> prepare("UPDATE user SET restricted =1 WHERE id = ?");
        $setuserflag -> bind_param("i",$id);
        $setuserflag -> execute();
        $setuserflag -> close();


        header("Location:user.php?user=$id");
    } else {
        $restrictq = $conn->prepare("UPDATE restrictions SET  restrictions.reviews=?, restrictions.applyforshow =? WHERE restrictions.userid=?");
        $restrictq->bind_param("iii", $review, $apply, $id);
        $restrictq->execute();
        $restrictq->close();

        $setuserflag = $conn -> prepare("UPDATE user SET restricted =1 WHERE id = ?");
        $setuserflag -> bind_param("i",$id);
        $setuserflag -> execute();
        $setuserflag -> close();

        header("Location:user.php?user=$id");
    }
}
?>

<html>
    <head>
        <title> Restrict Account </title>
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
            <img src="../img/logo.png " class="img-fluid" >
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
<?php
$applyandreviewscheck = $conn->prepare("SELECT * FROM restrictions WHERE userid = ?");
$applyandreviewscheck->bind_param("i", $id);
$applyandreviewscheck->execute();

$applyandreviewscheckresult = $applyandreviewscheck->get_result();
$applyandreviewscheckresult = $applyandreviewscheckresult->fetch_assoc();
$isreviewset = $applyandreviewscheckresult['reviews'];
$isapplyset = $applyandreviewscheckresult['applyforshow'];
$applyandreviewscheck->close();
?>




            <div class="col-xl-12 text-center" id="con" style="height:724px;">


                <form action="restrictaccount.php?restrict=<?php echo $id; ?>" method="post">
                    <div class="form-group-inline text-center" id="loggroup">
                        <h1 class="formh"> Select restrictions to apply to <?php echo htmlescape($username); ?>:  </h1>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block text-center">
            <?php if ($isreviewset != 1) {
                echo "<div class='form-check'>
  <input class='form-check-input' type='checkbox' value='1' id='review' name='r'>
  <label class='form-check-label' for='review'>
  <h2 class ='formh'>
    Restrict ability to make reviews.
    </h2>
  </label>
</div>";
            }
            ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="logdiv center-block">
            <?php if ($isapplyset != 1) {
                echo "<div class='form-check'>
  <input class='form-check-input' type='checkbox' value='1' id='apply' name='a'>
  <label class='form-check-label' for='apply'>
  <h2 class='formh'>
    Restrict ability to apply for shows
    </h2>
  </label>
</div>";
            }
            ?>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class = "logdiv center-block">
                                <input type="hidden"  name="check" value="1">
                                <input  class = "form-control"  id="logcon" type = "submit" value="Restrict">
                        <?php echo  "<a href = 'user.php?user=$id'> <button type='button' class='btn btn-danger'>Cancel</button> </a>"; ?>
                            </div>
                        </div>












                    </div>
                </form>
            </div>
        </div>
        <footer style="background-color:#4B88A2"  class="navbar fixed-bottom">

            <h1 class ="footertext"> BigFestBelfast </h1>

        </footer>














    </body>












</html>