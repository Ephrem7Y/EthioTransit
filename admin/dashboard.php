<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

$users = $conn->query("SELECT COUNT(*) as total FROM users")->fetch_assoc()['total'];
$bookings = $conn->query("SELECT COUNT(*) as total FROM bookings")->fetch_assoc()['total'];
$payments = $conn->query("SELECT SUM(amount) as total FROM payments")->fetch_assoc()['total'];

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Dashboard</title>
        <link rel="icon" type="image/jpeg" href="../images/favcon.jpeg" />
        <link rel="stylesheet" href="../css/admin.css?v=4">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    </head>
    
    <body>
        <button class="admin-menu-toggle" id="admin-menu-toggle" aria-label="Open admin navigation" aria-expanded="false">☰</button>
        <div class="admin-container">
            <div class="sidebar">
                <h2>EthioTransit</h2>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage-bookings.php">Bookings</a>
                <a href="manage-users.php">Users</a>
                <a href="manage-buses.php">Buses</a>
                <a href="manage-schedules.php">Schedules</a>
                <a href="../logout.php">Logout</a>
            </div>

            <div class="main-content">
                <div class="top-bar">
                    <h1>Welcome, <?php echo $_SESSION['admin_name']; ?></h1>
                    <a href="admin-logout.php" class="logout-btn">Logout</a>
                </div>
                <div class="stats-grid">
                    <div class="stat-card">
                        <h3>Total Users</h3>
                        <h2><?php echo $users; ?></h2>
                    </div>
                    <div class="stat-card">
                        <h3>Total Bookings</h3>
                        <h2><?php echo $bookings; ?></h2>
                    </div>
                    <div class="stat-card">
                        <h3>Total Revenue</h3>
                        <h2><?php echo $payments ? $payments : 0; ?> ETB</h2>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="../js/admin.js?v=2"></script>
    </body>
</html>