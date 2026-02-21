<?php
include "../config/db.php";

$id = $_GET['id'];
$conn->query("UPDATE vehicles SET status='retired' WHERE id=$id");

header("Location: list.php");