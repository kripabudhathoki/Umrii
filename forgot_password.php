<?php require_once "controllerUserData.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <br>
<a href="forgot_password.php" class="navbar-brand" style="justify-content: center;display: flex;">
            <h1 class="display-6"><img src="assets/img/logoW.png" class="main-logo" /></h1>
        </a>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
            <div class="bg-white p-5 contact-form">
                <form action="forgot_password.php" method="POST" autocomplete="">
                    <h2 class="text-center">Forgot Password</h2>
                    <p class="text-center">Enter your email address</p>
                    <?php
                        if(count($errors) > 0){
                            ?>
                            <div class="alert alert-danger text-center">
                                <?php 
                                    foreach($errors as $error){
                                        echo $error;
                                    }
                                ?>
                            </div>
                            <?php
                        }
                    ?>
                    <div class="form-group">
                        <input class="form-control" type="email" name="email" placeholder="Enter email address" required value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <input class="form-control button" type="submit" name="check-email" value="Continue"  style = "background-color:#e6a756;">
                    </div>
                </form>
            </div>
        </div>
    </div>
                    </div>
</body>
</html>