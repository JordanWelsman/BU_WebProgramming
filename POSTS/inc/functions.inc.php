<?php

// header("location: ../index.php?error=insufficientprivileges");

// START SESSION IF NONE IS STARTED
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// SIGN UP FUNCTIONS //

/**
 * Check if any of the sign up variables passed in are empty
 * @param string $forename First name supplied for sign up
 * @param string $surname Second name supplied for sign up
 * @param string $email Email supplied for sign up
 * @param string $pwd Password supplied for sign up
 * @param string $pwdrepeat Repeated password supplied for sign up
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputSignup($forename, $surname, $email, $pwd, $pwdrepeat)
{
    $result = 1;
    if (empty($forename) || empty($surname) || empty($email) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the string passed in is in an email format
 * @param string $email Email supplied for sign up
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function invalidEmail($email)
{
    $result = 1;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the repeated password matches the first password
 * @param string $pwd First password supplied for sign up
 * @param string $pwdrepeat Second password to verify first password is correctly entered
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function mismatchedPassword($pwd, $pwdrepeat)
{
    $result = 1;
    if ($pwd != $pwdrepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the email exists as a user in the SQL database
 * @param string $email Email checked for existing instance in the database
 * @return mixed Returns user row if email exists in database or FALSE if it does not
 */
function emailExists($email)
{
    $query = "SELECT * FROM users WHERE email = '$email';";
    $result = dbQuery($query);

    if ($row = mysqli_fetch_assoc($result)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }
}

/**
 * Create user with supplied credentials, create sesion variables for use with email, and call mail send script
 * @param string $forename First name supplied for account creation
 * @param string $surname Last name supplied for account creation
 * @param string $email Email supplied for account creation
 * @param string $pwd Password supplied for encryption and account creation
 * @return void This function does not return anything
 */
function createUser($forename, $surname, $email, $pwd)
{
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (id, forename, surname, email, password, admin) VALUES (NULL, '$forename', '$surname', '$email', '$hashedPwd', 0)";

    dbQuery($query);

    // Send user to Sign Up page after signing up
    // header("location: ../signup.php?error=none");

    $_SESSION["useremail"] = $email;
    $_SESSION["userfname"] = $forename;
    $_SESSION["userpass"] = $pwd;

    // Send user an email after signing up
    header("location: ../mail/welcome.php");
    exit();
}

// LOG IN FUNCTIONS //

/**
 * Check if any of the login variables passed in are empty
 * @param string $email Email supplied for login
 * @param string $pwd Password supplied for login
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputLogin($email, $pwd)
{
    $result = 1;
    if (empty($email) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Verify credentials, log in user, and create session variables for use in web pages
 * @param string $email Email supplied for login
 * @param string $pwd Password supplied for login
 * @return void This function does not return anything
 */
function loginUser($email, $pwd)
{
    $emailExists = emailExists($email);
    if ($emailExists === false) {
        header("location: ../login.php?error=badlogin");
    }

    $pwdHashed = $emailExists["password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../login.php?error=badlogin");
    } else if ($checkPwd === true) {
        session_start();

        $_SESSION["userid"] = $emailExists["id"];
        $_SESSION["useremail"] = $emailExists["email"];
        $_SESSION["userfname"] = $emailExists["forename"];
        $_SESSION["userlname"] = $emailExists["surname"];
        $_SESSION["userpass"] = $emailExists["password"];
        $_SESSION["useradmin"] = $emailExists["admin"];

        header("location: ../index.php?error=none");
    }
}

// PACKAGE SEARCH FUNCTIONS //

/**
 * Check if the search query variable passed in is empty
 * @param string $trackingnumber Tracking number supplied for database search
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptySearch($trackingnumber)
{
    $result = 1;
    if (empty($trackingnumber)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Prepare tracking number passed in into a search query URL and forward the browser to said URL
 * @param string $trackingnumber Tracking number passed in from search form
 * @return void This function does not return anything
 */
function searchTracking($trackingnumber)
{
    header("location: ../searchresults.php?tracking=$trackingnumber");
}

// USER DETAIL UPDATE FUNCTIONS //

/**
 * Check if any of the user update variables passed in are empty
 * @param string $forename First name supplied for user update
 * @param string $surname Last name supplied for user update
 * @param string $email Email supplied for user update
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputUpdateDetails($forename, $surname, $email)
{
    $result = 1;
    if (empty($forename) || empty($surname) || empty($email)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Update user account details with supplied credentials, update session variables for use with email, and call mail send script
 * @param string $forename First name supplied for user detail update
 * @param string $surname Last name supplied for user detil update
 * @param string $email Email supplied for user detail update
 * @return void This function does not return anything
 */
