<?php
session_start();
include('dbconnect.php'); // Include your database connection script

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Check if the user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

// Fetch current user ID from session
$userId = $_SESSION['uid'];

// Initialize error array
$errors = [];

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $email = trim($_POST['email']);
    $username = trim($_POST['username']);
    $firstName = trim($_POST['first_name']);
    $lastName = trim($_POST['last_name']);
    $phoneNumber = trim($_POST['phone_number']);
    $address = trim($_POST['address']);

    // Validate form data
    if (empty($email)) {
        $errors[] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Invalid email format.';
    }

    if (empty($username)) {
        $errors[] = 'Username is required.';
    }

    if (empty($firstName)) {
        $errors[] = 'First name is required.';
    }

    if (empty($lastName)) {
        $errors[] = 'Last name is required.';
    }

    if (empty($phoneNumber)) {
        $errors[] = 'Phone number is required.';
    } elseif (!preg_match('/^\d{10,}$/', $phoneNumber)) {
        $errors[] = 'Phone number must be at least 10 digits.';
    }

    if (empty($address)) {
        $errors[] = 'Address is required.';
    }

    // Check for uniqueness of email and username
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT uid FROM users WHERE (email = ? OR username = ?) AND uid != ?");
        $stmt->bind_param("ssi", $email, $username, $userId);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $errors[] = 'Email or Username already exists.';
        }
        $stmt->close();
    }

    // If no errors, update the database
    if (empty($errors)) {
        $stmt = $conn->prepare("UPDATE users SET email = ?, username = ?, fname = ?, lname = ?, phone = ?, address = ? WHERE uid = ?");
        $stmt->bind_param("ssssssi", $email, $username, $firstName, $lastName, $phoneNumber, $address, $userId);

        if ($stmt->execute()) {
            // Update session data
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['fname'] = $firstName;
            $_SESSION['lname'] = $lastName;
            $_SESSION['phone'] = $phoneNumber;
            $_SESSION['address'] = $address;

            // Redirect to profile page with success message
            header('Location: myprofile.php?success=1');
            exit;
        } else {
            $errors[] = 'Failed to update profile. Please try again.';
        }

        $stmt->close();
    }
}

// Handle errors: display alert and redirect
if (!empty($errors)) {
    $errorMessage = implode('\n', $errors);
    echo "<script>
        alert('$errorMessage');
        window.location.href = 'myprofile.php';
    </script>";
    exit;
}
?>
