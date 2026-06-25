<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Services | EthioTransit</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />

    <link rel="stylesheet" href="css/global.css" />

    <link rel="stylesheet" href="css/services.css" />

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

    <section class="services-hero">
      <div class="overlay"></div>

      <div class="hero-content">
        <h1>Our Services</h1>

        <p>
          Premium digital transportation solutions designed for Ethiopian
          travelers.
        </p>
      </div>
    </section>

    <section class="services-grid">
      <div class="service-card">
        <div class="icon">🎫</div>

        <h3>Online Ticket Booking</h3>

        <p>
          Book seats instantly from anywhere in Ethiopia using our digital
          platform.
        </p>
      </div>

      <div class="service-card">
        <div class="icon">💺</div>

        <h3>Interactive Seat Selection</h3>

        <p>
          Choose preferred seats visually with real-time availability updates.
        </p>
      </div>

      <div class="service-card">
        <div class="icon">📍</div>

        <h3>Live Route Tracking</h3>

        <p>View bus departure locations and routes through integrated maps.</p>
      </div>

      <div class="service-card">
        <div class="icon">💳</div>

        <h3>Secure Payments</h3>

        <p>Pay safely using Ethiopian banking systems and mobile payments.</p>
      </div>

      <div class="service-card">
        <div class="icon">⚡</div>

        <h3>Fast Reservations</h3>

        <p>
          Experience smooth booking workflows inspired by modern airline
          systems.
        </p>
      </div>

      <div class="service-card">
        <div class="icon">📱</div>

        <h3>Digital Booking Management</h3>

        <p>Access booking summaries, receipts and travel details anytime.</p>
      </div>
    </section>

    <footer>
      <h3>EthioTransit</h3>

      <p>Modern Ethiopian Transportation Solutions</p>
    </footer>

    <script src="js/services.js"></script>
  </body>
</html>
