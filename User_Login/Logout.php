<?php

require_once "./User-Config.php";
// Initialize the session
session_start();

// Update Access Log
$employee_id = $_SESSION["employee_id"];
$mysqli->query("UPDATE access_log_audit SET last_logout = CURRENT_TIMESTAMP WHERE employee_id = '$employee_id'");

// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session
session_destroy();

// Redirect to login page
header("location: ../User_Login/User-Login.php");
exit;
?>

