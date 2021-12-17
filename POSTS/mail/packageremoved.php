<?php
session_start();

if (!isset($_SESSION["useremail"])) {
    header("location: ../login.php");
}

// To
$to = $_SESSION["useremail"];
$name = $_SESSION["userfname"];

// Subject
$subject = "Package Removed";

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nYou have removed a package from your account."
    . "\r\nIf this was was a mistake, please contact"
    . "\r\n" . $reply . "."

    . "\r\n \r\nMany thanks,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../mypackages.php?status=packageremoved");
exit();
