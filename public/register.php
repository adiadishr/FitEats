<?php
require_once './includes/config.php';
require './includes/head.php';
?>

<body class="bg-background font-universal">

    <!-- Top Start -->
    <div class="flex w-full h-[130px] justify-center items-center">
        <a href="index.php">
            <div class="flex flex-row gap-[30px]">
                <div class="flex items-center justify-center">
                    <img src="./assets/logo.svg" class="w-auto h-[120px]">
                </div>
                <div class="flex items-center justify-center">
                    <h1 class="mt-10 logo">Fit.eats</h1>
                </div>
            </div>
        </a>
    </div>
    <!-- Top End -->

    <!-- Register Start -->
    <div class="flex w-full justify-center items-center py-[40px]">
        <div class="flex w-9/12 border-2 border-black rounded-[40px]">
            <div class="flex flex-col w-1/2 bg-white rounded-tl-[40px] rounded-bl-[40px] justify-center items-center gap-10">
                <div class="dividers flex flex-col gap-[7px] w-9/12 mx-auto">
                    <div class="h-[4px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[5px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[6px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[7px] rounded-lg bg-[#6A994E]"></div>
                </div>
                <h1 class="text-[48px]/[120%] font-bold text-primary text-center">Eat Healthy, <br> Be Healthy!</h1>
            </div>
            <div class="flex flex-col items-center px-[5%] w-1/2 rightside rounded-tr-[40px] rounded-br-[40px] gap-[24px] py-[25px]">
                <h1 class="text-[48px]/[120%] font-bold text-white">Register</h1>
                <form id="registrationForm" class="flex flex-col w-full gap-[24px]" action="./actions/register_action.php" method="post" onsubmit="return validateForm();">
                    <div class="flex flex-row gap-5">
                        <div class="flex flex-col gap-2">
                            <label for="first_name" class="logintext">First Name:</label>
                            <input placeholder="First Name" class="w-full p-2 rounded-md" type="text" id="first_name" name="first_name">
                            <span class="error" id="first_name_err"></span>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label for="last_name" class="logintext">Last Name:</label>
                            <input placeholder="Last Name" class="w-full p-2 rounded-md" type="text" id="last_name" name="last_name">
                            <span class="error" id="last_name_err"></span>
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="username" class="logintext">Username:</label>
                        <input placeholder="Enter your username" class="p-2 rounded-md" type="text" id="username" name="username">
                        <span class="error" id="username_err"></span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="email" class="logintext">Email:</label>
                        <input placeholder="Enter your email" class="p-2 rounded-md" type="email" id="email" name="email">
                        <span class="error" id="email_err"></span>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="password" class="logintext">Password:</label>
                        <input placeholder="Enter your password" class="p-2 rounded-md" type="password" id="password" name="password">
                        <span class="error" id="password_err"></span>
                        <input placeholder="Repeat your password" class="p-2 rounded-md" type="password" id="confirm_password" name="confirm_password">
                        <span class="error" id="confirm_password_err"></span>
                    </div>
                    <button id="registerButton" type="submit" class="text-center loginbtn btn">Register</button>
                </form>
                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center">
                        <p class="cursor-pointer logintext hover:underline">Already have an account?</p>
                    </div>
                    <a href="login.php" class="logintext"><button class="auxiliary-btn btn">Login</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- Register End -->

    <!-- Scripts -->

    <!-- Validation Start -->
    <script>
        function validateForm() {
            // Retrieve form inputs
            var firstName = document.getElementById('first_name').value.trim();
            var lastName = document.getElementById('last_name').value.trim();
            var username = document.getElementById('username').value.trim();
            var email = document.getElementById('email').value.trim();
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirm_password').value;

            // Define regular expression for email validation
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            // Define error flag
            var isError = false;

            // Validate first name
            if (firstName === '') {
                document.getElementById('first_name_err').innerText = 'Please enter your first name.';
                isError = true;
            } else {
                document.getElementById('first_name_err').innerText = '';
            }

            // Validate last name
            if (lastName === '') {
                document.getElementById('last_name_err').innerText = 'Please enter your last name.';
                isError = true;
            } else {
                document.getElementById('last_name_err').innerText = '';
            }

            // Validate username
            if (username === '') {
                document.getElementById('username_err').innerText = 'Please enter a username.';
                isError = true;
            } else {
                document.getElementById('username_err').innerText = '';
            }

            // Validate email
            if (email === '') {
                document.getElementById('email_err').innerText = 'Please enter your email address.';
                isError = true;
            } else if (!emailRegex.test(email)) {
                document.getElementById('email_err').innerText = 'Invalid email format.';
                isError = true;
            } else {
                document.getElementById('email_err').innerText = '';
            }

            // Validate password
            if (password === '') {
                document.getElementById('password_err').innerText = 'Please enter a password.';
                isError = true;
            } else if (password.length < 8) {
                document.getElementById('password_err').innerText = 'Password must be at least 8 characters long.';
                isError = true;
            } else {
                document.getElementById('password_err').innerText = '';
            }


            // Validate confirm password
            if (confirmPassword === '') {
                document.getElementById('confirm_password_err').innerText = 'Please confirm password.';
                isError = true;
            } else if (password !== confirmPassword) {
                document.getElementById('confirm_password_err').innerText = 'Password did not match.';
                isError = true;
            } else {
                document.getElementById('confirm_password_err').innerText = '';
            }

            // Return true if no errors, false otherwise
            return !isError;
        }
    </script>
    <!-- Validation End -->

</body>

</html>