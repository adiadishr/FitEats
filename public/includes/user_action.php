<?php

// Retrieve user ID from session
if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    $user_id = $_SESSION['user_id'];
}

// SQL query to retrieve user data based on user ID
$sql = "SELECT * FROM users WHERE id = ?";

// Prepare statement
$stmt = $conn->prepare($sql);

// Bind parameters
$stmt->bind_param("i", $user_id);

// Execute statement
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Fetch user data
$user = $result->fetch_assoc();

// echo '<pre>';
// var_dump($user);

// Close statement
$stmt->close();

// Now $user variable contains the user data retrieved from the database
