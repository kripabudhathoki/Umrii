<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navbar with Review Icon</title>

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        .hov:hover {
            color: #FFD700; /* Change color on hover */
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand navbar-white bg-dark">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./dashboard.php" class="font nav-link text-white-50"> 
                    <i class="nav-icon fas fa-home"></i> Home
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./dashboard.php" class="nav-link text-white-50">
                    <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./add-product.php" class="text-white-50 nav-link">
                    <i class="nav-icon fas fa-upload"></i> Add Product
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./manageprod.php" class="text-white-50 nav-link">
                    <i class="nav-icon fas fa-edit"></i> Manage Product
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./manageUsr.php" class="text-white-50 nav-link">
                    <i class="nav-icon fas fa-user-edit"></i> Manage User
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./manageorder.php" class="text-white-50 nav-link">
                    <i class="nav-icon fas fa-briefcase"></i> Manage Orders
                </a>
            </li>
            <li class="nav-item d-none d-sm-inline-block hov">
                <a href="./review.php" class="text-white-50 nav-link">
                    <!-- Bootstrap Icon for Star -->
                    <i class="bi bi-star-fill fs-3"></i> Reviews
                </a>
            </li>
        </ul>

        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="info">
                <a class="nav-link text-white-50 font" href="./logout.php">
                    <i class="fas fa-sign-out-alt text-white-50" aria-hidden="true"></i>Logout
                </a>
            </li>
        </ul>
    </nav>

    <!-- Optional: Add Bootstrap JS for interactivity -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
