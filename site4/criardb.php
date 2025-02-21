<?php
$servername = "localhost";
$username = "usario";
$password = "senha";

// Criar conexão
$conn = new mysqli($servername, $username, $password);

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Criar banco de dados
$sql = "CREATE DATABASE oilLevelsDB";
if ($conn->query($sql) === TRUE) {
    echo "Banco de dados criado com sucesso!";
} else {
    echo "Erro ao criar banco de dados: " . $conn->error;
}

// Selecionar banco de dados
$conn->select_db("oilLevelsDB");

// Criar tabela
$sql = "CREATE TABLE oil_levels (
    id INT AUTO_INCREMENT PRIMARY KEY,
    boat_id VARCHAR(255) NOT NULL,
    oil_level INT NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabela criada com sucesso!";
} else {
    echo "Erro ao criar tabela: " . $conn->error;
}

$conn->close();
?>
