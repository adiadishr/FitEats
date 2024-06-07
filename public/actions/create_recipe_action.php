<?php

include '../includes/config.php';
include '../includes/login_check.php';

if ($_FILES["recipe_picture"]["size"] > 0) {
    // Preliminaries
    $file_name = time() . rand(0, 100);
    $target_dir = "../assets/recipes/";
    $target_file = $target_dir . basename($_FILES["recipe_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $file_name = $file_name . '.' . $imageFileType;
    $target_file = $target_dir . $file_name;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["recipe_picture"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    if (
        $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif"
    ) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        // if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["recipe_picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["recipe_picture"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$category_id = $_POST['category_id'];
$title = $_POST['title'];
$calories = $_POST['calories'];
$description = $_POST['description'];
$ingredients = $_POST['ingredients'];
$instructions = $_POST['instructions'];
$user_id = $_SESSION['user_id'];
$recipe_picture = $file_name ?? null;

$query = "INSERT INTO recipes (title, category_id,calories, description, ingredients, instructions, user_id, recipe_picture) VALUES ('$title', '$category_id','$calories', '$description', '$ingredients', '$instructions', $user_id, '$recipe_picture')";

if (mysqli_query($conn, $query)) {
    header("Location: ../home.php");
}
