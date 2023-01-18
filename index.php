<?php
// Initialize the session
session_start();
// Check if the user is already logged in, if yes then redirect him to welcome page
require_once './include/header.php';
if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    require_once './include/navbar.php';
    require_once './include/sidebar.php';
    require_once './pages/dashboard.php';
    require_once './include/footer.php';
}else {
    require_once './pages/login.php';
}
require_once './include/script.php';
?>