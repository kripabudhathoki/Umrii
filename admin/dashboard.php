<?php
session_start();
include '../dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Umrii | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
  <link rel="stylesheet" href="../assets/css/style.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.css" />
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
  <link rel="icon" type="image/x-icon" href="../assets/images/logos/webw.png" />
  <link rel="stylesheet" href="css/adminlte.min.css" />

</head>

<body class="">
  <?php
  include '../includes/aside.php';
  ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="container font">
    <!-- Content Header (Page header) -->
    <div class=" d-flex justify-content-center">
      <h1 class="mt-3 mb-5 font-bolder">Dashboard</h1>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-dark zoom">
              <div class="inner hov">
                <h4 class="mb-2">Total Products</h4>
                <?php
                $dashTotProd = "SELECT * from products";
                $dashTotProdQuery = mysqli_query($conn, $dashTotProd);

                if ($totalProd = mysqli_num_rows($dashTotProdQuery)) {
                  echo '<h4 class="mb-0">' . $totalProd . '</h4>';
                } else {
                  echo '<h4 class="mb-0">No Data Found</h4>';
                }
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-gift"></i>
              </div>
              <a href="./manageprod.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-purple zoom">
              <div class="inner">
                <h4 class="mb-2">Total Users</h4>
                <?php
                $dashTotUsr = "SELECT * from users";
                $dashTotUsrQuery = mysqli_query($conn, $dashTotUsr);

                if ($totalUsr = mysqli_num_rows($dashTotUsrQuery)) {
                  echo '<h4 class="mb-0">' . $totalUsr . '</h4>';
                } else {
                  echo '<h4 class="mb-0">No Data Found</h4>';
                }
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-user"></i>
              </div>
              <a href="./manageUsr.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-olive zoom">
              <div class="inner">
                <h4 class="mb-2">Total Orders</h4>
                <?php
                $dashTotOrd = "SELECT * from orders";
                $dashTotOrdQuery = mysqli_query($conn, $dashTotOrd);

                if ($totalProd = mysqli_num_rows($dashTotOrdQuery)) {
                  echo '<h4 class="mb-0">' . $totalProd . '</h4>';
                } else {
                  echo '<h4 class="mb-0">No Data Found</h4>';
                }
                ?>
              </div>
              <div class="icon">
                <i class="fas fa-briefcase"></i>
              </div>
              <a href="./manageorder.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <!-- <div class="small-box bg-danger zoom">
              <div class="inner">
                <h4 class="mb-2">Total Categories</h4>
                <h4 class="mb-0">
                  <?php
                  $dashTotOrd = "SELECT * from products";
                  $dashTotOrdQuery = mysqli_query($conn, $dashTotOrd);

                  if ($totalProd = mysqli_num_rows($dashTotOrdQuery)) {
                    echo '<h4 class="mb-0">' . $totalProd . '</h4>';
                  } else {
                    echo '<h4 class="mb-0">No Data Found</h4>';
                  }
                  ?></h4>
              </div>
              <div class="icon">
                <i class="fas fa-arrow-circle-right"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div> -->
          </div>
        </div>
      </div>
    </section>

  </div>
  <?php
  require '../footer.php'; ?>
</body>

</html>