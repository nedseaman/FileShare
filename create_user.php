<?php
session_start();

if(!$_SESSION['username']) {
    header("Location: login.html");
}

$new_username = $_POST['new_username'];
if( !preg_match('/^[\w_\.\-]+$/', $new_username) ){
	echo "Invalid new username";
	exit;
}

$username = $_SESSION['username'];
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$file = fopen("/srv/users.txt", "r");

while(!feof($file)){
	if(trim(fgets($file)) == $new_username) {
		fclose($file);
	    header("Location: create_user_failure.html");
	    exit;
	}
}

fclose($file);

if(file_put_contents("/srv/users.txt", $new_username."\n", FILE_APPEND)){
	mkdir("/srv/".$new_username);
	header("Location: files.php");
	exit;
}else{
    fclose($file);
	header("Location: create_user_failure.html");
	exit;
}

?>