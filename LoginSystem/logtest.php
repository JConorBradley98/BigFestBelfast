 <?php
session_start();
include("conn.php");


$q = $conn -> prepare("SELECT * FROM user WHERE username=? and password = MD5(?)");

$q -> bind_param("ss",$_POST['u'],$_POST['p']);
$q -> execute();

$result = $q -> get_result();

if($result -> num_rows > 0){
    while($row=$result->fetch_assoc()){


        $name = $row["username"];
        $sess=$row["usertype"];
        $id = $row['id'];
       



        
        if($sess == "admin"){
            $_SESSION['admin'] = $id;
            echo "admin";
            echo $_SESSION['admin'];
        } elseif($sess == "venue"){
            $_SESSION['venue'] = $id;
            echo "venue";
        }
        
        elseif($sess == "performer"){
            $_SESSION['performer'] = $id;
            echo "performer";
        } 
        
        elseif($sess == "public"){
            $_SESSION['public'] = $id;
            echo "public";
        }
        header("Location:index.php");




}
} else{

  echo"No valid Login Details";

}



if(isset($_SESSION['admin'])) {
    echo "<h1> Hello admin </h1>";
}

if(isset($_SESSION['venue'])) {
    echo "<h1> Hello Manager </h1>";
}

if(isset($_SESSION['performer'])) {
    echo "<h1> Hello  Performer </h1>";
}

if(isset($_SESSION['public'])) {
    echo "<h1> Hello MOP </h1>";
}












?>