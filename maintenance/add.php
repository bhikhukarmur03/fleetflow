<?php
include "../auth/auth_check.php";
include "../config/db.php";

$vehicles = $conn->query(
    "SELECT id, name FROM vehicles WHERE status!='retired'"
);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Service</title>

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
            margin: 70px auto;
            background: #020617;
            border: 1px solid #1e293b;
            border-radius: 14px;
            padding: 25px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.6);
        }

        .box h3 {
            text-align: center;
            margin-bottom: 25px;
            color: #22c55e;
        }

        label {
            font-size: 14px;
            color: #94a3b8;
        }

        select,
        textarea,
        input {
            width: 100%;
            padding: 12px;
            margin-top: 6px;
            margin-bottom: 18px;
            border-radius: 8px;
            border: 1px solid #1e293b;
            background: #020617;
            color: #e5e7eb;
            outline: none;
            resize: none;
        }

        select:focus,
        textarea:focus,
        input:focus {
            border-color: #22c55e;
        }

        textarea {
            min-height: 80px;
        }

        .actions {
            display: flex;
            gap: 10px;
        }

        button {
            flex: 1;
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

        .cancel {
            flex: 1;
            text-align: center;
            padding: 12px;
            border-radius: 8px;
            background: #ef4444;
            color: #fff;
            font-weight: bold;
            text-decoration: none;
        }

        .cancel:hover {
            background: #dc2626;
        }
    </style>
</head>

<body>

<div class="box">
    <h3>New Service</h3>

    <form action="save.php" method="POST">

        <label>Vehicle</label>
        <select name="vehicle_id" required>
            <option value="">Select Vehicle</option>
            <?php while ($v = $vehicles->fetch_assoc()) { ?>
                <option value="<?= $v['id'] ?>">
                    <?= htmlspecialchars($v['name']) ?>
                </option>
            <?php } ?>
        </select>

        <label>Issue / Service</label>
        <textarea name="description" placeholder="Describe the issue or service performed" required></textarea>

        <label>Service Date</label>
        <input type="date" name="date" required>

        <label>Service Cost</label>
        <input type="number" name="cost" placeholder="e.g. 2500" required>

        <div class="actions">
            <button type="submit">Create Service</button>
            <a href="index.php" class="cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>