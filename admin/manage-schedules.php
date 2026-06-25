<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){

header("Location: admin-login.php");

exit();

}

$query = "
SELECT
    schedules.*,
    buses.company_name,
    routes.from_city,
    routes.to_city

FROM schedules

JOIN buses
ON schedules.bus_id = buses.id

JOIN routes
ON schedules.route_id = routes.id

ORDER BY schedules.departure_date DESC
";

$result = mysqli_query($conn, $query);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Schedules</title>
        <link rel="icon" type="image/jpeg" href="../images/favcon.jpeg" />
        <link rel="stylesheet" href="../css/global.css">
        <link rel="stylesheet" href="../css/admin.css?v=4">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <button class="admin-menu-toggle" id="admin-menu-toggle" aria-label="Open admin navigation" aria-expanded="false">☰</button>
        <div class="admin-container">
            <div class="sidebar">
                <h2>Admin Panel</h2>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage-users.php">Manage Users</a>
                <a href="manage-buses.php">Manage Buses</a>
                <a href="manage-schedules.php" class="active">Manage Schedules</a>
                <a href="manage-bookings.php">Manage Bookings</a>
                <a href="admin-logout.php">Logout</a>
            </div>
            
            <div class="content">
                <div class="page-header">
                    <h1>Manage Schedules</h1>
                    <a href="add-schedule.php" class="add-btn">+ Add Schedule</a>
                </div>
                <div class="table-card">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Bus</th><th>Route</th>
                                <th>Date</th>
                                <th>Departure</th>
                                <th>Arrival</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while($schedule = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                                <td>
                                    <?php echo $schedule['id']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['company_name']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['from_city']; ?>
                                    →
                                    <?php echo $schedule['to_city']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['departure_date']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['departure_time']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['arrival_time']; ?>
                                </td>
                                <td>
                                    <?php echo $schedule['price']; ?> ETB
                                </td>
                                <td class="schedule-actions">
                                    <a href="edit-schedule.php?id=<?php echo $schedule['id']; ?>" class="edit-btn">Edit</a>
                                    <a href="delete-schedule.php?id=<?php echo $schedule['id']; ?>" class="delete-btn" onclick="return confirm('Delete this schedule?')">Delete</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <script src="../js/admin.js?v=2"></script>
    </body>
</html>