<?php
session_start();
include("conn.php");

if(!isset($_SESSION['venue'])){
 header("Location:index.php");
}

$managerid = $_SESSION['venue'];

$filesizelimit = 1097152;


$materials = count($_FILES['material']['name']);



function setname($filename){

    $matname = rand(1000,10000).$filename;
    return $matname;
   
   
 }


   for($i = 0; $i <$materials; $i++) {
    $materialfile = $_FILES['material']["name"][$i];
    $materialtemp = $_FILES['material']["tmp_name"][$i];
    $materialsize = $_FILES['material']["size"][$i];
    $materialfileformat = strtolower(pathinfo($materialfile, PATHINFO_EXTENSION));
    
    if(!empty($materialfile)){
        if($materialsize > $filesizelimit || $materialsize == 0){
            Echo "Promo Material Size Greater than 1MB Cannot Upload";
            die();
        } 
    if ($materialfileformat != "jpg" && $materialfileformat!= "png" && $materialfileformat != "jpeg" && $materialfileformat != "pdf") {
           echo"File type invalid please ensure file is a png,jpg,JPEG or pdf";
           }  else {

            
               
               $truematerialname = setname($materialfile);
               move_uploaded_file($materialtemp, "promomaterial/$truematerialname");
                   
              $insertmaterialquery = $conn -> prepare("INSERT INTO promomaterial (id,promomaterial,owner) VALUES(NULL,?,?)");

               $insertmaterialquery -> bind_param("si",$truematerialname,$managerid);
               $insertmaterialquery -> execute();
               $insertmaterialquery -> close();
               
               header("Location:venuepage.php?venue=$managerid");
               
               
       } 
       
   }
   else{
    echo  "No Material Selected for Upload";
    die();
   }
}


   


?>