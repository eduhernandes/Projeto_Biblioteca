<?php
require_once __DIR__ . '/auth.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sistema de Biblioteca para gerenciamento de livros e leitores.">
    <title>Página Inicial - Sistema Biblioteca</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <div style="display:flex; justify-content:space-between; align-items:center; gap:1rem; margin-bottom:1rem;">
            <h1 class="text-center" style="margin:0;">Bem-vindo, <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?></h1>
            <a href="logout.php" class="button secondary">Sair</a>
        </div>
    </header>
    <main class="container">
        <p>Escolha uma das opções abaixo para continuar:</p>

        <div class="button-group">
            <h2>Leitores</h2>
            <a href="./readers/form.php" class="button">Cadastrar Leitores</a>
            <a href="./readers/listar.php" class="button">Listar Leitores</a>
        </div>

        <div class="button-group">
            <h2>Livros</h2>
            <a href="./books/form.php" class="button">Cadastrar Livros</a>
            <a href="./books/listar.php" class="button">Alterar/Excluir Livros</a>
        </div>

        <div class="button-group">
            <h2>Empréstimos</h2>
            <a href="./loans/form.php" class="button">Cadastrar Empréstimo</a>
            <a href="./loans/listar.php" class="button">Consultar Empréstimos</a>
        </div>

        <?php if (($_SESSION['usuario_tipo'] ?? '') === 'admin'): ?>
            <div class="button-group">
                <h2>Usuários</h2>
                <a href="./usuarios/form.php" class="button">Cadastrar Usuário</a>
                <a href="./usuarios/listar.php" class="button">Listar Usuários</a>
            </div>
        <?php endif; ?>
    </main>
    <footer>
        <p>&copy; 2024 Sistema Biblioteca. Todos os direitos reservados.</p>
    </footer>
</body>
</html>
