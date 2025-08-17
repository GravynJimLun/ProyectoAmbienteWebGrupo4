<?php
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$host = 'localhost';
$user = 'root'; 
$pass = '1234';
$db   = 'proyecto_web';
$mysqli = new mysqli($host, $user, $pass, $db);
$mysqli->set_charset("utf8mb4");
?>