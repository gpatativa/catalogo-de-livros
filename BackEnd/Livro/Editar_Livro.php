<?php

// Incluir a conexão com o banco de dados
require_once('Index.php');

// Verificar se o método é PUT
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    // Pegar o conteúdo da requisição PUT
    $input = file_get_contents("php://input");
    $data = json_decode($input, true); // Decodifica o JSON recebido

    // Verificar se o ID, nome, ano de publicação, gênero e autor foram passados
    if (isset($data['id']) && isset($data['nome_livro']) && isset($data['ano_publicacao']) && isset($data['Id_genero']) && isset($data['Id_autor'])) {
        $id = $data['id'];
        $nome = $data['nome_livro'];
        $ano_publicacao = $data['ano_publicacao'];
        $genero = $data['Id_genero'];
        $autor = $data['Id_autor'];

        // SQL para atualizar o registro
        $sql = "UPDATE livros SET nome_livro = ?, ano_publicacao = ?, Id_genero = ?, Id_autor = ? WHERE Id_livro = ?";

        // Preparar a consulta SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssiii", $nome, $ano_publicacao, $genero, $autor, $id);

        // Executar a consulta e verificar o resultado
        if ($stmt->execute()) {
            echo json_encode(['sucesso' => true, 'mensagem' => 'Registro atualizado com sucesso!']);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Falha ao atualizar o registro.']);
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Dados incompletos. Necessário passar todos os dados.']);
    }

} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método HTTP inválido. Use PUT.']);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
