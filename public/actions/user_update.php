<?php
include '../includes/config.php';
include '../includes/login_check.php';

if ($_FILES["profile_picture"]["size"] > 0) {
    // Preliminaries
    $file_name = time() . rand(0, 100);
    $target_dir = "../assets/profile_picture/";
    $target_file = $target_dir . basename($_FILES["profile_picture"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $file_name = $file_name . '.' . $imageFileType;
    $target_file = $target_dir . $file_name;

    // Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["profile_picture"]["tmp_name"]);
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
        if (move_uploaded_file($_FILES["profile_picture"]["tmp_name"], $target_file)) {
            echo "The file " . htmlspecialchars(basename($_FILES["profile_picture"]["name"])) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}



// Check if the HTTP request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Define variables to store form data
    $first_name = $last_name = $username = $email = $location = $bio = $location = $profile_picture = "";

    // Check if form fields are set and not empty, then assign them to variables
    if (isset($_POST["first_name"])) {
        $first_name = $_POST["first_name"];
    }
    if (isset($_POST["last_name"])) {
        $last_name = $_POST["last_name"];
    }
    if (isset($_POST["username"])) {
        $username = $_POST["username"];
    }
    if (isset($_POST["email"])) {
        $email = $_POST["email"];
    }
    if (isset($_POST["location"])) {
        $location = $_POST["location"];
    }
    if (isset($_POST["bio"])) {
        $bio = $_POST["bio"];
    }
    $user_id = $_SESSION['user_id'];
    if (isset($file_name)) {
        $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', email = '$email', location = '$location', bio = '$bio', profile_picture = '$file_name' WHERE id = '$user_id'";
    } else {
        $query = "UPDATE users SET first_name = '$first_name', last_name = '$last_name', username = '$username', email = '$email', location = '$location', bio = '$bio' WHERE id = '$user_id'";
    }

    $result = mysqli_query($conn, $query);

    if ($result) {
        header("Location: ../user.php");
        exit;
    } else {
        echo 'Oops! Something went wrong!';
        exit;
    }

}
