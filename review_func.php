<?php
session_start();
include "dbconnect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $product_name = $_POST['product_name'];
    $rating = $_POST['rating'];
    $review = $_POST['review'];
    $product_image = $_FILES["image"]["name"];

    $target_dir = "uploads/"; // Directory where you want to store uploaded images
    $target_file = $target_dir . basename($_FILES["image"]["name"]);

    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO review (name, product_name, rating, review, image) VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiss", $name, $product_name, $rating, $review,$product_image);

        if ($stmt->execute()) {
            $_SESSION['show_popup'] = true;
                header('Location: review.php');
                exit;;
        } else {
            $signup_error['database'] = "Error: " . $stmt->error;
            echo "<script>
                    alert('Error: " . $stmt->error . "');
                </script>";
        }
    $stmt->close();
        // Now you can process/store other form data along with the image path ($target_file)
    } else {
        echo "Sorry, there was an error uploading your file.";
    }

    exit;
    
    
}

?>