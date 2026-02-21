<?php
include "../auth/auth_check.php";
include "../config/db.php";

$trips = $conn->query(
    "SELECT t.*, v.name AS vehicle, d.name AS driver
     FROM trips t
     JOIN vehicles v ON t.vehicle_id = v.id
     JOIN drivers d ON t.driver_id = d.id
     ORDER BY t.id DESC"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trips</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #1e293b;
            text-align: center;
        }

        th {
            background: #020617;
            color: #e5e7eb;
        }

        .done {
            background: #22c55e;
            padding: 6px 10px;
            border-radius: 6px;
            color: #000;
            text-decoration: none;
            margin-right: 5px;
        }

        .cancel {
            background: #ef4444;
            padding: 6px 10px;
            border-radius: 6px;
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <h1>Trip Dispatcher</h1>

    <table>
        <tr>
            <th>ID</th>
            <th>Vehicle</th>
            <th>Driver</th>
            <th>Cargo</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

        <?php while ($t = $trips->fetch_assoc()) { ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= htmlspecialchars($t['vehicle']) ?></td>
            <td><?= htmlspecialchars($t['driver']) ?></td>
            <td><?= $t['cargo_weight'] ?> kg</td>
            <td><?= strtoupper($t['status']) ?></td>
            <td>
                <?php if ($t['status'] == 'dispatched') { ?>
                    <a class="done" href="complete.php?id=<?= $t['id'] ?>">Complete</a>
                    <a class="cancel" href="cancel.php?id=<?= $t['id'] ?>">Cancel</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>