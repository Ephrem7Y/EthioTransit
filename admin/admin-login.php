<?php

session_start();

include "../config/database.php";

$error = "";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "
    SELECT *
    FROM admins
    WHERE email = ?
    ";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();
    if($admin && password_verify($password, $admin['password'])){
        $_SESSION['admin_id'] = $admin['id'];
        $_SESSION['admin_name'] = $admin['full_name'];
        header("Location: dashboard.php");
        exit();
        }else{
            $error = "Invalid admin credentials.";
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" type="image/jpeg" href="../images/favcon.jpeg" />
    <link rel="stylesheet" href="../css/login.css?v=2">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>
</head>

<body>
    <div class="auth-container">
        <div class="auth-left">
            <div class="dark-overlay"></div>
            <div class="brand-content">
                <h1>EthioTransit Admin</h1>
                <p>
                    Manage routes, buses, schedules,
                    payments and platform operations.
                </p>
            </div>
            <div class="floating-card">
                <span>ADMIN PANEL</span>
                <h3>System Management</h3>
                <p>
                    Monitor bookings, users,
                    payments and transport operations.
                </p>
            </div>
        </div>
        
        <div class="auth-right">
            <div class="auth-box fade-up">
                <h2>Admin Access</h2>
                <p class="subtitle">
                    Authorized personnel only.
                </p>
                <?php if($error != ""){ ?>
                <p style="color:red; margin-bottom:20px;">
                    <?php echo $error; ?>
                </p>
                <?php } ?>
                <form method="POST">
                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" required>
                    </div>
                    <div class="input-group">
                        <label>Password</label>
                        <input type="password" name="password" required>
                    </div>
                    <button type="submit" class="auth-btn">
                        Login As Admin
                    </button>
                </form>
            </div>
        </div>
    </div>
</body>
</html>