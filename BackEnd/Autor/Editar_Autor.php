<?php

// Incluir a conexão com o banco de dados
require_once('Index.php');

// Configurar o cabeçalho para JSON
header('Content-Type: application/json');

// Verificar se o método da requisição é PUT
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Obter os dados enviados no corpo da requisição
    $inputData = json_decode(file_get_contents("php://input"), true);

    // Validar os dados recebidos
    if (isset($inputData['id'], $inputData['nome']) && !empty($inputData['id']) && !empty($inputData['nome'])) {
        $id = intval($inputData['id']);
        $nome = trim($inputData['nome']);

        // SQL para atualizar o nome do autor
        $sql = "UPDATE autores SET nome_autor = ? WHERE Id_autor = ?";

        // Preparar a consulta SQL
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $nome, $id);

            // Executar a consulta e verificar o resultado
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['sucesso' => true, 'mensagem' => 'Autor editado com sucesso']);
                } else {
                    echo json_encode(['sucesso' => false, 'erro' => 'Autor não encontrado ou sem alterações']);
                }
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Erro ao executar a edição']);
            }

            $stmt->close();
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro na preparação da consulta']);
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Dados inválidos ou incompletos']);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método HTTP inválido']);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
