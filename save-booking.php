<?php

session_start();

include "config/database.php";

$schedule_id = $_POST['schedule_id'];

$seat_numbers = $_POST['seat_numbers'];

$passenger_names = $_POST['passenger_names'];

$payment_method = $_POST['payment_method'];

$amount = $_POST['total_price'];

$phone = $_POST['phone'];

if(!isset($_SESSION['user_id'])){

    header("Location: login.php");

    exit();

}

$user_id = $_SESSION['user_id'];

$seats_array = explode(",", $seat_numbers);

foreach($seats_array as $index => $seat_number){

$passenger_name = $passenger_names[$index];

$booking_query = "
INSERT INTO bookings
(user_id, schedule_id, seat_number, passenger_name)

VALUES (?, ?, ?, ?)
";

$booking_stmt = $conn->prepare($booking_query);

$booking_stmt->bind_param(
    "iiis",
    $user_id,
    $schedule_id,
    $seat_number,
    $passenger_name
);

$booking_stmt->execute();

$booking_id = $conn->insert_id;

$payment_query = "
INSERT INTO payments
(user_id, booking_id, amount, payment_method, payment_status)

VALUES (?, ?, ?, ?, ?)
";

$payment_status = "Paid";

$payment_stmt = $conn->prepare($payment_query);

$payment_stmt->bind_param(
    "iidss",
    $user_id,
    $booking_id,
    $amount,
    $payment_method,
    $payment_status
);

$payment_stmt->execute();

}

$details_query = "
SELECT
    buses.company_name,
    routes.from_city,
    routes.to_city,
    schedules.departure_time

FROM schedules

JOIN buses
ON schedules.bus_id = buses.id

JOIN routes
ON schedules.route_id = routes.id

WHERE schedules.id = ?
";

$details_stmt = $conn->prepare($details_query);

$details_stmt->bind_param("i", $schedule_id);

$details_stmt->execute();

$details_result = $details_stmt->get_result();

$details = $details_result->fetch_assoc();

$bus_name = urlencode($details['company_name']);

$from_city = urlencode($details['from_city']);

$to_city = urlencode($details['to_city']);

$departure_time = urlencode($details['departure_time']);

$url = "booking-success.php?" .
"bus=".$bus_name .
"&from=".$from_city .
"&to=".$to_city .
"&departure=".$departure_time .
"&seats=".$seat_numbers .
"&total=".$amount .
"&payment=".$payment_method .
"&phone=".$phone;

header("Location: $url");

exit();

?>