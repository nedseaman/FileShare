<?php
session_start();

if(!$_SESSION['username']) {
    header("Location: login.html");
}

$filename = str_replace('/','',$_GET['filename']);
$username = $_SESSION['username'];
$full_path = '/srv/'.$username.'/'.$filename;


header("Content-Description: File Transfer"); 
header("Content-Type: application/octet-stream"); 
header('Content-Disposition: attachment; filename="'.basename($full_path).'"');

readfile($full_path);
exit;

?>