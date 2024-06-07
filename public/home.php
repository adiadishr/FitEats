<?php
// Include the database connection file
require './includes/config.php';
require './includes/login_check.php';
if (isset($_GET['category_id'])) {
    $category_query = $_GET['category_id'];
    $title_query = "SELECT name FROM categories WHERE id = $category_query";
    $title_result = mysqli_fetch_assoc(mysqli_query($conn, $title_query));
    $title = $title_result['name'];
} else {
    $title = "Explore";
}

require './includes/head.php';
?>

<body class="relative bg-background font-universal">

    <div id="top" class="absolute top-0"></div>

    <?php require './includes/top.php' ?>

    <?php require './includes/messages.php' ?>

    <!-- Main Start -->
    <div class="flex py-[20px]">
        <!-- Inside Frame -->
        <div class="flex w-full h-full md:mx-[3%] mx-[7.5%]">
            <?php require './includes/main_left.php'; ?>
            <!-- Right Frame -->
            <div class="flex flex-wrap md:gap-[10px] gap-[20px] w-full h-full">
                <!-- Item -->
                <?php
                if (isset($_GET['category_id'])) {
                    $category_id = $_GET['category_id'];
                    $query = "SELECT * FROM recipes where category_id = $category_id ORDER BY views_amount desc";
                } else {
                    $query = "SELECT * FROM recipes ORDER BY views_amount desc";
                }
                $result = mysqli_query($conn, $query);
                while ($recipes = mysqli_fetch_assoc($result)) {
                ?>
                    <div class="card">
                        <!-- Admin Menu -->
                        <?php
                        $user_id = $_SESSION['user_id'];
                        $user_query = "SELECT `role_id` FROM users WHERE id = $user_id";
                        $user_result = mysqli_query($conn, $user_query);
                        $user = mysqli_fetch_assoc($user_result);
                        // echo $user['role_id'];
                        // die;
                        if ($user['role_id'] == 1) {
                        ?>
                            <button class="absolute flex items-center px-4 py-1 text-white bg-gray-700 admin-menu-btn top-5 left-5 rounded-xl focus:outline-none focus:bg-gray-600">
                                <i class="text-xl fas fa-ellipsis-h"></i>
                            </button>
                        <?php
                        }
                        ?>
                        <div class="absolute hidden bg-gray-700 rounded-md admin-dropdown-menu bg-opacity-80 top-12 left-5">
                            <!-- Dropdown items go here -->
                            <a href="#" class="block w-full px-6 py-2 text-white rounded-t-xl hover:bg-gray-600">Post 1</a>
                            <a href="./actions/delete_post.php?recipe_id=<?= $recipes['id'] ?>" class="block px-6 py-2 text-white rounded-b-xl hover:bg-gray-600">Delete Post</a>
                        </div>
                        <!-- Image -->
                        <img src="./assets/recipes/<?= $recipes['recipe_picture'] ?>" class="h-full rounded-t-xl">
                        <!-- Details -->
                        <div class="flex flex-col w-full h-full px-[15px] py-[10px]">
                            <!-- Upper -->
                            <div class="flex flex-col justify-center w-full h-full p-[10px] border-b border-[#262626] border-opacity-20">
                                <a href="recipe.php?recipe_id=<?= $recipes['id'] ?>">
                                    <h5 class="flex items-center h-full recipe-title"><?= $recipes['title'] ?></h5>
                                </a>
                                <div class="flex flex-row items-center justify-between h-full">
                                    <p class="recipe-subtitle"><?= $recipes['views_amount'] ?> Views</p>
                                    <p class="recipe-subtitle"><?= $recipes['calories'] ?> Calories</p>
                                </div>
                            </div>
                            <!-- Lower -->
                            <div class="flex flex-row w-full h-full items-center justify-between p-[10px]">
                                <a href="user.php?user_id=<?= $recipes['user_id'] ?>">
                                    <div class="flex flex-row gap-2">
                                        <?php
                                        $user_id = $recipes['user_id'];
                                        $user_query = "SELECT `username`, `profile_picture` FROM users WHERE id = $user_id";
                                        $user_result = mysqli_query($conn, $user_query);
                                        $user = mysqli_fetch_assoc($user_result);
                                        ?>
                                        <img class="w-[40px] h-[40px] rounded-full object-cover shadow-md bg-black bg-opacity-25" src="./assets/profile_picture/<?= $user['profile_picture']; ?>"></img>
                                        <span class="flex items-center recipe-subtitle hover:underline">@<?= $user['username'] ?></span>
                                    </div>
                                </a>
                                <div class="flex flex-col">
                                    <p class="text-center rating text-primary">
                                        <?php
                                        $recipe_id = $recipes['id'];
                                        include('./includes/get_post_avg_rating.php');
                                        echo $avg_rating;
                                        ?>
                                    </p>
                                    <p class="text-center recipe-subtitle">Rating</p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Main End -->

    <?php require './includes/footer.php' ?>

    <!-- Script -->


    <!-- Admin Menu Start -->
    <script>

    </script>
    <!-- Admin Menu End -->


</body>

</html>