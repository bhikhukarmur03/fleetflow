<?php
include "../auth/auth_check.php";
include "../config/db.php";

$vehicle_id   = $_POST['vehicle_id'];
$driver_id    = $_POST['driver_id'];
$cargo_weight = $_POST['cargo_weight'];
$origin       = $_POST['origin'];
$destination  = $_POST['destination'];

/* INSERT TRIP */
$conn->query("
    INSERT INTO trips 
    (vehicle_id, driver_id, cargo_weight, origin, destination, status)
    VALUES 
    ($vehicle_id, $driver_id, $cargo_weight, '$origin', '$destination', 'dispatched')
");

/* UPDATE VEHICLE & DRIVER STATUS */
$conn->query("UPDATE vehicles SET status='on_trip' WHERE id=$vehicle_id");
$conn->query("UPDATE drivers SET status='on_trip' WHERE id=$driver_id");

/* REDIRECT WITH SUCCESS FLAG */
header("Location: index.php?success=1");
exit;