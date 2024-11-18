<?php
// Habilitar exibição de erros para depuração (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados
require_once('Index.php');

// Verificar conexão com o banco de dados
if ($conn->connect_error) {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro de conexão com o banco de dados: ' . $conn->connect_error]);
    exit();
}

// Definir o cabeçalho para JSON
header('Content-Type: application/json; charset=utf-8');

// Array para armazenar os autores
$autores = [];

// SQL para selecionar todos os autores
$sql = "SELECT Id_autor AS id_autor, nome_autor 
        FROM autores";

$query = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($query) {
    while ($row = $query->fetch_assoc()) {
        $autores[] = $row;
    }
    // Retornar os autores como JSON
    echo json_encode(['sucesso' => true, 'autores' => $autores], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao carregar autores: ' . $conn->error]);
}

// Fechar a conexão
$conn->close();
?>
