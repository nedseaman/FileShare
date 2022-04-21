<?php
session_start();

if(!$_SESSION['username']) {
    header("Location: login.html");
}

$filename = str_replace('/','',$_GET['filename']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

// Get the username and make sure it is valid
$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

unlink($full_path);
header("Location: files.php");

?>