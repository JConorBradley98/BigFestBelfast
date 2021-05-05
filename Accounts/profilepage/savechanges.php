<?php
session_start();
include("conn.php");



$profileimgfile = $_FILES["img"]["name"];
$profileimgtemp = $_FILES["img"]["tmp_name"]; 
$filesize = $_FILES["img"]['size'];

$images = count($_FILES['images']['name']);

$filesizelimit = 1097152;

if($images>3){
    echo "Too many images selected";
    die();
} 










function setname($imgname){

    $filename = rand(1000,10000).$imgname;
    return $filename;
   
   
   }




   

if(isset($_SESSION['venue'])){
 $trueprofileeditor = $_SESSION['venue'];
}elseif(isset($_SESSION['public'])){
 $trueprofileeditor = $_SESSION['public'];
}elseif(isset($_SESSION['performer'])){
 $trueprofileeditor = $_SESSION['performer'];
}else{
    header("Location:index.php");
}


$editorid = $trueprofileeditor;
$profiletitle = $_POST['profiletitle'];
$profiletext = $_POST['profiletext'];


if(empty($profiletitle)){
    $profiletitlequery = $conn -> prepare("SELECT title FROM profilepage WHERE userid =?");
    $profiletitlequery -> bind_param("i",$editorid);
    $profiletitlequery -> execute();
    $profiletitlequeryresult = $profiletitlequery -> get_result();
    $profiletitlequeryresult = $profiletitlequeryresult -> fetch_assoc();
    $profiletitle = $profiletitlequeryresult['title'];
    $profiletitlequery -> close();
}

if(empty($profiletext)){
    $profiletextquery = $conn -> prepare("SELECT text FROM profilepage WHERE userid =?");
    $profiletextquery -> bind_param("i",$editorid);
    $profiletextquery -> execute();
    $profiletextqueryresult = $profiletextquery -> get_result();
    $profiletextqueryresult = $profiletextqueryresult -> fetch_assoc();
    $profiletext = $profiletextqueryresult['text'];
    $profiletextquery -> close();
}







$format = strtolower(pathinfo($profileimgfile, PATHINFO_EXTENSION));
if (!empty($profileimgfile)) {
    if($filesize > $filesizelimit || $filesize ==0){
        Echo " Profile Image File Greater than 1MB Cannot Upload";
        die();
    } 
    if ($format != "jpg" && $format!= "png" && $format != "jpeg") {
        echo"File type invlaid please ensure file is a png,jpg or JPEG";
    }  else {
        $truename = setname($profileimgfile);
        move_uploaded_file($profileimgtemp, "img/$truename");
    }
}

        
$imagecounter = 1;


  for($i = 0; $i <$images; $i++) {
     $profilepageimgfile = $_FILES['images']["name"][$i];
     $profilepageimgtemp = $_FILES['images']["tmp_name"][$i];
     $profilepageimgsize = $_FILES['images']['size'][$i];
     $profilepageimgfileformat = strtolower(pathinfo($profilepageimgfile, PATHINFO_EXTENSION));
     if(!empty($profilepageimgfile)){
        if($profilepageimgsize > $filesizelimit || $profilepageimgsize == 0){
            Echo " One of the Page Image Files Greater than 1MB Cannot Upload";
            die();
        } 
     if ($profilepageimgfileformat != "jpg" && $profilepageimgfileformat!= "png" && $profilepageimgfileformat != "jpeg") {
            echo"File type invlaid please ensure file is a png,jpg or JPEG";
            }  else {
                
                $trueprofilepageimgname = setname($profilepageimgfile);
                move_uploaded_file($profilepageimgtemp, "img/$trueprofilepageimgname");
                $imagedatabase = "img";
                $imagedatabaselocation = $imagedatabase.$imagecounter;
                echo $imagedatabaselocation;
                if($imagecounter == 1){

                
                $profileimageupdatequery = $conn -> prepare("UPDATE profilepage set img1=? WHERE userid =?");
                echo"q1";
                 }


                if($imagecounter == 2){
                    $profileimageupdatequery = $conn -> prepare("UPDATE profilepage set img2=? WHERE userid =?");
                    echo"q2";
                    
                }

                if($imagecounter == 3){
                    $profileimageupdatequery = $conn -> prepare("UPDATE profilepage set img3 =? WHERE userid =?");
                    echo"q3";
                }
                $imagecounter++;
                $profileimageupdatequery -> bind_param("si",$trueprofilepageimgname,$editorid);
                $profileimageupdatequery -> execute();
                $profileimageupdatequery -> close();
        } 
        
    }
}

$updateprofilequery = $conn -> prepare("UPDATE user SET profileimg=? WHERE id =? ");
$updateprofilequery -> bind_param("si",$truename,$editorid);
$updateprofilequery -> execute();
$updateprofilequery -> close();


$updateprofilepagequery = $conn -> prepare("UPDATE profilepage SET title=?, text=?  WHERE userid = ?");
$updateprofilepagequery -> bind_param("ssi",$profiletitle,$profiletext,$editorid);
$updateprofilepagequery -> execute();
$updateprofilepagequery -> close();


header("Location:profilepage.php?user=$editorid");

    






























?>