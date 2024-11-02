<?php
// Conexão com o banco de dados
include "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codLeitor = $_POST['codLeitor'];

    // Prepara e executa a consulta
    $stmt = $conn->prepare("SELECT * FROM leitores WHERE CodLeitor = ?");
    $stmt->bind_param("s", $codLeitor);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Exibe os dados do leitor
        $leitor = $result->fetch_assoc();
        echo json_encode($leitor);
    } else {
        echo "Leitor não encontrado.";
    }

    $stmt->close();
}
$conn->close();
?>