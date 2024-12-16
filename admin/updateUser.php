<?php
include '../dbconnect.php';
session_start();
$uid = $_GET['uid'];	

if (isset($_POST['update'])) {
    // Sanitize and escape the input values
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check for unique email and username
    $email_check = mysqli_query($conn, "SELECT * FROM users WHERE email='$email' AND uid != '$uid'");
    $username_check = mysqli_query($conn, "SELECT * FROM users WHERE username='$username' AND uid != '$uid'");

    if (mysqli_num_rows($email_check) > 0) {
        $error = "Email already exists.";
    } elseif (mysqli_num_rows($username_check) > 0) {
        $error = "Username already exists.";
    } else {
        // Update user details
        if (!empty($password)) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $stmt = $conn->prepare("UPDATE users SET fname=?, lname=?, email=?, username=?, address=?, phone=?, password=? WHERE uid=?");
            $stmt->bind_param("sssssssi", $fname, $lname, $email, $username, $address, $phone, $hashed_password, $uid);
        } else {
            $stmt = $conn->prepare("UPDATE users SET fname=?, lname=?, email=?, username=?, address=?, phone=? WHERE uid=?");
            $stmt->bind_param("ssssssi", $fname, $lname, $email, $username, $address, $phone, $uid);
        }

        if ($stmt->execute()) {
            header('Location: manageUsr.php');
            exit();
        } else {
            $error = "Error updating user: " . $stmt->error;
        }
    }
}

// Select old user details
$q = mysqli_query($conn, "SELECT * FROM users WHERE uid='$uid'");
$res = mysqli_fetch_array($q);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UMRII | Update User</title>
    <link rel="shortcut icon" href="../assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/adminlte.min.css" />
    <link rel="icon" type="image/x-icon" href="../assets/images/webw.png" />

</head>

<body>
    <?php
    include '../includes/aside.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container d-flex justify-content-center font">
                <b>
                    <h1>Update User</h1>
                </b>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                    </div>
                </div>

                <div class="border border-secondary card-body font m-auto rounded-3 w-50">
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form method="POST">
                        <div class="form-group mb-3">
                            <b>First Name</b>
                            <input type="text" name="fname" value="<?php echo htmlspecialchars($res['fname']); ?>" class="mt-2 border-secondary form-control" required />
                        </div>

                        <div class="form-group mb-3">
                            <b>Last Name</b>
                            <input type="text" name="lname" value="<?php echo htmlspecialchars($res['lname']); ?>" class="mt-2 border-secondary form-control" required />
                        </div>

                        <div class="form-group mb-3">
                            <b>Email</b>
                            <input type="email" name="email" value="<?php echo htmlspecialchars($res['email']); ?>" class="mt-2 border-secondary form-control" required />
                        </div>

                        <div class="form-group mb-3">
                            <b>Username</b>
                            <input type="text" name="username" value="<?php echo htmlspecialchars($res['username']); ?>" class="mt-2 border-secondary form-control" required />
                        </div>

                        <div class="form-group mb-3">
                            <b>Address</b>
                            <textarea name="address" cols="10" rows="5" class="mt-2 border-secondary form-control" required><?php echo htmlspecialchars($res['address']); ?></textarea>
                        </div>

                        <div class="form-group mb-3">
                            <b>Contact</b>
                            <input type="text" name="phone" value="<?php echo htmlspecialchars($res['phone']); ?>" class="mt-2 border-secondary form-control" required />
                        </div>

                        <div class="form-group mb-3">
                            <b>Password (leave blank to keep current password)</b>
                            <input type="password" name="password" class="mt-2 border-secondary form-control" />
                        </div>

                        <div class="text-white form-group mt-4">
                            <input type="submit" value="Update" name="update" class="btn btn-primary" />
                            <input type="reset" class="btn btn-dark" />
                        </div>
                    </form>
                </div>
            </section>
        </section>
    </div>
    <?php
    require '../footer.php'; ?>
</body>

</html>
