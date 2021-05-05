 <?php
session_start();

$_SESSION = array();

if(ini_get("session.use_cookies")) {

	 $end = session_get_cookie_params();
    setcookie(session_name(), '', time() - 50000,
        $end["path"], 
		$end["domain"],
        $end["secure"], 
		$end["httponly"]
    );
}session_destroy();


header("Location:index.php");






?>