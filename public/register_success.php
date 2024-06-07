<?php
require './includes/config.php';
require './includes/head.php';
?>

<body class="bg-background font-universal">

    <?php
    require './includes/top.php'
    ?>


    <!-- Success Message Section -->
    <div class="mx-auto flex flex-col items-center justify-center mt-[3.5%]">
        <h1 class="mt-10 mb-5 text-4xl font-bold text-center">Registration Successful!</h1>
        <p class="mb-10 text-lg text-center">Thank you for registering with Fit.eats. You can now explore our delicious and nutritious recipes.</p>
        <a href="login.php" class="px-6 py-3 text-lg font-semibold text-white transition-all duration-300 rounded-full bg-primary hover:bg-opacity-80">Log In</a>
    </div>
    <!-- Success Message Section End -->

    <?php
    require './includes/footer.php';
    ?>

    <!-- Scripts -->
    <script src="./js/main.js"></script>

</body>

</html>