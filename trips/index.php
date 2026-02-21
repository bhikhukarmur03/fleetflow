<?php
include "../auth/auth_check.php";
include "../config/db.php";

/* ===============================
   AVAILABLE VEHICLES
   =============================== */
$vehicles = $conn->query("
    SELECT id, name, max_capacity 
    FROM vehicles 
    WHERE status = 'available'
");

/* ===============================
   ELIGIBLE DRIVERS (FIXED)
   - Allows available / off_duty / NULL
   - Blocks ONLY suspended drivers
   =============================== */
$drivers = $conn->query("
    SELECT id, name 
    FROM drivers 
    WHERE status IS NULL 
       OR status IN ('available','off_duty')
");

/* ===============================
   EXISTING TRIPS
   =============================== */
$trips = $conn->query("
    SELECT 
        t.id, 
        v.name AS vehicle, 
        t.origin, 
        t.destination, 
        t.status
    FROM trips t
    JOIN vehicles v ON t.vehicle_id = v.id
    ORDER BY t.id DESC
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Trip Dispatcher</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .box {
            display: flex;
            gap: 30px;
        }
        .left, .right {
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 12px;
            padding: 20px;
        }
        .left { width: 60%; }
        .right { width: 40%; }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 12px;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #1e293b;
            text-align: center;
        }

        th {
            color: #94a3b8;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-top: 8px;
            border-radius: 6px;
            border: none;
            background: #020617;
            color: #fff;
            border: 1px solid #334155;
        }

        .btn {
            margin-top: 14px;
            background: #22c55e;
            padding: 10px;
            border: none;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .btn:hover {
            background: #16a34a;
        }

        .status.dispatched { color: #facc15; font-weight: bold; }
        .status.completed  { color: #22c55e; font-weight: bold; }
        .status.cancelled  { color: #ef4444; font-weight: bold; }

        .empty {
            padding: 20px;
            text-align: center;
            color: #94a3b8;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <h2>Trip Dispatcher & Management</h2>

    <div class="box">

        <!-- LEFT : ACTIVE TRIPS -->
        <div class="left">
            <h3>Active Trips</h3>

            <table>
                <tr>
                    <th>ID</th>
                    <th>Vehicle</th>
                    <th>Origin</th>
                    <th>Destination</th>
                    <th>Status</th>
                </tr>

                <?php if ($trips->num_rows > 0) { ?>
                    <?php while ($t = $trips->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $t['id'] ?></td>
                        <td><?= htmlspecialchars($t['vehicle']) ?></td>
                        <td><?= htmlspecialchars($t['origin']) ?></td>
                        <td><?= htmlspecialchars($t['destination']) ?></td>
                        <td>
                            <span class="status <?= $t['status'] ?>">
                                <?= ucfirst($t['status']) ?>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                <?php } else { ?>
                    <tr>
                        <td colspan="5" class="empty">No trips available</td>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <!-- RIGHT : NEW TRIP FORM -->
        <div class="right">
            <h3>New Trip Form</h3>

            <form action="save.php" method="POST">

                <label>Vehicle</label>
                <select name="vehicle_id" required>
                    <option value="">Choose Vehicle</option>
                    <?php while ($v = $vehicles->fetch_assoc()) { ?>
                        <option value="<?= $v['id'] ?>">
                            <?= htmlspecialchars($v['name']) ?> (<?= $v['max_capacity'] ?> kg)
                        </option>
                    <?php } ?>
                </select>

                <label>Cargo Weight (kg)</label>
                <input type="number" name="cargo_weight" required>

                <label>Driver</label>
                <select name="driver_id" required>
                    <option value="">Choose Driver</option>
                    <?php if ($drivers->num_rows > 0) { ?>
                        <?php while ($d = $drivers->fetch_assoc()) { ?>
                            <option value="<?= $d['id'] ?>">
                                <?= htmlspecialchars($d['name']) ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option disabled>No drivers available</option>
                    <?php } ?>
                </select>

                <label>Origin</label>
                <input name="origin" placeholder="Mumbai" required>

                <label>Destination</label>
                <input name="destination" placeholder="Pune" required>

                <button class="btn">Confirm & Dispatch Trip</button>
            </form>
        </div>

    </div>

</div>

</body>
</html>