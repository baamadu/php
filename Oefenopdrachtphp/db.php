<?php
$host_name = 'localhost';
$database_name = 'personal';
$database_user = 'root';
$database_password = '';

$connection = new mysqli($host_name, $database_user, $database_password, $database_name);

if ($connection->connect_error) {
    die("Verbinding mislukt: " . $connection->connect_error);
}
?>
 