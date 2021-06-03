<?php
// Keep login data
$username = $_SESSION['username'];
$adminType = $_SESSION['adminType'];

// Unset session variables
session_unset();

// Set session variables to keep authentication
$_SESSION['username'] = $username;
$_SESSION['adminType'] = $adminType;
$_SESSION['message'] = "";
$_SESSION['timedateRefreshCount'] = 0;
?>
