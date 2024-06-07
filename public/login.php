<?php
// Include the database connection file
include './includes/config.php';

// Check if the user is already logged in, redirect to dashboard if so
if (isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

// Define variables and initialize with empty values
$username = $password = "";
$error = "";

// Processing form data when form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate username and password
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Prepare a select statement
    $sql = "SELECT id, username, password, profile_picture, status FROM users WHERE username = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_username);

        // Set parameters
        $param_username = $username;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Store result
            $stmt->store_result();

            // Check if username exists, if yes then verify password
            if ($stmt->num_rows == 1) {
                // Bind result variables
                $stmt->bind_result($id, $username, $hashed_password, $profile_picture, $status);
                if ($stmt->fetch()) {
                    if (password_verify($password, $hashed_password)) {
                        if ($status == 1) {
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION['user_id'] = $id;
                            $_SESSION['username'] = $username;
                            $_SESSION['profile_picture'] = $profile_picture;

                            // Redirect user to dashboard page
                            header("Location: home.php");
                            exit();
                        } else {
                            $error = "You have been banned, contact admin";
                        }
                    } else {
                        // Display an error message if password is not valid
                        $error = "Invalid password";
                    }
                }
            } else {
                // Display an error message if username doesn't exist
                $error = "Username not found";
            }
        } else {
            $error = "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
}
?>

<!-- HTML login form -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                <div class="flex items-center justify-center">
                    <h1 class="mt-10 logo">Fit.eats</h1>
                </div>
            </div>
        </a>
    </div>
    <!-- Top End -->

    <!-- Login Start -->
    <div class="flex w-full justify-center items-center py-[40px]">
        <div class="flex w-9/12 border-2 border-black rounded-[40px]">
            <div class="flex flex-col items-center px-[5%] w-1/2 rightside rounded-tl-[40px] rounded-bl-[40px] gap-[24px] py-[25px]">
                <h1 class="text-[48px]/[120%] font-bold text-white">Log In</h1>
                <form class="flex flex-col w-full gap-[24px]" action="" method="post">
                    <?php if (!empty($error)) : ?>
                        <p class="text-red-500"><?php echo $error; ?></p>
                    <?php endif; ?>
                    <div class="flex flex-col gap-2">
                        <p class="logintext">Username:</p>
                        <input placeholder="Enter your username" class="p-2 rounded-md" type="text" name="username" value="<?php echo htmlspecialchars($username); ?>">
                    </div>
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-row">
                            <div class="flex justify-start w-1/2">
                                <p class="logintext">Password:</p>
                            </div>
                        </div>
                        <input placeholder="Enter your password" class="p-2 rounded-md" type="password" name="password">
                    </div>
                    <button class="text-center loginbtn btn" type="submit">Log in</button>
                </form>
                <div class="flex flex-row justify-between w-full">
                    <div class="flex items-center">
                        <p class="cursor-pointer logintext hover:underline">Don't have an account?</p>
                    </div>
                    <a href="register.php" class="logintext"><button class="auxiliary-btn btn">Create New</button></a>
                </div>
            </div>
            <div class="flex flex-col w-1/2 bg-white rounded-tr-[40px] rounded-br-[40px] justify-center items-center gap-10">
                <div class="dividers flex flex-col gap-[7px] w-9/12 mx-auto">
                    <div class="h-[4px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[5px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[6px] rounded-lg bg-[#6A994E]"></div>
                    <div class="h-[7px] rounded-lg bg-[#6A994E]"></div>
                </div>
                <h1 class="text-[48px]/[120%] font-bold text-primary text-center">Eat Healthy, <br> Be Healthy!</h1>
            </div>
        </div>
    </div>
    <!-- Login End -->

</body>

</html>