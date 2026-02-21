<?php
include "../config/db.php";

$vehicle_id = $_POST['vehicle_id'];
$desc = $_POST['description'];
$date = $_POST['date'];
$cost = $_POST['cost'];

/* Insert maintenance log */
$conn->query("
    INSERT INTO maintenance_logs (vehicle_id, description, date, cost)
    VALUES ($vehicle_id, '$desc', '$date', $cost)
");

/* AUTO: Mark vehicle as IN SHOP */
$conn->query("
    UPDATE vehicles SET status='in_shop' WHERE id=$vehicle_id
");

header("Location: index.php");