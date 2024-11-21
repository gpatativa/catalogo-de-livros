<?php
require_once('Index.php'); // Conexão com o banco de dados
header('Content-Type: application/json; charset=utf-8');

// Verificar se o ID foi passado como parâmetro
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Buscar o livro pelo ID
    $sql = "SELECT Id_livro, nome_livro, ano_publicacao, Id_genero, Id_autor FROM livros WHERE Id_livro = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $livro = $result->fetch_assoc();
            echo json_encode(['sucesso' => true, 'livro' => $livro]);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Livro não encontrado.']);
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Erro ao executar a consulta: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'ID do livro não fornecido.']);
}

$conn->close();
?>
