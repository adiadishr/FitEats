<?php
require_once('./includes/config.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fit.eats</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="shortcut icon" href="./assets/logo.png" type="image/x-icon">
    <script src="https://kit.fontawesome.com/ee759840f5.js" crossorigin="anonymous"></script>
</head>

<body class="bg-background font-universal">

    <!-- Navbar Start -->
    <div id="navbar" class="w-full h-[140px] bg-transparent flex flex-row absolute top-0 z-50">
        <div class="w-full lg:w-1/2 h-[inherit] flex flex-row gap-[30px] justify-start">
            <div class="ml-[10%] flex items-center justify-center">
                <img src="./assets/logo.svg" class="w-auto h-[120px]">
            </div>
            <div class="flex items-center justify-center">
                <h1 class="mt-10 logo">Fit.eats</h1>
            </div>
        </div>
        <div class="w-1/2 h-[inherit] flex items-center justify-end">
            <div class="navlinks hidden lg:flex flex-row h-max mr-[10%] gap-[30px] items-center">
                <a href="index.html" class="navlink">Home</a>
                <a href="#about" class="navlink">About Us</a>
                <a class="navlink">Team</a>
                <!-- <a class="navlink">Explore</a> -->
                <!-- <a href="login.php">
                    <button class="auxiliary-btn hover:scale-110 transition-all duration-[350ms]">
                        Log In
                    </button>
                </a> -->
            </div>
        </div>
    </div>
    <!-- Navbar End -->

    <!-- Hero Section Start -->
    <div class="flex flex-col w-full mb-40 h-max lg:flex-row">
        <div class="container lg:w-1/2 h-max grow">
            <div class="mt-[160px] px-[10%] h-max w-full flex flex-col gap-[30px]">
                <div class="dividers flex flex-col gap-[7px]">
                    <div class="h-[4px] w-10/12 rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[5px] w-10/12 rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[6px] w-10/12 rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[7px] w-10/12 rounded-lg bg-[#6A994E]"></div>
                </div>
                <h1 class="heading">Discover Delicious and Nutritious Recipes on Fit.eats</h1>
                <p class="paragraph">Welcome to the ultimate platform for sharing and
                    exploring
                    healthy
                    recipes. Whether you're a
                    seasoned chef or just starting your culinary journey, we have a wide range of delicious and
                    nutritious recipes to suit your taste buds.
                </p>
                <div class="flex flex-row items-center gap-5 buttons">
                    <a href="<?php echo isset($_SESSION['user_id']) ? 'home.php' : 'login.php'; ?>">
                        <button class="border-2 primary-btn btn border-primary">
                            <?php echo isset($_SESSION['user_id']) ? 'Explore Recipes' : 'Get Started';
                            ?>
                        </button>
                    </a>
                    <?php
                    if (!isset($_SESSION['user_id'])) {
                    ?>
                        <a href="register.php">
                            <button class="secondary-btn btn ">
                                Sign Up <i class="fa-solid fa-arrow-right fa-rotate-by " style="--fa-rotate-angle: -45deg;"></i>
                            </button>
                        </a>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="relative hidden w-full lg:block lg:w-1/2 rightside rounded-bl-3xl grow">
            <img src="./assets/hero.png" class="absolute w-[674.503px] -bottom-10 rolling-image">
        </div>
    </div>
    <!-- Hero Section End -->

    <!-- About Section Start -->
    <div class="flex flex-col items-center w-full mb-20 h-max" id="about">
        <div class="h-max flex flex-col gap-[80px] mx-[5%]">
            <div class="flex flex-col gap-[30px]">
                <h1 class="w-11/12 mx-auto heading lg:text-center md:w-10/12 lg:w-7/12">So, what is Fit.eats?</h1>
                <div class="w-11/12 mx-auto md:w-10/12 lg:w-7/12">
                    <p class="paragraph lg:text-center">Fiteats is a health food recipe sharing platform. It serves as a
                        comprehensive resource
                        for individuals seeking nutritious meal ideas, cooking inspiration, and community support on
                        their
                        wellness journey.</p>
                </div>
            </div>
            <div class="flex flex-col ">
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-[49.5%]">
                        <img src="./assets/2.png">
                    </div>
                    <div class="w-[1%] bg-light"></div>
                    <div class="lg:w-[49.5%] flex flex-col gap-[40px] justify-center lg:p-[60px] p-[20px]">
                        <div class="border-b-2 border-light">
                            <h1 class="heading">Our Mission</h1>
                        </div>
                        <p class="paragraph">We want to make eating healthy enjoyable, convenient, and sustainable for
                            everyone.</p>

                    </div>
                </div>
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-[49.5%] flex flex-col gap-[40px] justify-center lg:p-[60px] p-[20px] order-3 lg:order-1">
                        <div class="border-b-2 border-light">
                            <h1 class="heading lg:text-right">What we do</h1>
                        </div>
                        <p class="paragraph lg:text-right">We provide a platform where the health oriented community and
                            foster and share a diverse range of nutritious recipes
                        </p>
                    </div>
                    <div class="w-[1%] bg-light order-2"></div>
                    <div class="lg:w-[49.5%] order-1 lg:order-3">
                        <img src="./assets/4.png">
                    </div>
                </div>
                <div class="flex flex-col lg:flex-row">
                    <div class="lg:w-[49.5%]">
                        <img src="./assets/6.png">
                    </div>
                    <div class="w-[1%] bg-light"></div>
                    <div class="lg:w-[49.5%] flex flex-col gap-[40px] justify-center lg:p-[60px] p-[20px]">
                        <div class="border-b-2 border-light">
                            <h1 class="heading">Problems we solve</h1>
                        </div>
                        <div>
                            <p class="paragraph">
                            <ul class="list-disc list-inside">
                                <li>Lack of Time</li>
                                <li>Limited Access to Healthy Options</li>
                                <li>Monotonous Meals</li>
                                <li>Lack of Inspiration</li>
                            </ul>
                            </p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About Section End -->

    <!-- Footer Section -->
    <div class="flex flex-col w-full mt-24 mb-10 h-max">
        <div class="flex flex-col mx-[5%] h-full gap-[50px]">
            <div class="flex flex-row">
                <div class="flex flex-row w-1/2 gap-8">
                    <img src="./assets/logo.svg" class="w-auto h-[120px]">
                    <div class="items-center hidden sm:flex">
                        <h1 class="mt-10 logo">Fit.eats</h1>
                    </div>
                </div>
                <div class="flex items-end justify-end w-1/2">
                    <div class="flex flex-row items-center gap-5 h-max">
                        <p class="hidden md:block font-semibold text-[20px]/[150%] text-textcolor">Go to top</p>
                        <a href="#top" id="topbutton">
                            <div class="flex rounded-full h-16 w-16 bg-[#658936] items-center justify-center"><i class="text-2xl text-white fas fa-arrow-up"></i></div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-row rounded-lg bg-primary py-5 md:py-[1.5%] justify-between px-[2.5%]">
                <div class="flex  flex-col md:flex-row md:gap-[2%] gap-4">
                    <div class="flex items-center">
                        <div class="flex flex-row items-center gap-3 px-5 py-3 border rounded-md h-max">
                            <i class="text-2xl fas fa-envelope text-light"></i>
                            <p class="footertext">fiteats@gmail.com</p>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <div class="flex flex-row items-center gap-3 px-5 py-3 border rounded-md h-max">
                            <i class="text-2xl fas fa-location-dot text-light"></i>
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
    <script>
        // Smooth Scroll with even slower speed
        document.getElementById("topbutton").addEventListener("click", function(event) {
            event.preventDefault();
            const navbar = document.getElementById("navbar");

            // Delay scrolling by 100 milliseconds (adjust as needed)
            setTimeout(function() {
                navbar.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                    inline: "nearest"
                }); // Adjust the options here
            }, 100); // Adjust the delay time here
        });
    </script>
    <script src="./js/main.js"></script>

</body>

</html>