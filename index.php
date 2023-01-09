<?php
require_once './include/session.php';
require_once './include/header.php';
if($session){
    require_once './include/navbar.php';
    require_once './include/sidebar.php';
    require_once './pages/dashboard.php';
    require_once './include/footer.php';
} else {
    require_once './pages/login.php';
}
require_once './include/script.php';
?>