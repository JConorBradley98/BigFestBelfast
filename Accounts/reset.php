 <?php

include("conn.php");



$reset = $conn ->prepare ("UPDATE user SET `password` =MD5(?) WHERE  email=? AND secans = MD5(?)");
$reset -> bind_param("sss",$_POST['pass'],$_POST['em'], $_POST['ans']);
$reset -> execute();
$reset ->close();
echo "success";







?>