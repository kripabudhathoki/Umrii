<?php

$username = "root";
    $password = "";
    $server = "localhost";
    $database = "umrii";
    $conn = mysqli_connect($server, $username, $password, $database);
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
        }
?>