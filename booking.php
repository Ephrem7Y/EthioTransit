<?php

include "config/database.php";

$schedule_id = $_GET['schedule_id'];
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
$booked_query = "
SELECT seat_number
FROM bookings
WHERE schedule_id = ?
";

$booked_stmt = $conn->prepare($booked_query);
$booked_stmt->bind_param("i", $schedule_id);
$booked_stmt->execute();
$booked_result = $booked_stmt->get_result();
$booked_seats = [];
while($seat = $booked_result->fetch_assoc()){
    $booked_seats[] = $seat['seat_number'];
}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Seat</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/booking.css?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  <body>
    <section class="booking-page">
      <a href="javascript:history.back()" class="back-button">← Back</a>
      <div class="booking-container">
        <div class="left-side">
          <h1>
            <?php echo $bus['company_name']; ?>
          </h1>
          <p>
            <?php echo $bus['from_city']; ?>→<?php echo $bus['to_city']; ?>
          </p>
          <div class="seat-legend">
            <div>
              <span class="legend-box available-box"></span>
              Available
            </div>
            <div>
              <span class="legend-box selected-box"></span>
              Selected
            </div>
            <div>
              <span class="legend-box booked-box"></span>
              Unavailable
            </div>
          </div>
          <div class="seat-layout">
            <?php
            $seatNumber = 1;
            for($row = 1; $row <= 8; $row++){
            ?>
            <div class="seat-row">
              <div class="seat-group">
                <?php
                for($left = 0; $left < 2; $left++){
                  $isBooked = in_array($seatNumber, $booked_seats);
                ?>
                <div
                  class="seat <?php echo $isBooked ? 'booked' : ''; ?>"
                  data-seat="<?php echo $seatNumber; ?>"
                >
                  <?php echo $seatNumber; ?>
                </div>
                <?php
                $seatNumber++;
                }
                ?>
              </div>
              <div class="aisle-space"></div>
              <div class="seat-group">
                <?php
                for($right = 0; $right < 2; $right++){
                  $isBooked = in_array($seatNumber, $booked_seats);
                ?>
                <div
                  class="seat <?php echo $isBooked ? 'booked' : ''; ?>"
                  data-seat="<?php echo $seatNumber; ?>"
                >
                  <?php echo $seatNumber; ?>
                </div>
                <?php
                $seatNumber++;
                }
                ?>
              </div>
            </div>
            <?php } ?>
            <div class="back-row">
              <?php
              for($back = 0; $back < 5; $back++){
                $isBooked = in_array($seatNumber, $booked_seats);
              ?>
              <div
                class="seat <?php echo $isBooked ? 'booked' : ''; ?>"
                data-seat="<?php echo $seatNumber; ?>"
              >
                <?php echo $seatNumber; ?>
              </div>
              <?php
              $seatNumber++;}
              ?>
            </div>
          </div>
        </div>
        
        <div class="right-side">
          <h2>Booking Summary</h2>
          <div class="summary-card">
            <div class="summary-row">
              <span>🚌 Bus</span>
              <h3>
                <?php echo $bus['company_name']; ?>
              </h3>
            </div>
            <div class="summary-row">
              <span>📍 Route</span>
              <h3>
                <?php echo $bus['from_city']; ?>→<?php echo $bus['to_city']; ?>
              </h3>
            </div>
            <div class="summary-row">
              <span>🕒 Departure</span>
              <h3>
                <?php echo $bus['departure_time']; ?>
              </h3>
            </div>
            <div class="summary-row">
              <span>💺 Selected Seats</span>
              <h3 id="selectedSeats">None</h3>
            </div>
            <div class="summary-row total-row">
              <span>💰 Total Price</span>
              <h2 id="totalPrice">
                0 ETB
              </h2>
            </div>
          </div>
          <form action="payment.php" method="POST">
            <div id="passengerContainer"></div>
            <input type="hidden" name="schedule_id" value="<?php echo $schedule_id; ?>">
            <input type="hidden" name="seat_numbers" id="seatInput" required>
            <input type="hidden" name="total_price" id="totalPriceInput">
            <button type="submit">Continue To Payment →</button>
          </form>
        </div>
      </div>
    </section>
    
<script>
const seats = document.querySelectorAll(".seat:not(.booked)");

const selectedSeatsText = document.getElementById("selectedSeats");

const totalPriceText = document.getElementById("totalPrice");

const seatInput = document.getElementById("seatInput");

const passengerContainer = document.getElementById("passengerContainer");

const basePrice = <?php echo $bus['price']; ?>;

let selectedSeats = [];

function updateUI(){

selectedSeatsText.innerText =
selectedSeats.length > 0
? selectedSeats.join(", ")
: "None";

seatInput.value = selectedSeats.join(",");

const total = selectedSeats.length * basePrice;

document.getElementById("totalPriceInput").value = total;

totalPriceText.innerText = total + " ETB";

passengerContainer.innerHTML = "";

selectedSeats.forEach((seat) => {

passengerContainer.innerHTML += `

<input
type="text"
name="passenger_names[]"
placeholder="Passenger for Seat ${seat}"
required
class="passenger-input"
>

`;

});

}

seats.forEach(seat => {

seat.addEventListener("click", () => {

const seatNumber = seat.dataset.seat;

if(selectedSeats.includes(seatNumber)){

selectedSeats =
selectedSeats.filter(s => s !== seatNumber);

seat.classList.remove("selected");

}else{

selectedSeats.push(seatNumber);

seat.classList.add("selected");

}

updateUI();

});

});
</script>

  </body>
</html>