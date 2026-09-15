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
// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: {$conn->connect_error}");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codleitor = $_POST['codleitor'];
    $nome = $_POST['nome'];
    $dtnasc = $_POST['dtnasc'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $ra = $_POST['ra'];
    $endereco = $_POST['endereco'];
    $num_end = $_POST['num_end'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];

    $sql = "UPDATE leitores SET 
                Nome='$nome', 
                DtNasc='$dtnasc', 
                Celular='$celular', 
                Email='$email',
                RA='$ra', 
                Endereco='$endereco', 
                NumEnd='$num_end', 
                Bairro='$bairro', 
                CidadeUF='$cidade' 
            WHERE CodLeitor='$codleitor'";
    
    $resultado = mysqli_query($conn, $sql);


    if ($resultado) {
        echo "Cadastro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar cadastro: " . mysqli_error($conn); // Corrigido para exibir a mensagem de erro correta
    }

}
$conn->close();
?>

</body>
</html>