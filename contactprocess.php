
<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection file
    include('dbconnect.php');

    // Get form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    // SQL query to insert data into the 'contact' table
    $sql = "INSERT INTO contact (name, email, message) VALUES ('$name', '$email', '$message')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        header("Location: contact.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
