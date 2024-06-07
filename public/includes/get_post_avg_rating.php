<?php
$rating_query = mysqli_query($conn, "SELECT SUM(rating) AS total_ratings, COUNT(id) as total_num_ratings FROM reviews WHERE recipe_id = $recipe_id");
$ratings = mysqli_fetch_assoc($rating_query);
if ($ratings['total_ratings'] == 0 || $ratings['total_num_ratings'] == 0) {
    $avg_rating = 0;
} else {
    $avg_rating = number_format($ratings['total_ratings'] / $ratings['total_num_ratings'], 1);
}
