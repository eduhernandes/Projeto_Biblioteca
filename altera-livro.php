<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Cadastro de Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <a href="index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">ALTERAR CADASTRO DE LIVROS</h3>
    <hr>
  </header>
  <main>
  <?php
include "config.php"; // Inclui o arquivo de configuração do banco de dados

// Verifica se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtém os dados do formulário
    $codlivro = $_POST['codlivro'];
    $titulo = $_POST['titulo'];
    $autor = $_POST['autor'];
    $editora = $_POST['editora'];
    $sinopse = $_POST['sinopse'];
    $ano_pub = $_POST['ano_pub'];
    $genero = $_POST['genero'];
    $paginas = $_POST['paginas'];

    $sql = "UPDATE livros SET 
                    Titulo = '$titulo', 
                    Autor = '$autor', 
                    Editora = '$editora', 
                    Sinopse = '$sinopse', 
                    AnoPublicacao = '$ano_pub', 
                    Genero = '$genero', 
                    Paginas = $paginas 
                WHERE CodLivro = $codlivro";

        // Executa a consulta
        if (mysqli_query($conn, $sql)) {
            echo "<p>Livro atualizado com sucesso!</p>";
        } else {
            echo "<p>Erro ao atualizar o livro: " . mysqli_error($conn) . "</p>";
        }
}

// Fecha a conexão com o banco de dados
mysqli_close($conn);

// Redireciona para a página de listagem de livros ou qualquer outra página desejada
echo '<a href="listar-livros.php">Voltar para a lista de livros</a>';
?>
  </main>
</body>
</html>