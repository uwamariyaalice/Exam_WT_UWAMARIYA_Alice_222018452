<?php
// Database credentials
$hostname = "localhost";
$username = "Alice";
$password = "alice@05";
$database = "virtualroboticstrainingplatform";

// Create connection
$connection = new mysqli($hostname, $username, $password, $database);

if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}
?>