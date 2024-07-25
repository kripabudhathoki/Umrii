<?php
include '../dbconnect.php';
session_start();
extract($_POST);

if (isset($login)) {
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $que = mysqli_query($conn, "SELECT * FROM admin WHERE username ='$user' AND password ='$pass'");
    $row = mysqli_num_rows($que);
    if ($row) {
        $_SESSION['admin'] = $user;
        echo "<script>alert('Admin Login Successful');window.location.href='./dashboard.php';</script>";
    } else {
        $err = "<center><font style='Loco' color='red'>Invalid Username and Password!!</font></center>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>UMRII | Admin Login</title>
    <link rel="shortcut icon" href="../assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII | Log In</title>
</head>


<body>
    <!-- <?php
        if ($login) {
            echo "Logged in Successfully";
        }
     ?> -->
    <div class="container" style="flex-direction: column">
        <h3><a href="#" class="nav-link text-white">
                <span class="hov" style="color: black; display: flex;justify-content:center;">Admin Login</span>
            </a></h3>
        <img src="../assets/img/logoB.png" style="width: 30%; display: flex;justify-content:center;">
        <!-- <h1 class="text-center" style="    top: 1rem; position:relative;">Welcome to</h1> -->
        <form action="index.php" method="POST">
            <form method="POST" class="mt-2">
                <fieldset>
                    <div class="form-group">
                        <label for="username" class="mb-2"><b>Username</label>
                        <span class="text-danger">*</span></b> <input class="form-control mb-2 border-secondary" name="user"
                            type="text" required placeholder="Username">
                    </div>
            
                    <div class="form-group">
                        <label for="password" class="mt-3">
                            <b>Password: <span class="text-danger">*</span></b>
                        </label>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control border-secondary mb-2" name="pass" id="password"
                                placeholder="Password" onfocus="toggleVisibility()" aria-label=" Recipient's username"
                                aria-describedby="button-addon2">
                        </div>
                    </div>
                    <div class="form-group d-flex form-group justify-content-center mb-1">
                        <input name="login" type="submit" value="Login"
                            class="d-flex justify-content-between btn btn-dark text-white btn-block">
                    </div>
                    <?php echo @$err; ?>
                </fieldset>
            </form>

        </form>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>



    <div style="position: relative; top: 6rem;">
        <?php include "../footer.php"?>
    </div>
</body>

</html>
