<?php
include '../dbconnect.php';
$pid = $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM products WHERE pid='$pid'");

header('location:manageProd.php?page=notification');
