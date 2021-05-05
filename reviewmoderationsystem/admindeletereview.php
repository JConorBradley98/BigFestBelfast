<?php
include("../conn.php");

if(!isset($_SESSION['admin'])){
    header("Location:index.php");
}




$reviewdeletequery = $conn -> prepare("DELETE FROM review WHERE id=?");

$reviewdeletequery -> bind_param("i",$_POST[])

$reviewdeletequery -> execute();

$reviewdeletequery -> close();











?>