<?php
session_start();
if (isset($_POST['delivery_charge'])) {
    $_SESSION['delivery_charge'] = $_POST['delivery_charge'];
}
?>
