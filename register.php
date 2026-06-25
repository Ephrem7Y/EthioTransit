<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

include "config/database.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $query = "
    INSERT INTO users
    (full_name, email, phone, password)

    VALUES (?, ?, ?, ?)
    ";

    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        "ssss",
        $full_name,
        $email,
        $phone,
        $password
    );

    if($stmt->execute()){
        $_SESSION['user_id'] = $conn->insert_id;
        $_SESSION['full_name'] = $full_name;
        header("Location: index.php");
        exit();
    }else{
        echo "Registration Failed: " . $stmt->error;
    }
}

?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Create Account - EthioTransit</title>
        <link rel="icon" type="image/jpeg" href="images/favcon.jpeg" />
        <link rel="stylesheet" href="css/global.css">
        <link rel="stylesheet" href="css/signup.css?v=2">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
    </head>
    
    <body>
        <a href="index.php" class="back-home-btn">
        ← Back to Home
        </a>
        <div class="signup-container">
            <div class="signup-left">
                <div class="dark-overlay"></div>
                <div class="signup-brand">
                    <h1>EthioTransit</h1>
                    <p>
                    Experience the pinnacle of Ethiopian ground transportation
                    with comfort, luxury, and reliability.
                    </p>
                </div>
                <div class="perk-card">
                    <span>MEMBER BENEFIT</span>
                    <h3>Priority Booking Access</h3>
                    <p>
                    Get early access to premium buses,
                    holiday routes, and exclusive travel offers.
                    </p>
                </div>
            </div>
            
            <div class="signup-right">
                <div class="signup-box fade-up">
                    <h2>Create your account</h2>
                    <p class="subtitle">
                    Join Ethiopia’s modern digital transportation platform.
                    </p>
                    <form method="POST">
                        <div class="input-group">
                            <label>Full Name</label>
                            <input type="text" name="full_name" placeholder="Abebe Bikila" required>
                        </div>
                        <div class="input-group">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="abebe@example.com" required>
                        </div>
                        <div class="input-group">
                            <label>Phone Number</label>
                            <input type="text" name="phone" placeholder="+251 911 234 567" required>
                        </div>
                        <div class="input-group">
                            <label>Password</label>
                            <div class="password-box">
                                <input type="password" name="password" id="signupPassword" placeholder="Create password" required>
                                <span id="toggleSignupPassword">👁</span>
                            </div>
                        </div>
                        <button type="submit" class="signup-btn">
                        Create Account
                        </button>
                    </form>
                    <div class="bottom-link">
                        Already have an account?
                        <a href="login.php">Sign In</a>
                    </div>
                </div>
            </div>
        </div>

<script>

const toggle = document.getElementById("toggleSignupPassword");

const password = document.getElementById("signupPassword");

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