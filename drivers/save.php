<?php
include "../config/db.php";

$name = $_POST['name'];
$license = $_POST['license_number'];
$expiry = $_POST['license_expiry'];

$conn->query("
    INSERT INTO drivers (name, license_number, license_expiry)
    VALUES ('$name', '$license', '$expiry')
");

header("Location: index.php");