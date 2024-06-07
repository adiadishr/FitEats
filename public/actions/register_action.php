<?php
require '../includes/config.php';

// Define error variable to store validation errors
$errors = [];

// To make role_id default user
$query = "SELECT id FROM roles WHERE name='user'";
$sql = mysqli_query($conn, $query);
$result = mysqli_fetch_assoc($sql);
$role_id = $result['id'];

// Taking values from forms (ensure data is sanitized)
$first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
$last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
$username = mysqli_real_escape_string($conn, $_POST['username']);
$email = mysqli_real_escape_string($conn, $_POST['email']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

// Check if username already exists
$query = "SELECT id FROM users WHERE username='$username' LIMIT 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $errors[] = "Username already exists.";
}

// Check if email already exists
$query = "SELECT id FROM users WHERE email='$email' LIMIT 1";
$result = mysqli_query($conn, $query);
if (mysqli_num_rows($result) > 0) {
    $errors[] = "Email already exists.";
}

// If there are validation errors, redirect to the registration failure page and display errors
if (!empty($errors)) {
    $_SESSION['errors'] = $errors;
    header("Location: ../register_failure.php");
    exit();
}

// Hash the password for security
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Prepare and execute the SQL query to insert data into the users table
$query = "INSERT INTO users (first_name, last_name, username, email, password, role_id) 
          VALUES ('$first_name', '$last_name', '$username', '$email', '$hashed_password', $role_id)";

if (mysqli_query($conn, $query)) {
    // Data inserted successfully
    header("Location: ../register_success.php"); // Redirect to success page
    exit(); // Ensure script execution stops after redirection
} else {
    // Error occurred while inserting data
    header("Location: ../register_failure.php"); // Redirect to failure page
    exit(); // Ensure script execution stops after redirection
}

// Close the database connection
mysqli_close($conn);
?>
