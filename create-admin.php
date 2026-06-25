<?php

include "config/database.php";

$password = password_hash("admin123", PASSWORD_DEFAULT);

$query = "
INSERT INTO admins
(full_name, email, password)

VALUES (?, ?, ?)
";

$full_name = "Main Admin";

$email = "admin@ethiotransit.com";

$stmt = $conn->prepare($query);

$stmt->bind_param(
    "sss",
    $full_name,
    $email,
    $password
);

$stmt->execute();

echo "Admin created successfully.";

?>