<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Umrii</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="css/login.css" rel="stylesheet" />
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
                        <label for="tab-1" class="tab">Login</label>
                        <input id="tab-2" type="radio" name="tab" class="sign-up">
                        <label for="tab-2" class="tab">Sign Up</label>
                        <div class="login-space">
                            <div class="login">
                                <div class="group">
                                    <label for="login-user" class="label">Username</label>
                                    <input id="login-user" type="text" class="input" placeholder="Enter your username">
                                </div>
                                <div class="group">
                                    <label for="login-pass" class="label">Password</label>
                                    <input id="login-pass" type="password" class="input" placeholder="Enter your password">
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" value="Sign In">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <a href="#">Forgot Password?</a>
                                </div>
                            </div>
                            <div class="sign-up-form">
                                <div class="group">
                                    <label for="signup-user" class="label">Username</label>
                                    <input id="signup-user" type="text" class="input" placeholder="Create your Username">
                                </div>
                                <div class="group">
                                    <label for="signup-pass" class="label">Password</label>
                                    <input id="signup-pass" type="password" class="input" placeholder="Create your password">
                                </div>
                                <div class="group">
                                    <label for="signup-repeat-pass" class="label">Repeat Password</label>
                                    <input id="signup-repeat-pass" type="password" class="input" placeholder="Repeat your password">
                                </div>
                                <div class="group">
                                    <label for="signup-email" class="label">Email Address</label>
                                    <input id="signup-email" type="text" class="input" placeholder="Enter your email address">
                                </div>
                                <div class="group">
                                    <input type="submit" class="button" value="Sign Up">
                                </div>
                                <div class="hr"></div>
                                <div class="foot">
                                    <label for="tab-1">Already Member?</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
