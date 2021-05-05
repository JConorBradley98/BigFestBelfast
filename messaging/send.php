<?php
session_start();
include("conn.php");

if(isset($_SESSION['admin'])){
    $sender = $_SESSION['admin'];
}elseif(isset($_SESSION['venue'])){
    $sender = $_SESSION['venue'];
}elseif(isset($_SESSION['public'])){
    $sender = $_SESSION['public'];
}elseif(isset($_SESSION['performer'])){
    $sender = $_SESSION['performer'];
}else{
    header("Location:index.php");
}

$datetime = date("Y-m-d H:i:s");



$findrecipient = $conn -> prepare("SELECT * FROM user WHERE username =?");
$findrecipient -> bind_param("s",$_POST['user']);
$findrecipient -> execute();
if(!$findrecipient){
    echo"Recipient not Found";
    die();
}

$findresult = $findrecipient -> get_result();


if($findresult -> num_rows < 1){
    echo"Recipient not Found";
    die();
}






while($count=$findresult->fetch_assoc()){
$recipientid=$count["id"];
}

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


$send = $conn -> prepare("INSERT INTO `message` (`id`,`senderid`,` recipientid`,`title`,`text`,`date`) VALUES (NULL,?,?,?,?,?)");
$send -> bind_param("iisss",$sender,$recipientid,$_POST['title'],$_POST['text'],$datetime);
$send -> execute();
if(!$send){
    echo"No Message sent";
    die();
}
$findrecipient -> close();
$send -> close();

header("Location:messagepage.php");











?>