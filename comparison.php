<?php

session_start();

if(!$_SESSION['username']) {
    header("Location: login.html");
}

if(explode('.', str_replace("/", "", $_GET['file1']))[1] != 'txt' ||
   explode('.', str_replace("/", "", $_GET['file2']))[1] != 'txt') {
       header("Location: comparison_failure.html");
       exit;
}

$username = $_SESSION['username'];

// We need to make sure that the filename is in a valid format; if it's not, display an error and leave the script.
// To perform the check, we will use a regular expression.
if( !preg_match('/^[\w_\.\-]+$/', str_replace("/", "", $_GET['file1'])) || !preg_match('/^[\w_\.\-]+$/', str_replace("/", "", $_GET['file2']))){
	echo "Invalid filename";
	exit;
}

$file1 = "/srv/".$username."/".str_replace("/", "", $_GET['file1']);
$file2 = "/srv/".$username."/".str_replace("/", "", $_GET['file2']);

// Get the username and make sure that it is alphanumeric with limited other characters.
// You shouldn't allow usernames with unusual characters anyway, but it's always best to perform a sanity check
// since we will be concatenating the string to load files from the filesystem.
if( !preg_match('/^[\w_\-]+$/', $username) ){
	echo "Invalid username";
	exit;
}

$words = array();
$file1_count = 0;
$file2_count = 0;
$difference = 0;

$current_file = fopen($file1, "r");

while(!feof($current_file)){
	$line = explode(' ',trim(fgets($current_file)));
    foreach($line as $word):
        if(array_key_exists($word, $words)) {
            $words[$word]++;
        } else {
            $words[$word] = 1;
        }

        $file1_count++;
    endforeach;
}

$current_file = fopen($file2, "r");

while(!feof($current_file)){
	$line = explode(' ',trim(fgets($current_file)));
    foreach($line as $word):
        if(array_key_exists($word, $words)) {
            $words[$word]--;
        } else {
            $words[$word] = -1;
        }

        $file2_count++;
    endforeach;
}

$keys = array_keys($words);
foreach($keys as $word):
    if($words[$word] != 0) {
        $difference += abs($words[$word]);
    }
endforeach;

$_SESSION['similarity'] = (float) round(100 * (1 - $difference / max($file1_count, $file2_count)), 2);
header('Location: comparison_results.php');

?>