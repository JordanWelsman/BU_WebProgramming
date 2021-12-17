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
$subject = "Goodbye from POSTS!";

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nWe're sad to see you go!"
    . "\r\nYou signed up with"
    . "\r\n" . $to
    . "\r\nYou can reuse this email if you change your mind!"

    . "\r\n \r\nMany thanks,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../inc/logout.inc.php?status=userdeleted");
exit();
