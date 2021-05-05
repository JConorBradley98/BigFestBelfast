<?php
session_start();
include("conn.php");
if(!isset($_SESSION['venue'])){

header("Location:index.php");



}


$profileimgfile = $_FILES["img"]["name"];
$profileimgtemp = $_FILES["img"]["tmp_name"];
$profileimgsize = $_FILES["img"]["size"]; 

$venueimgfile = $_FILES["venueimg"]["name"];
$venueimgtemp = $_FILES["venueimg"]["tmp_name"];
$venueimgsize = $_FILES["venueimg"]["size"];

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



$editorid = $trueprofileeditor;
$venuetitle = $_POST['venuepagetitle'];
$venuetext = $_POST['venuepagetext'];

}
if(empty($venuetitle)){
    $venuetitlequery = $conn -> prepare("SELECT title FROM venuepage WHERE managerid =?");
    $venuetitlequery -> bind_param("i",$editorid);
    $venuetitlequery -> execute();
    $venuetitlequeryresult = $venuetitlequery -> get_result();
    $venuetitlequeryresult = $venuetitlequeryresult -> fetch_assoc();
    $venuetitle = $venuetitlequeryresult['title'];
    $venuetitlequery -> close();
}

if(empty($venuetext)){
    $venuetextquery = $conn -> prepare("SELECT maintext FROM venuepage WHERE managerid =?");
    $venuetextquery -> bind_param("i",$editorid);
    $venuetextquery -> execute();
    $venuetextqueryresult = $venuetextquery -> get_result();
    $venuetextqueryresult = $venuetextqueryresult -> fetch_assoc();
    $venuetext = $venuetextqueryresult['maintext'];
    $venuetextquery -> close();
}




$venueemail = $_POST['email'];
$venuephone = $_POST['phonenumber'];
$venueaddress = $_POST['address'];
$venuecapacity = $_POST['capacity'];





if(empty($venueemail)){
    $venueemailquery = $conn -> prepare("SELECT email FROM venue WHERE managerid = ?");
    $venueemailquery -> bind_param("i",$editorid);
    $venueemailquery -> execute();
    $venueemailqueryresult = $venueemailquery -> get_result();
    $venueemailqueryresult = $venueemailqueryresult -> fetch_assoc();
    $venueemail = $venueemailqueryresult['email'];
    $venueemailquery -> close();

}

if(empty($venuephone)){
    $venuephonequery = $conn -> prepare("SELECT phone FROM venue WHERE managerid = ?");
    $venuephonequery -> bind_param("i",$editorid);
    $venuephonequery -> execute();
    $venuephonequeryresult = $venuephonequery -> get_result();
    $venuephonequeryresult = $venuephonequeryresult -> fetch_assoc();
    $venuephone = $venuephonequeryresult['phone'];
    $venuephonequery -> close();
    
}


if(empty($venueaddress)){
    $venueaddressquery = $conn -> prepare("SELECT address FROM venue WHERE managerid = ?");
    $venueaddressquery -> bind_param("i",$editorid);
    $venueaddressquery -> execute();
    $venueaddressqueryresult = $venueaddressquery -> get_result();
    $venueaddressqueryresult = $venueaddressqueryresult -> fetch_assoc();
    $venueaddress = $venueaddressqueryresult['address'];
    $venueaddressquery -> close();
    
}

if(empty($venuecapacity)){
    $venuecapacityquery = $conn -> prepare("SELECT capacity FROM venue WHERE managerid = ?");
    $venuecapacityquery -> bind_param("i",$editorid);
    $venuecapacityquery -> execute();
    $venuecapacityqueryresult = $venuecapacityquery -> get_result();
    $venuecapacityqueryresult = $venuecapacityqueryresult -> fetch_assoc();
    $venuecapacity = $venuecapacityqueryresult['capacity'];
    $venuecapacityquery -> close();
    
}





$format = strtolower(pathinfo($profileimgfile, PATHINFO_EXTENSION));
if (!empty($profileimgfile)) {
    if($profileimgsize > $filesizelimit || $profileimgsize == 0){
        Echo "Profile Image Size Greater than 1MB Cannot Upload";
        die();
    } 
    if ($format != "jpg" && $format!= "png" && $format != "jpeg") {
        echo"File type invlaid please ensure file is a png,jpg or JPEG";
    }  else {
        $truename = setname($profileimgfile);
        move_uploaded_file($profileimgtemp, "img/$truename");
    }
}



