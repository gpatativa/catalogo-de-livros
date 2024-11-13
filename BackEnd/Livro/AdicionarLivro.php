<?php
// Habilitar exibição de erros para depuração (remova em produção)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conectar ao banco de dados
require_once('Index.php');

// Definir o cabeçalho para JSON
header('Content-Type: application/json');

// Verificar se a requisição é POST para adicionar um livro
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Verificar se todos os dados foram enviados
    if (isset($_POST['nome_livro'], $_POST['ano_publicacao'], $_POST['Id_autor'], $_POST['Id_genero'])) {
        
        // Coletar dados do formulário
        $nome_livro = $_POST['nome_livro'];
        $ano_publicacao = $_POST['ano_publicacao'];
        $Id_autor = $_POST['Id_autor'];
        $Id_genero = $_POST['Id_genero'];

        // SQL para inserir um novo livro
        $sql = "INSERT INTO livros (nome_livro, ano_publicacao, Id_autor, Id_genero) VALUES (?, ?, ?, ?)";

        // Preparar a consulta SQL
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssii", $nome_livro, $ano_publicacao, $Id_autor, $Id_genero);

            // Executar a consulta e verificar o resultado
            if ($stmt->execute()) {
                echo json_encode(['sucesso' => true, 'mensagem' => 'Livro adicionado com sucesso!']);
            } else {
                echo json_encode(['sucesso' => false, 'erro' => 'Erro ao adicionar livro.']);
            }

            $stmt->close();
        } else {
            echo json_encode(['sucesso' => false, 'erro' => 'Erro na preparação da consulta.']);
        }

    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Todos os campos são obrigatórios.']);
    }

} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    // Carregar gêneros e autores para o formulário
    $result = ['generos' => [], 'autores' => []];

    // Obter gêneros
    $sql = "SELECT Id_genero, nome_genero FROM generos";
    $query = $conn->query($sql);
    if ($query) {
        while ($row = $query->fetch_assoc()) {
            $result['generos'][] = $row;
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Erro ao carregar gêneros.']);
        exit;
    }

    // Obter autores
    $sql = "SELECT Id_autor, nome_autor FROM autores";
    $query = $conn->query($sql);
    if ($query) {
        while ($row = $query->fetch_assoc()) {
            $result['autores'][] = $row;
        }
    } else {
        echo json_encode(['sucesso' => false, 'erro' => 'Erro ao carregar autores.']);
        exit;
    }

    // Retornar os dados de gêneros e autores como JSON
    echo json_encode($result);
}

// Fechar a conexão
$conn->close();
?>
