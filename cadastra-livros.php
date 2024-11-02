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
    echo "Cadastro realizado com sucesso!!<br>";
    echo "<a href='index.php'><button title='Home page'>Voltar</button></a>";
    echo "</center>";
} else {
    echo "<center>";
    echo "Erro ao cadastrar!!<br>";
    echo "<a href='index.php'><button title='Home page'>Voltar</button></a>";
    echo "</center>";
}
?>