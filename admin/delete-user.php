<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

$id = $_GET['id'];

$delete_payments = "
DELETE payments
FROM payments
JOIN bookings
ON payments.booking_id = bookings.id
WHERE bookings.user_id = ?
";

$stmt1 = $conn->prepare($delete_payments);
$stmt1->bind_param("i", $id);
$stmt1->execute();

$delete_bookings = "
DELETE FROM bookings
WHERE user_id = ?
";

$stmt2 = $conn->prepare($delete_bookings);
$stmt2->bind_param("i", $id);
$stmt2->execute();

$delete_user = "
DELETE FROM users
WHERE id = ?
";

$stmt3 = $conn->prepare($delete_user);
$stmt3->bind_param("i", $id);
$stmt3->execute();

header("Location: manage-users.php");

?>