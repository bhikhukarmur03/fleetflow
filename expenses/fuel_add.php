<?php
include "../auth/auth_check.php";
include "../config/db.php";

// Vehicles that are not retired
$vehicles = $conn->query(
    "SELECT * FROM vehicles WHERE status!='retired'"
);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Fuel Log</title>
    <style>
        body { font-family: Arial; background:#f4f6f8; }
        .box {
            width:450px; margin:40px auto;
            background:#fff; padding:20px;
            border-radius:8px;
        }
        select, input, button {
            width:100%; padding:10px; margin-top:10px;
        }
    </style>
</head>
<body>

<div class="box">
    <h2>Fuel Entry</h2>

    <form action="fuel_save.php" method="POST">
        <label>Vehicle</label>
        <select name="vehicle_id" required>
            <option value="">Select Vehicle</option>
            <?php while($v = $vehicles->fetch_assoc()) { ?>
                <option value="<?= $v['id'] ?>">
                    <?= $v['name'] ?> (<?= $v['license_plate'] ?>)
                </option>
            <?php } ?>
        </select>

        <input type="number" step="0.01" name="liters" placeholder="Fuel (Liters)" required>
        <input type="number" step="0.01" name="cost" placeholder="Total Cost" required>
        <input type="date" name="date" required>

        <button type="submit">Save Fuel Log</button>
    </form>
</div>

</body>
</html>