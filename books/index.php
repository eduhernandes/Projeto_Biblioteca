<?php
require_once '../auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <header>
        <a href="../index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">LIVROS</h3>
        <hr>
    </header>

    <main class="container">
        <div class="button-group">
            <a href="form.php" class="button">Cadastrar livro</a>
            <a href="listar.php" class="button">Listar livros</a>
        </div>
    </main>
</body>
</html>
