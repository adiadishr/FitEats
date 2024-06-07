<?php
require '../includes/config.php';
require '../includes/login_check.php';

$recipe_id = $_GET['recipe_id'];
$current_user_id = $_SESSION['user_id'];

// To see if the recipe's author matches the session user
$query = "SELECT user_id from recipes WHERE id = $recipe_id";
$recipe_user_id = mysqli_fetch_assoc(mysqli_query($conn, $query))['user_id'];

// To see if the user is an admin
$admin_query ="SELECT role_id FROM users WHERE id = $current_user_id";
$admin_query_result = mysqli_query($conn, $admin_query);
$admin = mysqli_fetch_assoc($admin_query_result);
$admin_check = $admin['role_id'];

if ($recipe_user_id == $_SESSION['user_id'] || $admin_check == 1 ) {
    $delete_query = "DELETE FROM recipes WHERE id = $recipe_id";
    if (mysqli_query($conn, $delete_query)) {
        $_SESSION['delete_message'] = "The post has been deleted!";
    }
} else {
    $_SESSION['delete_message'] = "You are not authorized to delete!";
    header("Location: ../user.php");
    die;
}

header("Location: {$_SERVER['HTTP_REFERER']}");