<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

$query = "
SELECT *
FROM buses
ORDER BY id DESC
";

$result = $conn->query($query);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Buses</title>
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
                <div class="page-header">
                    <h1>Manage Buses</h1>
                    <a href="add-bus.php" class="add-btn">+ Add Bus</a>
                </div>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Company</th>
                            <th>Total Seats</th>
                            <th>Bus Type</th>
                            <th>Actions</th>
                        </tr>
                        <?php while($bus = $result->fetch_assoc()){ ?>
                        <tr>
                            <td>
                                <?php echo $bus['id']; ?>
                            </td>
                            <td>
                                <?php echo $bus['company_name']; ?>
                            </td>
                            <td>
                                <?php echo $bus['total_seats']; ?>
                            </td>
                            <td>
                                <?php echo $bus['bus_type']; ?>
                            </td>
                            <td>
                                <a href="edit-bus.php?id=<?php echo $bus['id']; ?>" class="edit-btn">Edit</a>
                                <a href="delete-bus.php?id=<?php echo $bus['id']; ?>" class="delete-btn" onclick="return confirm('Delete this bus?')">Delete</a>
                            </td>
                        </tr>
                        <?php } ?>
                    </table>
                </div>
            </div>
        </div>
        
        <script src="../js/admin.js?v=2"></script>
    </body>
</html>