<?php

session_start();

include "config/database.php";

$schedule_id = $_POST['schedule_id'];

$seat_numbers = $_POST['seat_numbers'];

$total_price = $_POST['total_price'];

$passenger_names = $_POST['passenger_names'];

if(!isset($_SESSION['user_id'])){

$_SESSION['booking_data'] = $_POST;

header("Location: login.php?message=login_required");

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

WHERE schedules.id = ?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("i", $schedule_id);

$stmt->execute();

$result = $stmt->get_result();

$bus = $result->fetch_assoc();

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Payment</title>
        <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
        <link rel="stylesheet" href="css/payment.css?v=3">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <section class="payment-page">
            <div class="payment-container">
                <div class="payment-left">
                    <a href="javascript:history.back()" class="back-button">← Back</a>
                    <h1>Secure Payment</h1>
                    <div class="payment-summary">
                        <div class="summary-row">
                            <span>🚌 Bus</span>
                            <h3><?php echo $bus['company_name']; ?></h3>
                        </div>
                        <div class="summary-row">
                            <span>📍 Route</span>
                            <h3>
                                <?php echo $bus['from_city']; ?>
                                →
                                <?php echo $bus['to_city']; ?>
                            </h3>
                        </div>
                        <div class="summary-row">
                            <span>🕒 Departure</span>
                            <h3><?php echo $bus['departure_time']; ?></h3>
                        </div>

                        <div class="summary-row">
                            <span>💺 Seats</span>
                            <h3><?php echo $seat_numbers; ?></h3>
                        </div>
                        <div class="summary-passengers">
                            <h3>Passengers</h3>
                            <?php
                            foreach($passenger_names as $index => $name){
                                $seat_array = explode(",", $seat_numbers);
                                echo "
                                <p>
                                Seat {$seat_array[$index]}
                                - {$name}
                                </p>
                                ";
                            }
                            ?>
                        </div>
                        
                        <div class="summary-total">
                            <h2>Total</h2>
                            <h1><?php echo $total_price; ?> ETB</h1>
                        </div>
                    </div>
                </div>
                <div class="payment-right">
                    <form action="save-booking.php" method="POST">
                        <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
                        <input type="hidden" name="seat_numbers" value="<?php echo $seat_numbers; ?>">
                        <input type="hidden" name="total_price" value="<?php echo $total_price; ?>">
                        <?php
                        foreach($passenger_names as $name){
                            echo '
                            <input
                            type="hidden"
                            name="passenger_names[]"
                            value="'.$name.'"
                            >
                            ';
                        }
                        ?>
                        <h2>Select Payment Method</h2>
                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="Telebirr" checked>
                                Telebirr
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="CBE Birr">
                                CBE Birr
                            </label>

                            <label class="payment-option">
                                <input type="radio" name="payment_method" value="Awash Bank">
                                Awash Bank
                            </label>
                        </div>
                        <input type="text" name="phone" placeholder="Enter Phone Number" required class="payment-input">
                        <button type="submit">
                        Pay <?php echo $total_price; ?> ETB
                        </button>
                    </form>
                </div>
            </div>
        </section>
    </body>
</html>