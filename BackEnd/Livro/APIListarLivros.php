<?php

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['api_token']) && $_POST['api_token'] == 'TokenTeste') {
        require_once('Index.php'); 

        $query = '
            SELECT livros.Id_livro, livros.nome_livro, livros.ano_publicacao, 
                   generos.nome_genero, autores.nome_autor 
            FROM livros
            JOIN generos ON livros.Id_genero = generos.Id_genero
            JOIN autores ON livros.Id_autor = autores.Id_autor
        ';
        
        $stmt = mysqli_prepare($conn, $query);

        if ($stmt) {
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $Id_livro, $nome_livro, $ano_publicacao, $nome_genero, $nome_autor);

            $response = array();

            while (mysqli_stmt_fetch($stmt)) {
                array_push($response, array(
                    "Id_livro" => $Id_livro,
                    "nome_livro" => $nome_livro,
                    "ano_publicacao" => $ano_publicacao,
                    "nome_genero" => $nome_genero,
                    "nome_autor" => $nome_autor
                ));
            }

            echo json_encode($response);
            mysqli_stmt_close($stmt);
        } else {
            echo json_encode(array("error" => "Erro na preparação da consulta"));
        }

        mysqli_close($conn);
    } else {
        $response = array('auth_token' => false, 'message' => 'Token inválido.');
        echo json_encode($response);
    }
} else {
    echo json_encode(array("error" => "Método não suportado"));
}
?>
