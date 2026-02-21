<?php
include "../auth/auth_check.php";
include "../config/db.php";

/*
Completion rate:
completed trips / total trips * 100
Safety score:
100 - (complaints * 5)
*/

$query = "
SELECT 
    d.id,
    d.name,
    d.license_number,
    d.license_expiry,
    d.complaints,
    COUNT(t.id) AS total_trips,
    SUM(CASE WHEN t.status='completed' THEN 1 ELSE 0 END) AS completed_trips
FROM drivers d
LEFT JOIN trips t ON d.id = t.driver_id
GROUP BY d.id
";

$drivers = $conn->query($query);
$today = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Driver Performance & Safety</title>

    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .btn {
            background: #22c55e;
            padding: 10px 16px;
            border-radius: 8px;
            font-weight: bold;
            text-decoration: none;
            color: #000;
        }
        .btn:hover {
            background: #16a34a;
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

        .status.expired {
            color: #ef4444;
            font-weight: bold;
        }
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <!-- HEADER + ADD BUTTON -->
    <div class="toolbar">
        <h1>Driver Performance & Safety Profiles</h1>
        <a href="add.php" class="btn">+ Add Driver</a>
    </div>

    <!-- DRIVER TABLE -->
    <table>
        <tr>
            <th>Name</th>
            <th>License #</th>
            <th>Expiry</th>
            <th>Completion Rate</th>
            <th>Safety Score</th>
            <th>Complaints</th>
        </tr>

        <?php while ($d = $drivers->fetch_assoc()) {

            // Completion Rate
            $completionRate = ($d['total_trips'] > 0)
                ? round(($d['completed_trips'] / $d['total_trips']) * 100)
                : 0;

            // Safety Score
            $safetyScore = max(0, 100 - ($d['complaints'] * 5));

            // License Expiry Check
            $expired = ($d['license_expiry'] < $today);

            // Auto suspend expired drivers
            if ($expired) {
                $conn->query(
                    "UPDATE drivers SET status='suspended' WHERE id=".$d['id']
                );
            }
        ?>
        <tr>
            <td><?= htmlspecialchars($d['name']) ?></td>
            <td><?= htmlspecialchars($d['license_number']) ?></td>
            <td>
                <span class="status <?= $expired ? 'expired' : 'available' ?>">
                    <?= $d['license_expiry'] ?>
                </span>
            </td>
            <td><?= $completionRate ?>%</td>
            <td><?= $safetyScore ?>%</td>
            <td><?= $d['complaints'] ?></td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>