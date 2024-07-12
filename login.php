<?php
include "dbconnect.php";
session_start();

$signup_success = false;
$login_success = false;
$signup_error = [];
$login_error = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['signup'])) {
        $fname = mysqli_real_escape_string($conn, $_POST['signup-firstname']);
        $lname = mysqli_real_escape_string($conn, $_POST['signup-lastname']);
        $email = mysqli_real_escape_string($conn, $_POST['signup-email']);
        $phone = mysqli_real_escape_string($conn, $_POST['signup-phone']);
        $password = mysqli_real_escape_string($conn, $_POST['signup-pass']);
        $address = mysqli_real_escape_string($conn, $_POST['signup-address']);
        $username = mysqli_real_escape_string($conn, $_POST['signup-username']);

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $signup_error['email'] = "Invalid email format";
        }

        // Validate phone number
        if (!preg_match("/^[0-9]{10}$/", $phone)) {
            $signup_error['phone'] = "Invalid phone number";
        }

        // Validate password length
        if (strlen($password) < 8) {
            $signup_error['password'] = "Password must be at least 8 characters long";
        }

        // Check if username or email already exists
        if (empty($signup_error)) {
            $check_query = "SELECT * FROM users WHERE username=? OR email=? LIMIT 1";
            $stmt = $conn->prepare($check_query);
            $stmt->bind_param("ss", $username, $email);
            $stmt->execute();
            $result = $stmt->get_result();
            $user = $result->fetch_assoc();

            if ($user) {
                if ($user['username'] === $username) {
                    $signup_error['username'] = "Username already exists";
                }

                if ($user['email'] === $email) {
                    $signup_error['email'] = "Email already exists";
                }
            } else {
                // Hash the password for security
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                // Insert user data into the database
                $sql = "INSERT INTO users (fname, lname, email, phone, password, address, username) VALUES (?, ?, ?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("sssssss", $fname, $lname, $email, $phone, $hashed_password, $address, $username);

                if ($stmt->execute()) {
                    $signup_success = true;
                } else {
                    $signup_error['database'] = "Error: " . $stmt->error;
                }
            }
        }
    }

    if (isset($_POST['login'])) {
        $username = mysqli_real_escape_string($conn, $_POST['login-username']);
        $password = mysqli_real_escape_string($conn, $_POST['login-password']);

        $query = "SELECT * FROM users WHERE username=? LIMIT 1";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['uid'] = $user['uid'];
            $_SESSION['loggedin'] = true;
            header('Location: index.php');
            exit();
        } else {
            $login_error = "Invalid username or password";
        }
    }
}

