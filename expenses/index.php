<?php
include "../auth/auth_check.php";
include "../config/db.php";

$expenses = $conn->query("SELECT * FROM trip_expenses ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expense & Fuel Logging</title>

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

        .status.available {
            color: #22c55e;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <h1>Expense & Fuel Logging</h1>

    <div class="toolbar">
        <input type="text" placeholder="Search expenses...">
        <a class="btn" href="add.php">+ Add an Expense</a>
    </div>

    <table>
        <tr>
            <th>Trip ID</th>
            <th>Driver</th>
            <th>Distance</th>
            <th>Fuel Expense</th>
            <th>Misc Expense</th>
            <th>Status</th>
        </tr>

        <?php while ($e = $expenses->fetch_assoc()) { ?>
        <tr>
            <td><?= $e['trip_id'] ?></td>
            <td><?= htmlspecialchars($e['driver']) ?></td>
            <td><?= $e['distance'] ?> km</td>
            <td>₹ <?= $e['fuel_cost'] ?></td>
            <td>₹ <?= $e['misc_cost'] ?></td>
            <td>
                <span class="status available">Done</span>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>