<?php
require_once __DIR__ . '/../auth.php';
requirePermission(['admin']);
include __DIR__ . '/../db.php';

$sql = 'SELECT CodUsuario, Nome, Email, Tipo, Status, DataCadastro FROM usuarios ORDER BY Nome ASC';
$result = $conn->query($sql);
$conn->close();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários Cadastrados</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.php" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Usuários cadastrados</h3>
        <hr>
    </header>

    <main class="container">
        <p><a href="form.php" class="button">Novo usuário</a></p>

        <?php if ($result && $result->num_rows > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Tipo</th>
                        <th>Status</th>
                        <th>Data de cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($usuario = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($usuario['CodUsuario']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Email']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Tipo']); ?></td>
                            <td><?php echo htmlspecialchars($usuario['Status']); ?></td>
                            <td><?php echo htmlspecialchars(date('d/m/Y H:i', strtotime($usuario['DataCadastro']))); ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Nenhum usuário encontrado.</p>
        <?php endif; ?>
    </main>
</body>
</html>
