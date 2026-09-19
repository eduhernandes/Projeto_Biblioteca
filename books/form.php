<?php
require_once '../auth.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Livros</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header>
    <a href="../index.html" class="button secondary" title="Voltar ao início">Home</a>
    <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
    <h3 class="text-center">Cadastro de Livros</h3>
    <hr>
  </header>

  <main class="container">
    <form action="cadastrar.php" method="post">
      <div>
        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required />
      </div>
      <div>
        <label for="autor">Autor:</label>
        <input type="text" id="autor" name="autor" required />
      </div>
      <div>
        <label for="editora">Editora:</label>
        <input type="text" id="editora" name="editora" required />
      </div>
      <div>
        <label for="sinopse">Sinopse:</label>
        <textarea id="sinopse" name="sinopse" required></textarea>
      </div>
      <div>
        <label for="ano_pub">Ano de Publicação:</label>
        <input type="number" id="ano_pub" name="ano_pub" min="1000" max="2100" required />
      </div>
      <div>
        <label for="genero">Gênero:</label>
        <input type="text" id="genero" name="genero" required />
      </div>
      <div>
        <label for="paginas">Número de Páginas:</label>
        <input type="number" id="paginas" name="paginas" min="1" required />
      </div>
      <div>
        <button type="submit">Cadastrar</button>
        <a href="listar.php" class="button secondary">Listar livros</a>
      </div>
    </form>
  </main>
</body>
</html>
