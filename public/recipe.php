<?php
require './includes/config.php';

$id = $_GET['recipe_id'];
$view_query = "SELECT views_amount FROM recipes WHERE id = $id";
$view_result = mysqli_query($conn, $view_query);
$recipes_view = mysqli_fetch_assoc($view_result);

$view_amount = $recipes_view['views_amount'];
$new_view_amount = $view_amount + 1;
$update_query = "UPDATE recipes SET views_amount = $new_view_amount WHERE id = $id";
mysqli_query($conn, $update_query);

$query = "SELECT * FROM recipes WHERE id = $id";
$result = mysqli_query($conn, $query);
$recipes = mysqli_fetch_assoc($result);

$title = $recipes['title'];

require './includes/head.php';
?>

<body class="relative bg-background font-universal">

    <div id="top" class="absolute top-0"></div>

    <?php require './includes/top.php' ?>

    <?php
    if (isset($_SESSION['review_same']) && !empty($_SESSION['review_same'])) {
    ?>
        <div class="fixed z-50 flex justify-center w-full top-[50%]" id="reviewSame">
            <div class="flex gap-5 px-10 py-5 bg-red-600 rounded-full ring-red-600 ring-8 ring-opacity-60">
                <p class="text-xl text-white"><?= $_SESSION['review_same']; ?></p>
                <button class="px-2 py-1 rounded-full hover:ring-2 ring-opacity-80 ring-white" onclick="closeReviewSame()">
                    <i class="text-lg font-bold text-white fas fa-x"></i>
                </button>
            </div>
        </div>
    <?php
        $_SESSION['review_same'] = '';
    }
    ?>

    <?php
    if (isset($_SSESION['review_succ']) && !empty($_SESSION['review_succ'])) {
    ?>
        <div class="fixed z-50 flex justify-center w-full top-[50%]" id="reviewSuccess">
            <div class="flex gap-5 px-10 py-5 rounded-full bg-primary ring-primary ring-8 ring-opacity-60">
                <p class="text-xl text-white"><?= $_SESSION['review_succ']; ?></p>
                <button class="px-2 py-1 rounded-full hover:ring-2 ring-opacity-80 ring-white" onclick="closeReviewSuccess()">
                    <i class="text-lg font-bold text-white fas fa-x"></i>
                </button>
            </div>
        </div>
    <?php
        $_SESSION['review_succ'] = '';
    }
    ?>

    <!-- Recipe Start -->
    <div class="flex py-[20px]">
        <!-- Inside Frame -->
        <div class="flex w-full h-full md:mx-[3%] mx-[7.5%]">
            <?php require './includes/main_left.php' ?>
            <!-- Right Frame -->
            <div class="flex flex-col w-full">
                <!-- Header -->
                <div class="flex flex-col w-full gap-10 mb-10 h-max lg:flex-row lg:gap-0">
                    <!-- Image -->
                    <div class="relative flex h-max lg:w-2/5">
                        <img class="rounded-2xl" src="./assets/recipes/<?= $recipes['recipe_picture'] ?>">
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
                            <a href="#" class="block w-full px-6 py-2 text-white rounded-t-xl hover:bg-gray-600">Post
                                1</a>
                            <a href="#" class="block px-6 py-2 text-white rounded-b-xl hover:bg-gray-600">Delete
                                Post</a>
                        </div>
                    </div>
                    <!-- Title -->
                    <div class="flex flex-col lg:w-3/5 lg:pb-[1.5%] lg:px-[5%] lg:justify-between">
                        <div class="mb-10 lg:mb-0">
                            <div class="flex justify-between w-full">
                                <div class="px-5 py-1 mb-2 rounded-full text-textcolor bg-slate-400 bg-opacity-20 w-max md:mb-0">
                                    <?php
                                    $category_id = $recipes['category_id'];
                                    $category_query = "SELECT * FROM categories WHERE id = $category_id";
                                    $category_result = mysqli_query($conn, $category_query);
                                    $categories = mysqli_fetch_assoc($category_result);
                                    echo $categories['name'];
                                    ?>
                                </div>
                                <div class="flex items-center">
                                    <button onclick="goBack()" class="transition-all duration-300 hover:-translate-x-1">
                                        <i class="text-xl fas fa-arrow-left "></i>
                                    </button>
                                </div>
                            </div>
                            <h1 class="text-[48px] font-bold text-textcolor mb-3"><?= $recipes['title'] ?></h1>
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
                        </div>
                        <div class="flex items-center justify-between w-full text-textcolor">
                            <div class="flex gap-5">
                                <div class="flex flex-row items-center gap-3">
                                    <i class="fas fa-eye"></i>
                                    <p><?= $recipes['views_amount'] ?> </p>
                                </div>
                                <div class="flex flex-row items-center gap-3">
                                    <i class="fas fa-calendar"></i>
                                    <p><?= date('Y-m-d', strtotime($recipes['posted_at'])) ?> </p>
                                </div>
                            </div>
                            <button class="relative z-10 px-3 py-2 transition-all duration-300 rounded-lg bg-slate-400 bg-opacity-20 hover:-translate-y-2 bookmark-button">
                                <i class="far fa-bookmark"></i>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Recipe -->
                <div class="flex flex-col gap-10 mb-10">
                    <!-- Description -->
                    <div class="flex flex-col">
                        <!-- Heading -->
                        <h1 class="instruction-heading mb-[2%]">Description:</h1>
                        <!-- Content -->
                        <div class="flex flex-col lg:flex-row w-11/12 lg:gap-[5%]">
                            <!-- Facts -->
                            <div class="flex gap-8 mb-[5%] lg:mb-0">
                                <div class="flex flex-col justify-center">
                                    <p class="font-semibold text-[36px] text-center text-primary">
                                        <?php
                                        $recipe_id = $recipes['id'];
                                        include('./includes/get_post_avg_rating.php');
                                        echo $avg_rating;
                                        ?>
                                    </p>
                                    <p class="text-[18px] text-center">Rating</p>
                                </div>
                                <div class="flex flex-col justify-center">
                                    <p class="font-semibold text-[36px] text-center text-primary"><?= $recipes['calories'] ?></p>
                                    <p class="text-[18px] text-center">Calories</p>
                                </div>
                            </div>
                            <!-- Text -->
                            <p class="leading-loose"><?= $recipes['description'] ?></p>
                        </div>
                    </div>
                    <!-- Ingredients -->
                    <div class="flex flex-col">
                        <!-- Heading -->
                        <h1 class="instruction-heading mb-[2%]">Ingredients:</h1>
                        <!-- Text -->
                        <ul class="w-11/12 list-disc list-inside">
                            <li class="recipe-list"><?= $recipes['ingredients'] ?></li>
                        </ul>
                    </div>
                    <!-- Instructions -->
                    <div class="flex flex-col">
                        <!-- Heading -->
                        <h1 class="instruction-heading mb-[2%]">Instructions:</h1>
                        <!-- Text -->
                        <ul class="w-11/12 list-disc list-inside">
                            <li class="recipe-list"><?= $recipes['instructions'] ?></li>
                        </ul>
                    </div>
                </div>
                <!-- Review -->
                <div class="flex flex-col">
                    <h1 class="instruction-heading mb-[2%]">Reviews:</h1>
                    <p class="text-[18px]/[120%] font-normal text-textcolor mb-[2%]">Add a review:</p>
                    <form class="mb-14" action="./actions/review_action.php" method="POST">
                        <div class="flex items-center mb-4">
                            <label for="rating" class="mr-2">Rating:</label>
                            <div class="flex items-center">
                                <input type="radio" id="star5" name="rating" value="1" class="hidden" />
                                <label for="star5" class="cursor-pointer">
                                    <i class="fas fa-star star"></i>
                                </label>
                                <input type="radio" id="star4" name="rating" value="2" class="hidden" />
                                <label for="star4" class="cursor-pointer">
                                    <i class="fas fa-star star"></i>
                                </label>
                                <input type="radio" id="star3" name="rating" value="3" class="hidden" />
                                <label for="star3" class="cursor-pointer">
                                    <i class="fas fa-star star"></i>
                                </label>
                                <input type="radio" id="star2" name="rating" value="4" class="hidden" />
                                <label for="star2" class="cursor-pointer">
                                    <i class="fas fa-star star"></i>
                                </label>
                                <input type="radio" id="star1" name="rating" value="5" class="hidden" />
                                <label for="star1" class="cursor-pointer">
                                    <i class="fas fa-star star"></i>
                                </label>
                                <input class="hidden" value="<?= $recipes['id'] ?>" name="recipe_id">
                            </div>
                        </div>
                        <div class="mb-4">
                            <label for="comment" class="block mb-2">Comment:</label>
                            <textarea id="comment" name="comment" rows="4" class="w-full p-2 border border-gray-300 rounded-md" required></textarea>
                            <p class="text-[16px] font-light text-orange-500 mt-2">
                                <?php
                                if (isset($_SESSION['review_err']) && $_SESSION['review_err'] != "") {
                                    echo $_SESSION['review_err'];
                                    $_SESSION['review_err'] = '';
                                }
                                ?></p>
                        </div>
                        <button type="submit" class="primary-btn">Submit</button>
                    </form>
                    <!--Individual Review -->
                    <?php
                    $query = "SELECT * FROM reviews WHERE recipe_id = $id";
                    $result = mysqli_query($conn, $query);
                    while ($review = mysqli_fetch_assoc($result)) {
                        $review_author_id = $review['user_id'];
                        $author_query = "SELECT `username`, `profile_picture` FROM users WHERE id = $review_author_id";
                        $author_result = mysqli_query($conn, $author_query);
                        $author = mysqli_fetch_assoc($author_result);
                        $author_name = $author['username'];
                        $author_profile_picture = $author['profile_picture'];
                    ?>
                        <div class="flex flex-col p-5 mb-5 bg-white border border-gray-600 rounded-lg">
                            <!-- UserID -->
                            <div class="flex flex-row gap-2 mb-4">
                                <a class="flex flex-row gap-2 cursor-pointer" href="user.php?user_id=<?= $review_author_id ?>">
                                    <img class="w-[40px] h-[40px] rounded-full object-center object-cover shadow-lg bg-black bg-opacity-25" src="./assets/profile_picture/<?= $author_profile_picture ?>"></img>
                                    <span class="flex items-center recipe-subtitle hover:underline">@<?= $author_name ?></span>
                                </a>
                                <span class="flex items-center font-light tracking-tighter"><?php echo date('m/d/Y', strtotime($review['posted_at'])); ?></span>
                            </div>
                            <!-- Content -->
                            <div class="flex flex-col md:flex-row gap-4 md:gap-8 mb-[5%] lg:mb-0">
                                <!-- Rating -->
                                <div class="flex items-center gap-3 md:gap-0 md:flex-col md:justify-center">
                                    <p class="font-semibold text-[36px] md:text-center text-primary"><?php echo $review['rating']; ?></p>
                                    <p class="text-[18px] md:text-center">Rating</p>
                                </div>
                                <!-- Text -->
                                <p class="leading-loose"><?php echo htmlspecialchars_decode($review['comment']); ?></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- Recipe End -->

    <?php require './includes/footer.php' ?>


    <!-- Scripts -->

    <!-- Bookmark -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const bookmarkButton = document.querySelector('.bookmark-button');

            bookmarkButton.addEventListener('click', function() {
                const bookmarkIcon = this.querySelector('i');
                bookmarkIcon.classList.toggle('far');
                bookmarkIcon.classList.toggle('fas');
            });
        });
    </script>
    <!-- Bookmark -->

    <!-- Review -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const stars = document.querySelectorAll('.star');

            stars.forEach((star, index) => {
                star.addEventListener('click', function() {
                    const rating = index + 1;
                    stars.forEach((s, i) => {
                        if (i < rating) {
                            s.classList.add('checked');
                        } else {
                            s.classList.remove('checked');
                        }
                    });
                });
            });
        });
    </script>
    <!-- Review -->


</body>

</html>