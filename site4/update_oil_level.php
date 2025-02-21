<?php
include 'db.php';

$data = json_decode(file_get_contents("php://input"), true);

$boatId = $data['boatId'];
$oilLevel = $data['oilLevel'];

if (!empty($boatId) && !empty($oilLevel)) {
    $stmt = $conn->prepare("UPDATE oil_levels SET oil_level = ? WHERE boat_id = ?");
    $stmt->bind_param("is", $oilLevel, $boatId);

    if ($stmt->execute()) {
        echo "Nível de óleo atualizado com sucesso!";
    } else {
        echo "Erro: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Por favor, forneça todos os dados.";
}

$conn->close();
?>
