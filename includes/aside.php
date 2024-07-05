<!-- Navbar -->

<nav class="navbar navbar-expand navbar-white bg-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">

        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./dashboard.php" class="font nav-link text-white-50"> <i class="nav-icon fas fa-home"></i>
                Home</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./dashboard.php" class="nav-link text-white-50">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                Dashboard
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./add-product.php" class="text-white-50 nav-link">
                <i class="nav-icon fas fa-upload"></i>
                Add Product
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./manageprod.php" class="text-white-50 nav-link">
                <i class="nav-icon fas fa-edit"></i>
                Manage Product
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./manageUsr.php" class="text-white-50 nav-link">
                <i class="nav-icon fas fa-user-edit"></i>
                Manage User
            </a>
        </li>
        <li class="nav-item d-none d-sm-inline-block hov">
            <a href="./manageorder.php" class="text-white-50 nav-link">
                <i class="nav-icon fas fa-briefcase"></i>
                Manage Orders
            </a>
        </li>

    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        </li>
        <!-- Notifications Dropdown Menu -->
        <li>
<!--             <a class="nav-link text-white-50" href="#">
                 <i class="far fa-user text-white-50"></i> <?php echo $_SESSION['admin']; ?> -->
            </a> 
        </li>
        <li class="info">
            <a class="nav-link text-white-50 font" href="./logout.php">
                <i class="fas fa-sign-out-alt text-white-50" aria-hidden="true"></i>Logout
            </a>
        </li>
    </ul>
</nav>