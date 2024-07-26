<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    // Redirect to login page if not logged in
    header('Location: login.php');
    exit;
}

// Retrieve user details from the session
$username = $_SESSION['username'];
$email = $_SESSION['email'];
$firstName = $_SESSION['fname'];
$lastName = $_SESSION['lname'];
$phoneNumber = $_SESSION['phone'];
$address = $_SESSION['address'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>UMRII</title>
    <link rel="stylesheet" href="css/products.css" type="text/css">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png">
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- Core theme CSS (includes Bootstrap) -->
    <link href="css/myprofile.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
</head>
<body>
    <?php include('navbar.php'); ?>

    <div class="profile" style="margin-top: 5%; margin-bottom: 5%;">
        <div class="profile-bg"></div>
        <div class="container-profile">
            <div class="profile-image">
            <img class="intro-img img-fluid mb-3 mb-lg-0 rounded d-flex justify-content-center" src="assets/img/logoW.png" alt="..." style="margin-top: 50%;"/>
                <i class="fas fa-camera camera"></i>
            </div>
            <div class="profile-info text-uppercase">
                <h1 class="first-name"><?php echo htmlspecialchars($firstName); ?></h1>
                <h1 class="second-name"><?php echo htmlspecialchars($lastName); ?></h1>
                <h2>User Profile</h2>
                <div class="user-details">
                    <p>Email: <span id="email"><?php echo htmlspecialchars($email); ?></span></p>
                    <p>First Name: <span id="first-name"><?php echo htmlspecialchars($firstName); ?></span></p>
                    <p>Last Name: <span id="last-name"><?php echo htmlspecialchars($lastName); ?></span></p>
                    <p>Phone Number: <span id="phone-number"><?php echo htmlspecialchars($phoneNumber); ?></span></p>
                    <p>Address: <span id="address"><?php echo htmlspecialchars($address); ?></span></p>
                    <p>username <span id="username"><?php echo htmlspecialchars($username); ?></span></p>
                  </div>
                <button class="edit-button">Edit Profile</button>
            </div>
        </div>
    </div>

    <div class="edit-profile-overlay">
        <form class="edit-profile-form" action="update_profile.php" method="POST">
            <h2>Edit Profile</h2>
            <label for="edit-email">Email</label>
            <input type="email" id="edit-email" name="email" value="<?php echo htmlspecialchars($email); ?>">
            <label for="edit-first-name">First Name</label>
            <input type="text" id="edit-first-name" name="first_name" value="<?php echo htmlspecialchars($firstName); ?>">
            <label for="edit-last-name">Last Name</label>
            <input type="text" id="edit-last-name" name="last_name" value="<?php echo htmlspecialchars($lastName); ?>">
            <label for="edit-phone-number">Phone Number</label>
            <input type="text" id="edit-phone-number" name="phone_number" value="<?php echo htmlspecialchars($phoneNumber); ?>">
            <label for="edit-address">Address</label>
            <input type="text" id="edit-address" name="address" value="<?php echo htmlspecialchars($address); ?>">
            <label for="edit-address">Username</label>
            <input type="text" id="edit-username" name="username" value="<?php echo htmlspecialchars($username); ?>">
            <button type="submit" class="save-button">Save</button>
            <button type="button" class="cancel-button">Cancel</button>
        </form>
    </div>

    <?php include('footer.php'); ?>
    <script>
        document.querySelector('.edit-button').addEventListener('click', function() {
            document.querySelector('.edit-profile-overlay').style.display = 'flex';
        });

        document.querySelector('.cancel-button').addEventListener('click', function() {
            document.querySelector('.edit-profile-overlay').style.display = 'none';
        });
    </script>
</body>
</html>
