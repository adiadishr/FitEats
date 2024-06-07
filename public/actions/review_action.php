<?php
require '../includes/config.php';
require '../includes/login_check.php';

$review_err = $review_succ = $review_same = "";



if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // $user_name = $_SESSION['username'];
    if (isset($_SESSION["user_id"])) {
        $user_id = $_SESSION["user_id"];
    }
    if (isset($_POST["recipe_id"])) {
        $recipe_id = $_POST["recipe_id"];
    }

    // Checking if the reviewAuthor is the same person as recipeAuthor
    $same_reviewer_query = "SELECT user_id from recipes WHERE id = '$recipe_id'";
    $same_reviewer_result = mysqli_query($conn, $same_reviewer_query);
    $same_reviewer = mysqli_fetch_assoc($same_reviewer_result);
    if ($same_reviewer['user_id'] == $user_id) {
        $review_same = "You can't review your own post!";
        $_SESSION['review_same'] = $review_same;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        die;
    }
    // End


    // Checking if review already exists from same user
    $existing_review_query = "SELECT * FROM reviews WHERE user_id = '$user_id' AND recipe_id = '$recipe_id'";
    $existing_review_result = mysqli_query($conn, $existing_review_query);
    if (mysqli_num_rows($existing_review_result) > 0) {
        $review_err = "You have already left a review for this recipe. You can't review again!";
        $_SESSION['review_err'] = $review_err;
        header("Location: {$_SERVER['HTTP_REFERER']}");
        die;
    }
    // End


    if (isset($_POST["rating"])) {
        $rating = $_POST["rating"];
    } else {
        $_SESSION['review_same'] = "Cannot Leave Rating Empty";
        header("Location: {$_SERVER['HTTP_REFERER']}");
        die;
    }
    if (isset($_POST["comment"])) {
        $comment = htmlspecialchars($_POST["comment"]);
    }
}

// $query = "INSERT INTO reviews (user_id, recipe_id, rating, comment) VALUES ('$user_id', '$recipe_id', '$rating', '$comment');";

$query = "INSERT INTO reviews (user_id, recipe_id, rating, comment) VALUES ('$user_id', '$recipe_id', '$rating', '" . mysqli_real_escape_string($conn, $comment) . "')";

if (mysqli_query($conn, $query)) {
    $review_succ = "Congratulations, your review has been put in!";
    $_SESSION['review_succ'] = $review_succ;
    header("Location: {$_SERVER['HTTP_REFERER']}");
    die;
}
