<?php
include "../config/db.php";

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="fleet_report.csv"');

$output = fopen("php://output", "w");
fputcsv($output, [
    'Vehicle','Total KM','Fuel(L)','Fuel Cost','Maintenance Cost'
]);

$data = $conn->query("
SELECT v.name,
IFNULL(SUM(t.end_odometer - t.start_odometer),0),
IFNULL(SUM(f.liters),0),
IFNULL(SUM(f.cost),0),
(
 SELECT IFNULL(SUM(m.cost),0)
 FROM maintenance_logs m WHERE m.vehicle_id=v.id
)
FROM vehicles v
LEFT JOIN trips t ON v.id=t.vehicle_id AND t.status='completed'
LEFT JOIN fuel_logs f ON v.id=f.vehicle_id
GROUP BY v.id
");

while($row = $data->fetch_row()){
    fputcsv($output, $row);
}

fclose($output);