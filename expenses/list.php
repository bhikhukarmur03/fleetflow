<?php
include "../auth/auth_check.php";
include "../config/db.php";

$fuel = $conn->query(
    "SELECT f.*, v.name AS vehicle
     FROM fuel_logs f
     JOIN vehicles v ON f.vehicle_id=v.id
     ORDER BY f.date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fuel Logs</title>
    <style>
        table {
            width:90%; margin:30px auto;
            border-collapse:collapse; background:#fff;
        }
        th, td {
            padding:10px; border-bottom:1px solid #ddd;
            text-align:center;
        }
        th { background:#2c3e50; color:white; }
    </style>
</head>
<body>

<table>
<tr>
    <th>ID</th>
    <th>Vehicle</th>
    <th>Liters</th>
    <th>Cost</th>
    <th>Date</th>
</tr>

<?php while($f = $fuel->fetch_assoc()) { ?>
<tr>
    <td><?= $f['id'] ?></td>
    <td><?= $f['vehicle'] ?></td>
    <td><?= $f['liters'] ?> L</td>
    <td>₹ <?= $f['cost'] ?></td>
    <td><?= $f['date'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>