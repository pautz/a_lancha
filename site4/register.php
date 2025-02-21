<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebe os dados do formulário
    $boatId = $_POST['boatId'];
    $oilLevel = $_POST['oilLevel'];
    $nextChange = $_POST['nextChange'];
    $nextChangeValue = $_POST['nextChangeValue'];

    // Verifica se os dados foram enviados corretamente
    if (!empty($boatId) && !empty($oilLevel) && !empty($nextChange) && !empty($nextChangeValue)) {
        // Prepara e executa a consulta SQL
        $stmt = $conn->prepare("INSERT INTO oil_levels (boat_id, oil_level, next_change, next_change_value) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("sisd", $boatId, $oilLevel, $nextChange, $nextChangeValue);

        if ($stmt->execute()) {
            echo "Nível de óleo cadastrado com sucesso!";
        } else {
            echo "Erro: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Por favor, preencha todos os campos.";
    }
}

$conn->close();
?>
