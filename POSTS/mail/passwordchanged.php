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
$subject = "POSTS Password Changed";

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$passwordrecovery = "passwordrecovery@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nYour password has just been changed!"
    . "\r\nIf this was not you, please contact"
    . "\r\n" . $passwordrecovery
    . "\r\nWe hope you continue to enjoy our services!"

    . "\r\n \r\nMany thanks,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../account.php?error=passwordupdated");
exit();
