<?php
session_start();
include "../dbconnect.php";

$query = "SELECT review_id, name, product_name, image, review, rating
        FROM review ORDER BY review_id DESC;";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Reviews</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/aside.php'; ?>
    <div class="container mt-5">
        <h2>Customer Reviews</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Review ID</th>
                    <th>Name</th>
                    <th>Product</th>
                    <th>Rating</th>
                    <th>Review</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($review = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $review['review_id']; ?></td>
                            <td><?php echo htmlspecialchars($review['name']); ?></td>
                            <td><?php echo htmlspecialchars($review['product_name']); ?></td>
                            <td><?php echo str_repeat('&#9733;', $review['rating']); ?></td>
                            <td><?php echo htmlspecialchars($review['review']); ?></td>
                            <td><img src="../uploads/<?php echo htmlspecialchars($review['image']); ?>" alt="Review Image" style="width: 100px; height: 100px;"></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6">No reviews found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
