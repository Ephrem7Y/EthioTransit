<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
}

if(!isset($_GET['id'])){
    header("Location: manage-buses.php");
    exit();
}

$bus_id = $_GET['id'];

$query = "
SELECT *
FROM buses
WHERE id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$result = $stmt->get_result();
$bus = $result->fetch_assoc();

if(!$bus){
    header("Location: manage-buses.php");
    exit();
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $company_name = $_POST['company_name'];
    $bus_type = $_POST['bus_type'];
    $total_seats = $_POST['total_seats'];
    $update_query = "
    UPDATE buses
    SET
    company_name = ?,
    bus_type = ?,
    total_seats = ?
    WHERE id = ?
    ";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param(
        "ssii",
        $company_name,
        $bus_type,
        $total_seats,
        $bus_id
    );
    $update_stmt->execute();
    header("Location: manage-buses.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Bus</title>
        <link rel="icon" type="image/jpeg" href="../images/favcon.jpeg" />
        <link rel="stylesheet" href="../css/global.css">
        <link rel="stylesheet" href="../css/admin.css?v=4">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <button class="admin-menu-toggle" id="admin-menu-toggle" aria-label="Open admin navigation" aria-expanded="false">☰</button>
        <div class="admin-container">
            <div class="admin-sidebar">
                <h2>Admin Panel</h2>
                <a href="dashboard.php">Dashboard</a>
                <a href="manage-users.php">Manage Users</a>
                <a href="manage-buses.php" class="active">Manage Buses</a>
                <a href="manage-bookings.php">Manage Bookings</a>
                <a href="admin-logout.php">Logout</a>
            </div>
            
            <div class="admin-content">
                <div class="page-header">
                    <h1>Edit Bus</h1>
                    <a href="manage-buses.php" class="back-btn">← Back</a>
                </div>
                <div class="form-card">
                    <form method="POST">
                        <div class="form-group">
                            <label>Company Name</label>
                            <input type="text" name="company_name" value="<?php echo $bus['company_name']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Bus Type</label>
                            <input type="text" name="bus_type" value="<?php echo $bus['bus_type']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label>Total Seats</label>
                            <input type="number" name="total_seats" value="<?php echo $bus['total_seats']; ?>" required>
                        </div>
                        <button type="submit" class="save-btn">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
        
        <script src="../js/admin.js?v=2"></script>
    </body>
</html>