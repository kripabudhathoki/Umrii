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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    
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
<!-- 
<div class="hero-wrap">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
      <div class="col-md-9 text-center">
        <h1 class="mb-0 bread">product-details</h1>
      </div>
    </div>
  </div>
</div> -->

    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
  <div class="container">
    <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
      <div class="col-md-9 text-center">
        <h1 class="mb-0 bread">Product Details</h1>
      </div>
    </div>
  </div>
</div>

    <section class="ftco-section">
        <div class="row intro-text left-0 text-center bg-faded p-5 rounded">
          <div class="col-lg-6 mb-5 ftco-animate">
            <a href="assets/img/strawberry.jpg" class="image-popup"><img src="assets/img/strawberry.jpg" class="img-fluid" alt="Colorlib Template"></a>
          </div>
          <div class="col-lg-6 product-details pl-md-5 ftco-animate" style="top: 50px;">
            <h3>Strawberry Crush</h3>
            <p class="price" style="font-size: x-large;"><span>Rs. 220</span></p>
            <p>Savor the refreshing taste of our Strawberry Crush. Made with luscious strawberry puree, zesty fresh lime, and a hint of aromatic mint, this delightful drink offers a perfect balance of sweetness and tang. Enjoy a revitalizing burst of flavor in every sip, perfect for any occasion.
            </p>
            <div class="row mt-4">
              <div class="col-md-6">
                <div class="form-group d-flex">
                  <div class="select-wrap">
                    <select name="" id="" class="form-control">
                      <option value="">Small</option>
                      <option value="">Medium</option>
                      <option value="">Large</option>
                      <option value="">Extra Large</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="input-group col-md-6 d-flex mb-3">
                <span class="input-group-btn mr-2">
                  <button type="button" class="quantity-left-minus btn btn-outline-secondary" data-type="minus" data-field="">
                    <span class="bi bi-dash"></span>
                  </button>
                </span>
                <input type="text" id="quantity" name="quantity" class="form-control input-number" value="1" min="1" max="100">
                <span class="input-group-btn ml-2">
                  <button type="button" class="quantity-right-plus btn btn-outline-secondary" data-type="plus" data-field="">
                    <span class="bi bi-plus"></span>
                  </button>
                </span>
              </div>
            </div>
            <p><a href="cart.html" class="btn btn-primary py-3 px-5">Add to Cart</a></p>
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <span class="subheading">Products</span>
            <h2 class="mb-4">Related Products</h2>
            <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
          </div>
        </div>    		
      </div>
      <div class="container">
        <div class="row">
          <div class="col-md-6 col-lg-3 ftco-animate">
            <div class="product">
              <a href="#" class="img-prod"><img class="img-fluid" src="images/product-1.jpg" alt="Colorlib Template">
                <span class="status">30%</span>
                <div class="overlay"></div>
              </a>
              <div class="text py-3 pb-4 px-3 text-center">
                <h3><a href="#">Bell Pepper</a></h3>
                <div class="d-flex">
                  <div class="pricing">
                    <p class="price"><span class="mr-2 price-dc">$120.00</span><span class="price-sale">$80.00</span></p>
                  </div>
                </div>
                <div class="bottom-area d-flex px-3">
                  <div class="m-auto d-flex">
                    <a href="#" class="add-to-cart d-flex justify-content-center align-items-center text-center">
                      <span><i class="bi bi-cart-plus"></i></span>
                    </a>
                    <a href="#" class="buy-now d-flex justify-content-center align-items-center mx-1">
                      <span><i class="bi bi-bag-fill"></i></span>
                    </a>
                    <a href="#" class="heart d-flex justify-content-center align-items-center ">
                      <span><i class="bi bi-heart"></i></span>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Repeat product structure for more products -->
        </div>
      </div>
    </section>
   <?php 
   include('footer.php');
   ?>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
		$(document).ready(function(){

		var quantitiy=0;
		   $('.quantity-right-plus').click(function(e){
		        
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		            
		            $('#quantity').val(quantity + 1);

		          
		            // Increment
		        
		    });

		     $('.quantity-left-minus').click(function(e){
		        // Stop acting like a button
		        e.preventDefault();
		        // Get the field name
		        var quantity = parseInt($('#quantity').val());
		        
		        // If is not undefined
		      
		            // Increment
		            if(quantity>0){
		            $('#quantity').val(quantity - 1);
		            }
		    });
		    
		});
	</script>
  </body>
</html>
