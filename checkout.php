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
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
      .hero-wrap { position: relative; overflow: hidden; }
      .hero-wrap::before { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: url('assets/img/background1.jpg'); background-size: cover; background-position: center; filter: blur(1px); z-index: -1; padding: 5em 0; margin: 0 5%; }
      .billing-form { background: #BB676B; padding: 30px; border-radius: 10px; box-shadow: 0 0 15px rgba(0, 0, 0, 0.1); margin-top: 20px; }
      .cart-detail { background: rgba(255, 255, 255, 0.8); padding: 20px; border-radius: 10px; margin-top: 30px; text-align: center; }
      #suggestions { display: none; border: 1px solid #ced4da; max-height: 150px; overflow-y: auto; background-color: #fff; position: absolute; width: 100%; z-index: 1000; }
      .suggestion-item { padding: 10px; cursor: pointer; }
      .suggestion-item:hover { background-color: #f1f1f1; }
    </style>
</head>
<body>
<?php include('navbar.php'); ?>

<div class="myorders" style="min-height: 100vh;">
  <div class="hero-wrap">
    <div class="container">
      <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
        <div class="col-md-9 text-center">
          <h1 class="mb-0 bread"><b>Checkout</b></h1>
        </div>
      </div>
    </div>
  </div>

  <section class="ftco-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-xl-7 col-lg-8 col-md-10">
          <form id="billing-form" class="bg-white p-5 contact-form" method="POST" action="process_payment.php" style="margin-top: 5%;">
            <h3 class="billing-heading">Billing Details</h3>
            <div class="row block-9">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="firstname">First Name*</label>
                  <input type="text" name="first_name" id="firstname" class="form-control" required>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="lastname">Last Name</label>
                  <input type="text" name="last_name" id="lastname" class="form-control">
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="address">Address*</label>
                  <input type="text" name="address" id="address" class="form-control" placeholder="Type to search location" required>
                  <div id="suggestions"></div>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="phone">Phone*</label>
                  <input type="text" name="phone" id="phone" class="form-control" required>
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="email">Email Address*</label>
                  <input type="email" name="email" id="email" class="form-control" required>
                </div>
              </div>
            </div>

            <div class="cart-detail col-md-12" style = "height: 100px;">
              <h6>Delivery Charge</h6>
              <p id="deliveryCost">Delivery Price: Calculating...</p>
            </div>

            <div class="cart-detail p-0 p-md-4">
              <h3>Payment Method</h3>
              <div class="payment-method-buttons">
                <input type="hidden" name="payment_method" id="payment-method" value="">
                <button type="submit" id="cash-on-delivery" class="btn btn-primary py-3 px-4" data-method="cod">Cash on Delivery</button>
                <button type="submit" id="pay-with-khalti" class="btn btn-primary py-3 px-3" data-method="khalti"><img src="assets/img/khaltilogo.svg" style="height: 35px;"></button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </section>
</div>

<?php include('footer.php'); ?>

<!-- jQuery and other scripts -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<script src="public/scripts.js"></script>
</body>
</html>
