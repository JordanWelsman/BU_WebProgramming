<?php
// START SESSION IF NONE IS STARTED
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["useremail"])) {
    header("location: ../login.php");
}

// To
$to = $_SESSION["useremail"];
$name = $_SESSION["userfname"];

// Subject
$subject = "New Package Added";
$package = $_SESSION["lastpackageadded"];

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nYou have added a package to our tracking system!"
    . "\r\nIf this was not you, please contact"
    . "\r\n" . $reply
    . "\r\nLog in and browse to 'My Packages' to see status updates for " . $package . "!"

    . "\r\n \r\nMany thanks,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../newpackage.php?error=packageadded");
exit();
