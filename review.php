<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
        <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #BB676B !important;
        }
        .form-container {
            background:#BB676B !important;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin-top: 0%;
        }
        .review-card {
            border: 1px solid #dee2e6;
            border-radius: 0.5rem;
            padding: 1.5rem;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            transition: transform 0.3s;
            margin-top: 20px;
        }
        .review-card:hover {
            transform: scale(1.05);
        }
        .review-rating {
            color:#BB676B !important;
            font-size: 1.2rem;
        }
        .review-text {
            font-style: italic;
        }
        .reviewer-name {
            font-weight: bold;
        }
        .reviewer-image {
            max-width: 80px;
            border-radius: 50%;
        }
        .star-rating {
            direction: rtl;
            display: inline-block;
        }
        .star-rating input[type="radio"] {
            display: none;
        }
        .star-rating label {
            color: #bbb;
            font-size: 2rem;
            padding: 0;
            cursor: pointer;
            transition: all 0.3s;
        }
        .star-rating input[type="radio"]:checked ~ label {
            color: #f8d64e;
        }
        .star-rating label:hover,
        .star-rating label:hover ~ label {
            color: #f8d64e;
        }
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

    /* The Popup (background) */
    .cart-popup {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 1000; /* Sit on top */
        left: 0;
        top: 0;
        width: 100%; /* Full width */
        height: 100%; /* Full height */
        overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
    }

    /* Popup Content */
    .cart-popup-content {
        background-color: #fefefe;
        margin: 15% auto; /* 15% from the top and centered */
        padding: 20px;
        border: 1px solid #888;
        width: 80%; /* Could be more or less, depending on screen size */
        max-width: 400px; /* Set a max-width for better design */
        border-radius: 10px; /* Rounded corners */
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); /* Subtle shadow */
    }

    /* The Close Button */
    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }
    </style>
</head>
<body>
    <?php include('navbar.php'); ?>
    

    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: center center; padding: 5em 0; margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <h1 class="mb-0 bread">Reviews</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="review-card d-flex align-items-center" style="background:#bdadad9e;">
                    <img src="assets/img/1.jpg" alt="Reviewer Image" class="reviewer-image mr-3">
                    <div>
                        <div class="review-rating">
                            &#9733; &#9733; &#9733; &#9733; &#9734;
                        </div>
                        <div class="review-text mt-2">
                            "This product exceeded my expectations. The quality is top-notch and the customer service was excellent!"
                        </div>
                        <div class="reviewer-name mt-3">
                            - John Doe
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card d-flex align-items-center" style="background: #bdadad9e;">
                    <img src="assets/img/gallery2.jpg" alt="Reviewer Image" class="reviewer-image mr-3">
                    <div>
                        <div class="review-rating">
                            &#9733; &#9733; &#9733; &#9734; &#9734;
                        </div>
                        <div class="review-text mt-2">
                            "Good value for money. I am satisfied with my purchase and would recommend it to others."
                        </div>
                        <div class="reviewer-name mt-3">
                            - Jane Smith
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="review-card d-flex align-items-center" style="background: #bdadad9e;">
                    <img src="assets/img/bestseller1.jpg" alt="Reviewer Image" class="reviewer-image mr-3">
                    <div>
                        <div class="review-rating">
                            &#9733; &#9733; &#9733; &#9733; &#9733;
                        </div>
                        <div class="review-text mt-2">
                            "Absolutely amazing! This product has changed my life. Five stars!"
                        </div>
                        <div class="reviewer-name mt-3">
                            - Alex Johnson
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row block-9">
            <div class="col-md-6 order-md-last d-flex">
                <div class="bg-white p-5 contact-form" style="margin-left: 20%; margin-top: -20px;margin-bottom: 25px;">
                    <h2>Submit Your Review</h2>
                    <form id="reviewForm">
                        <div class="form-group">
                            <br>
                            <input type="text" class="form-control" id="reviewerName" placeholder="Your Name" required>
                        </div>
                        <div class="form-group">
                        <br>
                            <input type="text" class="form-control" id="reviewerImage" placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                            <label for="reviewRating">Rating</label>
                            <div class="star-rating">
                                <input type="radio" id="5-stars" name="rating" value="5" required>
                                <label for="5-stars" class="star">&#9733;</label>
                                <input type="radio" id="4-stars" name="rating" value="4">
                                <label for="4-stars" class="star">&#9733;</label>
                                <input type="radio" id="3-stars" name="rating" value="3">
                                <label for="3-stars" class="star">&#9733;</label>
                                <input type="radio" id="2-stars" name="rating" value="2">
                                <label for="2-stars" class="star">&#9733;</label>
                                <input type="radio" id="1-star" name="rating" value="1">
                                <label for="1-star" class="star">&#9733;</label>
                            </div>
                        </div>
                        <div class="form-group">
                        
                            <textarea class="form-control" id="reviewText" rows="3" placeholder="Your Review" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary justify-content-center" style="margin: 2% 40%;">Submit</button>
                    </form>
                </div>
            </div>
            <div class="col-md-6 d-flex" style="margin-top: -50px;margin-bottom: 25px;">
                    <div id="map" class="img-popup"><img src="assets/img/review1.jpg"alt="img-fluid" class="reviewer-image mr-3" style="max-width: 70%;margin-top: 5%;margin-left: 17%;"></div>
                </div>
        </div>
        

        <div id="reviewsContainer" class="row"></div>
    </div>

    <!-- <script>
        document.getElementById('reviewForm').addEventListener('submit', function(event) {
            event.preventDefault();

            const name = document.getElementById('reviewerName').value;
            const imageUrl = document.getElementById('reviewerImage').value;
            const rating = document.querySelector('input[name="rating"]:checked').value;
            const reviewText = document.getElementById('reviewText').value;

            const ratingStars = '★'.repeat(rating) + '☆'.repeat(5 - rating);

            const reviewCard = `
                <div class="col-md-4">
                    <div class="review-card d-flex align-items-center">
                        <img src="${imageUrl}" alt="Reviewer Image" class="reviewer-image mr-3">
                        <div>
                            <div class="review-rating">
                                ${ratingStars}
                            </div>
                            <div class="review-text mt-2">
                                "${reviewText}"
                            </div>
                            <div class="reviewer-name mt-3">
                                - ${name}
                            </div>
                        </div>
                    </div>
                </div>
            `;

            document.getElementById('reviewsContainer').insertAdjacentHTML('beforeend', reviewCard);

            document.getElementById('reviewForm').reset();
        });
    </script> -->
<?php
include('footer.php') ?>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
