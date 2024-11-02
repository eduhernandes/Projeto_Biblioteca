<?php
// Conexão com o banco de dados
include "config.php";
// Verifica a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codLeitor = $_POST['codLeitor'];
    $nome = $_POST['nome'];
    $dtnasc = $_POST['dtnasc'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $num_end = $_POST['num_end'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];

    // Prepara e executa a atualização
    $stmt = $conn->prepare("UPDATE leitores SET nome=?, dtnasc=?, celular=?, email=?, endereco=?, num_end=?, bairro=?, cidade=? WHERE CodLeitor=?");
    $stmt->bind_param("sssssssss", $nome, $dtnasc, $celular, $email, $endereco, $num_end, $bairro, $cidade, $codLeitor);
    
    if ($stmt->execute()) {
        echo "Cadastro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar cadastro: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>