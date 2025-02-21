<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$boatId = $data['boatId'];
$nextChangeValue = $data['nextChangeValue'];

if (!empty($boatId) && !empty($nextChangeValue)) {
    $stmt = $conn->prepare("UPDATE oil_levels SET next_change_value = ? WHERE boat_id = ?");
    $stmt->bind_param("ds", $nextChangeValue, $boatId);

    if ($stmt->execute()) {
        echo "Valor da próxima troca atualizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, forneça todos os dados.";
}

$conn->close();
?>
