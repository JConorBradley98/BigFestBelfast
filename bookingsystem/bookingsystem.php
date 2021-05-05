 
<?php
/// Session Code
session_start();

if (isset($_SESSION['admin'])) {
  $user = $_SESSION['admin'];
  $type = "admin";
} elseif (isset($_SESSION['venue'])) {
  $type = "venue";
  $user = $_SESSION['venue'];
} elseif (isset($_SESSION['public'])) {
  $type = "public";
  $user = $_SESSION['public'];
} elseif (isset($_SESSION['performer'])) {
  $user = $_SESSION['performer'];
  $type = "performer";
} else {
  $user = "unreg";
}

/// Connection Code

include("conn.php"); 
include("pass.php");
include("sitescriptingfix.php");


$acts = "SELECT * FROM showdb INNER JOIN showpage user ON showdb.id = shwopage.showid ";
$actresult = $conn->query($acts);



?>


<?php


$ticketprice = "SELECT * FROM showdb INNER JOIN showpage ON showdb.id = ticketprice";
$ticketcount =$_POST['ticketnumber'];





while($a < $showdescription->fetch_assoc()){

  $showdescription = $showcontent["show"];
}




    ?>
<html>
    <head> <!--Head Begins-->
        <title>Booking System</title>
        <!--Bootstrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link rel="stylesheet" href ="frontendcss.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">




    </head> <!--Head Ends-->
    <?php

if ($user == "unreg") {


    echo" <li class='nav-item'>
        <a class='nav-link' href='login.php'>Login</a>
      </li>";
} else {
    echo "<li class='nav-item'>
        <a class='nav-link' href='logout.php'>Logout</a>
      </li></a>
      </li>";}

 if ($user == "unreg") {
    echo "<li class='nav-item'>
        <a class='nav-link' href='create.php'>Create Account</a>
      </li>";}

 if (isset($_SESSION['admin'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='secure/userspage.php'>View Users and Take Admin Actions</a>
      </li>";}

 if ($user != "unreg") {
     echo "<li class='nav-item'>
        <a class='nav-link' href='inbox.php'>Inbox</a>
      </li>";


     echo "<li class='nav-item'>
      <a class='nav-link' href='messagepage.php'>Send Message</a>
    </li>";}


 if (isset($_SESSION['venue'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='venueannouncement.php'>Make an Announcement to Performers</a>
      </li>";}

 if (isset($_SESSION['performer'])) {
    echo "<li class='nav-item'>
        <a class='nav-link' href='application.php'>Apply to run a Show</a>
      </li>"; }

 if ($user != "unreg") {

    echo "<li class='nav-item'>
        <a class='nav-link' href='profilepage.php?user=$user'>View Profile</a>
      </li>";
 }


?>
    <body id="cbody">
        <header>
            <img src="img/logo.png" >
        </header>

        <div class="contain-fluid">

            <nav> <!--Nav Begins-->
                <ul>
                    <li> <a href="">Homepage</a> </li>
                    <li> <a href="">Venues</a> </li>
                    <li> <a href="">Show Page</a> </li>
                    <li> <a href="">Reviews Page</a> </li>
                    <li> <a href="">Registration/a> </li>
                    <li> <a href="">Sign In</a> </li>
                </ul>
            </nav> <!--Nav Ends-->

            <div class="row"> <!--Row Begins-->
                <div class="col-xl-4">
                    <h1>Acts & Performers</h1> 
                    <p> Available tickets :<?php echo "<p>$ticketcount</p>";?> </p>
                    <button type="button">Purchase Tickets</button>
                    

        

                
                    
                </div> <!--Acts Div Ends-->


                <div class="col-xl-4">  <!---Booking Div Begins ---->
                    <h1>Ticket Booking</h1>
                    <form action = "processbooking.php" method = "post" >  
                    
                    <label for="attendeefname">Forename:</label>
                    <input type = "text" id="attendeefname" name ="fname">
                    
                    <label for="attendeesname">Surname:</label> <br>
                    <input type ="text" id="attendeesname" name ="sname">
                    
                    <label for="Email">Email Address:</label><br>
                    <input type = "text" id="Email" name ="emailaddress">
                    
                    <label for="phoneno">Phone No:</label>
                    <input type = "text" id="phoneno" name ="phoneno">

                    <label for="ticketpick">No. Of Tickets</label>

                      <select id="ticketpick">
                      <input type="number" id="ticketpick" name= "ticketcount" min="1" max="5">
                      
                      </select>
  







                    <P>Seating Options</p>

                    <label for="seatingstanding"></label>
                    <input type="radio" id="stdingseating" name="standingrdo" value="Standing">

                    <label for="seatingsitting"></label>
                    <input type="radio" id="stdingseating" name="sittingrdo" value="Seated">

                    <label for="VIPsitting"></label>
                    <input type="radio" id="VIPseating" name="sittingrdo" value="VIP Seating">

                    <input type="submit" value="Submit">
   
                    </form>

                  
                </div><!---Shows Div PHP Ends ---->




                <div class="col-xl-4">

                    <h1> Venue Details </h1>
                        
                    <table class="table table-bordered">
    <thead>
      <tr>
        <th>Venue</th>
        <th>Show</th>
        <th>Performer</th>
        <th>Show Opening</th>
        <th>Show Ending</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td><?php echo "$venuecontent"; ?></td> <!-----Venue----->
        <td><?php echo "$showcontent";?></td> <!-----Show-----> 
        <td><?php echo ""; ?>  </td>  <!-----Performer-----> 
        <td><?php echo "";?>  </td>    <!-----Show start Date-----> 
        <td><?php echo "";?>  </td>   <!-----Show End date----->
      </tr>
      <tr>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
      </tr>
      <tr>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
        <td><?php echo "";?>  </td>
      </tr>
    </tbody>
  </table>
</div>            
        <footer>

            <h1>

                    <?php
                    echo $currentdate;
                    ?>

            </h1>

        </footer>














    </body>












</html>