<?php
if (isset($_SESSION['user_id'])) {
    $query = "SELECT username, profile_picture FROM users WHERE id = $_SESSION[user_id]";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $profile_picture = $row['profile_picture'];
}
?>
<!-- Top Start -->
<div class="flex h-[90px] sticky top-0 bg-background z-50">
    <div class="flex flex-row justify-between pb-[10px] w-full md:mx-[3%] mx-[5%] border-b border-[#262626] border-opacity-80">
        <!-- Left Side -->
        <div class="flex items-center md:hidden">
            <i class="fas fa-bars text-4xl pl-[10px]"></i>
        </div>
        <a href="home.php" class="flex gap-[10px]">
            <img src="./assets/logo.svg" alt="" class="h-[80px] w-[80px]">
            <div class="flex flex-row pb-[10px]">
                <h1 class="hidden md:flex font-bold text-[36px]/[120%] h-full text-textcolor items-end">Fit.eats
                </h1>
            </div>
        </a>
        <!-- Right Side -->
        <div class="flex flex-row items-center gap-[20px]">
            <!-- User Icon -->
            <a href="user.php">
                <img class="hidden sm:flex w-[50px] h-[50px] rounded-full object-center object-cover shadow-md bg-black bg-opacity-25 hover:shadow-xl transition-all duration-200 hover:-translate-y-[2.5px] hover:outline-dashed outline-primary outline-[4px]" src="./assets/profile_picture/<?= $profile_picture ?? 'default.png'; ?>">
                </img>
            </a>
            <!-- Triple Dot -->
            <div class="relative inline-block">
                <!-- navBtn -->
                <button class="px-3 text-4xl transition-all duration-200 hover:bg-gray-700 hover:bg-opacity-20 rounded-xl" id="navBtn">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <!-- navMenu -->
                <div class="hidden absolute right-2 mt-[4.5px]" id="navMenu">
                    <div class="triangle-holder flex w-full h-full justify-end drop-shadow-[4px_-4px_35px_rgba(0,0,0,0.25)]">
                        <div class="triangle"></div>
                    </div>
                    <div class="w-48 rounded-tr-none shadow-xl rounded-tl-md rounded-b-md bg-primary bg-opacity-85">
                        <!-- Dropdown content -->
                        <a href="./actions/logout.php" class="block px-6 py-3 text-white rounded-tl-md rounded-b-md hover:bg-primary"><i class="mr-2 fas fa-power-off"></i> Logout</a>
                        <a href="index.php" class="block px-6 py-3 text-white rounded-tl-md rounded-b-md hover:bg-primary"><i class="mr-2 text-lg fas fa-circle-info"></i> About us</a>
                        <a href="create_recipe.php" class="block px-6 py-3 text-white rounded-b-md hover:bg-primary" ~>
                            <div class="inline-flex items-center justify-center"><i class="mr-2 text-xl far fa-square-plus"></i></div>Create Recipe
                        </a>
                        <a href="user_self.php" class="block px-6 py-3 text-white md:hidden rounded-tl-md rounded-b-md hover:bg-primary"><i class="mr-2 fas fa-user"></i> View Profile</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Top End -->

<!-- Nav Menu Start -->
<script>
    // Style navBtn
    document.addEventListener("DOMContentLoaded", function() {
        // Select the element with the ID navBtn
        const navBtn = document.getElementById("navBtn");

        // Add click event listener to the navBtn
        navBtn.addEventListener("click", function() {
            // Toggle the classes
            navBtn.classList.toggle("bg-gray-700");
            navBtn.classList.toggle("bg-opacity-40");
            navBtn.classList.toggle("hover:bg-gray-700");
            navBtn.classList.toggle("hover:bg-opacity-20");
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        const navBtn = document.getElementById("navBtn");
        const navMenu = document.getElementById("navMenu");

        navBtn.addEventListener("click", function() {
            navMenu.classList.toggle("hidden");
        });

        // Close dropdown when clicking outside
        window.addEventListener("click", function(event) {
            if (!navBtn.contains(event.target) && !navMenu.contains(event.target)) {
                navMenu.classList.add("hidden");
            }
        });
    });
</script>
<!-- Nav Menu End -->