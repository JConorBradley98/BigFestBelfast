<?php

session_start();
include("conn.php");

if(!isset($_SESSION['venue'])){
    header("Location:index.php");
}




$approvingmanagerid = $_SESSION['venue'];
$applicationid = $_GET['acceptedapplication'];

$venuemanagercheck = $conn -> prepare("SELECT application.venueid, venue.managerid, application.performerid, application.date, application.title, application.message, application.enddatetime FROM application INNER JOIN venue ON application.venueid = venue.id WHERE application.id = ? AND venue.managerid = ? ");
$venuemanagercheck -> bind_param("ii",$applicationid,$approvingmanagerid);
$venuemanagercheck -> execute();
$venuemanagercheckresult = $venuemanagercheck -> get_result();

if($venuemanagercheckresult ->num_rows > 0){
    $venuemanagerassoc = $venuemanagercheckresult -> fetch_assoc();
    $performerid = $venuemanagerassoc['performerid'];
    $venueid = $venuemanagerassoc['venueid'];
    $starttime = $venuemanagerassoc['date'];
    $endtime = $venuemanagerassoc['enddatetime'];
    $showtitle = $venuemanagerassoc['title'];
    $showdescription = $venuemanagerassoc['message'];
    

    
$prebookingcheck = $conn -> prepare("SELECT * FROM application WHERE date >= ? AND enddatetime <= ? AND performerid =? AND confirmed=1");
$prebookingcheck -> bind_param("ssi",$starttime, $endtime,$performerid);
$prebookingcheck -> execute();

$prebookingcheckresult = $prebookingcheck -> get_result();
if($prebookingcheckresult ->num_rows > 0){
    echo"Show already starting at that time.";
    die();
}









$approveapplication = $conn -> prepare("UPDATE application SET confirmed = 1 WHERE id = ?");
$approveapplication -> bind_param('i',$applicationid);
$approveapplication -> execute();
$approveapplication -> close();
$venuemanagercheck -> close();
$insertshowdb = $conn -> prepare("INSERT INTO showdb (id,performerid,venueid,showdate,endate,showdescription) VALUES(NULL,?,?,?,?,?)");
$insertshowdb -> bind_param("iisss",$performerid,$venueid,$starttime,$endtime,$showdescription);
$insertshowdb -> execute();
$insertshowdb -> close();



$showselectquery = $conn -> prepare("SELECT MAX(id) FROM showdb WHERE performerid =? AND venueid = ?");
$showselectquery -> bind_param("ii",$performerid,$venueid);
$showselectquery -> execute();
$showselectqueryresult = $showselectquery -> get_result();
$showselectassoc = $showselectqueryresult -> fetch_assoc();
$showid =  $showselectassoc['MAX(id)'];




$insertshowpage = $conn -> prepare("INSERT INTO showpage(id,showid,title,img1,img2,img3) VALUES(NULL,?,?,NULL,NULL,NULL)");
echo"one";
$insertshowpage->bind_param("is",$showid,$showtitle);
$insertshowpage -> execute();
$insertshowpage -> close();
$showselectquery -> close();
header("Location:inbox.php");










}
































?>