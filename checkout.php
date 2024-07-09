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
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/open-iconic/1.1.1/font/css/open-iconic-bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php
   include('navbar.php');
?>
<style>
  .hero-wrap {
    position: relative;
    overflow: hidden;
  }

  .hero-wrap::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('assets/img/background1.jpg');
    background-size: cover;
    background-position: center;
    filter: blur(1px);
    z-index: -1;
    padding: 5em 0;
    margin: 0 5%;
  }

  .hero-content {
    position: relative;
    z-index: 1;
  }

  .billing-form {
    background:  #BB676B;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
  }

  .billing-heading {
    text-align: center;
    margin-bottom: 30px;
    font-size: 24px;
    font-weight: bold;
  }

  .form-control {
    border-radius: 0;
    box-shadow: none;
    border: 1px solid #ced4da;
  }

  .cart-detail {
    background: rgba(255, 255, 255, 0.8);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
    margin-top: 30px;
    text-align: center;
  }

  .cart-detail h3 {
    margin-bottom: 20px;
    font-size: 24px;
    font-weight: bold;
  }

  .payment-method-buttons {
    display: flex;
    justify-content: center;
  }

  .payment-method-buttons .btn {
    margin: 0 10px;
  }
</style>

<div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
      <div class="col-md-9 text-center">
        <h1 class="mb-0 bread">Checkout</h1>
      </div>
    </div>
  </div>
</div>

<section class="ftco-section">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-10">
        <form action="#" class="billing-form">
          <h3 class="billing-heading">Billing Details</h3>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="firstname">First Name*</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="lastname">Last Name</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="address">Address*</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="postcodezip">Landline</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="phone">Phone *</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <label for="emailaddress">Email Address *</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
    <div class="row justify-content-center">
      <div class="col-xl-7 col-lg-8 col-md-10">
        <div class="cart-detail p-3 p-md-4">
          <h3>Payment Method</h3>
          <div class="payment-method-buttons">
            <a href="#" class="btn btn-primary py-3 px-4">Cash on Delivery</a>
            <a href="#" class="btn btn-primary py-3 px-4">Online Payment</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php
   include('footer.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
