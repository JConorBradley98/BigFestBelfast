<?php

session_start();
include("conn.php");

if(!isset($_SESSION['venue'])){
    header("Location:index.php");
}

$approvingmanagerid = $_SESSION['venue'];
$applicationid = $_GET['denyapplication'];

$venuemanagercheck = $conn -> prepare("SELECT application.venueid, venue.managerid FROM application INNER JOIN venue ON application.venueid = venue.id WHERE application.id = ? AND venue.managerid = ? ");
$venuemanagercheck -> bind_param("ii",$applicationid,$approvingmanagerid);
$venuemanagercheck -> execute();
$venuemanagercheckresult = $venuemanagercheck -> get_result();

if($venuemanagercheckresult -> num_rows > 0){
$approveapplication = $conn -> prepare("UPDATE application SET confirmed = 0 WHERE id = $applicationid");
$approveapplication -> bind_param('i',$applicationid);
$approveapplication -> execute();
$approveapplication -> close();
$venuemanagercheck -> close();
header("Location:inbox.php");

}




?>