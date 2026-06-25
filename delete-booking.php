<?php

session_start();

include "config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: my-bookings.php");
    exit();
}

$booking_id = $_GET['id'];

$user_id = $_SESSION['user_id'];

$query = "
DELETE FROM bookings
WHERE id = ?
AND user_id = ?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("ii", $booking_id, $user_id);

$stmt->execute();

header("Location: my-bookings.php");

exit();

?>