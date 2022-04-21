<?php
session_start();

$username = (String) $_GET['username'];

$file = fopen("/srv/users.txt", "r");

while(!feof($file)){
	if(trim(fgets($file)) == $username) {
		$_SESSION['username'] = $username;
		header("Location: files.php");
		exit;
	}
}

fclose($file);
header("Location: login.html");
exit;

?>