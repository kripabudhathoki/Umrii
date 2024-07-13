<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet"/>
    <style>
        h5 {
            font-size: 24px;
            font-weight: bold;
            color: #ff5722;
            text-align: center;
            background-color: #f1f1f1;
            padding: 10px;
            border-radius: 5px;
            box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
            margin-top: 6rem !important;
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
    </style>
</head>
<body>
    <?php
    include('navbar.php')
    ?>
    <div class="myorders" style="margin: 0 100px;">
    <div class="hero-wrap" style="background-image: url('assets/img/background1.jpg');background-size: cover;background-repeat: no-repeat;background-position: center center;padding: 5em 0;margin: 0 5%; z-index: -1;">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center hero-content">
                <div class="col-md-9 text-center">
                    <p class="breadcrumbs"><span class="mr-2"><a></a></span> <span></span></p>
                    <h1 class="mb-0 bread"><b>My Order</b></h1>
                </div>
            </div>
        </div>
    </div>

        <!-- <div class="alert alert-success text-center" role="alert">
            Order placed successfully!
        </div> -->

        <table class="table table-hover table-bordered text-center">
            <thead class="thead-dark">
                <tr>
                    <th>Create Date</th>
                    <th>Status</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Payment Method</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>2024-07-13</td>
                    <td>Shipped</td>
                    <td>John Doe</td>
                    <td>123 Main St, Anytown, USA</td>
                    <td>Credit Card</td>
                    <td>
                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#details-1" aria-expanded="false" aria-controls="details-1">
                            View Details
                        </button>
                    </td>
                </tr>
                <tr class="collapse" id="details-1">
                    <td colspan="6">
                        <table class="table table-sm table-bordered">
                            <thead class="thead-light">
                                <tr>
                                    <th>Product Image</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><img src="https://via.placeholder.com/100" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                                    <td>Product 1</td>
                                    <td>2</td>
                                    <td>Rs 100.00</td>
                                    <td>Rs 200.00</td>
                                </tr>
                                <tr>
                                    <td><img src="https://via.placeholder.com/100" alt="Product Image" style="max-width: 100px; max-height: 100px;"></td>
                                    <td>Product 2</td>
                                    <td>1</td>
                                    <td>Rs 150.00</td>
                                    <td>Rs 150.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- Repeat for more orders as needed -->
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
