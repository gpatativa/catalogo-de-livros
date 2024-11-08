<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Index.css">
    <title>Catalogo de Livros</title>
</head>
<body>
    <h1>Catálogo de Livros</h1>
    <h2>Realize o cadastro de novos livros!</h2>

    <div class="Tabela">

        <div class="Info">
            <button><a href="Adicionar.html">Adicionar</a></button>
            <button><a href="Excluir.html">Excluir</a></button>
            <button><a href="Editar.html">Editar</a></button>                   
        </div>
        <br>

        <table>
            <tr>
                <th style="text-align:center; width: 50%">Id</th>
                <th style="text-align:center; width: 50%">Nome do Livro</th>
                <th style="text-align:center; width: 50%">Data de Publicação</th>
                <th style="text-align:center; width: 50%">Gênero</th>
                <th style="text-align:center; width: 50%">Autor</th>
            </tr>

            <?php
                // Código para fazer a requisição ao back-end
                $postdata = http_build_query(
                    array(
                        'api_token' => 'TokenTeste'
                    )
                );
                $opts = array('http' =>
                    array(
                        'method'  => 'POST',
                        'header'  => 'Content-type: application/x-www-form-urlencoded',
                        'content' => $postdata
                    )
                );
                $context  = stream_context_create($opts);
                $result = file_get_contents('http://localhost/CatalogoLivros/BackEnd/Livro/APIListarLivros.php', false, $context);

                // Decodifica a resposta JSON
                $jsonObj = json_decode($result);

                if ($jsonObj) {
                    // Itera sobre os dados e os exibe na tabela
                    foreach ($jsonObj as $livros) {
                        echo "<tr>";
                        echo "<td style='text-align:center; width: 50%'>{$livros->Id_livro}</td>";
                        echo "<td style='text-align:center; width: 50%'>{$livros->nome_livro}</td>";
                        echo "<td style='text-align:center; width: 50%'>{$livros->data_publicacao}</td>";
                        echo "<td style='text-align:center; width: 50%'>{$livros->Id_genero}</td>"; //Acho que vai ter que colocar tabela generos
                        echo "<td style='text-align:center; width: 50%'>{$livros->Id_autor}</td>"; //Acho que vai ter que colocar tabela autores
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Erro ao carregar dados.</td></tr>";
                }
            ?>
        </table>
    </div>
    </div
</body>
</html>
