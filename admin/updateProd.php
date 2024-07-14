<?php
include '../dbconnect.php';
session_start();
$pid = $_GET['pid'];    

if (isset($_POST['update'])) {
    // Sanitize and escape the input values
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = (int)$_POST['product_price'];
    $isFeatured = (int)$_POST['isFeatured'];
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);

    // Initialize variables for the image
    $product_image = '';
    $image_updated = false;

    // Check if a new image is uploaded
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $target_path = "../assets/img/";
        $target_file = $target_path . basename($_FILES['product_image']['name']);

        // Check if the directory exists and is writable
        if (!is_dir($target_path) || !is_writable($target_path)) {
            die("Upload directory does not exist or is not writable.");
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            $product_image = $_FILES['product_image']['name'];
            $image_updated = true;
        } else {
            echo "Error uploading image.";
        }
    } else {
        // Debugging information for upload error
        if (isset($_FILES['product_image'])) {
            echo "Upload Error: " . $_FILES['product_image']['error'] . "<br>";
        }
    }

    // Use prepared statement to avoid SQL injection
    if ($image_updated) {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_description=?, product_image=?, isFeatured=? WHERE pid=?");
        $stmt->bind_param("sissii", $product_name, $product_price, $product_description, $product_image, $isFeatured, $pid);
    } else {
        $stmt = $conn->prepare("UPDATE products SET product_name=?, product_price=?, product_description=?, isFeatured=? WHERE pid=?");
        $stmt->bind_param("sisii", $product_name, $product_price, $product_description, $isFeatured, $pid);
    }

    if ($stmt->execute()) {
        $err = "<font color='blue'>Product updated </font>";
        echo '<script>
        alert("Product Updated");
        window.location.href="manageProd.php";
        </script>';
    } else {
        $err = "<font color='red'>Could not update the product. Please try again later.</font>";
    }
}

// Fetch the product details
$product = null;
if ($pid) {
    $stmt = $conn->prepare("SELECT * FROM products WHERE pid = ?");
    $stmt->bind_param("i", $pid);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Umrii | Add new product</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css" />
    <link rel="stylesheet" href="../assets/css/style.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css" />
    <!-- Theme style -->
    <link rel="stylesheet" href="css/adminlte.min.css" />
    <link rel="icon" type="image/x-icon" href="../assets/images/logos/webw.png" />
    <style>
        .form-row {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .form-group {
            flex: 1 1 calc(50% - 20px); /* Adjust width as needed */
        }

        .form-group.col-image {
            display: flex;
            align-items: center;
        }

        .image-preview {
            width: 100px; /* Adjust the width as needed */
            height: auto; /* Maintain aspect ratio */
            margin-left: 20px; /* Adjust margin as needed */
        }

        .image-preview img {
            max-width: 100%;
            height: auto;
            display: block;
        }
    </style>
</head>

<body>
    <?php include '../includes/aside.php'; ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="container">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container d-flex justify-content-center">
                <b class="font">
                    <h1>Update Product</h1>
                </b>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-body font">
                        <?php if ($product): ?>
                        <form method="POST" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control border-1 border-secondary" value="<?= htmlspecialchars($product['product_name']) ?>" required>
                                </div>

                                <div class="form-group col-image">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <input type="file" name="product_image" id="product_image" class="form-control border-1 border-secondary" onchange="previewImage();">
                                    </div>
                                    <div class="image-preview" id="imagePreview">
                                        <img id="imgPreview" src="<?= '../assets/img/' . htmlspecialchars($product['product_image']) ?>" alt="Image Preview">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="product_price" id="price" class="form-control border-1 border-secondary" value="<?= htmlspecialchars($product['product_price']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <label>Description:</label>
                                    <textarea name="product_description" id="description" cols="10" rows="5" class="form-control border-1 border-secondary" required><?= htmlspecialchars($product['product_description']) ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>isFeatured</label>
                                    <input type="number" name="isFeatured" id="isFeatured" class="form-control border-1 border-secondary" value="<?= htmlspecialchars($product['isFeatured']) ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="submit" value="Update" name="update" id="update" class="btn bg-dark text-white" />
                                    <input type="reset" value="RESET" name="" id="reset" class="btn bg-purple" />
                                </div>
                            </div>
                        </form>
                        <?php else: ?>
                        <p>Product not found.</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <?php require '../footer.php'; ?>

    <script>
        function previewImage() {
            var preview = document.getElementById('imgPreview');
            var file = document.getElementById('product_image').files[0];
            var reader = new FileReader();

            reader.onloadend = function() {
                preview.src = reader.result;
                preview.style.display = 'block'; // Display the previewed image
            }

            if (file) {
                reader.readAsDataURL(file); // Converts the file to a data URL.
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }
        }
    </script>
</body>

</html>
