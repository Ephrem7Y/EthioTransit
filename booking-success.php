<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$bus = $_GET['bus'];
$from = $_GET['from'];
$to = $_GET['to'];
$departure = $_GET['departure'];
$seats = $_GET['seats'];
$total = $_GET['total'];
$payment = $_GET['payment'];
$phone = $_GET['phone'];
$booking_id = "ETH".rand(100000,999999);
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Booking Success</title>
        <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
        <link rel="stylesheet" href="css/booking-success.css">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    </head>
    
    <body>
        <section class="success-page">
            <div class="ticket-card">
                <div class="success-icon">✓</div>
                <h1>Booking Confirmed</h1>
                <p class="subtitle">Your ticket has been successfully booked.</p>
                <div class="ticket-body">
                    <div class="ticket-row">
                        <span>Booking ID</span>
                        <strong><?php echo $booking_id; ?></strong>
                    </div>
                    <div class="ticket-row">
                        <span>Bus Operator</span>
                        <strong><?php echo $bus; ?></strong>
                    </div>
                    <div class="ticket-row">
                        <span>Route</span>
                        <strong>
                            <?php echo $from; ?>
                            →
                            <?php echo $to; ?>
                        </strong>
                    </div>
                    <div class="ticket-row">
                        <span>Departure</span>
                        <strong><?php echo $departure; ?></strong>
                    </div>
                    <div class="ticket-row">
                        <span>Seats</span>
                        <strong><?php echo $seats; ?></strong>
                    </div>
                    <div class="ticket-row">
                        <span>Payment Method</span>
                        <strong><?php echo $payment; ?></strong>
                    </div>
                    <div class="ticket-row">
                        <span>Phone Number</span>
                        <strong><?php echo $phone; ?></strong>
                    </div>
                    <div class="ticket-row total">
                        <span>Total Paid</span>
                        <strong>
                            <?php echo $total; ?> ETB
                        </strong>
                    </div>
                </div>
            </div>

            <div class="ticket-footer">
                <button onclick="window.print()">
                    Print Ticket
                </button>
                <a href="index.php">
                    <button class="home-btn">
                        Return Home
                    </button>
                </a>
            </div>
        </section>
    </body>
</html>