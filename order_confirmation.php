<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Order Confirmation - UMRII</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .confirmation-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8f9fa;
        }
        .confirmation-card {
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            background-color: #ffffff;
            text-align: center;
        }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>
<div class="confirmation-container">
    <div class="confirmation-card">
        <h1>Thank you for your order!</h1>
        <p>Your order has been placed successfully. A confirmation email has been sent to your email address.</p>
        <a href="index.php" class="btn btn-primary">Go to Home</a>
    </div>
</div>
<?php include('footer.php'); ?>
</body>
</html>
