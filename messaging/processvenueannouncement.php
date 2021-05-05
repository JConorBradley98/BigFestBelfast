<?php
session_start();
include("conn.php");

if(!isset($_SESSION['venue'])){

header("Location:index.php");




}

$datetime = date("Y-m-d H:i:s");
echo $datetime;

$sendingmanager = $_SESSION['venue'];








if(empty($_POST['title'])){
    echo"No Title Entered";
    die();
}

if(empty($_POST['text'])){
    echo"No Text Entered";
    die();
}



$lengthcheck = strlen($_POST['text']);

if($lengthcheck > 600){
    echo "Description is too long";
    die();
}

$findrecipients = $conn -> prepare("SELECT DISTINCT application.performerid FROM application INNER JOIN venue ON application.venueid = venue.id WHERE venue.managerid =? AND application.confirmed=1 ");
$findrecipients -> bind_param("i",$sendingmanager);
$findrecipients -> execute();
if(!$findrecipients){
    echo"Recipients not Found";
    die();
}

$findresult = $findrecipients -> get_result();
while($count=$findresult->fetch_assoc()){
$recipientsid=$count["performerid"];






$send = $conn -> prepare("INSERT INTO `message` (`id`,`senderid`,` recipientid`,`title`,`text`,`date`,`announcement`) VALUES (NULL,?,?,?,?,?,1)");
$send -> bind_param("iisss",$sendingmanager,$recipientsid,$_POST['title'],$_POST['text'],$datetime);
$send -> execute();
if(!$send){
    echo"No Performers Currently Registered to Perform in your Venue";
}}
$findrecipients -> close();
$send -> close();


header("Location:venueannouncement.php");

