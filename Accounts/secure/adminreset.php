<?php
session_start();
include("../conn.php");
if(!isset($_SESSION['admin'])){
    header("Location:../index.php");
}


$id = $_GET['reset'];


$resetq = $conn -> prepare("UPDATE user SET `password` =MD5('reset') WHERE id=?");
$resetq -> bind_param("i",$id);
$resetq -> execute();
$resetq -> close();
header("Location:user.php?user=$id");













?> 