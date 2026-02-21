<?php
include "../auth/auth_check.php";
include "../config/db.php";

/* TOTAL FUEL COST */
$fuel = $conn->query("SELECT IFNULL(SUM(fuel_cost),0) total FROM trip_expenses")
             ->fetch_assoc()['total'];

/* VEHICLE COUNT */
$totalVehicles = $conn->query("SELECT COUNT(*) c FROM vehicles")
                       ->fetch_assoc()['c'];

/* ACTIVE TRIPS */
$activeTrips = $conn->query("SELECT COUNT(*) c FROM trips WHERE status='on_way'")
                     ->fetch_assoc()['c'];

/* UTILIZATION RATE */
$utilization = ($totalVehicles > 0)
    ? round(($activeTrips / $totalVehicles) * 100)
    : 0;

/* MAINTENANCE COST */
$maintenance = $conn->query("SELECT IFNULL(SUM(cost),0) total FROM maintenance_logs")
                    ->fetch_assoc()['total'];

/* REVENUE (assumed from completed trips) */
$revenue = $conn->query("
    SELECT COUNT(*) * 5000 AS total
    FROM trips WHERE status='completed'
")->fetch_assoc()['total'];

/* TOTAL COST */
$totalCost = $fuel + $maintenance;

/* FLEET ROI */
$roi = ($totalCost > 0)
    ? round((($revenue - $totalCost) / $totalCost) * 100, 2)
    : 0;

/* MONTHLY SUMMARY */
$summary = $conn->query("
    SELECT 
        MONTH(date) AS month,
        SUM(fuel_cost) AS fuel,
        SUM(misc_cost) AS misc
    FROM trip_expenses
    GROUP BY MONTH(date)
");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Operational Analytics & Financial Reports</title>

    <!-- Global CSS -->
    <link rel="stylesheet" href="../assets/css/style.css">

    <style>
        .cards {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .card {
            flex: 1;
            padding: 20px;
            border-radius: 12px;
            border: 1px solid #1e293b;
            background: #020617;
        }

        .card h4 {
            color: #94a3b8;
            margin: 0;
        }

        .card p {
            font-size: 28px;
            margin-top: 10px;
            color: #22c55e;
        }

        .section {
            margin-top: 30px;
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
    </style>
</head>

<body>

<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN CONTENT -->
<div class="main">

    <h1>Operational Analytics & Financial Reports</h1>

    <!-- KPI CARDS -->
    <div class="cards">
        <div class="card">
            <h4>Total Fuel Cost</h4>
            <p>₹ <?= number_format($fuel) ?></p>
        </div>

        <div class="card">
            <h4>Fleet ROI</h4>
            <p><?= $roi ?>%</p>
        </div>

        <div class="card">
            <h4>Utilization Rate</h4>
            <p><?= $utilization ?>%</p>
        </div>
    </div>

    <!-- FINANCIAL SUMMARY -->
    <div class="section">
        <h3>Financial Summary (Monthly)</h3>

        <table>
            <tr>
                <th>Month</th>
                <th>Revenue</th>
                <th>Fuel Cost</th>
                <th>Maintenance</th>
                <th>Net Profit</th>
            </tr>

            <?php while ($s = $summary->fetch_assoc()) {

                $monthRevenue = 5000; // demo assumption
                $net = $monthRevenue - ($s['fuel'] + $maintenance);
            ?>
            <tr>
                <td><?= $s['month'] ?></td>
                <td>₹ <?= $monthRevenue ?></td>
                <td>₹ <?= $s['fuel'] ?></td>
                <td>₹ <?= $maintenance ?></td>
                <td>₹ <?= $net ?></td>
            </tr>
            <?php } ?>
        </table>
    </div>

</div>

</body>
</html>