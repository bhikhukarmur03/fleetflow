<?php
include "../auth/auth_check.php";
include "../config/db.php";

/* Only available vehicles */
$vehicles = $conn->query(
    "SELECT * FROM vehicles WHERE status='available'"
);

/* Only drivers who are NOT suspended */
$drivers = $conn->query(
    "SELECT * FROM drivers WHERE status!='suspended'"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Trip</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        body {
            margin: 0;
            background: #020617;
            font-family: Arial, sans-serif;
            color: #e5e7eb;
        }

        .box {
            width: 420px;
            margin: 60px auto;
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        .box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #22c55e;
        }

        label {
            font-size: 14px;
            color: #94a3b8;
        }

        select, input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #1e293b;
            background: #020617;
            color: #e5e7eb;
            outline: none;
        }

        select:focus, input:focus {
            border-color: #22c55e;
        }

        button {
            width: 100%;
            padding: 12px;
            border-radius: 8px;
            border: none;
            background: #22c55e;
            color: #000;
            font-weight: bold;
            font-size: 15px;
            cursor: pointer;
        }

        button:hover {
            background: #16a34a;
        }
    </style>
</head>

<body>

<div class="box">
    <h2>Create Trip</h2>

    <form action="save.php" method="POST">

        <label>Vehicle</label>
        <select name="vehicle_id" required>
            <option value="">Select Vehicle</option>
            <?php while ($v = $vehicles->fetch_assoc()) { ?>
                <option value="<?= $v['id'] ?>">
                    <?= htmlspecialchars($v['name']) ?> (<?= $v['max_capacity'] ?> kg)
                </option>
            <?php } ?>
        </select>

        <label>Driver</label>
        <select name="driver_id" required>
            <option value="">Select Driver</option>
            <?php while ($d = $drivers->fetch_assoc()) { ?>
                <option value="<?= $d['id'] ?>">
                    <?= htmlspecialchars($d['name']) ?>
                </option>
            <?php } ?>
        </select>

        <label>Cargo Weight (kg)</label>
        <input type="number" name="cargo_weight" placeholder="e.g. 250" required>

        <label>Start Odometer</label>
        <input type="number" name="start_odometer" placeholder="e.g. 10230" required>

        <button type="submit">Dispatch Trip</button>
    </form>
</div>

</body>
</html>