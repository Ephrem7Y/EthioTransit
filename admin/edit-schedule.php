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
SELECT *
FROM schedules
WHERE id = ?
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $schedule_id);
$stmt->execute();
$result = $stmt->get_result();
$schedule = $result->fetch_assoc();

if(!$schedule){
    header("Location: manage-schedules.php");
    exit();
}

$buses_query = "
SELECT *
FROM buses
ORDER BY company_name ASC
";

$buses_result = mysqli_query($conn, $buses_query);

$routes_query = "
SELECT *
FROM routes
ORDER BY from_city ASC
";

$routes_result = mysqli_query($conn, $routes_query);

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $bus_id = $_POST['bus_id'];
    $route_id = $_POST['route_id'];
    $departure_date = $_POST['departure_date'];
    $departure_time = $_POST['departure_time'];
    $arrival_time = $_POST['arrival_time'];
    $price = $_POST['price'];
    $update_query = "
    UPDATE schedules
    SET
    bus_id = ?,
    route_id = ?,
    departure_date = ?,
    departure_time = ?,
    arrival_time = ?,
    price = ?
    WHERE id = ?
    ";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param(
        "iisssdi",
        $bus_id,
        $route_id,
        $departure_date,
        $departure_time,
        $arrival_time,
        $price,
        $schedule_id
    );
    $update_stmt->execute();
    header("Location: manage-schedules.php");
    exit();
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Schedule</title>
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
                <a href="manage-buses.php">Manage Buses</a>
                <a href="manage-schedules.php" class="active">Manage Schedules</a>
                <a href="manage-bookings.php">Manage Bookings</a>
                <a href="admin-logout.php">Logout</a>
            </div>

            <div class="admin-content">
                <div class="page-header">
                    <h1>Edit Schedule</h1>
                    <a href="manage-schedules.php" class="back-btn">← Back</a>
                </div>

                <div class="form-card">
                    <form method="POST">
                        <div class="form-group">
                            <label>Select Bus</label>
                            <select name="bus_id" required>
                                <?php while($bus = mysqli_fetch_assoc($buses_result)){ ?>
                                <option 
                                    value="<?php echo $bus['id']; ?>"
                                    <?php if($bus['id'] == $schedule['bus_id']) echo "selected"; ?>
                                >
                                    <?php echo $bus['company_name']; ?>
                                    (<?php echo $bus['bus_type']; ?>)
                                </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Select Route</label>
                            <select name="route_id" required>
                                <?php while($route = mysqli_fetch_assoc($routes_result)){ ?>
                            <option
                                value="<?php echo $route['id']; ?>"
                                <?php if($route['id'] == $schedule['route_id']) echo "selected"; ?>
                            >
                                <?php echo $route['from_city']; ?>
                                →
                                <?php echo $route['to_city']; ?>
                            </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Departure Date</label>
                        <input type="date" name="departure_date" value="<?php echo $schedule['departure_date']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Departure Time</label>
                        <input type="time" name="departure_time" value="<?php echo $schedule['departure_time']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Arrival Time</label>
                        <input type="time" name="arrival_time" value="<?php echo $schedule['arrival_time']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label>Ticket Price (ETB)</label>
                        <input type="number" step="0.01" name="price" value="<?php echo $schedule['price']; ?>" required>
                    </div>
                    <button type="submit" class="save-btn">Save Changes</button>
                </form>
            </div>
        </div>
    </div>
    
    <script src="../js/admin.js?v=2"></script>
</body>
</html>