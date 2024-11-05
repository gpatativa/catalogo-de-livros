<?php

header ('Content-Type: application/json');

if ($_SERVER ['REQUEST_METHOD'] == 'POST')
{
    $api_token = $_POST ['api_token'];
    if ($api_token == 'TokenTeste')
    {


require_once('Index.php');

$query = 'SELECT Id_livro, nome_livro, data_publicacao, Id_genero, Id_autor FROM livros';
$stmt = mysqli_prepare($conn, $query);

if ($stmt) {
    mysqli_stmt_execute($stmt);
    mysqli_stmt_bind_result($stmt, $Id_livro, $nome_livro, $data_publicacao, $Id_genero, $Id_autor);

    $response = array();

    while (mysqli_stmt_fetch($stmt)) {
        array_push($response, array(
            "Id_livro" => $Id_livro,
            "nome_livro" => $nome_livro,
            "data_publicacao" => $data_publicacao,
            "Id_genero" => $Id_genero, // talvez aqui vamos ter que trocar pelo nome_genero da tabela generos
            "Id_autor" => $Id_autor // talvez aqui vamos ter que trocar pelo nome_autor da tabela autores
        ));
    }

    echo json_encode($response);
}
    mysqli_stmt_close($stmt);
}

mysqli_close($conn);

}
else{
    $response['auth_token'] = false;
    echo json_encode ($response);
}
?>

