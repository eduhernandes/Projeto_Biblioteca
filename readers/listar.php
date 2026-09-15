<?php
include "../db.php";

$sql = "SELECT * FROM leitores ORDER BY CodLeitor ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leitores Cadastrados</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">LEITORES CADASTRADOS</h3>
        <hr>
    </header>

    <main class="container">
        <p><a href="form.php"><button type="button">Novo cadastro</button></a></p>

        <?php if ($result && $result->num_rows > 0): ?>
            <table border="1" cellpadding="8" cellspacing="0">
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>Celular</th>
                        <th>E-mail</th>
                        <th>RA</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($leitor = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($leitor['CodLeitor']); ?></td>
                            <td><?php echo htmlspecialchars($leitor['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($leitor['Celular']); ?></td>
                            <td><?php echo htmlspecialchars($leitor['Email']); ?></td>
                            <td><?php echo htmlspecialchars($leitor['RA']); ?></td>
                            <td>
                                <a href="editar.php?codleitor=<?php echo urlencode($leitor['CodLeitor']); ?>">Editar</a> |
                                <a href="excluir.php?codleitor=<?php echo urlencode($leitor['CodLeitor']); ?>" onclick="return confirm('Deseja realmente excluir este leitor?');">Excluir</a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum leitor encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>

<?php $conn->close(); ?>
