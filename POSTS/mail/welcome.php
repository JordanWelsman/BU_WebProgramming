<?php
// START SESSION IF NONE IS STARTED
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION["useremail"])) {
    header("location: ../signup.php");
}

// To
$to = $_SESSION["useremail"];
$name = $_SESSION["userfname"];

// Subject
$subject = "Welcome to POSTS!";

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nWelcome to POSTS!"
    . "\r\nYou signed up with"
    . "\r\n" . $to
    . "\r\nLog in to start tracking your packages!"

    . "\r\n \r\nKind regards,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../inc/logmein.inc.php");
exit();
