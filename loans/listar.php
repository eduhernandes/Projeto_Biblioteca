<?php
require_once "../auth.php";
include "../db.php";

$sql = "
    SELECT e.CodEmprestimo, l.Nome AS NomeLeitor, li.Titulo AS TituloLivro, e.Data_Emprestimo, e.Data_Devolucao
    FROM emprestimos e
    INNER JOIN leitores l ON e.CodLeitor = l.CodLeitor
    INNER JOIN livros li ON e.CodLivro = li.CodLivro
    ORDER BY e.CodEmprestimo DESC
";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Empréstimos</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Empréstimos cadastrados</h3>
        <hr>
    </header>

    <main class="container">
        <p><a href="form.php" class="button">Novo empréstimo</a></p>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Leitor</th>
                        <th>Livro</th>
                        <th>Data Empréstimo</th>
                        <th>Data Devolução</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($emprestimo = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($emprestimo['CodEmprestimo']); ?></td>
                            <td><?php echo htmlspecialchars($emprestimo['NomeLeitor']); ?></td>
                            <td><?php echo htmlspecialchars($emprestimo['TituloLivro']); ?></td>
                            <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($emprestimo['Data_Emprestimo']))); ?></td>
                            <td><?php echo htmlspecialchars(date('d/m/Y', strtotime($emprestimo['Data_Devolucao']))); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum empréstimo encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
