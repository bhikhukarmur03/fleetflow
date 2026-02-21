<?php
include "../auth/auth_check.php";
include "../config/db.php";

$id = $_GET['id'];

$trip = $conn->query(
    "SELECT * FROM trips WHERE id=$id"
)->fetch_assoc();

// Complete trip
$conn->query(
    "UPDATE trips SET status='completed' WHERE id=$id"
);

// Reset vehicle & driver
$conn->query(
    "UPDATE vehicles SET status='available' WHERE id=".$trip['vehicle_id']
);

$conn->query(
    "UPDATE drivers SET status='off_duty' WHERE id=".$trip['driver_id']
);

header("Location: list.php");