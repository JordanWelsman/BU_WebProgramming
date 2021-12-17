<?php

if (isset($_POST["submit"])) {
    $forename = $_POST["forename"];
    $surname = $_POST["surname"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $pwdrepeat = $_POST["pwdrepeat"];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptyInputSignup($forename, $surname, $email, $pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=emptyinput");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../signup.php?error=invalidemail");
        exit();
    }

    if (mismatchedPassword($pwd, $pwdrepeat) !== false) {
        header("location: ../signup.php?error=mismatchedpasswords");
        exit();
    }

    if (emailExists($email) !== false) {
        header("location: ../signup.php?error=emailtaken");
        exit();
    }

    createUser($forename, $surname, $email, $pwd);
} else {
    header("location: ../signup.php");
}
