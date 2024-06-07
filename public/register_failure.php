<?php
require './includes/config.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Failed</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
</head>

<body class="bg-background font-universal">

    <!-- Top Start -->
    <div class="flex w-full h-[130px] justify-center items-center">
        <a href="index.php">
            <div class="flex flex-row gap-[30px]">
                <div class="flex items-center justify-center">
                    <img src="./assets/logo.svg" class="w-auto h-[120px]">
                </div>
                <div class="flex justify-center items-center">
                    <h1 class="logo mt-10">Fit.eats</h1>
                </div>
            </div>
        </a>
    </div>
    <!-- Top End -->

    <!-- Failure Message Section -->
    <div class="mx-auto flex flex-col items-center justify-center mt-[3.5%]">
        <h1 class="text-4xl font-bold text-center mt-10 mb-5">Registration Failed!</h1>
        <?php
        // Check if there are errors stored in the session
        if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
            foreach ($_SESSION['errors'] as $error) {
                echo "<p class='text-lg text-center mb-10'>$error</p>";
            }
            // Clear errors from session
            unset($_SESSION['errors']);
        } else {
            // If no specific error message is set, display a generic error message
            echo "<p class='text-lg text-center mb-10'>An error occurred during registration. Please try again later.</p>";
        }
        ?>
        <a href="login.php" class="bg-primary text-white py-3 px-6 rounded-full font-semibold text-lg hover:bg-opacity-80 transition-all duration-300">Register Again</a>
    </div>
    <!-- Failure Message Section End -->

    <!-- Footer Section -->
    <div class="flex flex-col h-max w-full mt-24 mb-10">
        <div class="flex flex-col mx-[5%] h-full gap-[50px]">
            <div class="flex flex-row rounded-lg bg-primary py-5 md:py-[1.5%] justify-between px-[2.5%]">
                <div class="flex  flex-col md:flex-row md:gap-[2%] gap-4">
                    <div class="flex items-center">
                        <div class="flex flex-row items-center h-max gap-3 border py-3 px-5 rounded-md">
                            <i class="fas fa-envelope text-light text-2xl"></i>
                            <p class="footertext">fiteats@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-row items-center h-max gap-3 border py-3 px-5 rounded-md">
                            <i class="fas fa-location-dot text-light text-2xl"></i>
                            <p class="footertext">Kathmandu</p>
                        </div>
                    </div>
                </div>
                <div class="flex-row hidden md:flex">
                    <div class="flex items-center">
                        <p class="footertext">&copy; Fit.eats, All rights reserved</p>
                    </div>
                </div>
            </div>
            <div class="flex items-center md:hidden mt-[-25px] mb-10">
                <p class="text-primary text-[18px]/[150%] font-normal">&copy; Fit.eats, All rights reserved</p>
            </div>
        </div>
    </div>
    <!-- Footer Section End -->

    <!-- Scripts -->
    <script src="./js/main.js"></script>

</body>

</html>