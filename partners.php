<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Partners | EthioTransit</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />

    <link rel="stylesheet" href="css/global.css" />

    <link rel="stylesheet" href="css/partners.css" />

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

    <section class="partners-hero">
      <div class="overlay"></div>

      <div class="hero-content">
        <h1>Our Trusted Partners</h1>

        <p>
          Collaborating with Ethiopia's leading transportation and financial
          institutions.
        </p>
      </div>
    </section>

    <section class="partners-section">
      <div class="partner-card">
        <img
          src="images/buses/golden.jpg"
        />

        <h3>Golden Bus</h3>

        <p>Premium cross-country transportation services.</p>
      </div>

      <div class="partner-card">
        <img
          src="images/buses/selam.jpg"
        />

        <h3>Selam Bus</h3>

        <p>Reliable nationwide travel routes and scheduling.</p>
      </div>

      <div class="partner-card">
        <img
          src="images/buses/sky.jpg"
        />

        <h3>Sky Bus</h3>

        <p>Luxury Ethiopian intercity transportation provider.</p>
      </div>

      <div class="partner-card">
  <img src="images/dashenbank.png">

  <h3>Dashen Bank</h3>

  <p>
    Secure digital banking and online payment integration for EthioTransit users.
  </p>
</div>

<div class="partner-card">
  <img src="images/buses/abay.jpg">

  <h3>Abay Bus</h3>

  <p>
    Comfortable long-distance transportation services across Ethiopia.
  </p>
</div>

<div class="partner-card">
  <img src="https://images.unsplash.com/photo-1494412574643-ff11b0a5c1c3?q=80&w=1200&auto=format&fit=crop">

  <h3>Habesha Breweries</h3>

  <p>
    Supporting national transportation modernization initiatives and tourism.
  </p>
</div>

      <div class="partner-card">
        <img
          src="images/Ethiopia-Commercial-Bank.webp"
        />

        <h3>Commercial Bank of Ethiopia</h3>

        <p>Secure digital payment integration partner.</p>
      </div>

      <div class="partner-card">
        <img
          src="images/Telebirr.png"
        />

        <h3>telebirr</h3>

        <p>Mobile payment and digital transaction support.</p>
      </div>

      <div class="partner-card">
        <img
          src="images/awashbank.jpeg"
        />

        <h3>Awash Bank</h3>

        <p>Modern banking and online transaction services.</p>
      </div>
    </section>

    <footer>
      <h3>EthioTransit</h3>

      <p>Connecting Ethiopia Through Technology</p>
    </footer>

    <script src="js/partners.js"></script>
  </body>
</html>
