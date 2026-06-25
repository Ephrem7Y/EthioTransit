<?php

include "config/database.php";

$schedule_id = $_GET['schedule_id'];

$query = "
SELECT
    schedules.*,
    buses.company_name,
    buses.bus_type,
    buses.image,

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
    <title>Bus Details</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/bus-details.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  </head>
  
  <body>
    <header class="navbar">
      <div class="logo">EthioTransit</div>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="search-results.php">Back</a></li>
        </ul>
      </nav>
    </header>
    
    <section class="details-hero">
        <div class="details-card">
          <div class="image-side">
            <img src="<?php echo $bus['image']; ?>">
          </div>
          <div class="info-side">
            <span class="bus-badge">
              Premium Ethiopian Travel
            </span>
            <h1>
              <?php echo $bus['company_name']; ?>
            </h1>
            <p class="route">
              <?php echo $bus['from_city']; ?>
              →
              <?php echo $bus['to_city']; ?>
            </p>
            <div class="detail-grid">
              <div class="detail-box">
                <h3>Departure</h3>
                <p><?php echo $bus['departure_time']; ?></p>
              </div>
              <div class="detail-box">
                <h3>Arrival</h3>
                <p><?php echo $bus['arrival_time']; ?></p>
              </div>
              <div class="detail-box">
                <h3>Bus Type</h3>
                <p><?php echo $bus['bus_type']; ?></p>
              </div>
              <div class="detail-box">
                <h3>Price</h3>
                <p><?php echo $bus['price']; ?> ETB</p>
              </div>
            </div>
            <div class="amenities">
              <span>WiFi</span>
              <span>Charging Port</span>
              <span>Air Conditioning</span>
              <span>Reclining Seats</span>
            </div>
            <a href="booking.php?schedule_id=<?php echo $schedule_id; ?>">
              <button class="book-btn">Book Seat</button>
            </a>
          </div>
        </div>
      </section>
      
      <section class="map-section">
        <h2>Route Map</h2>
        <div class="map-container">
          <iframe
            src="https://maps.google.com/maps?q=<?php echo urlencode($bus['from_city']); ?> Ethiopia to <?php echo urlencode($bus['to_city']); ?> Ethiopia&output=embed"
            width="100%"
            height="450"
            style="border:0;"
            allowfullscreen=""
            loading="lazy">
          </iframe>
        </div>
      </section>
    </body>
</html>