<?php

session_start();

if (isset($_SESSION["useremail"])) { // If user arrives at page without signing up
    if (isset($_SESSION["userid"])) { // If user is logged in
        header("location: ../index.php?error=insufficientprivileges");
    } else {
        require_once '../db/config_uni.php';
        require_once '../db/db.php';
        require_once 'functions.inc.php';

        loginUser($_SESSION["useremail"], $_SESSION["userpass"]);
    }
} else {
    header("location: ../index.php?error=insufficientprivileges");
}
