<?php
// Conexão com o banco de dados
include "config.php";

if (isset($_GET['codleitor'])) {
    $codleitor = $_GET['codleitor'];

    // Prepara e executa a exclusão
    $stmt = $conn->prepare(query: "DELETE FROM leitores WHERE CodLeitor = ?");
    $stmt->bind_param( "s", $codleitor);
    
    if ($stmt->execute()) {
        echo "Cadastro excluído com sucesso.";
    } else {
        echo "Erro ao excluir cadastro: " . $stmt->error;
    }

    $stmt->close();
}
$conn->close();
?>