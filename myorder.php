<?php

    session_start();


// Check if the user is logged in
$is_logged_in = isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true;
$username = $is_logged_in ? $_SESSION['username'] : 'Guest';

include('dbconnect.php');


// Fetch orders
$sql = "SELECT o.order_id, o.order_date, o.status, o.payment_method, o.is_paid, 
               u.fname, u.lname, u.address, 
               GROUP_CONCAT(DISTINCT CONCAT(p.product_name, ' (', oi.quantity, ')') ORDER BY p.product_name SEPARATOR ', ') AS product_details
        FROM orders o
        JOIN users u ON o.uid = u.uid
        JOIN order_items oi ON o.order_id = oi.order_id
        JOIN products p ON oi.pid = p.pid
        GROUP BY o.order_id, u.fname, u.lname, u.address, o.status, o.payment_method, o.is_paid, o.order_date
        ORDER BY o.order_date DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>UMRII</title>
    <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/styles.css" rel="stylesheet" />
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
    <?php include('navbar.php'); ?>

    <div class="myorders">
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

        <table class="table table-hover table-bordered text-center" style="width: 88%;margin-bottom: 1rem;color: #212529;margin:2em 5em;">
            <thead class="" style="background: #bfaeae;">
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
            <?php if ($result->num_rows > 0): ?>
                            <?php while ($row = $result->fetch_assoc()): ?>
                                <tr style="background: azure;">
                                    <td><?php echo date('Y-m-d', strtotime($row['order_date'])); ?></td>
                                    <td><?php echo $row['status']; ?></td>
                                    <td><?php echo $row['fname'] . ' ' . $row['lname']; ?></td>
                                    <td><?php echo $row['address']; ?></td>
                                    <td><?php echo $row['payment_method']; ?></td>
                                    <td>
                                        <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#details-<?php echo $row['order_id']; ?>" aria-expanded="false" aria-controls="details-<?php echo $row['order_id']; ?>">
                                            View Details
                                        </button>
                                    </td>
                                </tr>
                                <tr class="collapse" id="details-<?php echo $row['order_id']; ?>">
                                    <td colspan="6">
                                        <table class="table table-sm table-bordered">
                                            <thead class="" style="background: #bfaeae;">
                                                <tr>
                                                <th>Product Image</th>
                                                    <th>Product Name</th>
                                                    <th>Quantity</th>
                                                    <th>Unit Price</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Fetch order items for this order
                                                $orderId = $row['order_id'];
                                                $itemSql = "SELECT p.product_name, oi.quantity, oi.unit_price, (oi.quantity * oi.unit_price) AS subtotal
                                                            FROM order_items oi
                                                            JOIN products p ON oi.pid = p.pid
                                                            WHERE oi.order_id = $orderId";
                                                $itemResult = $conn->query($itemSql);
                                                ?>
                                                <?php while ($itemRow = $itemResult->fetch_assoc()): ?>
                                                    <tr style="background: gainsboro;">
                                                    <td><img src="assets/img/<?php echo $itemRow['product_image'];?>" alt="<?php echo $itemRow['product_name']; ?>" style="width: 100px; height: auto;"></td>
                                                        <td><?php echo $itemRow['product_name']; ?></td>
                                                        <td><?php echo $itemRow['quantity']; ?></td>
                                                        <td>Rs <?php echo number_format($itemRow['unit_price'], 2); ?></td>
                                                        <td>Rs <?php echo number_format($itemRow['subtotal'], 2); ?></td>
                                                    </tr>
                                                <?php endwhile; ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            <?php endwhile; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6">No orders found</td>
                            </tr>
                        <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
