<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>About Us | EthioTransit</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/aboutUs.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  </head>

  <body>
    <header class="navbar" id="navbar">
      <div class="logo">EthioTransit</div>
      <div class="menu-toggle" id="menu-toggle">☰</div>
      <nav id="mobile-nav">
        <div class="close-menu" id="close-menu">✕</div>
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="my-bookings.php">My Bookings</a></li>
          <li><a href="popular.php">Popular</a></li>
          <li><a href="aboutUs.php">About Us</a></li>
          <li><a href="support.php">Support</a></li>
          <li><a href="partners.php">Partners</a></li>
          <li><a href="services.php">Services</a></li>
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

    <section class="about-hero">
      <div class="overlay"></div>
      <div class="hero-content">
        <span class="hero-badge">
          Ethiopia's Modern Transportation Platform
        </span>
        <h1>About EthioTransit</h1>
        <p>
          Transforming intercity travel across Ethiopia with modern technology,
          comfort, and seamless digital booking experiences.
        </p>
      </div>
    </section>

    <section class="story-section">
      <div class="story-image">
        <img src="images/aboutUs.png"/>
      </div>
      <div class="story-content">
        <span>Who We Are</span>
        <h2>Built For Ethiopian Travelers</h2>
        <p>
          EthioTransit is a modern Ethiopian bus ticket management platform
          designed to simplify intercity transportation. Our system connects
          passengers with trusted bus companies across Ethiopia including Golden
          Bus, Selam Bus, Sky Bus and more.
        </p>
        <p>
          We aim to replace traditional ticket booking systems with a premium
          digital experience inspired by modern airline reservation platforms.
        </p>
      </div>
    </section>

    <section class="mission-section">
      <div class="section-title">
        <h2>Our Mission</h2>
        <p>
          To modernize Ethiopian transportation through accessible technology,
          real-time booking systems and premium passenger experiences.
        </p>
      </div>
      <div class="mission-grid">
        <div class="mission-card">
          <div class="mission-icon">🚌</div>
          <h3>Modern Travel</h3>
          <p>Making bus transportation easier, faster and more comfortable.</p>
        </div>
        <div class="mission-card">
          <div class="mission-icon">📍</div>
          <h3>Nationwide Connectivity</h3>
          <p>
            Connecting cities and regions across Ethiopia through one platform.
          </p>
        </div>
        <div class="mission-card">
          <div class="mission-icon">⚡</div>
          <h3>Fast Booking</h3>
          <p>Providing seamless online booking, seat selection and payment.</p>
        </div>
      </div>
    </section>

    <section class="stats-section">
      <div class="stats-card">
        <h2>20+</h2>
        <p>Bus Companies</p>
      </div>
      <div class="stats-card">
        <h2>40+</h2>
        <p>Ethiopian Cities</p>
      </div>
      <div class="stats-card">
        <h2>10K+</h2>
        <p>Monthly Travelers</p>
      </div>
      <div class="stats-card">
        <h2>24/7</h2>
        <p>Customer Support</p>
      </div>
    </section>

    <footer>
      <div class="footer-content">
        <h3>EthioTransit</h3>
        <p>Modern Ethiopian Intercity Transportation Platform</p>
      </div>
    </footer>

    <script src="js/aboutUs.js"></script>
  </body>
</html>
