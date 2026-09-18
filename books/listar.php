<?php
include "../db.php";

$sql = "SELECT * FROM livros ORDER BY CodLivro ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros Cadastrados</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Livros cadastrados</h3>
        <hr>
    </header>

    <main class="container">
        <p><a href="form.php" class="button">Novo cadastro</a></p>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Título</th>
                        <th>Autor</th>
                        <th>Editora</th>
                        <th>Ano</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($livro = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($livro['CodLivro']); ?></td>
                            <td><?php echo htmlspecialchars($livro['Titulo']); ?></td>
                            <td><?php echo htmlspecialchars($livro['Autor']); ?></td>
                            <td><?php echo htmlspecialchars($livro['Editora']); ?></td>
                            <td><?php echo htmlspecialchars($livro['AnoPublicacao']); ?></td>
                            <td>
                                <a href="editar.php?codlivro=<?php echo urlencode($livro['CodLivro']); ?>">Editar</a> |
                                <a href="excluir.php?codlivro=<?php echo urlencode($livro['CodLivro']); ?>" onclick="return confirm('Deseja realmente excluir este livro?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum livro encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
