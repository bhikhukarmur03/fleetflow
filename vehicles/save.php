<?php
include "../auth/auth_check.php";
include "../config/db.php";

$name = $_POST['name'];
$plate = $_POST['license_plate'];
$capacity = $_POST['max_capacity'];
$odometer = $_POST['odometer'];

$sql = "INSERT INTO vehicles 
        (name, license_plate, max_capacity, odometer, status)
        VALUES (?, ?, ?, ?, 'available')";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $name, $plate, $capacity, $odometer);

if ($stmt->execute()) {
    header("Location: list.php");
} else {
    echo "Error adding vehicle";
}