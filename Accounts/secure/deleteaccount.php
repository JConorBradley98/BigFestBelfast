<?php
 session_start();
 include("../conn.php");
 if(!isset($_SESSION['admin'])){
   header("Location:../index.php");
 }


$id = $_GET['delete'];


$delete = $conn -> prepare("DELETE FROM user WHERE id=?");
$delete -> bind_param("i",$id);
$delete -> execute();
$delete -> close();
header("Location:userspage.php");













?> 