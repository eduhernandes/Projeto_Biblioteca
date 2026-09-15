<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Leitores</title>
  <link rel="stylesheet" href="../style.css">
</head>
<body>
  <header>
    <a href="../index.html"><button title="Voltar ao início">Home</button></a>
    <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
    <h3 class="text-center">CADASTRO DE LEITORES</h3>
    <hr>
  </header>

  <main class="container">
    <form action="cadastrar.php" method="post">
      <div>
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required />
      </div>
      <div>
        <label for="dtnasc">Data de Nascimento:</label>
        <input type="date" id="dtnasc" name="dtnasc" required />
      </div>
      <div>
        <label for="celular">Celular:</label>
        <input type="tel" id="celular" name="celular" required />
      </div>
      <div>
        <label for="email">E-mail:</label>
        <input type="email" id="email" name="email" required />
      </div>
      <div>
        <label for="ra">RA:</label>
        <input type="text" id="ra" name="ra" required />
      </div>
      <div>
        <label for="endereco">Endereço:</label>
        <input type="text" id="endereco" name="endereco" required />
      </div>
      <div>
        <label for="num_end">Número:</label>
        <input type="number" id="num_end" name="num_end" min="1" required />
      </div>
      <div>
        <label for="bairro">Bairro:</label>
        <input type="text" id="bairro" name="bairro" required />
      </div>
      <div>
        <label for="cidade">Cidade:</label>
        <input type="text" id="cidade" name="cidade" required />
      </div>
      <div>
        <button type="submit">Cadastrar</button>
        <a href="index.php"><button type="button">Listar Leitores</button></a>
      </div>
    </form>
  </main>
</body>
</html>
