<?php
session_start();
include("conn.php");



$ticketcount = $_POST['ticketcount'];

if($ticketcount > 5){
   echo "Cannot book more than 5 tickets";
   die();


}

if($ticketcount < 1){
   echo "Cannot make a booking with no tickets selected";
   die();


}


if(empty($ticketcount)){
   echo "Cannot make a booking with no tickets selected";
   die();


}


if($ticketcount < 1){
    echo "Cannot make a booking with no tickets selected";
    die();
 
 
 }


 if(empty($ticketcount)){
    echo "Cannot make a booking with no tickets selected";
    die();
 
 
 }
 


if(!isset($_SESSION['public'])){
    header("Location:index.php");
}


$confirmbookingquery = $conn -> prepare("INSERT INTO booking (id,userid,venueid,showid,date) VALUES(NULL,?,?,?,?)");
$confirmbookingquery -> bind_param("iiis",$_POST[],$_POST[],$_POST[],$_POST[]);
$confirmbookingquery -> execute();
$confirmbookingquery -> close();












?>