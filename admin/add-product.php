<?php
session_start();
include '../dbconnect.php';

$product_name = '';
$product_image = 'no-image.jpg';
$product_description = '';

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_image = $_FILES['product_image']['name'];
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $isFeatured = mysqli_real_escape_string($conn, $_POST['isFeatured']);

    // Validate file upload
    $allowed_extensions = array('jpg', 'jpeg', 'png', 'gif');
    $file_extension = pathinfo($product_image, PATHINFO_EXTENSION);

    if (in_array($file_extension, $allowed_extensions)) {
        $target_path = "../assets/img/";
        $target_file = $target_path . basename($product_image);

        if (move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file)) {
            try {
                $stmt = $conn->prepare("INSERT INTO products (product_name, product_image, product_description, product_price, isFeatured) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("sssdi", $product_name, $product_image, $product_description, $product_price, $isFeatured);

                if ($stmt->execute()) {
                    echo '<script>alert("Product Added Successfully");window.location.href="./dashboard.php";</script>';
                } else {
                    echo '<script>alert("Cannot Add Product");</script>';
                    header("Location: ../admin/add-product.php");
                }

                $stmt->close();
            } catch (Exception $e) {
                echo '<script>alert("Unable to add new product.");</script>';
                error_log($e->getMessage());
            }
        } else {
            echo '<script>alert("Sorry, file not uploaded, please try again!");</script>';
        }
    } else {
        echo '<script>alert("Invalid file type. Only JPG, JPEG, PNG, and GIF files are allowed.");</script>';
    }
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
                    <h1>Add New Product</h1>
                </b>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card card-default">
                    <div class="card-body font">
                        <form method="POST" id="ProductDetails" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group">
                                    <label>Product Name</label>
                                    <input type="text" name="product_name" id="product_name" class="form-control border-1 border-secondary" required placeholder="Product Name">
                                </div>

                                <div class="form-group col-image">
                                    <label>Image</label>
                                    <div class="input-group">
                                        <input type="file" name="product_image" id="product_image" class="form-control border-1 border-secondary" onchange="previewImage();" required>
                                    </div>
                                    <div class="image-preview" id="imagePreview">
                                        <img id="imgPreview" src="#" alt="Image Preview" style="display: none;">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="number" name="product_price" id="price" required placeholder="Price" class="form-control border-1 border-secondary">
                                </div>

                                <div class="form-group">
                                    <label>Description:</label>
                                    <textarea name="product_description" id="description" cols="10" rows="5" class="form-control border-1 border-secondary" required placeholder="Product Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>isFeatured</label>
                                    <input type="number" name="isFeatured" id="isFeatured" required placeholder="0 1 and 2" class="form-control border-1 border-secondary">
                                </div>
                               

                                <div class="form-group">
                                    <input type="submit" value="ADD" name="submit_prod" id="submit" class="btn bg-dark text-white" />
                                    <input type="reset" value="RESET" name="" id="reset" class="btn bg-purple" />
                                </div>
                            </div>
                        </form>
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
