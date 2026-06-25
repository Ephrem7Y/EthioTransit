<?php

session_start();

include "../config/database.php";

if(!isset($_SESSION['admin_id'])){
    header("Location: admin-login.php");
    exit();
    }

$query = "
SELECT
bookings.id,
bookings.seat_number,
bookings.passenger_name,
users.full_name as user_name,
payments.amount,
payments.payment_method,
payments.payment_status,
buses.company_name,
routes.from_city,
routes.to_city,
schedules.departure_time

FROM bookings

JOIN users
ON bookings.user_id = users.id

JOIN payments
ON payments.booking_id = bookings.id

JOIN schedules
ON bookings.schedule_id = schedules.id

JOIN buses
ON schedules.bus_id = buses.id

JOIN routes
ON schedules.route_id = routes.id

ORDER BY bookings.id DESC
";

$result = $conn->query($query);

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Manage Bookings</title>
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
                <a href="manage-bookings.php">Bookings</a><a href="manage-users.php">Users</a>
                <a href="manage-buses.php">Buses</a>
                <a href="manage-schedules.php">Schedules</a>
                <a href="../logout.php">Logout</a>
            </div>
            
            <div class="main-content"><h1>Manage Bookings</h1>
                <div class="table-container">
                    <table>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Passenger</th>
                            <th>Bus</th>
                            <th>Route</th>
                            <th>Seat</th>
                            <th>Departure</th>
                            <th>Payment</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        <?php while($booking = $result->fetch_assoc()){ ?>
                        <tr>
                            <td>
                                <?php echo $booking['id']; ?>
                            </td>
                            <td>
                                <?php echo $booking['user_name']; ?>
                            </td>
                            <td>
                                <?php echo $booking['passenger_name']; ?>
                            </td>
                            <td>
                                <?php echo $booking['company_name']; ?>
                            </td>
                            <td>
                                <?php echo $booking['from_city']; ?>→<?php echo $booking['to_city']; ?>
                            </td>
                            <td>
                                <?php echo $booking['seat_number']; ?>
                            </td>
                            <td>
                                <?php echo $booking['departure_time']; ?>
                            </td>
                            <td>
                                <?php echo $booking['amount']; ?> ETB
                            </td>
                            <td>
                                <?php echo $booking['payment_status']; ?>
                            </td>
                            <td>
                                <a href="cancel-booking.php?id=<?php echo $booking['id']; ?>" class="delete-btn" onclick="return confirm('Cancel this booking?')">Cancel</a>
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