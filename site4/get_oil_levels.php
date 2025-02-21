<?php
include 'db.php';

$boatId = isset($_GET['boat_id']) ? $_GET['boat_id'] : '';

if ($boatId) {
    $stmt = $conn->prepare("SELECT boat_id, oil_level, next_change, next_change_value, registration_date FROM oil_levels WHERE boat_id = ?");
    $stmt->bind_param("s", $boatId);
} else {
    $stmt = $conn->prepare("SELECT boat_id, oil_level, next_change, next_change_value, registration_date FROM oil_levels");
}

$stmt->execute();
$result = $stmt->get_result();

$oilLevels = array();
while($row = $result->fetch_assoc()) {
    $oilLevels[] = $row;
}

echo json_encode($oilLevels);

$stmt->close();
$conn->close();
?>
