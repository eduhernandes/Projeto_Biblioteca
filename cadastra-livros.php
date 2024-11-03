<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Livros</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <header>
    <a href="index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">CADASTRO DE LIVROS</h3>
    <hr>
  </header>
<main>
<?php
// Inclui o arquivo de configuração (conexão com banco de dados)
include "config.php";
// Verifica se a conexão com o banco foi bem-sucedida
if (!$conn){
    // Se a conexão falhar, exibe uma mensagem de erro e encerra a execução
    die("Falha na conexão: " . mysqli_connect_error());
}

//recebe os dados do formulário
$titulo = $_POST['titulo'];
$autor = $_POST['autor'];
$editora = $_POST['editora'];
$sinopse = $_POST['sinopse'];
$ano_pub = $_POST['ano_pub'];
$genero = $_POST['genero'];
$paginas = $_POST['paginas'];

//cria variável para inserir o registro
$sql = "INSERT INTO `livros` 
(`Titulo`, `Autor`, `Editora`, `Sinopse`, `AnoPublicacao`, `Genero`, `Paginas`) VALUES ('$titulo', '$autor', '$editora', '$sinopse', '$ano_pub', '$genero', '$paginas')";

// Executa a consulta SQL. Se falhar, exibe o erro do banco de dados
$query = mysqli_query(mysql: $conn,query: $sql) or 
die(mysqli_error(mysql: $conn));

if($query){
    echo "<center>";
    echo "<h3 class='text-center'>Cadastro realizado com sucesso!!</h3><br>";
    echo "<a href='index.html'><button title='Home page'>Voltar</button></a>";
    echo "</center>";
} else {
    echo "<center>";
    echo "<h3 class='text-center'>Erro ao cadastrar!!<br>";
    echo "<a href='index.html'><button title='Home page'>Voltar</button></a>";
    echo "</center>";
}
?>
</main>
</body>
</html>
