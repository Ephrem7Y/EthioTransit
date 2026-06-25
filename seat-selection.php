<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Select Seats</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/seat-selection.css" />
  </head>

  <body>
    <div class="top-bar">
      <button class="back-btn" onclick="goBack()">← Back</button>
      <h2>Select Your Seats</h2>
    </div>
    <div class="seat-page">
      <div class="seat-left">
        <div class="legend">
          <div>
            <span class="box available"></span>
            Available
          </div>

          <div>
            <span class="box selected"></span>
            Selected
          </div>

          <div>
            <span class="box occupied"></span>
            Occupied
          </div>
        </div>

        <div class="bus-layout">
          <div class="driver">🚌 Driver</div>

          <div class="seats" id="seatContainer"></div>
        </div>
      </div>

      <div class="summary-panel">
        <h1>Booking Summary</h1>

        <div class="summary-box">
          <div class="summary-item">
            <small>Operator</small>
            <h3 id="companyName">Golden Bus</h3>
          </div>

          <div class="summary-item">
            <small>Route</small>
            <h3 id="routeName">Addis → Hawassa</h3>
          </div>

          <div class="summary-item">
            <small>Departure</small>
            <h3>
              <span id="departureDate"></span>•<span id="departureTime">07:00 AM</span>
            </h3>
          </div>

          <hr />

          <div class="seat-summary-header">
            <h3>Selected Seats</h3>
            <span id="seatCount">0</span>
          </div>

          <div id="selectedSeats"></div>

          <hr />

          <div class="price-row">
            <p>Base Fare</p>
            <h3 id="baseFare">0 ETB</h3>
          </div>

          <div class="price-row">
            <p>Service Fee</p>
            <h3>50 ETB</h3>
          </div>

          <div class="price-row total">
            <p>Total</p>
            <h2 id="totalPrice">0 ETB</h2>
          </div>

          <button class="continue-btn" id="continuePaymentBtn">Continue To Payment →</button>
        </div>
      </div>
    </div>

    <script src="js/seat-selection.js"></script>
  </body>
</html>
