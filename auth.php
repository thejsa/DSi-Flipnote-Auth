<?php
// Hatena Authentication Script - DSi Flipnote Studio.
// Works with EU, US and JP.
// By PokeAcer.
// TY jaames for helping test JP copy.

//Set a log file path here:
$log = "/path/to/log"; // Linux
//$log = "C:\Path\To\log"; // Windows

// Make a token (this is used in both GET and POST so this is needed here)
$token = md5(microtime());

if ($_SERVER['REQUEST_METHOD'] === 'POST') { // Is the user connecting after a GET to give data?
// YES
//$header = apache_request_headers(); // Apache request headers
$header = getallheaders(); // IIS 7 (?) request headers

$userdata = array( // Get user-specific data
"FSID" => $header['X-DSi-ID'],
"MAC" =>  $header['X-DSi-MAC'],
"Birthday" => $header['X-Birthday'],
"Username" => $header['X-DSi-User-Name'],
"Region" => $header['X-DSi-Region'],
"Country" => $header['X-DSi-Country'],
"Language" => $header['X-DSi-Lang'],
"UIColor" => $header['X-DSi-Color'],
"AuthValid" => $header['X-DSi-Auth-Response']
);

// Log stuff - TODO: change this to a better system i.e. SQL

$authlog = fopen($log, "a") or die("Unable to open file!");
$logdata = "--START--\nTime of request is " . date("Y-m-d-H-i-s") . "\nToken is " . $token . "\nMAC Address is " . $userdata["MAC"] . "\nBirthday (YYYY-MM-DD) is " . $userdata["Birthday"]. "\nUsername in base64 is " . $userdata["Username"] . "\nRegion is " . $userdata["Region"] . "\nCountry is " . $userdata["Country"] . "\nLanguage is " . $userdata["Language"] . "\nUser's UI Colour is ". $userdata["UIColor"] . "\n Their auth response is " . $userdata["AuthValid"] . "\n--END--\n\n";
fwrite($authlog, $logdata);
fclose($authlog);

// Send the headers for authentication:

// Documentation: 
// X-DSi-New-Notices / X-DSi-Unread-Notices - set either to 1 for flashing "NEW" on index.ugo for the mailbox.

header('X-DSi-New-Notices: 1');
header('X-DSi-SID: ' . $token); 
header('X-DSi-Unread-Notices: 0');
header('X-Hatena-Locale-Vary: l,c,r,d'); 
header('X-Ridge-Dispatch: Hatena::UgoMemo::Engine::DS::Auth#default'); 

} else {
// NO 

header('X-DSi-Auth-Challenge: \0\0\0\0\0\0\0\0'); //Set challenge for user (not verified by this script)
header('X-DSi-New-Notices: 0');
header('X-DSi-SID: ' . $token);
header('X-DSi-Unread-Notices: 0;'); 
header('X-Hatena-Locale-Vary: l,c,r,d;');
header('X-Ridge-Dispatch: Hatena::UgoMemo::Engine::DS::Auth#default'); 

}
// If wanting to send a message on login:
//header('X-DSi-Dialog-Type: 1');
//echo mb_convert_encoding($message, "UTF-16LE");

// If wanting to tell user to load message from URL:
//header('X-DSi-Dialog-Type: 0');
//echo "[INSERT URL]";
?>


