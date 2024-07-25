<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
// $email = $is_logged_in ? $_SESSION['email'] : '';
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
    <?php
    include('navbar.php')?>
<div class="profile" style="margin-top: 5%; margin-bottom: 5%;">
  <div class="profile-bg"></div>
  <div class="container-profile">
    <div class="profile-image">
      <i class="fas fa-camera camera"></i>
    </div>
    <div class="profile-info">
      <h1 class="first-name">John</h1>
      <h1 class="second-name">Doe</h1>
      <h2>User Profile</h2>
      <div class="user-details">
        <p>Email: <span id="email">john.doe@example.com</span></p>
        <p>First Name: <span id="first-name">John</span></p>
        <p>Last Name: <span id="last-name">Doe</span></p>
        <p>Phone Number: <span id="phone-number">123-456-7890</span></p>
        <p>Address: <span id="address">1234 Main St, Anytown, USA</span></p>
      </div>
      <button class="edit-button">Edit Profile</button>
    </div>
  </div>
</div>

<div class="edit-profile-overlay">
  <div class="edit-profile-form">
    <h2>Edit Profile</h2>
    <label for="edit-email">Email</label>
    <input type="email" id="edit-email" value="john.doe@example.com">
    <label for="edit-first-name">First Name</label>
    <input type="text" id="edit-first-name" value="John">
    <label for="edit-last-name">Last Name</label>
    <input type="text" id="edit-last-name" value="Doe">
    <label for="edit-phone-number">Phone Number</label>
    <input type="text" id="edit-phone-number" value="123-456-7890">
    <label for="edit-address">Address</label>
    <input type="text" id="edit-address" value="1234 Main St, Anytown, USA">
    <button class="save-button">Save</button>
    <button class="cancel-button">Cancel</button>
  </div>
</div>

<?php
include('footer.php')
?>
<script>
  document.querySelector('.edit-button').addEventListener('click', function() {
    document.querySelector('.edit-profile-overlay').style.display = 'flex';
  });

  document.querySelector('.cancel-button').addEventListener('click', function() {
    document.querySelector('.edit-profile-overlay').style.display = 'none';
  });

  document.querySelector('.save-button').addEventListener('click', function() {
    // Get values from input fields
    const email = document.getElementById('edit-email').value;
    const firstName = document.getElementById('edit-first-name').value;
    const lastName = document.getElementById('edit-last-name').value;
    const phoneNumber = document.getElementById('edit-phone-number').value;
    const address = document.getElementById('edit-address').value;

    // Update profile details
    document.getElementById('email').textContent = email;
    document.getElementById('first-name').textContent = firstName;
    document.getElementById('last-name').textContent = lastName;
    document.getElementById('phone-number').textContent = phoneNumber;
    document.getElementById('address').textContent = address;

    // Hide the edit form
    document.querySelector('.edit-profile-overlay').style.display = 'none';
  });
</script>
</body>
</html>
