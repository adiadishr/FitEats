<?php
// Database connection settings
$host = 'localhost';
$dbname = 'fiteats_db';
$username = 'root';
$password = '';

// Create a connection to the database
$conn = mysqli_connect($host, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>