<?php
include "../auth/auth_check.php";
include "../config/db.php";

$logs = $conn->query("
    SELECT m.id, v.name AS vehicle, m.description, m.date, m.cost
    FROM maintenance_logs m
    JOIN vehicles v ON m.vehicle_id = v.id
    ORDER BY m.date DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maintenance & Service Logs</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .toolbar input {
            width: 280px;
            padding: 10px;
            border-radius: 8px;
            border: none;
            outline: none;
        }

        .btn {
            background: #22c55e;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 10px;
            border-bottom: 1px solid #1e293b;
            text-align: left;
        }

        th {
            color: #94a3b8;
            font-weight: 600;
        }

        .status.in_shop {
            color: #f59e0b;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <h1>Maintenance & Service Logs</h1>

    <div class="toolbar">
        <input type="text" placeholder="Search service logs...">
        <a class="btn" href="add.php">+ Create New Service</a>
    </div>

    <table>
        <tr>
            <th>Log ID</th>
            <th>Vehicle</th>
            <th>Issue / Service</th>
            <th>Date</th>
            <th>Cost</th>
            <th>Status</th>
        </tr>

        <?php while ($m = $logs->fetch_assoc()) { ?>
        <tr>
            <td><?= $m['id'] ?></td>
            <td><?= htmlspecialchars($m['vehicle']) ?></td>
            <td><?= htmlspecialchars($m['description']) ?></td>
            <td><?= $m['date'] ?></td>
            <td>₹ <?= $m['cost'] ?></td>
            <td>
                <span class="status in_shop">In Shop</span>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>