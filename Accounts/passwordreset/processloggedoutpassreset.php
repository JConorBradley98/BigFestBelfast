 <?php
include("conn.php");
if(isset($_SESSION['admin'])){
    header("Location:index.php");
  }elseif(isset($_SESSION['admin'])){
   header("Location:index.php");
  } elseif(isset($_SESSION['venue'])){
   header("Location:index.php");
  } elseif(isset($_SESSION['performer'])){
   header("Location:index.php");
  } elseif(isset($_SESSION['public'])){
   header("Location:index.php");
  }
  


if(empty($_POST['answer'])){
    echo "No Answer Entered";
    die();
}

if(empty($_POST['password'])){
    echo "No Password Entered";
    die();
}






$securityanswercheck = $conn -> prepare("SELECT * FROM user WHERE email =? and secans =MD5(?)");

$securityanswercheck -> bind_param("ss",$_POST['email'],$_POST['answer']);

$securityanswercheck -> execute();

$securityanswercheckresult = $securityanswercheck -> get_result();

if($securityanswercheckresult -> num_rows == 0){
    echo"Wrong answer";
    die();
}else{


$updatepassword = $conn -> prepare("UPDATE user SET password=MD5(?) WHERE email = ? and secans = MD5(?)");

$updatepassword -> bind_param("sss",$_POST['password'],$_POST['email'],$_POST['answer']);

$updatepassword -> execute();

$updatepassword -> close();

header("Location:login.php");






}



































?>