if ($signup_success) {
    echo '<script>
            alert("Signup successful");
            window.location.href = "index.php";
          </script>';
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="css/login.css" rel="stylesheet" />
    <style>
        .name-group {
            display: flex;
            justify-content: space-between;
        }
        .name-group .input {
            width: 48%;
        }
        .error {
            color: red;
            font-size: 0.875em;
            margin-top: 3px;
        }
    </style>
</head>
<body>
    <a href="index.php" class="navbar-brand">
        <h1 class="display-6" style="text-align: center;">
            <img src="assets/img/logoW.png" class="main-logo" alt="Umrii Logo" />
        </h1>
    </a>
    <div class="row">
        <div class="col-md-6 mx-auto p-0">
            <div class="card">
                <div class="login-box">
                    <div class="login-snip">
                        <input id="tab-1" type="radio" name="tab" class="sign-in" checked>
                        <label for="tab-1" class="tab">Log In</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">
                                <form id="login-form" action="" method="POST" onsubmit="return validateLogin()">
                                    <div class="group">
                                        <label for="login-user" class="label">Username</label>
                                        <input id="login-user" type="text" name="login-username" class="input" placeholder="Enter your username">
                                        <?php if ($login_error): ?>
                                            <div id="login-user-error" class="error"><?php echo $login_error; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="group">
                                        <label for="login-pass" class="label">Password</label>
                                        <input id="login-pass" type="password" name="login-password" class="input" placeholder="Enter your password">
                                        <div id="login-pass-error" class="error"></div>
                                    </div>
                                    <div class="group">
                                        <input type="submit" name="login" class="button" value="Log In">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot">
                                        <a href="#">Forgot Password?</a>
                                    </div>
                                </form>
                            </div>
                            <div class="sign-up-form">
                                <form id="signup-form" action="" method="POST" onsubmit="return validateSignUp()">
                                    <div class="name-group group">
                                        <div>
                                            <label for="signup-firstname" class="label">First Name</label>
                                            <input id="signup-firstname" type="text" name="signup-firstname" class="input" placeholder="Enter your first name">
                                            <?php if (isset($signup_error['fname'])): ?>
                                                <div id="signup-firstname-error" class="error"><?php echo $signup_error['fname']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <label for="signup-lastname" class="label">Last Name</label>
                                            <input id="signup-lastname" type="text" name="signup-lastname" class="input" placeholder="Enter your last name">
                                            <?php if (isset($signup_error['lname'])): ?>
                                                <div id="signup-lastname-error" class="error"><?php echo $signup_error['lname']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <label for="signup-username" class="label">Username</label>
                                        <input id="signup-username" type="text" name="signup-username" class="input" placeholder="Create a username">
                                        <?php if (isset($signup_error['username'])): ?>
                                            <div id="signup-username-error" class="error"><?php echo $signup_error['username']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="group">
                                        <label for="signup-pass" class="label">Password</label>
                                        <input id="signup-pass" type="password" name="signup-pass" class="input" placeholder="Create your password">
                                        <?php if (isset($signup_error['password'])): ?>
                                            <div id="signup-pass-error" class="error"><?php echo $signup_error['password']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="group">
                                        <label for="signup-repeat-pass" class="label">Repeat Password</label>
                                        <input id="signup-repeat-pass" type="password" name="signup-repeat-pass" class="input" placeholder="Repeat your password">
                                        <?php if (isset($signup_error['repeat_password'])): ?>
                                            <div id="signup-repeat-pass-error" class="error"><?php echo $signup_error['repeat_password']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="group">
                                        <label for="signup-email" class="label">Email Address</label>
                                        <input id="signup-email" type="text" name="signup-email" class="input" placeholder="Enter your email address">
                                        <?php if (isset($signup_error['email'])): ?>
                                            <div id="signup-email-error" class="error"><?php echo $signup_error['email']; ?></div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="name-group group">
                                        <div>
                                            <label for="signup-address" class="label">Address</label>
                                            <input id="signup-address" type="text" name="signup-address" class="input" placeholder="Enter your address">
                                            <?php if (isset($signup_error['address'])): ?>
                                                <div id="signup-address-error" class="error"><?php echo $signup_error['address']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <label for="signup-phone" class="label">Phone Number</label>
                                            <input id="signup-phone" type="number" name="signup-phone" class="input" placeholder="Enter your phone number">
                                            <?php if (isset($signup_error['phone'])): ?>
                                                <div id="signup-phone-error" class="error"><?php echo $signup_error['phone']; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="group">
                                        <input type="submit" name="signup" class="button" value="Sign Up">
                                    </div>
                                    <div class="hr"></div>
                                    <div class="foot">
                                        <label for="tab-1">Already Member?</label>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function validateLogin() {
            let isValid = true;
            const username = document.getElementById('login-user');
            const password = document.getElementById('login-pass');

            if (username.value.trim() === '') {
                document.getElementById('login-user-error').textContent = 'Username is required';
                isValid = false;
            } else {
                document.getElementById('login-user-error').textContent = '';
            }

            if (password.value.trim() === '') {
                document.getElementById('login-pass-error').textContent = 'Password is required';
                isValid = false;
            } else {
                document.getElementById('login-pass-error').textContent = '';
            }

            return isValid;
        }

        function validateSignUp() {
            let isValid = true;
            const firstName = document.getElementById('signup-firstname');
            const lastName = document.getElementById('signup-lastname');
            const username = document.getElementById('signup-username');
            const password = document.getElementById('signup-pass');
            const repeatPassword = document.getElementById('signup-repeat-pass');
            const email = document.getElementById('signup-email');
            const address = document.getElementById('signup-address');
            const phone = document.getElementById('signup-phone');

            if (firstName.value.trim() === '') {
                document.getElementById('signup-firstname-error').textContent = 'First Name is required';
                isValid = false;
            } else {
                document.getElementById('signup-firstname-error').textContent = '';
            }

            if (lastName.value.trim() === '') {
                document.getElementById('signup-lastname-error').textContent = 'Last Name is required';
                isValid = false;
            } else {
                document.getElementById('signup-lastname-error').textContent = '';
            }

            if (username.value.trim() === '') {
                document.getElementById('signup-username-error').textContent = 'Username is required';
                isValid = false;
            } else {
                document.getElementById('signup-username-error').textContent = '';
            }

            if (password.value.trim() === '') {
                document.getElementById('signup-pass-error').textContent = 'Password is required';
                isValid = false;
            } else {
                document.getElementById('signup-pass-error').textContent = '';
            }

            if (repeatPassword.value.trim() === '') {
                document.getElementById('signup-repeat-pass-error').textContent = 'Repeat Password is required';
                isValid = false;
            } else if (repeatPassword.value.trim() !== password.value.trim()) {
                document.getElementById('signup-repeat-pass-error').textContent = 'Passwords do not match';
                isValid = false;
            } else {
                document.getElementById('signup-repeat-pass-error').textContent = '';
            }

            if (email.value.trim() === '') {
                document.getElementById('signup-email-error').textContent = 'Email is required';
                isValid = false;
            } else if (!validateEmail(email.value.trim())) {
                document.getElementById('signup-email-error').textContent = 'Invalid email format';
                isValid = false;
            } else {
                document.getElementById('signup-email-error').textContent = '';
            }

            if (address.value.trim() === '') {
                document.getElementById('signup-address-error').textContent = 'Address is required';
                isValid = false;
            } else {
                document.getElementById('signup-address-error').textContent = '';
            }

            if (phone.value.trim() === '') {
                document.getElementById('signup-phone-error').textContent = 'Phone number is required';
                isValid = false;
            } else if (!validatePhone(phone.value.trim())) {
                document.getElementById('signup-phone-error').textContent = 'Invalid phone number';
                isValid = false;
            } else {
                document.getElementById('signup-phone-error').textContent = '';
            }

            return isValid;
        }

        function validateEmail(email) {
            const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(String(email).toLowerCase());
        }

        function validatePhone(phone) {
            const re = /^[0-9]{10}$/;
            return re.test(String(phone));
        }
    </script>
</body>
</html>

