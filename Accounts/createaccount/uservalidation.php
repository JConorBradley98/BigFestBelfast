 <?php
include("conn.php");

$username = $_POST['uname'];
$usernamequery = $conn->prepare("SELECT * FROM user WHERE username =?");
$usernamequery -> bind_param("s",$username);
$usernamequery -> execute();


$usernamequeryresult = $usernamequery -> get_result();
if($usernamequeryresult->num_rows > 0){
    $usernamevalid = 0;
} else{
    $usernamevalid =1;
}

echo $usernamevalid;











?>