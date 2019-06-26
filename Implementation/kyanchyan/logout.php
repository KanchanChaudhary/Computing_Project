<?php
session_start();
if( !isset($_SESSION["username"]) ){
	header("Location: index.php");
	exit();
} 
$_SESSION = array();

if ( session_destroy() ) {
	header("Location: index.php");
	exit();
}else{
	echo "Logout error, try again!";
}

?>