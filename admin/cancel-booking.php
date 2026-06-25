<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

$id = $_GET['id'];

$delete_payment = "
DELETE FROM payments
WHERE booking_id = ?
";

$stmt1 = $conn->prepare($delete_payment);
$stmt1->bind_param("i", $id);
$stmt1->execute();

$delete_booking = "
DELETE FROM bookings
WHERE id = ?
";

$stmt2 = $conn->prepare($delete_booking);
$stmt2->bind_param("i", $id);
$stmt2->execute();

header("Location: manage-bookings.php");

?>