<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>EthioTransit</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css" />
    <link rel="stylesheet" href="css/home.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  </head>

  <body>
    <header class="navbar" id="navbar">
      <div class="logo">EthioTransit</div>
      <div class="menu-toggle" id="menu-toggle">☰</div>
      <nav id="mobile-nav">
        <div class="close-menu" id="close-menu">✕</div>
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

    <section class="hero">
      <div class="overlay"></div>

      <div class="hero-content fade-in">
        <span class="hero-badge"> Premium Ethiopian Travel Experience </span>

        <h1>
          Your Journey,<br />
          Elevated.
        </h1>

        <p>
          Discover modern intercity transportation across Ethiopia with luxury
          buses, live schedules, and seamless booking.
        </p>

<form class="search-box" action="search-results.php" method="GET">

  <div class="input-group">
    <label>Leaving From</label>

    <select name="from" required>
      <option value="">City or Station</option>
      <option>Addis Ababa</option>
      <option>Adama</option>
      <option>Dire Dawa</option>
      <option>Hawassa</option>
      <option>Bahir Dar</option>
      <option>Jimma</option>
    </select>
  </div>

  <div class="input-group">
    <label>Going To</label>

    <select name="to" required>
      <option value="">City or Station</option>
      <option>Hawassa</option>
      <option>Dire Dawa</option>
      <option>Bahir Dar</option>
      <option>Jimma</option>
      <option>Adama</option>
      <option>Addis Ababa</option>
    </select>
  </div>

  <div class="input-group">
    <label>Date of Travel</label>

    <input type="date" name="travel_date" required />
  </div>

  <button type="submit">
    Search Buses →
  </button>

</form>
      </div>
    </section>

    <section class="destinations">
      <div class="section-header">
        <div>
          <h2>Explore Ethiopia</h2>

          <p>Premium routes connecting heritage sites and major cities.</p>
        </div>
      </div>

      <div class="destination-grid">
        <div class="destination-card large-card reveal">
          <img
            src="images/addisababa1.jpg"
          />

          <div class="destination-overlay">
            <span>Capital City</span>

            <h3>Addis Ababa</h3>
          </div>
        </div>

        <div class="destination-column">
          <div class="destination-card reveal">
            <img
              src="images/Gondar.jpg"
            />

            <div class="destination-overlay">
              <h3>Gondar</h3>
            </div>
          </div>

          <div class="small-grid">
            <div class="destination-card reveal">
              <img
                src="images/axum.jpg"
              />

              <div class="destination-overlay">
                <h3>Axum</h3>
              </div>
            </div>

            <div class="destination-card reveal">
              <img
                src="images/lalibela.jpg"
              />

              <div class="destination-overlay">
                <h3>Lalibela</h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="features-section">
      <div class="section-title">
        <h2>The EthioTransit Standard</h2>

        <p>
          We bring the rigor and comfort of premium air travel to Ethiopian
          ground transportation.
        </p>
      </div>

      <div class="features-grid">
        <div class="feature-card reveal">
          <div class="feature-icon">✓</div>

          <h3>Uncompromising Safety</h3>

          <p>
            GPS monitored routes, licensed operators, and daily inspections.
          </p>
        </div>

        <div class="feature-card reveal">
          <div class="feature-icon">★</div>

          <h3>Executive Comfort</h3>

          <p>
            Spacious seats, charging ports, WiFi and climate-controlled cabins.
          </p>
        </div>

        <div class="feature-card reveal">
          <div class="feature-icon">⏱</div>

          <h3>Precision Scheduling</h3>

          <p>Live departure tracking with reliable real-time updates.</p>
        </div>
      </div>
    </section>

    <footer id="footer">
      <div class="footer-grid">
        <div>
          <h3>EthioTransit</h3>

          <p>Modern Ethiopian Intercity Bus Booking Platform</p>
        </div>

        <div>
          <h4>Company</h4>

          <p><a href="aboutUs.php">About Us</a></p>

          <p><a href="partners.php">Partners</a></p>

          <p><a href="services.php">Services</a></p>
        </div>

        <div>
          <h4>Support</h4>

          <p><a href="support.php">Contact</a></p>

          <p><a href="support.php">FAQ</a></p>

          <?php if(isset($_SESSION['user_id'])){ ?>

<p>
  <a href="my-bookings.php">
    Track Bus
  </a>
</p>

<?php } else { ?>

<p>
  <a href="login.php?message=login_required">
    Track Bus
  </a>
</p>

<?php } ?>
        </div>
      </div>

      <div class="footer-bottom">
        <p>&copy; 2026 EthioTransit. All rights reserved.</p>
      </div>

    </footer>

    <script src="js/home.js"></script>
  </body>
</html>
