<?php

// Incluir a conexão com o banco de dados
require_once('Index.php');

// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar se o ID foi passado
    if (isset($_POST['id'])) {
        $id = $_POST['id'];

        // SQL para deletar o registro
        $sql = "DELETE FROM livros WHERE Id_livro = ?";

        // Preparar a consulta SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        // Executar a consulta e verificar o resultado
        if ($stmt->execute()) {
            echo json_encode(['sucesso' => true, 'mensagem' => 'Livro excluído com sucesso']);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao excluir livro']);
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'ID não fornecido']);
    }

} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método HTTP inválido']);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
