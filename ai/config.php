<?php
// Database connection settings
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "moodle2";

// Create a connection to the Moodle database
$mysqli = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($mysqli->connect_errno) {
    echo "Failed to connect to MySQL: " . $mysqli->connect_error;
    exit();
}
?>