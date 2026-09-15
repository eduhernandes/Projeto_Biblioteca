<!DOCTYPE html>
<html>
<head>
    <title>Agenda de Contatos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
        <a href="index.html"><button title="Voltar ao início">Home</button></a>
        <h1 class="text-center">SISTEMA BIBLIOTECA</h1>
        <h3 class="text-center">CADASTRO DE LEITORES</h3>
        <hr>
</header>
<?php
// Conexão com o banco de dados
include "config.php";

if (isset($_GET['codleitor'])) {
    $codleitor = $_GET['codleitor'];

    // Certifique-se de que o codleitor é um número inteiro para evitar SQL Injection
    $codleitor = (int)$codleitor;

    // Executando a consulta diretamente
    $sql = "DELETE FROM leitores WHERE CodLeitor = $codleitor";

    if (mysqli_query($conn, $sql)) {
        echo "Cadastro excluído com sucesso.";
    } else {
        echo "Erro ao excluir cadastro: " . mysqli_error($conn);
    }
}

$conn->close();
?>

</body>
</html>