<?php
session_start();

// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';
// $email = $is_logged_in ? $_SESSION['email'] : '';
?>
<style>
    #section-counter {
    position: relative;
    z-index: 0;
    }
    .ftco-counter {
    padding: 5em 0;
}
.hero-wrap, .img, .blog-img, .user-img {
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
}
#section-counter:after {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    content: '';
    opacity: .5;
    z-index: -1;
    background: white;
   
}
    </style>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>UMRII</title>
        <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
    <?php
    include('navbar.php');
    ?>
        <section class="page-section about-heading" style="color: white;">
            <div class="container">
                <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="assets/img/aboutus.jpg" alt="..." />
                <div class="about-heading-content">
                    <div class="row">
                        <div class="col-xl-9 col-lg-10 mx-auto">
                            <div class="bg-faded rounded p-5">
                                <h2 class="section-heading mb-4">
                                    <span class="section-heading-lower"><b>About Umrii</b></span>
                                </h2>
                                <p><b>Welcome to Umrii, where refreshing moments come to life!</b></p>
                                <p>Founded in 2023 by the<b><em>Pritam Chhetri and Urmila Tamang</em></b>, our establishment has been serving up freshly fruits sourced from farmers in various regions of Nepal.</p>
                                <p class="mb-0">
                                We are thrilled to have you embark on a 
                                    <em>delightful journey</em>
                                    of taste and rejuvenation. Our carefully crafted drinks are designed to awaken your senses and provide a burst of revitalizing flavors. Whether you're craving a zingy fruit fusion or a cool, sparkling blend, Umrii has something to satisfy every thirst. So sit back, relax, and let our refreshing creations transport you to a world of pure refreshment.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(assets/img/about2.jpg); padding: 5em 0;margin: 0 5%; ">
    	<div class="container">
    		<div class="row justify-content-center py-5">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="10000">0</strong>
		                <div style="font-size: larger;"><b>Happy Customers</b></div>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="100">0</strong>
		                <div style="font-size: larger;"><b>Reviews</b></div>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="1000">0</strong>
		                <div style="font-size: larger;"><b>Partner</b></div>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="100">0</strong>
		                <div style="font-size: larger;"><b>Awards</b></div>
		              </div>
		            </div>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
<script src="https://cdn.rawgit.com/aishek/jquery-animateNumber/master/jquery.animateNumber.min.js"></script>

<script>
    $(document).ready(function() {
        var scrollWindow = function() {
            $(window).scroll(function(){
                var $w = $(this),
                    st = $w.scrollTop(),
                    navbar = $('.ftco_navbar'),
                    sd = $('.js-scroll-wrap');

                if (st > 150) {
                    if (!navbar.hasClass('scrolled')) {
                        navbar.addClass('scrolled');    
                    }
                } 
                if (st < 150) {
                    if (navbar.hasClass('scrolled')) {
                        navbar.removeClass('scrolled sleep');
                    }
                } 
                if (st > 350) {
                    if (!navbar.hasClass('awake')) {
                        navbar.addClass('awake');    
                    }

                    if (sd.length > 0) {
                        sd.addClass('sleep');
                    }
                }
                if (st < 350) {
                    if (navbar.hasClass('awake')) {
                        navbar.removeClass('awake');
                        navbar.addClass('sleep');
                    }
                    if (sd.length > 0) {
                        sd.removeClass('sleep');
                    }
                }
            });
        };
        scrollWindow();

        var counter = function() {
            $('#section-counter').waypoint(function(direction) {
                if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {
                    var comma_separator_number_step = $.animateNumber.numberStepFactories.separator(',');
                    $('.number').each(function(){
                        var $this = $(this),
                            num = $this.data('number');
                        $this.animateNumber(
                            {
                                number: num,
                                numberStep: comma_separator_number_step
                            }, 7000
                        );
                    });
                    $(this.element).addClass('ftco-animated');
                }
            }, { offset: '95%' });
        };
        counter();

        var contentWayPoint = function() {
            var i = 0;
            $('.ftco-animate').waypoint(function(direction) {
                if (direction === 'down' && !$(this.element).hasClass('ftco-animated')) {
                    i++;
                    $(this.element).addClass('item-animate');
                    setTimeout(function(){
                        $('body .ftco-animate.item-animate').each(function(k){
                            var el = $(this);
                            setTimeout(function () {
                                var effect = el.data('animate-effect');
                                if (effect === 'fadeIn') {
                                    el.addClass('fadeIn ftco-animated');
                                } else if (effect === 'fadeInLeft') {
                                    el.addClass('fadeInLeft ftco-animated');
                                } else if (effect === 'fadeInRight') {
                                    el.addClass('fadeInRight ftco-animated');
                                } else {
                                    el.addClass('fadeInUp ftco-animated');
                                }
                                el.removeClass('item-animate');
                            }, k * 50, 'easeInOutExpo');
                        });
                    }, 100);
                }
            }, { offset: '95%' });
        };
        contentWayPoint();
    });
</script>


    </body>
</html>
