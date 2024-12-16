<?php
session_start();
include '../dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>UMRII | Dashboard</title>
  <link rel="shortcut icon" href="../assets/img/logoW.png" type="image/x-icon">
  <link rel="icon" type="image/x-icon" href="../assets/img/logoW.png" />

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/adminlte.min.css" />
</head>

<body>
  <?php include '../includes/aside.php'; ?>

  <div class="container font">
    <div class="d-flex justify-content-center">
      <h1 class="mt-3 mb-5 font-bolder">Dashboard</h1>
    </div>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- Total Products Box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-dark zoom">
              <div class="inner hov">
                <h4 class="mb-2">Total Products</h4>
                <?php
                $dashTotProd = "SELECT * FROM products";
                $dashTotProdQuery = mysqli_query($conn, $dashTotProd);
                $totalProd = mysqli_num_rows($dashTotProdQuery);
                echo '<h4 class="mb-0">' . ($totalProd ?: 'No Data Found') . '</h4>';
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="./manageprod.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Total Users Box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-purple zoom">
              <div class="inner">
                <h4 class="mb-2">Total Users</h4>
                <?php
                $dashTotUsr = "SELECT * FROM users";
                $dashTotUsrQuery = mysqli_query($conn, $dashTotUsr);
                $totalUsr = mysqli_num_rows($dashTotUsrQuery);
                echo '<h4 class="mb-0">' . ($totalUsr ?: 'No Data Found') . '</h4>';
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="./manageUsr.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Total Orders Box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-olive zoom">
              <div class="inner">
                <h4 class="mb-2">Total Orders</h4>
                <?php
                $dashTotOrd = "SELECT * FROM orders";
                $dashTotOrdQuery = mysqli_query($conn, $dashTotOrd);
                $totalOrd = mysqli_num_rows($dashTotOrdQuery);
                echo '<h4 class="mb-0">' . ($totalOrd ?: 'No Data Found') . '</h4>';
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <a href="./manageorder.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <!-- Total Reviews Box -->
          <div class="col-lg-3 col-6">
            <div class="small-box bg-info zoom">
              <div class="inner">
                <h4 class="mb-2">Total Reviews</h4>
                <?php
                $dashTotRev = "SELECT * FROM review";
                $dashTotRevQuery = mysqli_query($conn, $dashTotRev);
                $totalRev = mysqli_num_rows($dashTotRevQuery);
                echo '<h4 class="mb-0">' . ($totalRev ?: 'No Data Found') . '</h4>';
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-star"></i>
              </div>
              <a href="review.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  <?php include '../footer.php'; ?>
</body>

</html>
