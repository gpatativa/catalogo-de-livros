<!DOCTYPE html>
<html lang="pt-br">
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
            <button><a href="../Menu de navegação/index.html">Menu</a></button> 
            <button><a href="Adicionar.html">Adicionar</a></button>
            <button><a href="Editar.html">Editar</a></button>      
            <button><a href="Excluir.html">Excluir</a></button>   
        </div>
        <br>

        <table>
            <tr>
                <th style="text-align:center; width: 50%">Id</th>
                <th style="text-align:center; width: 50%">Nome do Autor</th>
            </tr>
        </table>

        <script>
            // Função para carregar os dados da API
            async function carregarAutores() {
                try {
                    const response = await fetch('https://localhost/catalogo-de-livros/BackEnd/Autor/APIListarAutores.php');
                    const data = await response.json();

                    if (data.sucesso) {
                        const table = document.querySelector('table');
                        data.autores.forEach(autor => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td style="text-align:center; width: 50%">${autor.id_autor}</td>
                                <td style="text-align:center; width: 50%">${autor.nome_autor}</td>
                            `;
                            table.appendChild(row);
                        });
                    } else {
                        alert('Erro ao carregar autores: ' + data.erro);
                    }
                } catch (error) {
                    alert('Erro ao conectar à API: ' + error.message);
                }
            }

            // Chama a função ao carregar a página
            carregarAutores();
        </script>
    </div>
</body>
</html>
