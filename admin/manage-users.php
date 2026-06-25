<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

$query = "
SELECT *
FROM users
ORDER BY id DESC
";

$result = $conn->query($query);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Users</title>
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
                <h1>Manage Users</h1>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        <?php while($user = $result->fetch_assoc()){ ?>
                        <tr>
                            <td>
                                <?php echo $user['id']; ?>
                            </td>
                            <td>
                                <?php echo $user['full_name']; ?>
                            </td>
                            <td>
                                <?php echo $user['email']; ?>
                            </td>
                            <td>
                                <?php echo $user['phone']; ?>
                            </td>
                            <td>
                                <a href="delete-user.php?id=<?php echo $user['id']; ?>" class="delete-btn" onclick="return confirm('Delete this user?')">Delete</a>
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