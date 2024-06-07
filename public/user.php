<?php
// Include config file to establish database connection
require './includes/config.php';
require './includes/login_check.php';
require './includes/user_action.php';

$title = '@' . $_SESSION['username'];

require './includes/head.php';
?>

<body class="bg-background font-universal">

    <div id="top" class="absolute top-0"></div>

    <?php require './includes/top.php' ?>

    <?php require './includes/messages.php' ?>

    <!-- User Start -->
    <div class="flex py-[20px]">
        <!-- Inside Frame -->
        <div class="flex flex-col gap-10 w-full md:mx-[3%] mx-[7.5%] rounded-3x">
            <!-- Details Row -->
            <div class="flex flex-col lg:flex-row w-full h-max gap-10 lg:gap-[2.5%]">
                <!-- Image -->
                <div class="relative flex justify-center px-2 py-2 lg:justify-start lg:w-4/12 h-max">
                    <?php if ($user['profile_picture'] == null) {
                    ?>
                        <img src="./assets/profile_picture/default.png" class="rounded-[50%] object-cover object-center border-[#262626] border-b-2 border-r-2">
                    <?php } else { ?>
                        <img src="./assets/profile_picture/<?php echo $user['profile_picture'] ?>" class="rounded-[50%] object-cover object-center border-[#262626] border-b-2 border-r-2">
                    <?php } ?>
                </div>
                <!-- Details -->
                <div class="flex lg:w-8/12 ">
                    <!-- Inner -->
                    <div class="flex flex-col w-full gap-5 px-4 pt-4 pb-2 bg-white border-2 rounded-xl border-textcolor">
                        <!-- Heading -->
                        <div class="flex items-center justify-between gap-2 text-3xl h-max lg:w-11/12">
                            <div class="flex gap-2 text-primary">
                                <i class="far fa-user-circle"></i>
                                <p>About</p>
                            </div>
                            <div class="flex items-center">
                                <button onclick="goBack()" class="transition-all duration-300 hover:-translate-x-1">
                                    <i class="text-xl fas fa-arrow-left "></i>
                                </button>
                            </div>
                        </div>
                        <!-- Information -->
                        <div class="flex flex-col gap-3 text-textcolor">
                            <div class="flex flex-col justify-between w-full gap-3 lg:flex-row lg:w-10/12">
                                <div class="flex gap-3">
                                    <p>Username:</p>
                                    <p class="font-light">@<?php echo $user['username']; ?></p>
                                </div>
                                <div class="flex gap-3">
                                    <p>Full Name:</p>
                                    <p class="font-light"><?php echo $user['first_name'] . ' ' . $user['last_name']; ?></p>
                                </div>
                            </div>
                            <div class="flex flex-col justify-between w-full gap-3 lg:flex-row lg:w-10/12">
                                <div class="flex gap-3">
                                    <p>Email:</p>
                                    <p class="font-light"><?php echo $user['email']; ?></p>
                                </div>
                                <div class="flex gap-3">
                                    <p>Location:</p>
                                    <p class="font-light"><?php echo $user['location']; ?></p>
                                </div>
                            </div>
                            <div class="flex flex-col gap-3 mb-3">
                                <p>Bio:</p>
                                <p class="font-light text-justify"><?php echo $user['bio']; ?></p>
                            </div>
                            <div class="flex justify-center">
                                <?php
                                if ($user_id == $_SESSION['user_id']) {
                                ?>
                                    <button id="editProfileButton" class="px-5 py-3 transition-all duration-150 rounded-full hover:bg-light ">
                                        <i class="text-xl fas fa-edit text-primary"></i>
                                        Edit Profile
                                    </button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Tabs Row -->
            <div class="border-b border-gray-200 dark:border-gray-700">
                <ul class="flex justify-center -mb-px text-center text-gray-500">
                    <li class="me-2">
                        <a href="#" class="inline-flex items-center justify-center gap-3 p-4 border-b-2 text-primary border-primary" aria-current="page">
                            <i class="far fa-sticky-note"></i>
                            <p>Uploads</p>
                        </a>
                    </li>
                    <!-- <li class="me-2">
                <a href="#" class="inline-flex items-center justify-center gap-3 p-4 border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300">
                    <i class="far fa-bookmark"></i>
                    <p>Saved recipes</p>
                </a>
            </li> -->
                </ul>
            </div>
            <!-- Recipes Tab -->
            <div class="flex flex-wrap md:gap-[10px] gap-[20px] w-full h-full">
                <?php
                $recipes_query = "SELECT * FROM recipes where user_id = $user_id";
                $recipes_result = mysqli_query($conn, $recipes_query);
                while ($recipes = mysqli_fetch_assoc($recipes_result)) {
                ?>
                    <!-- Item -->
                    <div class="card">
                        <!-- Admin Menu -->
                        <?php if ($user_id == $_SESSION['user_id']) { ?>
                            <button class="absolute flex items-center px-4 py-1 text-white bg-gray-700 admin-menu-btn top-5 left-5 rounded-xl focus:outline-none focus:bg-gray-600">
                                <i class="text-xl fas fa-ellipsis-h"></i>
                            </button>
                        <?php
                        } ?>
                        <div class="absolute hidden bg-gray-700 rounded-md admin-dropdown-menu bg-opacity-80 top-12 left-5">
                            <!-- Dropdown items go here -->
                            <a href="#" class="block w-full px-6 py-[10px] text-white rounded-t-xl hover:bg-gray-600"><i class="mr-2 text-base font-thin fas fa-edit"></i>Edit Post</a>
                            <a href="./actions/delete_post.php?recipe_id=<?= $recipes['id'] ?>" class="block px-6 py-[10px] text-white rounded-b-xl hover:bg-gray-600"><i class="mr-2 text-base font-thin fas fa-trash"></i>Delete Post</a>
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
                                <a href="user.php?user_id=<?= $user_id ?>">
                                    <div class="flex flex-row gap-2">
                                        <img class="w-[40px] h-[40px] rounded-full object-cover shadow-md bg-black bg-opacity-25" src="./assets/profile_picture/<?= $user['profile_picture']; ?>"></img>
                                        <span class="flex items-center recipe-subtitle hover:underline">@<?= $user['username']; ?></span>
                                    </div>
                                </a>
                                <div class="flex flex-col">
                                    <p class="text-center rating text-primary">
                                        <?php
                                        $recipe_id = $recipes['id'];
                                        include('./includes/get_post_avg_rating.php');
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

    <!-- User End -->

    <?php require './includes/footer.php' ?>

    <!-- Modal Start -->
    <div id="editProfileModal" class="fixed inset-0 z-50 flex items-center justify-center hidden w-full bg-black bg-opacity-50 modal">
        <!-- Details -->
        <div class="modal-content relative bg-white w-[75%] md:w-[60%] p-6 rounded-lg flex flex-col justify-center items-center my-20">
            <!-- Modal Header -->
            <h2 class="text-[20px] font-semibold mb-4">Edit Profile</h2>
            <!-- Form -->
            <form id="editProfileForm" action="./actions/user_update.php" method="POST" enctype="multipart/form-data" class="flex flex-col w-full md:flex-row">
                <!-- Profile Picture & Bio -->
                <div class="flex flex-col items-center w-full gap-5 mb-4 md:justify-start lg:mb-0 lg:mr-4 md:w-5/12">
                    <!-- Profile Picture -->
                    <div class="flex w-full">
                        <input type="file" name="profile_picture" class="flex">
                    </div>
                    <!-- Bio -->
                    <div class="flex flex-col w-full gap-2">
                        <label for="bio" class="text-[16px]/[150%] font-normal">Bio:</label>
                        <textarea id="bio" name="bio" rows="12" class="p-2 border-2 border-dashed rounded-md" placeholder="Enter your bio"><?php echo htmlspecialchars($user['bio']); ?></textarea>
                    </div>
                </div>
                <!-- Details -->
                <div class="flex flex-col items-center justify-center w-full lg:items-start md:w-7/12">
                    <!-- Modal Body -->
                    <div class="flex flex-col w-full gap-2">
                        <!-- First Name -->
                        <div class="flex flex-col gap-2">
                            <label for="first_name" class="text-[16px]/[150%] font-normal">First Name:</label>
                            <input type="text" id="first_name" name="first_name" class="p-2 rounded-md" placeholder="Enter your First Name" value="<?php echo htmlspecialchars($user['first_name']); ?>">
                        </div>
                        <!-- Last Name -->
                        <div class="flex flex-col gap-2">
                            <label for="last_name" class="text-[16px]/[150%] font-normal">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" class="p-2 rounded-md" placeholder="Enter your Last Name" value="<?php echo htmlspecialchars($user['last_name']); ?>">
                        </div>
                        <!-- Username -->
                        <div class="flex flex-col gap-2">
                            <label for="username" class="text-[16px]/[150%] font-normal">Username:</label>
                            <input type="text" id="username" name="username" class="p-2 rounded-md" placeholder="Enter your username" value="<?php echo htmlspecialchars($user['username']); ?>">
                        </div>
                        <!-- Email -->
                        <div class="flex flex-col gap-2">
                            <label for="email" class="text-[16px]/[150%] font-normal">Email:</label>
                            <input type="email" id="email" name="email" class="p-2 rounded-md" placeholder="Enter your email" value="<?php echo htmlspecialchars($user['email']); ?>">
                        </div>
                        <!-- Location -->
                        <div class="flex flex-col gap-2">
                            <label for="location" class="text-[16px]/[150%] font-normal">Location:</label>
                            <input type="text" id="location" name="location" class="p-2 rounded-md" placeholder="Enter your location" value="<?php echo htmlspecialchars($user['location']); ?>">
                        </div>
                        <!-- Submit Button -->
                        <div class="flex justify-center w-full py-5">
                            <input type="submit" class="px-4 py-2 text-white transition-all duration-200 rounded-md cursor-pointer bg-primary hover:bg-opacity-85 hover:ring-2 hover:ring-primary hover:ring-opacity-60" value="Save Changes" />
                        </div>
                    </div>
                </div>
            </form>
            <!-- Close Button -->
            <div class="absolute flex top-5 right-5">
                <button id="closeModalBtn" class="border flex border-textcolor rounded-[50%] px-[10px] py-1 h-10 w-10 justify-center items-center hover:bg-textcolor hover:bg-opacity-80 hover:text-white hover:scale-105 transition-all duration-200 hover:ring-2 ring-textcolor ring-opacity-60 hover:border-transparent">
                    <i class="fas fa-x"></i>
                </button>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Script -->

    <!-- Modal Script -->
    <script>
        // Open the modal when edit button is clicked
        document.getElementById('editProfileButton').addEventListener('click', function() {
            document.getElementById('editProfileModal').classList.remove('hidden');
        });

        // Close the modal when close button is clicked
        document.getElementById('closeModalBtn').addEventListener('click', function() {
            document.getElementById('editProfileModal').classList.add('hidden');
        });

        // Close the modal when clicking outside of it
        window.addEventListener('click', function(event) {
            if (event.target === document.getElementById('editProfileModal')) {
                document.getElementById('editProfileModal').classList.add('hidden');
            }
        });

        // Prevent modal from closing when clicking inside it
        document.querySelector('.modal-content').addEventListener('click', function(event) {
            event.stopPropagation();
        });
    </script>
    <!-- Modal Script -->



</body>

</html>