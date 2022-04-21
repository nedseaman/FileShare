<?php
session_start();

if(!$_SESSION['username']) {
    header("Location: login.html");
}

$filename = basename($_FILES['uploadedfile']['name']);
if( !preg_match('/^[\w_\.\-]+$/', $filename) ){
	echo "Invalid filename";
	exit;
}

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$full_path = sprintf("/srv/%s/%s", $username, $filename);

if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $full_path)){
	header("Location: files.php");
	exit;
}else{
	header("Location: upload_failure.html");
	exit;
}

?>