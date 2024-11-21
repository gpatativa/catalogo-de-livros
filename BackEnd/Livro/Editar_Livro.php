<?php
require_once('Index.php'); // Conexão com o banco de dados
header('Content-Type: application/json; charset=utf-8');

// Verificar o método da requisição
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);

    // Verificar se todos os campos obrigatórios estão presentes
    if (
        isset($input['id'], $input['nome_livro'], $input['ano_publicacao'], $input['Id_genero'], $input['Id_autor'])
    ) {
        $id = intval($input['id']);
        $nome_livro = $input['nome_livro'];
        $ano_publicacao = intval($input['ano_publicacao']);
        $Id_genero = intval($input['Id_genero']);
        $Id_autor = intval($input['Id_autor']);

        // Atualizar o livro no banco
        $sql = "UPDATE livros SET nome_livro = ?, ano_publicacao = ?, Id_genero = ?, Id_autor = ? WHERE Id_livro = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("siiii", $nome_livro, $ano_publicacao, $Id_genero, $Id_autor, $id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                echo json_encode(['sucesso' => true, 'mensagem' => 'Livro atualizado com sucesso.']);
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Nenhuma alteração foi feita no livro.']);
            }
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao atualizar o livro: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Dados insuficientes para a atualização.']);
    }
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método não permitido. Use PUT.']);
}

$conn->close();
?>
