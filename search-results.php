<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "config/database.php";

$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$travel_date = $_GET['travel_date'] ?? '';

$query = "
SELECT
    schedules.id AS schedule_id,
    buses.company_name,
    buses.bus_type,
    buses.image,

    routes.from_city,
    routes.to_city,

    schedules.departure_date,
    schedules.departure_time,
    schedules.arrival_time,
    schedules.price

FROM schedules

JOIN buses
ON schedules.bus_id = buses.id

JOIN routes
ON schedules.route_id = routes.id

WHERE routes.from_city = ?
AND routes.to_city = ?
AND schedules.departure_date = ?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("sss", $from, $to, $travel_date);

$stmt->execute();

$result = $stmt->get_result();

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Results</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/results.css">
  </head>

  <body>
    <header class="navbar small-nav">
      <div class="logo">EthioTransit</div>
      <nav>
        <ul>
          <li><a href="index.php">Home</a></li>
        </ul>
      </nav>
    </header>
    
    <section class="results-header">
      <h1>Available Buses</h1>
      <p>
        <?php echo $from; ?>
        →
        <?php echo $to; ?>
      </p>
    </section>

    <section class="results-container">
      <?php
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
            ?>
            <div class="bus-card">
              <img src="<?php echo $row['image']; ?>">
              <div class="bus-info">
                <h2>
                  <?php echo $row['company_name']; ?>
                </h2> 
                <p>
                  <?php echo $row['from_city']; ?>
                  →
                  <?php echo $row['to_city']; ?>
                </p>
                <p>
                  Departure:
                  <?php echo $row['departure_time']; ?>
                </p>
                <p>
                  Arrival:
                  <?php echo $row['arrival_time']; ?>
                </p>
                <p>
                  <?php echo $row['bus_type']; ?>
                </p>
              </div>

              <div class="price-box">
                <h2>
                  <?php echo $row['price']; ?> ETB
                </h2>
                <a href="
                  bus-details.php?schedule_id=<?php echo $row['schedule_id']; ?>
                ">
                  <button>
                    View Details
                  </button>
                </a>
              </div>
            </div>
            <?php
          }
          } else {
            ?>
            <h2>No buses found.</h2>
            <?php } ?>
    </section>
  </body>
</html>