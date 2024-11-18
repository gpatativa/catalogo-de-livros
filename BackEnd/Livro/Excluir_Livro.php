<?php

// Incluir a conexão com o banco de dados
require_once('Index.php');

// Configurar o cabeçalho para JSON
header('Content-Type: application/json');

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Verificar se o ID foi enviado
    if (isset($_POST['id']) && !empty($_POST['id'])) {
        $id = intval($_POST['id']); // Garantir que seja um número inteiro

        // SQL para deletar o registro
        $sql = "DELETE FROM livros WHERE Id_livro = ?";

        // Preparar a consulta SQL
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("i", $id);

            // Executar a consulta e verificar o resultado
            if ($stmt->execute()) {
                if ($stmt->affected_rows > 0) {
                    echo json_encode(['sucesso' => true, 'mensagem' => 'Livro excluído com sucesso']);
                } else {
                    echo json_encode(['sucesso' => false, 'erro' => 'Livro não encontrado']);
                }
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Erro ao executar a exclusão']);
            }

            $stmt->close();
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro na preparação da consulta']);
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'ID do livro não fornecido ou inválido']);
    }

} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método HTTP inválido']);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
