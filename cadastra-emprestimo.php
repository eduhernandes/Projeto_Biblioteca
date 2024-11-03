<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empréstimos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <a href="index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">CADASTRO DE EMPRÉSTIMOS</h3>
        <hr>
    </header>
    <main>
        <?php
        // Inclui o arquivo de configuração
        include "config.php";

        // Verifica se a conexão com o banco foi bem-sucedida
        if (!$conn) {
            die("Falha na conexão: " . mysqli_connect_error());
        }

        // Recebe os dados do formulário
        $codleitor = $_POST['codleitor'];
        $codlivro = $_POST['codlivro'];
        $data_emprestimo = $_POST['data_emprestimo'];
        $data_devolucao = $_POST['data_devolucao'];

        // Verifica se o leitor existe
        $sql_leitor = "SELECT * FROM leitores WHERE CodLeitor = $codleitor";
        $result_leitor = mysqli_query($conn, $sql_leitor);

        // Verifica se o livro existe
        $sql_livro = "SELECT * FROM livros WHERE CodLivro = $codlivro";
        $result_livro = mysqli_query($conn, $sql_livro);

        if (mysqli_num_rows($result_leitor) == 0) {
            echo "<p>Erro: Leitor não encontrado!</p>";
        } else if (mysqli_num_rows($result_livro) == 0) {
            echo "<p>Erro: Livro não encontrado!</p>";
        } else {
            // Insere o empréstimo no banco de dados
            $sql = "INSERT INTO emprestimos (CodLeitor, CodLivro, Data_Emprestimo, Data_Devolucao) 
                    VALUES ($codleitor, $codlivro, '$data_emprestimo', '$data_devolucao')";

            if (mysqli_query($conn, $sql)) {
                echo "<p>Empréstimo cadastrado com sucesso!</p>";
            } else {
                echo "<p>Erro ao cadastrar empréstimo: " . mysqli_error($conn) . "</p>";
            }
        }

        mysqli_close($conn);
        ?>
        <br>
        <a href="index.html"><button>Voltar para a página inicial</button></a>
    </main>
</body>
</html>