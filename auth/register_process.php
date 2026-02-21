<?php
include "../config/db.php";

$name = $_POST['name'];
$email = $_POST['email'];
$role = $_POST['role'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);

$stmt = $conn->prepare(
    "INSERT INTO users (name,email,password,role) VALUES (?,?,?,?)"
);
$stmt->bind_param("ssss", $name, $email, $password, $role);

if ($stmt->execute()) {
    header("Location: auth.php");
} else {
    echo "Registration failed";
}