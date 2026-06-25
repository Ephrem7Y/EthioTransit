<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Popular Routes | EthioTransit</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />

    <link rel="stylesheet" href="css/global.css" />

    <link rel="stylesheet" href="css/popular.css" />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <header class="navbar" id="navbar">

  <div class="logo">
    EthioTransit
  </div>

  <div class="menu-toggle" id="menu-toggle">
    ☰
  </div>

  <nav id="mobile-nav">

    <div class="close-menu" id="close-menu">
      ✕
    </div>

    <ul>
      <li>
        <a href="index.php">Home</a>
      </li>

      <li>
        <a href="my-bookings.php">My Bookings</a>
      </li>

      <li>
        <a href="popular.php">Popular</a>
      </li>

      <li>
        <a href="aboutUs.php">About Us</a>
      </li>

      <li>
        <a href="support.php">Support</a>
      </li>

      <li>
        <a href="partners.php">Partners</a>
      </li>

      <li>
        <a href="services.php">Services</a>
      </li>
    </ul>

<div class="nav-buttons mobile-buttons">

<?php if(isset($_SESSION['user_id'])){ ?>

  <span class="welcome-user">
    Hi, <?php echo $_SESSION['full_name']; ?>
  </span>

  <a href="logout.php">
    <button class="btn-outline">Logout</button>
  </a>

<?php } else { ?>

  <a href="login.php">
    <button class="btn-outline">Login</button>
  </a>

  <a href="register.php">
    <button class="btn-primary">Sign Up</button>
  </a>

<?php } ?>

</div>

  </nav>

</header>

    <section class="popular-hero">
      <div class="overlay"></div>

      <div class="hero-content">
        <span>Top Ethiopian Destinations</span>

        <h1>Most Popular Routes</h1>

        <p>
          Explore Ethiopia’s most traveled and premium intercity destinations.
        </p>
      </div>
    </section>

    <section class="routes-section">

<?php

include "config/database.php";

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

ORDER BY schedules.price ASC
LIMIT 6
";

$result = mysqli_query($conn, $query);

while($route = mysqli_fetch_assoc($result)){

?>

<div class="route-card">

<img
src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?q=80&w=1200&auto=format&fit=crop"
>

<div class="route-info">

<h2>

<?php echo $route['from_city']; ?>

→

<?php echo $route['to_city']; ?>

</h2>

<p>

Travel comfortably with
<strong>
<?php echo $route['company_name']; ?>
</strong>

premium bus services.

</p>

<div class="route-stats">

<span>
<?php echo $route['departure_time']; ?>
</span>

<span>
<?php echo $route['price']; ?> ETB
</span>

<span>
<?php echo $route['departure_date']; ?>
</span>

</div>

<a
href="search-results.php?from=<?php echo urlencode($route['from_city']); ?>&to=<?php echo urlencode($route['to_city']); ?>&travel_date=<?php echo $route['departure_date']; ?>"
>

<button>
Explore Route
</button>

</a>

</div>

</div>

<?php } ?>

</section>

    <footer>
      <h3>EthioTransit</h3>

      <p>Premium Ethiopian Intercity Transportation</p>
    </footer>

    <script src="js/popular.js"></script>
  </body>
</html>
