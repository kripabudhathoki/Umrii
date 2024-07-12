<?php
session_start();
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

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body class="goto-here">    
    <?php 
    include('navbar.php')?>
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
    <div class="hero-wrap"style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a></a></span> <span></span></p>
                    <h1 class="mb-0 bread">Contact us</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light" style="margin: 0% 5%;">
        <div class="container">
            <div class="row d-flex mb-5 contact-info">
                <div class="w-100"></div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Address:</span> Umrii, Lalitpur 44700</p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Phone:</span> <a href="tel://1234567920">9828884567</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Email:</span> <a href="umrii.np@gmail.com">umrii.np@gmail.com</a></p>
                    </div>
                </div>
                <div class="col-md-3 d-flex">
                    <div class="info bg-white p-4">
                        <p><span>Website</span> <a href="#">umrii.np</a></p>
                    </div>
                </div>
            </div>
            <div class="row block-9">
                <div class="col-md-6 order-md-last d-flex">
                    <form action="contactprocess.php" method= "post" class="bg-white p-5 contact-form" style="margin-left: 20%; margin-top: -50px;margin-bottom: 25px;">
                        <div class="form-group">
                            <input type="text" name ="name" class="form-control" placeholder="Your Name">
                        </div>
                        <div class="form-group">
                            <input type="text" name ="email" class="form-control" placeholder="Your Email">
                        </div>
                        
                        <div class="form-group">
                            <textarea name="message" id="" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                        </div>
                        <div class="form-group">
                            <input type="submit" value="Send Message" class="btn btn-primary py-3 px-5">
                        </div>
                    </form>
                </div>
                <div class="col-md-6 d-flex" style="margin-top: -50px;margin-bottom: 25px;">
                    <div id="map" class="bg-white"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.9377926827437!2d85.306494874477!3d27.68831747619348!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb19429e09f9af%3A0xa131f4ae64c8d2ce!2sUmrii!5e0!3m2!1sne!2snp!4v1720519435024!5m2!1sne!2snp" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
                </div>

            </div>
        </div>
    </section>

<?php 
include('footer.php')
?>
   
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-migrate-3.3.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
</body>
</html>