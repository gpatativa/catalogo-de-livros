<?php
     $postdata = http_build_query(
        array(
            'api_token' =>'TokenTeste'
        )
    );
    $opts = array ('http' =>
        array(
            'method' => 'POST',
            'header' => 'Content-type: application/x-www-form-urlencoded',
            'content' => $postdata
        )
    );
        $context = stream_context_create($opts);
        $result = file_get_contents ('https://localhost/CatalogoLivros/BackEnd/Livro/APIListarLivros.php', false, $context);

        $jsonObj = json_decode ($result);

        foreach ( $jsonObj as $pessoa )
        {
            echo "$livros->Id_livro - $livros->nome_livro - $livros->ano_publicacao - $livros->Id_genero - $livros->Id_autor         <br>";
        }

?>

