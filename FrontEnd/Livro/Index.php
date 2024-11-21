<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Index.css">
    <title>Catálogo de Livros</title>
</head>
<body>
    <h1>Catálogo de Livros</h1>
    <h2>Realize o cadastro de novos livros!</h2>

    <div class="Tabela">
        <div class="Info">
            <button><a href="../Menu de navegação/index.html">Menu</a></button> 
            <button><a href="Adicionar.html">Adicionar</a></button>
            <button><a href="Editar.html">Editar</a></button>      
            <button><a href="Excluir.html">Excluir</a></button> 
        </div>
        <br>

        <!-- Tabela para exibir os livros -->
        <table>
            <thead>
                <tr>
                    <th style="text-align:center; width: 20%">ID</th>
                    <th style="text-align:center; width: 40%">Nome do Livro</th>
                    <th style="text-align:center; width: 20%">Ano de Publicação</th>
                    <th style="text-align:center; width: 20%">Gênero</th>
                    <th style="text-align:center; width: 20%">Autor</th>
                </tr>
            </thead>
            <tbody id="livrosTabela">
                <!-- Linhas serão inseridas dinamicamente -->
            </tbody>
        </table>
    </div>

    <script>
        // URL da API
        const apiUrl = "https://localhost/catalogo-de-livros/BackEnd/Livro/APIListarLivros.php";

        // Função para carregar os livros
        function carregarLivros() {
            fetch(apiUrl)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("Erro na requisição: " + response.status);
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.sucesso) {
                        const livrosTabela = document.getElementById("livrosTabela");

                        // Limpar tabela antes de adicionar novos dados
                        livrosTabela.innerHTML = "";

                        // Iterar pelos livros e adicioná-los na tabela
                        data.livros.forEach(livro => {
                            const row = document.createElement("tr");
                            row.innerHTML = `
                                <td style="text-align:center;">${livro.id_livro}</td>
                                <td style="text-align:center;">${livro.nome_livro}</td>
                                <td style="text-align:center;">${livro.ano_publicacao}</td>
                                <td style="text-align:center;">${livro.nome_genero}</td>
                                <td style="text-align:center;">${livro.nome_autor}</td>
                            `;
                            livrosTabela.appendChild(row);
                        });
                    } else {
                        console.error(data.erro);
                        alert("Erro ao carregar livros: " + data.erro);
                    }
                })
                .catch(error => {
                    console.error("Erro:", error);
                    alert("Ocorreu um erro ao carregar os livros.");
                });
        }

        // Carregar os livros ao carregar a página
        document.addEventListener("DOMContentLoaded", carregarLivros);
    </script>
</body>
</html>
