<link href="css/styles.css" rel="stylesheet" />
<header>
            <h1 class="site-heading text-center text-faded d-none d-lg-block">
                <div class="topbar bg-primary">
			<div class="d-flex justify-content-between">
				<div class="top-info ps-2">
                <small class="me-3"><a class="text-white"><b>Lalitpur, Nepal</b></a></small>
					<small class="me-3"><a class="text-white"><b>umrii.np@gmail.com</b></a></small>
				</div>
				<div class="top-link pe-2">
					<small class="me-3"><a class="text-white"><b>+977 9828884567</b></a></small>
				</div>
			</div>
		</div>
            <a href="index.php" class="navbar-brand">
					<h1 class="display-6"><img src="assets/img/logoW.png" class="main-logo" /></h1>
				</a>
            </h1>
        </header>
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.php">Home</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="about.php">About</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="products.php">Products</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="store.html">Store</a></li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="product.php">Review</a></li>
                    </ul>
                    <?php
						if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
							$loggedin = true;
						} else {
							$loggedin = false;
						}
						if (!$loggedin) {
							echo "<a href='login.php' class='nav-link text-uppercase'><button type='button' class='btn btn-primary' style='color:#A54A4E; background-color:#e6a756;'><b>Log In</b></button></a>";
						} else {
							echo "<a href='logout.php' class='position-relative ms-3 my-auto'>
							<i class='fas fa-solid fa-right-from-bracket fa-2x'></i></a>";
						}
						?>
						<a>
							<?php if (isset($_SESSION['email'])) {
								echo
								'<a class="nav-link">
						<i class="bi bi-person"></i>' . " " . $_SESSION['email'];
								'</a>';
							}
							?>
                </div>
            </div>
        </nav></div>