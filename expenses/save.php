<?php
include "../config/db.php";

$trip_id = $_POST['trip_id'];
$driver = $_POST['driver'];
$distance = $_POST['distance'];
$fuel = $_POST['fuel_cost'];
$misc = $_POST['misc_cost'];

$conn->query("
    INSERT INTO trip_expenses
    (trip_id, driver, distance, fuel_cost, misc_cost, status)
    VALUES
    ($trip_id, '$driver', $distance, $fuel, $misc, 'done')
");

header("Location: index.php");