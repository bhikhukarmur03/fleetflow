<?php
$conn = new mysqli("localhost", "root", "", "fleetflow", 3307);

if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}
?>