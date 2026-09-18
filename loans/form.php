<?php
include "../db.php";

$sql_leitores = "SELECT CodLeitor, Nome FROM leitores ORDER BY Nome";
$sql_livros = "SELECT CodLivro, Titulo FROM livros ORDER BY Titulo";

$result_leitores = $conn->query($sql_leitores);
$result_livros = $conn->query($sql_livros);
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Empréstimos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Cadastro de Empréstimos</h3>
        <hr>
    </header>

    <main class="container">
        <form action="cadastrar.php" method="post">
            <div>
                <label for="codleitor">Leitor:</label>
                <select id="codleitor" name="codleitor" required>
                    <option value="">Selecione um leitor</option>
                    <?php while ($leitor = $result_leitores->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($leitor['CodLeitor']); ?>">
                            <?php echo htmlspecialchars($leitor['CodLeitor'] . ' - ' . $leitor['Nome']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="codlivro">Livro:</label>
                <select id="codlivro" name="codlivro" required>
                    <option value="">Selecione um livro</option>
                    <?php while ($livro = $result_livros->fetch_assoc()): ?>
                        <option value="<?php echo htmlspecialchars($livro['CodLivro']); ?>">
                            <?php echo htmlspecialchars($livro['CodLivro'] . ' - ' . $livro['Titulo']); ?>
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>
            <div>
                <label for="data_emprestimo">Data do Empréstimo:</label>
                <input type="date" id="data_emprestimo" name="data_emprestimo" required />
            </div>
            <div>
                <label for="data_devolucao">Data de Devolução:</label>
                <input type="date" id="data_devolucao" name="data_devolucao" required />
            </div>
            <div>
                <button type="submit">Cadastrar empréstimo</button>
                <a href="listar.php" class="button secondary">Listar empréstimos</a>
            </div>
        </form>
    </main>
</body>
</html>
