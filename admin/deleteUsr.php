<?php
include '../dbconnect.php';
$uid = $_GET['id'];

$q = mysqli_query($conn, "DELETE FROM users where uid='$uid'");

header('location:manageUsr.php?page=manage_users');
