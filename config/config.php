<?php
define('DB_SERVER_USER', 'localhost');
define('DB_USERNAME_USER', 'root');
define('DB_PASSWORD_USER', '');
define('DB_NAME_USER', 'sacco');
 /* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=" . DB_SERVER_USER . ";dbname=" . DB_NAME_USER, DB_USERNAME_USER, DB_PASSWORD_USER);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>