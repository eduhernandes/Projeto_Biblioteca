<?php
require_once __DIR__ . '/../auth.php';
requirePermission(['admin']);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuários</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.php" class="button secondary" title="Voltar ao início">Home</a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">Cadastro de Usuários</h3>
        <hr>
    </header>

    <main class="container">
        <form action="cadastrar.php" method="post">
            <div>
                <label for="nome">Nome:</label>
                <input type="text" id="nome" name="nome" required />
            </div>

            <div>
                <label for="email">E-mail:</label>
                <input type="email" id="email" name="email" required />
            </div>

            <div>
                <label for="senha">Senha:</label>
                <input type="password" id="senha" name="senha" required />
            </div>

            <div>
                <label for="tipo">Tipo de usuário:</label>
                <select id="tipo" name="tipo" required>
                    <option value="">Selecione</option>
                    <option value="admin">Administrador</option>
                    <option value="bibliotecario">Bibliotecário</option>
                    <option value="usuario">Usuário</option>
                </select>
            </div>

            <div>
                <button type="submit">Cadastrar usuário</button>
                <a href="listar.php" class="button secondary">Listar usuários</a>
            </div>
        </form>
    </main>
</body>
</html>
