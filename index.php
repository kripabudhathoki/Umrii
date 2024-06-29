<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>UMRII</title>
        <link rel="shortcut icon" href="assets/img/logoW.png" type="image/x-icon">
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet" />
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body>
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
        <!--nav end-->
        <section class="page-section clearfix">
            <div class="container">
                <div class="intro">
                    <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="assets/img/file.jpg" alt="..." />
                    <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                        <h2 class="section-heading mb-4">
                            <span class="section-heading-lower"><b>Worth Drinking</b></span>
                        </h2>
                        <p class="mb-3">Every cup of our quality refreshing summer drinks starts with locally sourced, hand picked ingredients. Once you try it, our drinks will be a blissful addition to your everyday summer routine - we guarantee it!</p>
                        <div class="intro-button mx-auto"><a class="btn btn-primary btn-xl" href="#!"><b>Visit Us Today!</b></a></div>
                    </div>
                </div>
            </div>
        </section>
        <!--section 2-->
        <section class="page-section clearfix">
            <div class="container">

		<article class="postcard dark blue">
			<a class="postcard__img_link" href="#">
				<img class="postcard__img" src="assets/img/bestseller1.jpg" alt="Image Title" />
			</a>
			<div class="postcard__text">
				<h1 class="postcard__title blue"><a href="#"><b>Forest Fruit Crush</b></a></h1>
                <b>BEST SELLER</b>
				<div class="postcard__subtitle small">
				</div>
				<div class="postcard__bar"></div>
				<div class="postcard__preview-txt">Experience the vibrant blend of strawberries, blackcurrants, raspberries, red currants, and cherries, perfectly balanced with fresh lime and mint. Refreshing and delicious, our Forest Fruit Crush is a taste of nature's finest berries in every sip. Perfect for cooling down or enjoying a burst of fruity goodness!</div>
				<ul class="postcard__tagbox">
					<li class="tag__item"><i class="fas fa-tag mr-2"></i><b>Price: 220</b></li>
					<li class="tag__item play blue">
						<a href="#"><b>BUY NOW!</b></a>
					</li>
				</ul>
			</div>
		</article>
		<article class="postcard dark red">
			<a class="postcard__img_link" href="#">
				<img class="postcard__img" src="assets/img/special.jpg" alt="Image Title" />	
			</a>
			<div class="postcard__text">
				<h1 class="postcard__title red"><a href="#"><b>UMRII SPECIAL</b></a></h1>
				<div class="postcard__subtitle small">
				<b> YOU'RE SPECIAL</b>
				</div>
				<div class="postcard__bar"></div>
				<div class="postcard__preview-txt">Indulge in the rich and creamy delight of our Umrii Special. This luxurious drink is crafted with a perfect blend of milk and chocolate, offering a smooth and decadent experience with every sip. Whether you're in the mood for a comforting treat or a satisfying pick-me-up, the Umrii Special is your go-to choice for a deliciously indulgent moment.</div>
				<ul class="postcard__tagbox">
					<li class="tag__item"><i class="fas fa-tag mr-2"></i><b>Price:250</b></li>
					<li class="tag__item play red">
						<a href="#"><b>BUY NOW!</b></a>
					</li>
				</ul>
			</div>
		</article>
		<article class="postcard dark green">
			<a class="postcard__img_link" href="#">
				<img class="postcard__img" src="assets/img/bestseller2.jpg" alt="Image Title" />
			</a>
			<div class="postcard__text">
				<h1 class="postcard__title green"><a href="#"><b>STRAWBERRY CRUSH</b></a></h1>
				<div class="postcard__subtitle small">
						<b>EVERYONE'S FAVORITE</b>
				</div>
				<div class="postcard__bar"></div>
				<div class="postcard__preview-txt">Savor the refreshing taste of our Strawberry Crush. Made with luscious strawberry puree, zesty fresh lime, and a hint of aromatic mint, this delightful drink offers a perfect balance of sweetness and tang. Enjoy a revitalizing burst of flavor in every sip, perfect for any occasion.</div>
				<ul class="postcard__tagbox">
					<li class="tag__item"><i class="fas fa-tag mr-2"></i><b>Price: 220</b></li>
					<li class="tag__item play green">
						<a href="#"><b>BUY NOW!</b></a>
					</li>
				</ul>
			</div>
		</article>
	</div>
</section>
         <!--section 2 end -->
        <section class="page-section cta">
        <div class="container-gallery">
    <div class="popup popup-1">
        <img class="img-responsive" alt="Pop Up Gallety" src="assets/img/gallery1.jpg" />
    </div>
    <div class="popup popup-2">
        <img class="img-responsive" alt="Pop Up Gallety" src="assets/img/gallery2.jpg" />
    </div>
    <div class="popup popup-3">
        <img class="img-responsive" alt="Pop Up Gallety" src="assets/img/gallery5.jpg" />
    </div>
    <div class="popup popup-4">
        <img class="img-responsive" alt="Pop Up Gallety" src="assets/img/gallery3.jpg" />
    </div>
    <div class="popup popup-5">
        <img class="img-responsive" alt="Pop Up Gallety" src="assets/img/gallery4.jpg" />
    </div>
</div>
        </section>
		<footer class="footer text-faded text-center py-5">
        <div class="container">
            <p class="m-0 small">Copyright &copy; Umrii</p>
            <div>
                <a href="https://www.facebook.com/profile.php?id=100093131061049" target="_blank" class="socialMediaIcon"><i class="fab fa-facebook-f fa-1x"></i></a>
                <a href="https://www.instagram.com/umrii.np/" target="_blank" class="socialMediaIcon"><i class="fab fa-instagram fa-1x"></i></a>
            </div>
        </div>
    </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>
</html>
