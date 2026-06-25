<?php
session_start();
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Support | EthioTransit</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />

    <link rel="stylesheet" href="css/global.css" />

    <link rel="stylesheet" href="css/support.css?v=2" />

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

    <section class="support-hero">
      <div class="overlay"></div>

      <div class="support-content">
        <h1>How Can We Help?</h1>

        <p>
          Our support team is available to assist you anytime across Ethiopia.
        </p>
      </div>
    </section>

    <section class="support-grid">
      <div class="support-card">
        <div class="icon">☎</div>

        <h2>Call Support</h2>

        <p>+251 911 223 344</p>
      </div>

      <a
        class="support-card support-card-link"
        href="https://mail.google.com/mail/?view=cm&fs=1&to=support@ethiotransit.com"
        target="_blank"
        rel="noopener"
      >
        <div class="icon">✉</div>

        <h2>Email Us</h2>

        <p>support@ethiotransit.com</p>
      </a>

      <div class="support-card">
        <div class="icon">💬</div>

        <h2>Live Chat</h2>

        <p>Available 24/7 for quick help.</p>
      </div>
    </section>

    <section class="faq-section">
      <h2>Frequently Asked Questions</h2>

      <div class="faq-box">
        <button class="faq-question">How do I cancel my booking?</button>

        <div class="faq-answer">
          <p>
            You can cancel your booking from the My Bookings page before
            departure time.
          </p>
        </div>
      </div>

      <div class="faq-box">
        <button class="faq-question">Can I choose my seat?</button>

        <div class="faq-answer">
          <p>
            Yes, EthioTransit provides interactive seat selection before
            payment.
          </p>
        </div>
      </div>

      <div class="faq-box">
        <button class="faq-question">
          Which payment systems are supported?
        </button>

        <div class="faq-answer">
          <p>We support Telebirr, CBE, Dashen Bank, Awash Bank and more.</p>
        </div>
      </div>
    </section>

    <footer>
      <h3>EthioTransit</h3>

      <p>Reliable Ethiopian Intercity Transportation</p>
    </footer>

    <script src="js/support.js"></script>
  </body>
</html>
