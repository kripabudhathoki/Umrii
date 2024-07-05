<?php
include '../dbconnect.php';
session_start();
$pid = $_GET['pid'];	

if (isset($_POST['update'])) {
    // Sanitize and escape the input values
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = (int)$_POST['product_price'];
    $product_stock = (int)$_POST['product_stock'];
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);

    // Initialize variables for the image
    $product_image = '';
    $image_updated = false;

    // Check if a new image is uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $target_path = "uploads/products/";
        $target_file = $target_path . basename($_FILES['product_image']['name']);
        
        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $product_image = $_FILES['product_image']['name'];
            $image_updated = true;
        } else {
            echo "Error uploading image.";
        }
    }

    // Use prepared statement to avoid SQL injection
    if ($image_updated) {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_stock=?, product_description=?, product_image=? WHERE pid=?");
        $stmt->bind_param("siissi", $product_name, $product_price, $product_stock, $product_description, $product_image, $pid);
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_stock=?, product_description=? WHERE pid=?");
        $stmt->bind_param("siisi", $product_name, $product_price, $product_stock, $product_description, $pid);
    }

    if ($stmt->execute()) {
        $err = "<font color='blue'>Product updated </font>";
        echo '<script>
        alert("Product Updated");
        window.location.href="manageProd.php";
        </script>';
    } else {
        echo "Error updating product: " . $stmt->error;
    }
}

// Select old product
$q = mysqli_query($conn, "SELECT * FROM products WHERE pid='$pid'");
$res = mysqli_fetch_array($q);
?>

<?php
include '../includes/aside.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title>FABBRIK | Update Product</title>
	<link rel="stylesheet" href="../assets/css/style.css" />
	<link rel="stylesheet" href="../assets/css/bootstrap.css" />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<link rel="icon" type="image/x-icon" href="../assets/images/logos/webw.png" />
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
	<link rel="stylesheet" href="css/adminlte.min.css" />

</head>

<body>
	<div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<div class="container d-flex justify-content-center mt-3">
				<b class="font">
					<h1>Update Existing Product</h1>
				</b>
			</div>
		</section>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<!-- SELECT2 EXAMPLE -->
				<div class="card card-default">

				</div>
			</div>
			<!-- /.card-header -->
			<div class="border border-secondary card-body font m-auto rounded-3 w-50">
				<form method="POST" enctype="multipart/form-data">
					<div class="form-group mb-3">
						<div class="col-sm-4"><?php echo @$err; ?></div>
					</div>

					<div class="form-group mb-3">
						<b>Enter Product Name</b>
						<input type="text" name="product_name" value="<?php echo htmlspecialchars($res['product_name']); ?>" class="mt-2 border-secondary form-control" />
					</div>

					<div class="form-group mb-3">
						<b>Enter Price</b>
						<input type="text" name="product_price" value="<?php echo htmlspecialchars($res['product_price']); ?>" class="mt-2 border-secondary form-control" />
					</div>

					<div class="form-group mb-3">
						<b>Enter Available Stock</b>
						<input type="text" name="product_stock" class="mt-2 border-secondary form-control" value="<?php echo htmlspecialchars($res['product_stock']); ?>">
					</div>

					<div class="form-group mb-3">
						<b>Enter Description</b>
						<textarea name="product_description" cols="10" rows="5" class="mt-2 border-secondary form-control"><?php echo htmlspecialchars($res['product_description']); ?></textarea>
					</div>

					<div class="form-group mb-3">
						<b>Upload Product Image (optional)</b>
						<input type="file" name="product_image" class="mt-2 border-secondary form-control" />
					</div>

					<div class="text-white form-group mt-4">
						<input type="submit" value="Update" name="update" class="btn btn-primary" />
						<input type="reset" class="btn btn-dark" />
					</div>
				</form>
			</div>
		</section>

	</div>
	<?php require '../footer.php'; ?>
</body>

</html>
