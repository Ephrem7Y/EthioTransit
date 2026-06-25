<?php

$host = "localhost";
$username = "root";
$password = "Root@12345";
$database = "ethiotransit";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

//every webiste can use this to connect to the database

?>