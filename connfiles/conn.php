<?php
include("errors.php");
include("pass.php");
$webs="lamp17.hosting.eeecs.qub.ac.uk";
$dbame="csc2043Group0120";
$username="csc2043Group0120";
 
 $conn = new mysqli($webs, $username, $mypass, $dbame);
 $conn->set_charset('utf8');
if($conn->connect_errno){
 
   echo "Failed to connect to my database".$conn->connect_error;  
}

