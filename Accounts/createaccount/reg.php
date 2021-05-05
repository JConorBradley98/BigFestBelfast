 <?php
include("conn.php");
 
$file = $_FILES["img"]["name"];
$temp = $_FILES["img"]["tmp_name"];


$filesize = $_FILES["img"]['size'];



function setname($imgname){

 $filename = rand(1000,10000).$imgname;
 return $filename;


}



$check = $conn ->prepare ("SELECT * FROM user WHERE username =?");
$check -> bind_param("s",$_POST['uname']);
$check -> execute();
$cresult = $check ->get_result();

if($cresult -> num_rows >0){
    echo"username taken";
    die();



}else{



$emailvalidationcheck = $conn -> prepare("SELECT * FROM user WHERE email = ?");
$emailvalidationcheck -> bind_param("s",$_POST['em']);
$emailvalidationcheck -> execute();
$emailvalidationcheckresult = $emailvalidationcheck -> get_result();

if($emailvalidationcheckresult -> num_rows > 0){
    echo"Account already exists that is registered to this email";
    die();
}






$usertypecheck = $_POST['usertype'];


if(!isset($usertypecheck)){
   echo"invalid usertype";
    die();
}

if(empty($_POST['em'])){
    echo"no email entered";
    die();
}

if(empty($_POST['password'])){
    echo"no password entered";
    die();
}

if(empty($_POST['phone'])){
    echo"no phone number entered";
    die();
}

if(empty($_POST['que'])){
    echo"no security question entered";
    die();
}

if(empty($_POST['ans'])){
    echo"no security question answer entered";
    die();
}

if(empty($_POST['date'])){
    echo"no date of birth entered";
    die();
}

if(empty($file)){
    echo"no image uploaded";
    die();
}


$datecheck = $conn ->prepare("SELECT IF(NOW() < ?, 1, 0) AS 'check'");
$datecheck -> bind_param("s",$_POST['date']);
$datecheck -> execute();

$datecheckresults = $datecheck -> get_result();
$datecheckrow = $datecheckresults -> fetch_assoc();
$datecheckflag = $datecheckrow['check'];

if($datecheckflag == 1){
    echo "Birth date is ahead of the current date. Please Enter Valid Date";
    die();
}



$filesizelimit = 1097152;






$format = strtolower(pathinfo($file, PATHINFO_EXTENSION));
if (!empty($file)) {
    if($filesize > $filesizelimit || $filesize == 0){
        Echo "File Greater than 1MB Cannot Upload";
        die();
    } 
    if ($format != "jpg" && $format!= "png" && $format != "jpeg") {
        echo"File type invlaid please ensure file is a png,jpg or JPEG";
    }  else {
        $truename = setname($file);
        move_uploaded_file($temp, "img/$truename");
        $cq = $conn -> prepare("INSERT INTO user (id,username,`password`,secques,secans,email,phonenumber,profileimg,dob,usertype,venue,restricted) VALUES(NULL,?,MD5(?),?,MD5(?),?,?,?,?,?,NULL,NULL)");
        $cq ->bind_param("sssssssss", $_POST['uname'],$_POST['password'],$_POST['que'],$_POST['ans'],$_POST['em'],$_POST['phone'],$truename,$_POST['date'],$_POST['usertype']);
        $cq -> execute();
        $cq -> close();


        $profilepageselectquery = $conn -> prepare("SELECT * FROM user WHERE username = ?");
        $profilepageselectquery -> bind_param("s",$_POST['uname']);
        $profilepageselectquery -> execute();
        $profilepageselectqueryresult = $profilepageselectquery -> get_result();
        $profilepageselectqueryresult = $profilepageselectqueryresult -> fetch_assoc();
        

        $id = $profilepageselectqueryresult['id'];



    if($_POST['usertype'] != "venue"){


        $profilepagecreatequery = $conn->prepare("INSERT INTO profilepage (id,userid) VALUES(NULL,?)");
        $profilepagecreatequery -> bind_param("i",$id);
        $profilepagecreatequery -> execute();
        $profilepagecreatequery -> close();
        $profilepageselectquery -> close();
       
    }
   header("Location:login.php");            






    }

} 

}







?>