function updateDetails($forename, $surname, $email)
{
    $userId = $_SESSION["userid"];
    $query = "UPDATE users SET
        forename = '$forename',
        surname = '$surname',
        email = '$email'
    WHERE id = '$userId'";

    dbQuery($query);
    $_SESSION["userfname"] = $forename;
    $_SESSION["userlname"] = $surname;
    $_SESSION["useremail"] = $email;

    header("location: ../mail/detailschanged.php");
    exit();
}

// PASSWORD CHANGE FUNCTIONS //

/**
 * Check if any of the password update variables passed in are empty
 * @param string $oldpwd Old password supplied for password update
 * @param string $pwd New password supplied for password update
 * @param string $pwdrepeat Repeated password spplied for password update
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputUpdatePassword($oldpwd, $pwd, $pwdrepeat) // check any field is empty
{
    $result = 1;
    if (empty($oldpwd) || empty($pwd) || empty($pwdrepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the new password is idenical to the old password (password has been reused)
 * @param string $oldpwd Old password supplied for password update
 * @param string $pwd New password supplied for password update
 * @return bool Return check status (TRUE = failed | FALSE = passed)
 */
function reusedPassword($oldpwd, $pwd) // check new password is identitcal to old password
{
    $result = 1;
    if ($oldpwd == $pwd) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if old password doesn't match the password used to sign in
 * @param string $oldpwd Old password supplied for password update
 * @return bool Return check status (TRUE = failed | FALSE = passed)
 */
function verifyOldPassword($oldpwd) // check that old password doesn't match password in database
{
    $result = 1;
    $dbHashedPwd = $_SESSION["userpass"];
    $checkPwd = password_verify($oldpwd, $dbHashedPwd);
    if ($checkPwd === false) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Update user password with supplied credential, update session variable for use with web pages, and call mail send script
 * @param string $pwd New password supplied for password update
 * @return void This function does not return anything
 */
function updatePassword($pwd)
{
    $userId = $_SESSION["userid"];
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $query = "UPDATE users SET password = '$hashedPwd' WHERE id = '$userId'";

    dbQuery($query);
    $_SESSION["userpass"] = $hashedPwd;

    header("location: ../mail/passwordchanged.php");
    exit();
}

// DELETE USER FUNCTIONS //

/**
 * Check if the delete account variable passed in is empty
 * @param string $backpwd Backwards password supplied for account deletion
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputDeleteUser($backpwd)
{
    $result = 1;
    if (empty($backpwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the delete account variable passed in is different to the password used to sign in when reversed
 * @param string $backpwd Backwards password supplied for account deletion
 * @return bool Return check status (TRUE = failed | FALSE = passed)
 */
function verifyBackwardsPassword($backpwd)
{
    $result = 1;
    $dbHashedPwd = $_SESSION["userpass"]; // session password
    $checkPwd = password_verify(strrev($backpwd), $dbHashedPwd); // hashed (reversed user input)
    if ($checkPwd === false) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Delete user from database using session variable and call mail send script
 * @return void This function does not return anything
 */
function deleteUser()
{
    $userId = $_SESSION["userid"];
    $query = "DELETE FROM users WHERE id = '$userId'";

    dbQuery($query);
    header("location: ../mail/goodbye.php");
    exit();
}

// NEW PACKAGE FUNCTIONS //

/**
 * Find the ID of the latest package and increment it by 1 for use for the next parcel
 * @return int Returns the next available record ID for use in the packages table
 */
function findNextPackageId()
{
    $query = "SELECT * FROM packages ORDER BY id DESC LIMIT 1";
    $result = dbQuery($query);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $nextId = $row["id"] + 1;
    return $nextId;
}

/**
 * Check if any of the package creation variables passed in are empty
 * @param string $trackingnumber Tracking number supplied for package creation
 * @param string $status Status code supplied for package creation
 * @param string $name Full name supplied for package creation
 * @param string $country Country code supplied for package creation
 * @param string $city City name supplied for package creation
 * @param string $address Street address supplied for package creation
 * @param string $orderdate Order date supplied for package creation
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function emptyInputPackage($trackingnumber, $status, $name, $country, $city, $address, $orderdate)
{
    $result = 1;
    if (empty($trackingnumber) || empty($status) || empty($name) || empty($country) || empty($city) || empty($address) || empty($orderdate)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Check if the tracking number supplied already exists in the database and sets session variable if the package already exists for use in web pages
 * @param string $trackingnumber Tracking number supplied for package creation
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function trackingNumberExists($trackingnumber)
{
    $query = "SELECT * FROM packages WHERE trackingnumber = '$trackingnumber'";
    $result = dbQuery($query);

    if (mysqli_fetch_assoc($result)) {
        $result = true;
        $_SESSION["lastpackagesearched"] = $trackingnumber;
    } else {
        $result = false;
    }
    return $result;
}

/**
 * Create new package tracking entry with supplied information, bind the package to the current user's account, create sesion variable for use with email, and call mail send script
 * @param string $trackingnumber Tracking number supplied for package creation
 * @param string $status Status code supplied for package creation
 * @param string $name Full name supplied for package creation
 * @param string $country Country code supplied for package creation
 * @param string $city City name supplied for package creation
 * @param string $address Street address supplied for package creation
 * @param string $postcode Postcode supplied for package creation
 * @param string $orderdate Order date supplied for package creation
 * @param int $userid User ID supplied for account package linking
 * @param int $packageid Package ID supplied for account package linking
 * @return void This function does not return anything
 */
function createPackage($trackingnumber, $status, $name, $country, $city, $address, $postcode, $orderdate, $userid, $packageid)
{
    $country = strtoupper($country);
    $query = "INSERT INTO packages VALUES ('$packageid', '$trackingnumber', '$status', '$name', '$country', '$city', '$address', '$postcode', '$orderdate')";
    dbQuery($query);

    linkPackageToUser($userid, $packageid);
    $_SESSION["lastpackageadded"] = $trackingnumber;

    header("location: ../mail/packageadded.php");
    exit();
}

// ADD PACKAGE TO USER FUNCTIONS //

/**
 * Link package to user so they can see the packages they are tracking
 * @param int $userid User ID supplied for account package linking
 * @param int $packageid Package ID supplied for account package linking
 * @return void This function does not return anything
 */
function linkPackageToUser($userid, $packageid)
{
    $query = "INSERT INTO userpackages VALUES (NULL, '$userid', '$packageid')";
    dbQuery($query);
}

/**
 * Check if a package is not linked to a user account
 * @param int $userid User ID supplied for account package linking
 * @param int $packageid Package ID supplied for account package linking
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function userPackageExists($userid, $packageid)
{
    $query = "SELECT * from userpackages WHERE userid = $userid AND packageid = $packageid";
    $result = dbQuery($query);
    $relationship = 0;
    if (mysqli_num_rows($result) == 0) { // if relationship between user and package doens't exist
        $relationship = false;
    } else {
        $relationship = true;
    }
    return $relationship;
}

// DELETE RECORDS FROM TABLE FUNCTIONS //

/**
 * Delete a specified table instance from a specified database table
 * @param string $tablename Name of table to be deleted from
 * @param int $id Record ID to be deleted
 * @return void This function donesn't return anything
 */
function deleteFromTable($tablename, $id)
{
    $query = "DELETE FROM $tablename WHERE id = $id";
    dbQuery($query);
}

// ADMIN DELETE FUNCTIONS //

/**
 * Check if a user account exists in the user database
 * @param int $userid User ID to be checked
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function userExists($userid)
{
    $query = "SELECT * FROM users WHERE id = $userid";
    $result = dbQuery($query);
    $user = 0;
    if (mysqli_num_rows($result) == 0) {
        $user = false;
    } else {
        $user = true;
    }
    return $user;
}

/**
 * Check if a package instance exists in the package database
 * @param int $packageid Package ID to be checked
 * @return bool Returns check status (TRUE = failed | FALSE = passed)
 */
function packageExists($packageid)
{
    $query = "SELECT * FROM packages WHERE id = $packageid";
    $result = dbQuery($query);
    $package = 0;
    if (mysqli_num_rows($result) == 0) {
        $package = false;
    } else {
        $package = true;
    }
    return $package;
}

// ADMIN UPDATE PACKAGE FUNCTIONS //

/**
 * Update package with supplied information
 * @param int $packageid Package ID supplied for package information update
 * @param string $trackingnumber Tracking number supplied for package information update
 * @param string $status Status code supplied for package information update
 * @param string $name Full name supplied for package information update
 * @param string $country Country code supplied for package information update
 * @param string $city City name supplied for package information update
 * @param string $address Street address supplied for package information update
 * @param string $postcode Postcode supplied for package information update
 * @param string $orderdate Order date supplied for package information update
 * @return void This function does not return anything
 */
function updatePackage($packageid, $trackingnumber, $status, $name, $country, $city, $address, $postcode, $orderdate)
{
    $country = strtoupper($country);
    $query = "UPDATE packages
        SET
            trackingnumber = '$trackingnumber',
            status = '$status',
            name = '$name',
            country = '$country',
            city = '$city',
            destination = '$address',
            postcode = '$postcode',
            orderdate = '$orderdate'
        WHERE
            id = '$packageid'";

    dbQuery($query);
    header("location: ../packages.php?status=packageupdated");
    exit();
}

// ADMIN TOGGLE FUNCTIONS

/**
 * Set admin status according to determined boolean status
 * @param int $userid User ID supplied for admin allocation
 * @param bool $adminstate Admin status to be applied (TRUE = admin | FALSE = regular)
 * @return void This function does not return anything
 */
function setAdmin($userid, $adminstate)
{
    if (userExists($userid)) {
        $query = "UPDATE users
            SET
                admin = $adminstate
            WHERE
                id = '$userid'";

        dbQuery($query);
    }
}
