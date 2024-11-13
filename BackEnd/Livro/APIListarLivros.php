<?php
// Habilitar exibição de erros para depuração (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados
require_once('Index.php');

// Definir o cabeçalho para JSON
header('Content-Type: application/json');

// Array para armazenar os livros
$livros = [];

// SQL para selecionar todos os livros
$sql = "SELECT livros.id, livros.nome_livro, livros.ano_publicacao, autores.nome_autor, generos.nome_genero 
        FROM livros 
        JOIN autores ON livros.Id_autor = autores.Id_autor 
        JOIN generos ON livros.Id_genero = generos.Id_genero";

$query = $conn->query($sql);

if ($query) {
    while ($row = $query->fetch_assoc()) {
        $livros[] = $row;
    }
    // Retornar os livros como JSON
    echo json_encode($livros);
} else {
    echo json_encode(['sucesso' => false, 'erro' => 'Erro ao carregar livros.']);
}

// Fechar a conexão
$conn->close();
?>
