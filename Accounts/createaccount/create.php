<?php
session_start();
session_destroy();
include("");
?>

<html>
    <head>
        <title> Create an Account </title>
        <!--Bootsrap link-->
        <link href="https://fonts.googleapis.com/css?family=Bebas+Neue&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Righteous&display=swap" rel="stylesheet">
        <link rel="stylesheet" href ="frontendcss.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="datelimiter.js"></script>
        <!--Responsive-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

    </head>
    <body id="cbody">
        <header>
            <img src="img/logo.png"  class="img-fluid" >
            <h2 class="datetext"> From 29.06.2020 - 05.07.2020 </h2>
        </header>

        <div class="contain-fluid">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                         <a href="index.php">   <img src ='img/home.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                          <a href="login.php">  <img src ='img/log.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" href="create.php">Create Account</a>
                         <a href="create.php">   <img src ='img/createicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>

                        <li class='nav-item'>
                            <a class='nav-link' href='performerlistpage.php'>View Performers</a>
                         <a href="performerlistpage.php">   <img src ='img/performericon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            
                        </li>


                        <li class='nav-item'>
                            <a class='nav-link' href='showlistpage.php'>View Shows</a>
                         <a href="showlistpage.php">   <img src ='img/showicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                            
                        </li>



                        <li class='nav-item'>
                            <a class='nav-link' href='venuelistpage.php'>View Venues</a>
                          <a href="venuelistpage.php">  <img src ='img/venueicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>



                        <li class='nav-item'>
                            <a class='nav-link' href='publicuserpage.php'>View Standard Users</a>
                         <a href="venuelistpage.php">   <img src ='img/usersicon.png' class='img-fluid navicon' style='height:30px; width:30px'> </a>
                        </li>

                    </ul>
                </div>
            </nav>




            <script>

                src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"
            </script>

            <script>
                $(document).ready(function () {
                    document.getElementById("submit").style.visibility = "hidden";
                    $("#usernamecheck").keyup(function (e) {
                        e.preventDefault();
                        $.ajax({url: "uservalidation.php", type: "POST", data:
                                    $("#usernamecheck").serialize(), success: function (result) {
                                console.log(result);
                                $varcheck = result;
                                if ($varcheck == 0) {
                                    console.log("Name taken");
                                    document.getElementById("display").innerHTML = "Invalid Username";
                                    
                                } else {
                                    console.log("Name free");
                                    document.getElementById("display").innerHTML = "Valid Username";
                                    document.getElementById("submit").style.visibility = "visible";
                                }
                            }})
                                ;
                    })
                            ;
                });


            </script>
            <div class="col-xl-12" id="con" >
            <div class="col-xl-8" id="con">
                <h1 class="formh" style="text-align:center;"> Create an Account </h1>
                <form action="reg.php" method="post" enctype ="multipart/form-data">
                    <div class="form-group">
                    <label class='createlabel'>   <h1 class="footertext"> Username   </h1> </label>
                        <input type = "text" class="form-control createform" placeholder="Enter username" name="uname" id="usernamecheck" required>
                        <h1 id="display" class="footertext">          <h1>
                        <label  class='createlabel'>   <h1 class="footertext"> Password   </h1> </label>
                                <input type = "password" class="form-control createform" oninvalid="alert('Password must be at least 10 characters and contain a special character, an uppercase letter, a lower case letter and a number')" placeholder="Enter password" minlength ="10" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" name="password" required>
                                <label  class='createlabel'>   <h1 class="footertext"> Email   </h1> </label>
                                <input type = "email" class="form-control createform" placeholder="Enter email address" name="em" required>
                                <label  class='createlabel'>   <h1 class="footertext"> Phone Number   </h1> </label>
                                <input type = "text" class="form-control createform" placeholder="Enter phonenumber" name="phone" required>
                                <label  class='createlabel'>   <h1 class="footertext"> Date of Birth   </h1> </label>
                                <input type = "date" class="form-control createform" id="dob" max='2019-03-16' placeholder="Enter date of birth" name="date" required>
                                <label  class='createlabel'>   <h1 class="footertext"> Security Question   </h1> </label>
                                <input type = "text" class="form-control createform" placeholder="Enter security question" name="que" required>
                                <label  class='createlabel'>   <h1 class="footertext"> Security Question Answer   </h1> </label>
                                <input type = "password" class="form-control createform" placeholder="Enter security question answer" name="ans" required>
                                <div class="form-check" id="group">
                                    <h2 class="formh"> Select user type </h2>
                                    <div class="form-check">
                                        <label for="usertype" class="form-check-label"> Standard </label>
                                        <input class="form-check-input" type="radio" name="usertype" value="public" required>
                                    </div>
                                    <div class="form-check">
                                        <label for="usertype" class="form-check-label"> Venue Manager </label>
                                        <input class="form-check-input" type="radio" name="usertype" value="venue"  required>
                                    </div>
                                    <div class="form-check">
                                        <label for="usertype" class="form-check-label"> Performer </label>
                                        <input class="form-check-input" type="radio" name="usertype" value="performer" required>
                                    </div>
                                </div>
                                <label  class='createlabel'>   <h1 class="footertext"> Profile Image   </h1> </label>
                                <input type = "file" class="form-control createform" placeholder="Enter profile image" name="img" required>
                                <input type = "submit" id="submit" class="form-control createform" placeholder="Submit" value="Submit" name="sub">


                                </form>
                                </div>
                                </div>
                                </div>
                                </div>
                                <footer style="background-color:#4B88A2;"class="navbar fixed-bottom">
                                    <h1 class='footertext'> BigFestBelfast  </h1>
                                    
                        
                                    
                                </footer>



                                </body>
                                </html>

