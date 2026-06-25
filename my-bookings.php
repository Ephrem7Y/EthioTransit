<?php

session_start();

include "config/database.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$query = "
SELECT
    bookings.*,
    payments.amount,
    payments.payment_method,
    schedules.departure_date,
    schedules.departure_time,
    buses.company_name,
    routes.from_city,
    routes.to_city

FROM bookings

JOIN payments
ON bookings.id = payments.booking_id

JOIN schedules
ON bookings.schedule_id = schedules.id

JOIN buses
ON schedules.bus_id = buses.id

JOIN routes
ON schedules.route_id = routes.id

WHERE bookings.user_id = ?

ORDER BY bookings.id DESC
";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Bookings</title>
        <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
        <link rel="stylesheet" href="css/my-bookings.css?v=3">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    </head>
    
    <body>
        <div class="bookings-page">
            <div class="top-bar">
                <h1>My Bookings</h1>
                <a href="index.php">← Back Home</a>
            </div>
            
            <div class="bookings-grid">
                <?php while($booking = $result->fetch_assoc()){ ?>
                <div class="booking-card">
                    <div class="card-top">
                        <h2>
                            <?php echo $booking['company_name']; ?>
                        </h2>

                        <span>
                            Seat <?php echo $booking['seat_number']; ?>
                        </span>
                    </div>
                    <div class="route">
                        <?php echo $booking['from_city']; ?>
                        →
                        <?php echo $booking['to_city']; ?>
                    </div>
                    <div class="booking-info">
                        <p>
                            🧍 Passenger:
                            <strong>
                                <?php echo $booking['passenger_name']; ?>
                            </strong>
                        </p>
                        <p>
                            🕒 Departure:
                            <strong>
                                <?php echo date("M d, Y", strtotime($booking["departure_date"])); ?>
                                -
                                <?php echo $booking["departure_time"]; ?>
                            </strong>
                        </p>
                        <p>
                            💳 Payment:
                            <strong>
                                <?php echo $booking['payment_method']; ?>
                            </strong>
                        </p>
                        <p>
                            💰 Amount:
                            <strong>
                                <?php echo $booking['amount']; ?> ETB
                            </strong>
                        </p>
                    </div>
                    <div class="booking-actions">
                        <a 
                            href="delete-booking.php?id=<?php echo $booking['id']; ?>" 
                            class="delete-booking-btn" 
                            onclick="return confirm('Cancel this booking?')"
                        >
                            Cancel Booking
                        </a>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>