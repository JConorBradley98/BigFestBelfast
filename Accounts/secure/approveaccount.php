<?php
session_start();
include("../conn.php");
if(!isset($_SESSION['admin'])){
    header("Location:../index.php");
}

$id = $_GET['venue'];

$typecheck = $conn -> prepare("SELECT * FROM user WHERE id = ? and usertype = 'venue' ");
$typecheck -> bind_param("i",$id);
$typecheck -> execute();
$typecheckresult = $typecheck -> get_result();
if($typecheckresult ->num_rows != 1){
    echo "This user is not a venue manager so cannot be approved ";
    die();
}


$venuecheck = $conn -> prepare("UPDATE user SET venue =1 WHERE id=?");
$venuecheck-> bind_param("i",$id);
$venuecheck -> execute();


$venueinsert = $conn -> prepare("INSERT INTO venue (id,managerid) VALUES(NULL,?)");
$venueinsert -> bind_param("i",$id);
$venueinsert -> execute();
$venueinsert -> close();
$venuecheck -> close();



$venueidselect = $conn -> prepare("SELECT * FROM venue WHERE managerid = ?");
$venueidselect -> bind_param("i",$id);
$venueidselect -> execute();
$venueidselectresult = $venueidselect -> get_result();
$venueidselectresult = $venueidselectresult -> fetch_assoc();
$venueid = $venueidselectresult['id'];

$venueidselect-> close();


$venuepageinsert = $conn -> prepare("INSERT INTO venuepage(venueid,managerid) VALUES(?,?)");
$venuepageinsert -> bind_param("ii",$venueid,$id);
$venuepageinsert -> execute();
$venuepageinsert -> close(); 












header("Location:user.php?user=$id");













?> 