<?php
session_set_cookie_params(0);
// Initialize the session
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true || $_SESSION["status"]!="1"){
    // Unset all of the session variables
    $_SESSION = array();
    // Destroy the session.
    session_destroy();
    header("location: ./index.php");
    exit;
    $session = false;
}else
{
    $session = true;
}
$role = preg_split ("/\,/", $_SESSION["access"]);
