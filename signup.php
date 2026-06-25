<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Create Account - EthioTransit</title>
<link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />

    <link rel="stylesheet" href="css/global.css" />

    <link rel="stylesheet" href="css/signup.css?v=2" />

    <link
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
      rel="stylesheet"
    />
  </head>

  <body>
    <a href="index.php" class="back-home-btn"> ← Back to Home </a>
    
    <div class="signup-container">
      <div class="signup-left">
        <div class="dark-overlay"></div>

        <div class="signup-brand">
          <h1>EthioTransit</h1>

          <p>
            Experience the pinnacle of Ethiopian ground transportation with
            comfort, luxury, and reliability.
          </p>
        </div>

        <div class="perk-card">
          <span>MEMBER BENEFIT</span>

          <h3>Priority Booking Access</h3>

          <p>
            Get early access to premium buses, holiday routes, and exclusive
            travel offers.
          </p>
        </div>
      </div>

      <div class="signup-right">
        <div class="signup-box fade-up">
          <h2>Create your account</h2>

          <p class="subtitle">
            Join Ethiopia’s modern digital transportation platform.
          </p>

          <form id="signupForm">
            <div class="input-group">
              <label>Full Name</label>

              <input type="text" id="fullName" placeholder="Abebe Bikila" />
            </div>

            <div class="input-group">
              <label>Email Address</label>

              <input
                type="email"
                id="signupEmail"
                placeholder="abebe@example.com"
              />
            </div>

            <div class="input-group">
              <label>Phone Number</label>

              <input type="text" id="phone" placeholder="+251 911 234 567" />
            </div>

            <div class="input-group">
              <label>Password</label>

              <div class="password-box">
                <input
                  type="password"
                  id="signupPassword"
                  placeholder="Create password"
                />

                <span id="toggleSignupPassword">👁</span>
              </div>
            </div>

            <div class="strength">
              <div class="strength-bar">
                <div id="strengthFill"></div>
              </div>

              <span id="strengthText">Password strength</span>
            </div>

            <label class="checkbox terms">
              <input type="checkbox" />
              I agree to the
              <a href="#">Terms of Service</a>
              and
              <a href="#">Privacy Policy</a>
            </label>

            <button type="submit" class="signup-btn">Create Account</button>
          </form>

          <div class="bottom-link">
            Already have an account?
            <a href="login.php">Sign In</a>
          </div>
        </div>
      </div>
    </div>

    <script src="js/signup.js"></script>
  </body>
</html>
