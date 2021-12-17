<?php

if (isset($_POST["search"])) {

    $trackingNumber = $_POST["trackingnumber"];

    require_once '../db/config_uni.php';
    require_once '../db/db.php';
    require_once 'functions.inc.php';

    if (emptySearch($trackingNumber) !== false) {
        header("location: ../index.php?error=emptysearch");
        exit();
    }

    searchTracking($trackingNumber);
}
