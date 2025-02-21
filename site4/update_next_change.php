<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$boatId = $data['boatId'];
$nextChange = $data['nextChange'];

if (!empty($boatId) && !empty($nextChange)) {
    $stmt = $conn->prepare("UPDATE oil_levels SET next_change = ? WHERE boat_id = ?");
    $stmt->bind_param("ss", $nextChange, $boatId);

    if ($stmt->execute()) {
        echo "Data da próxima troca atualizada com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, forneça todos os dados.";
}

$conn->close();
?>
