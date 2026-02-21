<?php
include "../auth/auth_check.php";
include "../config/db.php";

$vehicle_id = $_POST['vehicle_id'];
$liters     = $_POST['liters'];
$cost       = $_POST['cost'];
$date       = $_POST['date'];

$conn->query(
    "INSERT INTO fuel_logs (vehicle_id, liters, cost, date)
     VALUES ($vehicle_id, $liters, $cost, '$date')"
);

header("Location: list.php");
