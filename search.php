<?php
session_start();
include "navbar.php";
include "dbconnect.php";
?>
<!doctype html>
<html lang="en">

<head>
    <title>Umrii</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet" />
    <script>
        function limitWords(descriptionElement, limit) {
            var words = descriptionElement.textContent.trim().split(/\s+/);
            if (words.length > limit) {
                descriptionElement.textContent = words.slice(0, limit).join(" ") + "...click buy";
            }
        }
    </script>
</head>

<body>
    <?php 
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search'])) {
        $searchTerm = $conn->real_escape_string($_POST['search']);
        $sql = "SELECT * FROM products WHERE product_name LIKE '%$searchTerm%'";
        $result = $conn->query($sql);

        if (!$result) {
            echo "Error: " . $sql . "<br>" . $conn->error;
        } elseif ($result->num_rows > 0) {
            echo "<div class='myorders' style='min-height: 100vh;'>
            <div class='hero-wrap' style='background-image: url(assets/img/background1.jpg);background-size: cover;
            background-repeat: no-repeat;
            background-position: center center;
            padding: 5em 0;
            margin: 0 5%;
            z-index: -1;'>
          <div class='container'>
            <div class='row no-gutters slider-text align-items-center justify-content-center hero-content'>
              <div class='col-md-9 text-center'>
                <h1 class='mb-0 bread'><b>Search</b></h1>
              </div>
            </div>
          </div>
        </div>";
        
            echo "<div class='container d-flex'>";
            while ($row = $result->fetch_assoc()) {
                echo "<div class='card'>";
                echo "<div class='row g-0'>";
                echo "<div class='col-md-4'>";
                echo "<img src='assets/img/{$row['product_image']}' class='img-fluid card-img-top' alt='{$row['product_name']}'>";
                echo "</div>";
                echo "<div class='col-md-8'>";
                echo "<div class='card-body'>";
                echo "<h5 class='card-title'>{$row['product_name']}</h5>";
                echo "<p class='card-text'>{$row['product_description']}</p>";
                echo "<p class='card-text'>Price: Rs. {$row['product_price']}</p>";
                if (isset($_SESSION['email'])) {    
                    echo "<a href='product-detail.php?pid={$row['pid']}' class='btn btn-primary'>Buy</a>";
                } else { 
                    echo "<a href='login.php' class='btn btn-primary'>Buy</a>";
                }
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }
            echo "</div>";
            echo "</div>";
        } else {
            echo "<div class='container'>";
            echo "<p class='text-center'>No results found.</p>";
            echo "</div>";
        }
    }
    ?>
    <!-- Initialize word limit for product descriptions -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var productDescriptions = document.querySelectorAll('.card-text');
            var wordLimit = 20; // Adjust word limit as needed

            productDescriptions.forEach(function(description) {
                limitWords(description, wordLimit);
            });
        });
    </script>

    <?php include "footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
