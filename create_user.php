<?php
include "config/db.php";

$pass = password_hash("admin123", PASSWORD_DEFAULT);

$conn->query("INSERT INTO users (name,email,password,role)
VALUES ('Admin Manager','admin@fleetflow.com','$pass','manager')");

echo "User created";
?>