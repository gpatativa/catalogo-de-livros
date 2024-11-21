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

// Array para armazenar os livros
$livros = [];

// SQL para selecionar todos os livros
$sql = "SELECT livros.Id_livro AS id_livro, livros.nome_livro, livros.ano_publicacao, 
               autores.nome_autor, generos.nome_genero 
        FROM livros 
        JOIN autores ON livros.Id_autor = autores.Id_autor 
        JOIN generos ON livros.Id_genero = generos.Id_genero";

$query = $conn->query($sql);

// Verificar se a consulta foi bem-sucedida
if ($query) {
    while ($row = $query->fetch_assoc()) {
        $livros[] = $row;
    }
    // Retornar os livros como JSON
    echo json_encode(['sucesso' => true, 'livros' => $livros], JSON_UNESCAPED_UNICODE);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao carregar livros: ' . $conn->error]);
}

// Fechar a conexão
$conn->close();
?>
