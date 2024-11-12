<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Index.css">
    <title>Lista de Autores</title>
</head>
<body>
    <h1>Autores</h1>
    <h2>Realize o cadastro de novos autores!</h2>

    <div class="Tabela">
        <div class="Info">
            <button><a href="Adicionar.html">Adicionar</a></button>
            <button><a href="Editar.html">Editar</a></button>      
            <button><a href="Excluir.html">Excluir</a></button>             
        </div>
        <br>

        <table>
            <tr>
                <th style="text-align:center; width: 50%">Id</th>
                <th style="text-align:center; width: 50%">Nome do autor</th>
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
                $result = file_get_contents('http://localhost/catalogo-de-livros/BackEnd/Autor/APIListarAutores.php', false, $context);

                // Decodifica a resposta JSON
                $jsonObj = json_decode($result);

                if ($jsonObj) {
                    // Itera sobre os dados e os exibe na tabela
                    foreach ($jsonObj as $autor) {  // Cada item JSON é um autor
                        echo "<tr>";
                        echo "<td style='text-align:center; width: 50%'>{$autor->Id_autor}</td>";
                        echo "<td style='text-align:center; width: 50%'>{$autor->nome_autor}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>Erro ao carregar dados.</td></tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
