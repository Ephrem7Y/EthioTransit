<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $company_name = $_POST['company_name'];
    $total_seats = $_POST['total_seats'];
    $bus_type = $_POST['bus_type'];
    $query = "
    INSERT INTO buses
    (company_name, total_seats, bus_type)
    VALUES (?, ?, ?)
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "sis",
        $company_name,
        $total_seats,
        $bus_type
    );
    $stmt->execute();
    header("Location: manage-buses.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Bus</title>
        <link rel="icon" type="image/jpeg" href="../images/favcon.jpeg" />
        <link rel="stylesheet" href="../css/admin.css?v=4">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    </head>
    
    <body>
        <button class="admin-menu-toggle" id="admin-menu-toggle" aria-label="Open admin navigation" aria-expanded="false">☰</button>
        
        <div class="admin-container">
            <div class="sidebar">
                <h2>Admin Panel</h2>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage-bookings.php">Bookings</a>
                <a href="manage-users.php">Users</a>
                <a href="manage-buses.php" class="active">Buses</a>
                <a href="manage-schedules.php">Schedules</a>
                <a href="admin-logout.php">Logout</a>
            </div>
            
            <div class="main-content">
                <form method="POST" class="admin-form">
                    <h1>Add New Bus</h1>
                    <input type="text" name="company_name" placeholder="Company Name" required>
                    <input type="number" name="total_seats" placeholder="Total Seats" required>
                    <input type="text" name="bus_type" placeholder="Bus Type" required>
                    <button type="submit">Add Bus</button>
                </form>
            </div>
        </div>
        
        <script src="../js/admin.js?v=2"></script>
    </body>
</html>