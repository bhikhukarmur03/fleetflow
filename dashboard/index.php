<?php
include "../auth/auth_check.php";
include "../config/db.php";

/* KPIs */
$activeFleet = $conn->query("SELECT COUNT(*) c FROM vehicles WHERE status='on_trip'")
                    ->fetch_assoc()['c'];

$inShop = $conn->query("SELECT COUNT(*) c FROM vehicles WHERE status='in_shop'")
               ->fetch_assoc()['c'];

$pendingCargo = $conn->query("SELECT COUNT(*) c FROM trips WHERE status='draft'")
                     ->fetch_assoc()['c'];

/* Live Trips */
$trips = $conn->query("
    SELECT t.id, v.name AS vehicle, d.name AS driver, t.status
    FROM trips t
    JOIN vehicles v ON t.vehicle_id=v.id
    JOIN drivers d ON t.driver_id=d.id
    ORDER BY t.id DESC
");
?>

<!DOCTYPE html>
<html>
<head>
    <title>FleetFlow Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<!-- SIDEBAR -->
<!-- SIDEBAR -->
<?php include "../includes/sidebar.php"; ?>

<!-- MAIN -->
<div class="main">

    <!-- TOP BAR -->
    <div class="topbar">
        <input class="search" placeholder="Search vehicle, trip, driver...">

        <div>
            <a href="../trips/create.php"><button class="btn">New Trip</button></a>
            <a href="../vehicles/add.php"><button class="btn">New Vehicle</button></a>
        </div>
    </div>

    <!-- KPI CARDS -->
    <div class="cards">
        <div class="card">
            <h4>Active Fleet</h4>
            <p><?= $activeFleet ?></p>
        </div>

        <div class="card">
            <h4>Maintenance Alerts</h4>
            <p><?= $inShop ?></p>
        </div>

        <div class="card">
            <h4>Pending Cargo</h4>
            <p><?= $pendingCargo ?></p>
        </div>
    </div>

    <!-- LIVE TABLE -->
    <table>
        <tr>
            <th>Trip</th>
            <th>Vehicle</th>
            <th>Driver</th>
            <th>Status</th>
        </tr>

        <?php while($t = $trips->fetch_assoc()) { ?>
        <tr>
            <td><?= $t['id'] ?></td>
            <td><?= $t['vehicle'] ?></td>
            <td><?= $t['driver'] ?></td>
            <td>
                <span class="status <?= $t['status'] ?>">
                    <?= strtoupper($t['status']) ?>
                </span>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>