<?php
include '../dbconnect.php';
$uid = $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM orders where id='$uid'");

header('location:manageorder.php?page=manage_orders');
