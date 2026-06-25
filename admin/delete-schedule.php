<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: manage-schedules.php");
    exit();
}

$schedule_id = $_GET['id'];

$query = "
DELETE FROM schedules
WHERE id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $schedule_id);
$stmt->execute();

header("Location: manage-schedules.php");

exit();

?>