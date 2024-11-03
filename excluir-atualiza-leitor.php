<?php
include "config.php";
// Verifica a conexão

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ra = $_POST['ra'];
    $nome = $_POST['nome'];
    $dtnasc = $_POST['dtnasc'];
    $celular = $_POST['celular'];
    $email = $_POST['email'];
    $endereco = $_POST['endereco'];
    $num_end = $_POST['num_end'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];

    // Prepara e executa a atualização
    $stmt = $conn->prepare("UPDATE leitores SET nome=?, dtnasc=?, celular=?, email=?, endereco=?, num_end=?, bairro=?, cidade=? WHERE ra=?");
    $stmt->bind_param("sssssssss", $nome, $dtnasc, $celular, $email, $endereco, $num_end, $bairro, $cidade, $ra);
    
    if ($stmt->execute()) {
        echo "Cadastro atualizado com sucesso.";
    } else {
        echo "Erro ao atualizar cadastro: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>