<?php

session_start();

include "config/database.php";


if(isset($_GET['message'])){

if($_GET['message'] == "login_required"){

echo '
<p style="
background:#fee2e2;
color:#b91c1c;
padding:14px;
border-radius:12px;
margin-bottom:20px;
font-weight:600;
">
Please login or create an account to continue payment.
</p>
';

}

}


$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){

$email = $_POST['email'];

$password = $_POST['password'];

$query = "
SELECT *
FROM users
WHERE email = ?
";

$stmt = $conn->prepare($query);

$stmt->bind_param("s", $email);

$stmt->execute();

$result = $stmt->get_result();

$user = $result->fetch_assoc();

if($user && password_verify($password, $user['password'])){

$_SESSION['user_id'] = $user['id'];

$_SESSION['full_name'] = $user['full_name'];

header("Location: index.php");

exit();

}else{

$error = "Invalid email or password.";

}

}

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EthioTransit</title>
    <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/login.css?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
  </head>
  
  <body>
    <a href="index.php" class="back-home-btn">← Back to Home</a>
    <div class="auth-container">
      <div class="auth-left">
        <div class="dark-overlay"></div>
        <div class="brand-content">
          <h1>EthioTransit</h1>
          <p>
          Premium Ethiopian ground transportation
          with comfort, precision, and elegance.
          </p>
        </div>
        <div class="floating-card">
          <span>TRAVEL MEMBER</span>
          <h3>Luxury Intercity Experience</h3>
          <p>
          Access executive buses, premium lounges,
          and seamless digital booking services.
          </p>
        </div>
      </div>
      
      <div class="auth-right">
        <div class="auth-box fade-up">
          <h2>Welcome Back</h2>
          <p class="subtitle">
            Sign in to continue your Ethiopian travel journey.
          </p>
          <?php if($error != ""){ ?>
          <p style="color:red; margin-bottom:20px;">
            <?php echo $error; ?>
          </p>
          <?php } ?>
          <?php if(isset($_GET['message'])){ ?>
          <div class="login-message">
            Please login first to track your bookings.
          </div>
          <?php } ?>
          <form method="POST">
            <div class="input-group">
              <label>Email Address</label>
              <input type="email" name="email" placeholder="example@email.com" required>
            </div>
            <div class="input-group">
              <label>Password</label>
              <div class="password-box">
                <input type="password" name="password" id="password" placeholder="Enter your password"required>
                <span id="togglePassword">👁</span>
              </div>
            </div>
            <button type="submit" class="auth-btn">
              Sign In
            </button>
          </form>
          <div class="bottom-link">
            Don't have an account?
            <a href="register.php">Create Account</a>
          </div>
        </div>
      </div>
    </div>

<script>

const toggle = document.getElementById("togglePassword");

const password = document.getElementById("password");

toggle.addEventListener("click", () => {
  if(password.type === "password"){
    password.type = "text";
  }else{
    password.type = "password";
  }
});

</script>

</body>
</html>