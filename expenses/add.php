<?php include "../auth/auth_check.php"; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>New Expense</title>

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
        }

        input:focus {
            border-color: #22c55e;
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
    <h3>New Expense</h3>

    <form action="save.php" method="POST">

        <label>Trip ID</label>
        <input name="trip_id" placeholder="e.g. 102" required>

        <label>Driver Name</label>
        <input name="driver" placeholder="e.g. Ramesh Patel" required>

        <label>Distance (km)</label>
        <input name="distance" placeholder="e.g. 320" required>

        <label>Fuel Cost (₹)</label>
        <input name="fuel_cost" placeholder="e.g. 2800" required>

        <label>Misc Expense (₹)</label>
        <input name="misc_cost" placeholder="e.g. 450" required>

        <div class="actions">
            <button type="submit">Create Expense</button>
            <a href="index.php" class="cancel">Cancel</a>
        </div>
    </form>
</div>

</body>
</html>