$formatvenueimg = strtolower(pathinfo($venueimgfile, PATHINFO_EXTENSION));
if (!empty($venueimgfile)) {
    if($venueimgsize > $filesizelimit || $venueimgsize == 0){
        Echo "Venue Page Image Size Greater than 1MB Cannot Upload";
        die();
    } 
    if ($formatvenueimg != "jpg" && $formatvenueimg!= "png" && $formatvenueimg != "jpeg") {
        echo"File type invlaid please ensure file is a png,jpg or JPEG";
    }  else {
        $truenamevenueimg = setname($venueimgfile);
        move_uploaded_file($venueimgtemp, "img/$truenamevenueimg");
        $venueimgquery = $conn -> prepare("UPDATE venue SET img =? WHERE managerid =?");
        $venueimgquery -> bind_param("si",$truenamevenueimg,$editorid);
        $venueimgquery -> execute();
        $venueimgquery -> close();
    }
}

        
$imagecounter = 1;


  for($i = 0; $i <$images; $i++) {
     $venuepageimgfile = $_FILES['images']["name"][$i];
     $venuepageimgtemp = $_FILES['images']["tmp_name"][$i];
     $venuepageimgsize = $_FILES['images']['size'][$i];
     $venuepageimgfileformat = strtolower(pathinfo($venuepageimgfile, PATHINFO_EXTENSION));
     if(!empty($venuepageimgfile)){
        if($venuepageimgsize > $filesizelimit || $venuepageimgsize ==0){
            Echo " One of the Page Image Files Greater than 1MB Cannot Upload";
            die();
        } 
     if ($venuepageimgfileformat != "jpg" && $venuepageimgfileformat!= "png" && $venuepageimgfileformat != "jpeg") {
            echo"File type invlaid please ensure file is a png,jpg or JPEG";
            }  else {
                
                $truevenuepageimgname = setname($venuepageimgfile);
                move_uploaded_file($venuepageimgtemp, "img/$truevenuepageimgname");
                $imagedatabase = "img";
                $imagedatabaselocation = $imagedatabase.$imagecounter;
                echo $imagedatabaselocation;
                if($imagecounter == 1){

                
                $venueimageupdatequery = $conn -> prepare("UPDATE venuepage set img1=? WHERE managerid =?");
                echo"q1";
                 }


                if($imagecounter == 2){
                    $venueimageupdatequery = $conn -> prepare("UPDATE venuepage set img2=? WHERE managerid =?");
                    echo"q2";
                    
                }

                if($imagecounter == 3){
                    $venueimageupdatequery = $conn -> prepare("UPDATE venuepage set img3 =? WHERE managerid =?");
                    echo"q3";
                }
                $imagecounter++;
                $venueimageupdatequery -> bind_param("si",$truevenuepageimgname,$editorid);
                $venueimageupdatequery -> execute();
                $venueimageupdatequery -> close();
        } 
        
    }
}

$updateprofilequery = $conn -> prepare("UPDATE user SET profileimg=? WHERE id =? ");
$updateprofilequery -> bind_param("si",$truename,$editorid);
$updateprofilequery -> execute();

$updateprofilequery -> close();



$updatevenuepagequery = $conn -> prepare("UPDATE venuepage SET title=?, maintext=?  WHERE managerid = ?");
$updatevenuepagequery -> bind_param("ssi",$venuetitle,$venuetext,$editorid);
$updatevenuepagequery -> execute();
$updatevenuepagequery -> close();




$updatevenuedetails = $conn -> prepare("UPDATE venue SET address =?, phone=?, email=?,capacity=? WHERE managerid = ?");
$updatevenuedetails -> bind_param("sssii", $venueaddress,$venuephone,$venueemail,$venuecapacity,$editorid);
$updatevenuedetails -> execute();

$updatevenuedetails -> close();

header("Location:venuepage.php?venue=$editorid");

    






























?>