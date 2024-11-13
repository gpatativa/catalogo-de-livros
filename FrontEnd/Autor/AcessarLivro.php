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
        $result = file_get_contents ('https://localhost/catalogo-de-livros/BackEnd/Livro/APIListarAutores.php', false, $context);

        $jsonObj = json_decode ($result);

        foreach ( $jsonObj as $pessoa )
        {
            echo "$Autores->Id_autor - $Autores->nome_autor  <br>";
        }

?>

