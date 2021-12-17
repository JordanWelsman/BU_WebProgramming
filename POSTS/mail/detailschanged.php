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
$subject = "Updated POSTS Details";

// Headers
$from = "noreply@posts.com";
$reply = "support@posts.com";
$headers = "From: " . $from . "\r\n" . "Reply-To: " . $reply;

// Message
$message = "Hi, " . $name . "."
    . "\r\nYou have just updated your account details!"
    . "\r\nIf this was not you, please contact"
    . "\r\n" . $reply
    . "\r\nWe hope you conmtinue to enjoy our services!"

    . "\r\n \r\nKind regards,"
    . "\r\nThe POSTS team.";

$message = wordwrap($message, 70);

echo "TO: " . $to . "\r\n";
echo "SUBJECT: " . $subject . "\r\n";
echo "MESSAGE: " . $message . "\r\n";
echo "HEADERS: " . $headers;

mail($to, $subject, $message, $headers);
header("location: ../account.php?error=detailsupdated");
exit();
