<?php

// Initialize the session
require_once "lib/config.php";

// Unset all of the session variables
$_SESSION = array();

// Destroy the session.
session_destroy();

// Redirect to login page
header("location: ./");
exit;
?>
