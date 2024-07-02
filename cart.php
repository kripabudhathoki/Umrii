<!DOCTYPE html>
<html lang="en">
  <head>
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Amatic+SC:400,700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.9.1/font/bootstrap-icons.min.css" rel="stylesheet">
  </head>
  <?php
   include('navbar.php');
   ?>
    
    <!-- END nav -->
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
    filter: blur(1px); /* Adjust the blur intensity as needed */
    z-index: -1;
    padding: 5em 0;
    margin: 0 5%;
  }

  .hero-content {
    position: relative;
    z-index: 1;
  }
</style>

    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
      <div class="col-md-9 text-center">
        <h1 class="mb-0 bread">My Cart</h1>
      </div>
    </div>
  </div>
</div>

    <section class="ftco-section ftco-cart">
      <div class="container">
        <div class="row intro-text left-0 text-center bg-faded p-5 rounded">
          <div class="col-md-12">
            <div class="cart-list">
              <table class="table">
                <thead class="thead-primary">
                  <tr class="text-center">
                    <th>&nbsp;</th>
                    <th>&nbsp;</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr class="text-center">
                    <td class="product-remove"><a href="#"><span class="bi bi-x-circle"></span></a></td>
                    <td class="image-prod"><div class="img" style="background-image:url(images/product-3.jpg);"></div></td>
                    <td class="product-name">
                      <h3>Bell Pepper</h3>
                      <p>Far far away, behind the word mountains, far from the countries</p>
                    </td>
                    <td class="price">$4.90</td>
                    <td class="quantity">
                      <div class="input-group mb-3">
                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td class="total">$4.90</td>
                  </tr><!-- END TR-->
                  <tr class="text-center">
                    <td class="product-remove"><a href="#"><span class="bi bi-x-circle"></span></a></td>
                    <td class="image-prod"><div class="img" style="background-image:url(images/product-4.jpg);"></div></td>
                    <td class="product-name">
                      <h3>Bell Pepper</h3>
                      <p>Far far away, behind the word mountains, far from the countries</p>
                    </td>
                    <td class="price">$15.70</td>
                    <td class="quantity">
                      <div class="input-group mb-3">
                        <input type="text" name="quantity" class="quantity form-control input-number" value="1" min="1" max="100">
                      </div>
                    </td>
                    <td class="total">$15.70</td>
                  </tr><!-- END TR-->
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row justify-content-end">
          <div class="col-lg-4 mt-5 cart-wrap">
            <div class="cart-total mb-3">
              <h3>Coupon Code</h3>
              <p>Enter your coupon code if you have one</p>
              <form action="#" class="info">
                <div class="form-group">
                  <label for="">Coupon code</label>
                  <input type="text" class="form-control text-left px-3" placeholder="">
                </div>
              </form>
            </div>
            <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Apply Coupon</a></p>
          </div>
          <div class="col-lg-4 mt-5 cart-wrap">
            <div class="cart-total mb-3">
              <h3>Estimate shipping and tax</h3>
              <p>Enter your destination to get a shipping estimate</p>
              <form action="#" class="info">
                <div class="form-group">
                  <label for="">Country</label>
                  <input type="text" class="form-control text-left px-3" placeholder="">
                </div>
                <div class="form-group">
                  <label for="country">State/Province</label>
                  <input type="text" class="form-control text-left px-3" placeholder="">
                </div>
                <div class="form-group">
                  <label for="country">Zip/Postal Code</label>
                  <input type="text" class="form-control text-left px-3" placeholder="">
                </div>
              </form>
            </div>
            <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Estimate</a></p>
          </div>
          <div class="col-lg-4 mt-5 cart-wrap">
            <div class="cart-total mb-3">
              <h3>Cart Total</h3>
              <p class="d-flex">
                <span>Subtotal</span>
                <span>$20.60</span>
              </p>
              <p class="d-flex">
                <span>Delivery</span>
                <span>$0.00</span>
              </p>
              <p class="d-flex">
                <span>Discount</span>
                <span>$3.00</span>
              </p>
              <hr>
              <p class="d-flex total-price">
                <span>Total</span>
                <span>$17.60</span>
              </p>
            </div>
            <p><a href="checkout.html" class="btn btn-primary py-3 px-4">Proceed to Checkout</a></p>
          </div>
        </div>
      </div>
    </section>
    
    <!-- Footer -->
    <?php
   include('footer.php');
   ?>
    
    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  </body>
</html>
