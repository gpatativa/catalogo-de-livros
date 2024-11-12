<?php
// Conectar ao banco de dados
require_once('Index.php');

// Verifica se a requisição é POST para adicionar autor
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar se o campo 'nome_autor' foi enviado
    if (isset($_POST['nome_autor'])) {
        
        // Coletar dados do formulário
        $nome_autor = $_POST['nome_autor'];

        // SQL para inserir um novo autor
        $sql = "INSERT INTO autores (nome_autor) VALUES (?)";

        // Preparar a consulta SQL
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $nome_autor); // 's' significa que o parâmetro é uma string

        // Executar a consulta e verificar o resultado
        if ($stmt->execute()) {
            echo json_encode(['sucesso' => true, 'mensagem' => 'Autor adicionado com sucesso!']);
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro ao adicionar Autor: ' . $stmt->error]);
        }

        $stmt->close();
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'O campo nome_autor é obrigatório.']);
    }

} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Método HTTP inválido. Use POST.']);
}

// Fechar a conexão
$conn->close();

?>
