<?php
include "../auth/auth_check.php";
include "../config/db.php";

$logs = $conn->query(
    "SELECT m.*, v.name AS vehicle
     FROM maintenance_logs m
     JOIN vehicles v ON m.vehicle_id = v.id
     ORDER BY m.date DESC"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Maintenance Logs</title>
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
    <th>Description</th>
    <th>Cost</th>
    <th>Date</th>
</tr>

<?php while($m = $logs->fetch_assoc()) { ?>
<tr>
    <td><?= $m['id'] ?></td>
    <td><?= $m['vehicle'] ?></td>
    <td><?= $m['description'] ?></td>
    <td>₹ <?= $m['cost'] ?></td>
    <td><?= $m['date'] ?></td>
</tr>
<?php } ?>

</table>

</body>
</html>