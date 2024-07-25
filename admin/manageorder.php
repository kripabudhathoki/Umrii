<?php
session_start();
include '../dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>UMRII | Manage Order</title>
    <link rel="shortcut icon" href="../assets/img/logoW.png" type="image/x-icon">
    <link rel="icon" type="image/x-icon" href="assets/img/logoW.png" />

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/adminlte.min.css" />
    <link rel="icon" type="image/x-icon" href="../assets/images/webw.png" />

</head>

<body>
    <?php
    include '../includes/aside.php';
    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container d-flex justify-content-center font">
                <b>
                    <h1>Manage Orders</h1>
                </b>
            </div>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <!-- SELECT2 EXAMPLE -->
                    <div class="card card-default">
                    </div>
                </div>


                <?php
                $q = mysqli_query($conn, "SELECT SUM(oi.quantity) AS quantity, oi.unit_price, o.total_price, o.order_id,u.username, CONCAT(c.first_name,' ',c.last_name) AS orderedby, c.address,c.phone, o.payment_method,o.status
                FROM orders o
                JOIN order_items oi ON oi.order_id = o.order_id
                JOIN checkouts c ON c.checkout_id = o.checkout_id
                JOIN users u ON o.uid = u.uid
                GROUP BY order_id");
                $rr = mysqli_num_rows($q);
                if (!$rr) {
                    echo "<h2 style='color:red'>No any order exists !!!</h2>";
                } else {
                ?>
                    <script>
                        function DeleteOrder(id) {
                            if (confirm("Do you want to delete this order?")) {
                                alert("Order Deleted Successfully")
                                window.location.href = "deleteorder.php?order_id=" + id;
                            }
                        }
                    </script>
                    <b class="hov font">
                        <h2 class="">All Orders</h2>
                    </b>

                    <table class="table table-hover table-bordered">
                        <Tr class="success">
                            <th>S.No</th>
                            <th>Username</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Order id</th>
                            <th>Ordered By</th>
                            <th>Address</th>
                            <th>Phone Number</th>
                            <th>Payment Method</th>
                            <th>Status</th>
                            <th>Delete</th>
                        </tr>
                        <?php


                        $i = 1;
                        while ($row = mysqli_fetch_assoc($q)) {

                            echo "<tr>";
                            echo "<td>" . $i . "</td>";
                            echo "<td>" . $row['username'] . "</td>";
                            echo "<td>" . $row['total_price'] . "</td>";
                            echo "<td>" . $row['quantity'] . "</td>";
                            echo "<td>" . $row['order_id'] . "</td>";
                            echo "<td>" . $row['orderedby'] . "</td>";
                            echo "<td>" . $row['address'] . "</td>";
                            echo "<td>" . $row['phone'] . "</td>";
                            echo "<td>" . $row['payment_method'] . "</td>";
                        ?>
                         <td>
    <select name="status" id="status">
      <option value="<?php echo $row['status']?>">Pending</option>
      <option value="<?php echo $row['status']?>">Cancelled</option>
      <option value="<?php echo $row['status']?>">Delivered</option>


    </select>
    </td>

                            <td><a href="javascript:DeleteOrder('<?php echo $row['order_id']; ?>')" class="btn btn-danger">Delete</a></td>
                           
                        <?php
                            echo "</tr>";
                            $i++;
                        }
                        ?>

                    </table>
                <?php } ?>
            </section>
        </section>
    </div>
    <?php
    require '../footer.php'; ?>
</body>

</html>