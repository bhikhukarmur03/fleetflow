<?php
include "../auth/auth_check.php";
include "../config/db.php";

/* Fetch all vehicles */
$vehicles = $conn->query("SELECT * FROM vehicles ORDER BY id ASC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vehicle Registry</title>

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
            color: #000;
            padding: 10px 16px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }

        .action-x {
            color: #ef4444;
            font-size: 20px;
            text-decoration: none;
            font-weight: bold;
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

        .status-retired {
            color: #ef4444;
            font-weight: bold;
        }

        .status-available {
            color: #22c55e;
            font-weight: bold;
        }

        .status-in_shop {
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

    <h1>Vehicle Registry</h1>

    <!-- TOOLBAR -->
    <div class="toolbar">
        <input type="text" placeholder="Search vehicle...">
        <a href="add.php" class="btn">+ New Vehicle</a>
    </div>

    <!-- VEHICLE TABLE -->
    <table>
        <tr>
            <th>No</th>
            <th>Plate</th>
            <th>Model</th>
            <th>Type</th>
            <th>Capacity</th>
            <th>Odometer</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        <?php
        $no = 1;
        while ($v = $vehicles->fetch_assoc()) {

            $statusClass = "status-" . $v['status'];
        ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= htmlspecialchars($v['license_plate']) ?></td>
            <td><?= htmlspecialchars($v['name']) ?></td>
            <td>Mini</td>
            <td><?= $v['max_capacity'] ?> kg</td>
            <td><?= $v['odometer'] ?></td>
            <td class="<?= $statusClass ?>">
                <?= ucfirst($v['status']) ?>
            </td>
            <td>
                <?php if ($v['status'] !== 'retired') { ?>
                    <a class="action-x" href="retire.php?id=<?= $v['id'] ?>">✖</a>
                <?php } ?>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>